<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: index.php");
    exit();
}
include "db.php";

$user_id = $_SESSION['id'];
$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount = $_POST['amount'];
    $date = $_POST['donation_date'];

    $insert = "INSERT INTO donors (user_id, amount, donation_date, status) VALUES ('$user_id', '$amount', '$date', 'pending')";
    if (mysqli_query($conn, $insert)) {
        $message = "Donation details submitted successfully!";
    } else {
        $message = "Error submitting donation: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enter Donation Details</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        form { max-width: 400px; margin: auto; }
        input, button { padding: 10px; margin: 10px 0; width: 100%; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h2>Enter Donation Details</h2>
    <a href="user_dashboard.php"> user Dashboard</a> |
    <?php if ($message): ?>
        <p class="<?= strpos($message, 'successfully') !== false ? 'success' : 'error' ?>"><?= $message ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Donation Amount:</label>
        <input type="number" name="amount" step="0.01" required>

        <label>Donation Date:</label>
        <input type="date" name="donation_date" required>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
