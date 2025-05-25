<?php
session_start();

// Allow only admin users
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

include "db.php";
$message = "";

// Handle status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_id'], $_POST['new_status'])) {
    $request_id = (int)$_POST['request_id'];
    $new_status = mysqli_real_escape_string($conn, $_POST['new_status']);

    $update = "UPDATE beneficiaries SET status = '$new_status' WHERE id = $request_id";
    if (mysqli_query($conn, $update)) {
        $message = "Request status updated successfully.";
    } else {
        $message = "Error updating status: " . mysqli_error($conn);
    }
}

// Fetch all beneficiary requests
$requests = mysqli_query($conn, "
    SELECT b.id, u.name, b.amount_requested, b.reason, b.status, b.request_date 
    FROM beneficiaries b 
    JOIN users u ON b.user_id = u.id
    ORDER BY b.request_date DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Beneficiary Requests</title>
    <style>
        body { font-family: Arial; background: #f5f5f5; padding: 30px; }
        .container { max-width: 1000px; margin: auto; background: white; padding: 20px; border-radius: 8px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        th { background-color: #f2f2f2; }
        select, button { padding: 6px 10px; border-radius: 5px; }
        button { background: #007bff; color: white; border: none; }
        button:hover { background: #0056b3; }
        .message { color: green; margin-top: 15px; }
        nav a { margin-right: 15px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Manage Beneficiary Requests</h2>
    <nav>
        <a href="admin_dashboard.php">Dashboard</a> |
        <a href="logout.php">Logout</a>
    </nav>

    <?php if ($message): ?>
        <p class="message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <table>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Amount</th>
            <th>Reason</th>
            <th>Status</th>
            <th>Request Date</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($requests)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td>₹<?= number_format($row['amount_requested'], 2) ?></td>
            <td><?= htmlspecialchars($row['reason']) ?></td>
            <td><?= htmlspecialchars($row['status']) ?></td>
            <td><?= $row['request_date'] ?></td>
            <td>
                <form method="POST" style="display:flex; gap:5px;">
                    <input type="hidden" name="request_id" value="<?= $row['id'] ?>">
                    <select name="new_status" required>
                        <option value="">--Select--</option>
                        <option value="approved">Approve</option>
                        <option value="rejected">Reject</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
