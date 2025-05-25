<?php
session_start();

// Check if user is logged in and is a 'user'
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: index.php");
    exit();
}

include "db.php";

$user_id = $_SESSION['id'];

// Fetch donation information for the logged-in user
$query = "SELECT * FROM donors WHERE user_id = $user_id ORDER BY donation_date DESC LIMIT 1";
$result = mysqli_query($conn, $query);
$donor = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Donation Info</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 20px;
            width: 500px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        p {
            font-size: 16px;
            color: #444;
        }
        nav {
            margin-bottom: 20px;
            text-align: center;
        }
        nav a {
            text-decoration: none;
            margin: 0 15px;
            color: #007BFF;
        }
        nav a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Welcome, <?= htmlspecialchars($_SESSION['name']) ?></h2>

    <nav>
        <a href="user_dashboard.php">Dashboard</a> |
        
        <a href="logout.php">Logout</a>
    </nav>

    <h3>My Donation Information</h3>

    <?php if ($donor): ?>
        <p><strong>Donation Amount:</strong> ₹<?= htmlspecialchars($donor['amount']) ?></p>
        <p><strong>Donation Date:</strong> <?= htmlspecialchars($donor['donation_date']) ?></p>
        <p><strong>Status:</strong> <?= htmlspecialchars($donor['status']) ?></p>
    <?php else: ?>
        <p>No donation record found.</p>
    <?php endif; ?>
</div>

</body>
</html>
