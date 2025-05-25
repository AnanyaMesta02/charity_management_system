<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

include "db.php";

$query = "SELECT b.*, u.name, u.email 
          FROM beneficiaries b 
          JOIN users u ON b.user_id = u.id 
          WHERE b.status = 'approved'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Received Beneficiaries</title>
    <style>
        body { font-family: Arial; background: #f9f9f9; padding: 30px; }
        table { width: 100%; border-collapse: collapse; background: #fff; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        .container { max-width: 800px; margin: auto; }
    </style>
</head>
<body>

<div class="container">
    <h2>List of Beneficiaries Who Received Help</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Amount</th>
            <th>Reason</th>
            <th>Request Date</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td>₹<?= $row['amount_requested'] ?></td>
                <td><?= htmlspecialchars($row['reason']) ?></td>
                <td><?= $row['request_date'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <a href="admin_dashboard.php">← Back to Dashboard</a>
</div>

</body>
</html>
