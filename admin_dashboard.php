<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #e0f7fa, #fff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .dashboard-container {
            background-color: #ffffff;
            padding: 40px 50px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 600px;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
        }

        .nav a {
            display: inline-block;
            margin: 12px;
            padding: 14px 24px;
            background:  #007BFF ;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .nav a:hover {
            background: gray;
            transform: scale(1.05);
        }

        .logout-btn {
            background: #dc3545 !important;
        }

        .logout-btn:hover {
            background: #c82333 !important;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <h1>Welcome, Admin</h1>
    <div class="nav">
        <a href="view_all_donors.php">View All Donors</a>
        <a href="update_user_form.php">Update User Details</a>
        <a href="view_beneficiary_requests.php">View Beneficiary Requests</a>
        <a href="received_beneficiaries.php">Received Beneficiaries</a>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</div>

</body>
</html>
