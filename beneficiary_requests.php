<?php
session_start();

// Allow only users
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: index.php");
    exit();
}

include "db.php";

$user_id = (int)$_SESSION['id'];  // cast to int for safety
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = floatval($_POST['amount']);
    $reason = mysqli_real_escape_string($conn, trim($_POST['reason']));

    if ($amount > 0 && !empty($reason)) {
        $insert = "INSERT INTO beneficiaries (user_id, amount_requested, reason, status, request_date) 
                   VALUES ($user_id, $amount, '$reason', 'pending', NOW())";
        if (mysqli_query($conn, $insert)) {
            $message = "Your request has been submitted successfully.";
        } else {
            $message = "Error submitting request: " . mysqli_error($conn);
        }
    } else {
        $message = "Please enter a valid amount and reason.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Beneficiary Request</title>
    <style>
        body { font-family: Arial; background: #f7f7f7; padding: 30px; }
        .container { max-width: 500px; margin: auto; background: white; padding: 20px; border-radius: 8px; }
        label { font-weight: bold; display: block; margin-top: 15px; }
        input[type="number"], textarea { width: 100%; padding: 10px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc; }
        button { margin-top: 20px; padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #218838; }
        .message { margin-top: 15px; color: green; }
        nav a { margin-right: 15px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Request Money as Beneficiary</h2>

    <nav>
        <a href="user_dashboard.php">Dashboard</a> |
        <a href="logout.php">Logout</a>
    </nav>

    <?php if ($message): ?>
        <p class="message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="POST" novalidate>
        <label for="amount">Amount Requested (₹):</label>
        <input type="number" name="amount" id="amount" step="0.01" min="1" required>

        <label for="reason">Reason for Request:</label>
        <textarea name="reason" id="reason" rows="4" required></textarea>

        <button type="submit">Submit Request</button>
    </form>
</div>

</body>
</html>
