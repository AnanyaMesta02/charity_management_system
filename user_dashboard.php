<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: index.php");
    exit();
}

include "db.php";
$user_id = $_SESSION['id'];

// Get latest donation (optional, not used here but kept for future use)
$donation_result = mysqli_query($conn, "SELECT * FROM donors WHERE user_id = $user_id ORDER BY donation_date DESC LIMIT 1");
$donor = mysqli_fetch_assoc($donation_result);

// Get all beneficiary requests
$request_result = mysqli_query($conn, "SELECT * FROM beneficiaries WHERE user_id = $user_id ORDER BY request_date DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f0f0; padding: 30px; }
        .container { background: white; padding: 20px; border-radius: 8px; max-width: 900px; margin: auto; }
        h1 { color: #333; }
        nav a { margin-right: 15px; color: #007bff; text-decoration: none; }
        nav a:hover { text-decoration: underline; }

        table { width: 100%; border-collapse: collapse; margin-top: 30px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }

        .status-approved { color: green; font-weight: bold; }
        .status-rejected { color: red; font-weight: bold; }
        .status-pending { color: orange; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <h1>Welcome, <?= htmlspecialchars($_SESSION['name']) ?></h1>

    <nav>
        <a href="donation_entry.php">Enter Donation</a> |
        <a href="view_donor_info.php">My Donation Info</a> |
        <a href="edit_user.php">Edit user information</a> |
        <a href="beneficiary_requests.php">Beneficiary Request</a> |
        <a href="logout.php">Logout</a>
    </nav>

    <h2>Your Beneficiary Request Status</h2>

    <?php if (mysqli_num_rows($request_result) > 0): ?>
        <table>
            <tr>
                <th>Amount Requested</th>
                <th>Reason</th>
                <th>Request Date</th>
                <th>Status</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($request_result)): ?>
                <tr>
                    <td>₹<?= number_format($row['amount_requested'], 2) ?></td>
                    <td><?= htmlspecialchars($row['reason']) ?></td>
                    <td><?= htmlspecialchars($row['request_date']) ?></td>
                    <td>
                        <?php if ($row['status'] === 'approved'): ?>
                            <span class="status-approved">✅ Approved</span>
                        <?php elseif ($row['status'] === 'rejected'): ?>
                            <span class="status-rejected">❌ Rejected</span>
                        <?php else: ?>
                            <span class="status-pending">⏳ Pending</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No beneficiary requests made yet.</p>
    <?php endif; ?>
</div>

</body>
</html>
