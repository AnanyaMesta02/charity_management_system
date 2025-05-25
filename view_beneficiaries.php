<?php
session_start();

// Check if user is logged in (either user or admin can view)
if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit();
}

include "db.php";

// Fetch only approved beneficiaries
$query = "SELECT * FROM beneficiaries WHERE status = 'approved' ORDER BY request_date DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Beneficiaries</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef;
            padding: 20px;
        }
        .container {
            background: #fff;
            padding: 20px;
            max-width: 700px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        nav {
            margin-bottom: 15px;
            text-align: center;
        }
        nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #007BFF;
        }
        nav a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>List of Beneficiaries (Approved)</h2>

    <nav>
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <a href="admin_dashboard.php">Admin Dashboard</a>
        <?php else: ?>
            <a href="user_dashboard.php">User Dashboard</a>
        <?php endif; ?>
        | <a href="logout.php">Logout</a>
    </nav>

    <table>
        <tr>
            <th>Name</th>
            <th>Reason</th>
            <th>Amount</th>
            <th>Approved On</th>
        </tr>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['reason']) ?></td>
                    <td>₹<?= htmlspecialchars($row['requested_amount']) ?></td>
                    <td><?= htmlspecialchars($row['request_date']) ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="4" style="text-align: center;">No beneficiaries found.</td></tr>
        <?php endif; ?>
    </table>
</div>

</body>
</html>
