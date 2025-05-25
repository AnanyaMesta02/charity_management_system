<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

include "db.php";

// Handle Approve or Reject actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && isset($_POST['beneficiary_id'])) {
    $beneficiary_id = intval($_POST['beneficiary_id']);
    
    if ($_POST['action'] === 'approve') {
        $updateQuery = "UPDATE beneficiaries SET status = 'approved' WHERE id = $beneficiary_id";
        mysqli_query($conn, $updateQuery);
    } elseif ($_POST['action'] === 'reject') {
        $deleteQuery = "DELETE FROM beneficiaries WHERE id = $beneficiary_id";
        mysqli_query($conn, $deleteQuery);
    }

    // Refresh to show updated data
    header("Location: view_beneficiary_requests.php");
    exit();
}

// Fetch all beneficiary requests
$query = "SELECT b.*, u.name, u.email 
          FROM beneficiaries b
          JOIN users u ON b.user_id = u.id
          ORDER BY b.request_date DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Beneficiary Requests</title>
    <style>
        body { font-family: Arial; background: #f0f0f0; padding: 20px; }
        .container { background: white; padding: 20px; border-radius: 10px; max-width: 1000px; margin: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        h2 { text-align: center; }
        a { display: block; margin-top: 20px; text-align: center; color: #007bff; }
        form button {
            margin-right: 5px;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }
        .approve { background-color: green; }
        .reject { background-color: red; }
    </style>
</head>
<body>

<div class="container">
    <h2>All Beneficiary Requests</h2>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <tr>
                <th>User Name</th>
                <th>Email</th>
                <th>Amount Requested</th>
                <th>Reason</th>
                <th>Date Requested</th>
                
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td>₹<?= number_format($row['amount_requested'], 2) ?></td>
                    <td><?= htmlspecialchars($row['reason']) ?></td>
                    <td><?= htmlspecialchars($row['request_date']) ?></td>
                    
                    <td>
                        <?php if (($row['status'] ?? 'pending') === 'pending'): ?>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="beneficiary_id" value="<?= $row['id'] ?>">
                                <button type="submit" name="action" value="approve" class="approve">Approve</button>
                                <button type="submit" name="action" value="reject" class="reject" onclick="return confirm('Are you sure you want to reject and delete this request?');">Reject</button>
                            </form>
                        <?php else: ?>
                            <?= ucfirst($row['status']) ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No requests found.</p>
    <?php endif; ?>

    <a href="admin_dashboard.php">← Back to Dashboard</a>
</div>

</body>
</html>
