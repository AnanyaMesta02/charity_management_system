<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

include "db.php";

if (!isset($_GET['donor_id'])) {
    echo "Donor ID not provided.";
    exit();
}

$donor_id = intval($_GET['donor_id']);
$message = "";

// Fetch donor data to pre-fill form
$result = mysqli_query($conn, "SELECT * FROM donors WHERE donor_id = $donor_id");
$donor = mysqli_fetch_assoc($result);

if (!$donor) {
    echo "Donor not found.";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'];
    $donation_date = $_POST['donation_date'];
    $status = $_POST['status'];

    // Update query - note the correct column names!
    $update_sql = "UPDATE donors SET amount='$amount', donation_date='$donation_date', status='$status' WHERE donor_id=$donor_id";
    if (mysqli_query($conn, $update_sql)) {
        $message = "Donor information updated successfully.";
        // Refresh donor data after update
        $result = mysqli_query($conn, "SELECT * FROM donors WHERE donor_id = $donor_id");
        $donor = mysqli_fetch_assoc($result);
    } else {
        $message = "Error updating donor: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Donor Information</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        form { max-width: 400px; margin: auto; }
        label { display: block; margin-top: 10px; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; }
        button { margin-top: 15px; padding: 10px; width: 100%; }
        .message { margin: 15px 0; font-weight: bold; color: green; }
    </style>
</head>
<body>

<h2>Update Donor Information</h2>

<?php if ($message): ?>
    <p class="message"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST">
    <label>Amount:</label>
    <input type="number" step="0.01" name="amount" value="<?= htmlspecialchars($donor['amount']) ?>" required>

    <label>Donation Date:</label>
    <input type="date" name="donation_date" value="<?= htmlspecialchars($donor['donation_date']) ?>" required>

    <label>Status:</label>
    <select name="status" required>
        <option value="pending" <?= $donor['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
        <option value="approved" <?= $donor['status'] === 'approved' ? 'selected' : '' ?>>Approved</option>
        <option value="rejected" <?= $donor['status'] === 'rejected' ? 'selected' : '' ?>>Rejected</option>
    </select>

    <button type="submit">Update</button>
</form>

<p><a href="view_all_donors.php">Back to All Donors</a></p>

</body>
</html>
