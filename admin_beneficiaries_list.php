<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

include "db.php";

// Fetch approved beneficiaries
$result = mysqli_query($conn, "SELECT b.*, u.name, u.email FROM beneficiaries b JOIN users u ON b.user_id = u.id WHERE b.status = 'approved' ORDER BY b.admin_action_date DESC");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Approved Beneficiaries - Admin</title>
    <style>
        body { font-family: Arial; background: #f7f7f7; padding: 20px; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        th { background: #28a745; color: white; }
        nav a { margin-right: 15px; }
    </style>
</head>
<body>

<h2>Approved Beneficiaries</h2>

<nav>
    <a href="admin_dashboard.php">Dashboard</a> |
    <a href="logout.php">Logout</a>
</nav>

<table>
    <tr>
        <th>ID</th>
        <th>User Name</th>
        <th>Email</th>
        <th>Amount Approved (₹)</th>
        <th>Reason</th>
        <th>Approval Date</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?= htmlspecialchars($row['id']) ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['amount_requested']) ?></td>
        <td><?= htmlspecialchars($row['reason']) ?></td>
        <td><?= htmlspecialchars($row['admin_action_date']) ?></td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
