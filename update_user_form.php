<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: admin_login.php");
    exit();
}

include "db.php";

// Fetch all donors with user info
$donors = mysqli_query($conn, "SELECT d.*, u.name, u.email FROM donors d JOIN users u ON d.user_id = u.id");

// Initialize donor variable
$donor = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['select_donor'])) {
    $donor_id = intval($_POST['selected_donor']);
    $query = "SELECT d.*, u.name, u.email FROM donors d JOIN users u ON d.user_id = u.id WHERE d.donor_id = $donor_id";
    $result = mysqli_query($conn, $query);
    $donor = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_donation'])) {
    $donor_id = intval($_POST['donor_id']);
    $amount = floatval($_POST['amount']);
    $donation_date = mysqli_real_escape_string($conn, $_POST['date']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $updateQuery = "UPDATE donors SET amount='$amount', donation_date='$donation_date', status='$status' WHERE donor_id='$donor_id'";
    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Donation record updated successfully');</script>";
    } else {
        echo "<script>alert('Error updating donation');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Donor Info</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 30px; }
        .container { max-width: 600px; background: #fff; padding: 20px; margin: auto; border-radius: 10px; }
        label { font-weight: bold; }
        input, select {
            width: 100%; padding: 10px; margin: 10px 0; border-radius: 5px; border: 1px solid #ccc;
        }
        button { background-color: #007BFF; color: white; padding: 10px 20px; border: none; border-radius: 5px; }
        button:hover { background-color: #0056b3; }
        a { display: block; margin-top: 20px; text-align: center; color: #007BFF; }
    </style>
</head>
<body>

<div class="container">
    <h2>Select Donor to Update</h2>

    <form method="POST">
        <label>Select Donor:</label>
        <select name="selected_donor" required>
            <option value="">-- Select a Donor --</option>
            <?php while ($row = mysqli_fetch_assoc($donors)): ?>
                <option value="<?= $row['donor_id'] ?>" <?= (isset($donor) && $donor['donor_id'] == $row['donor_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($row['name']) ?> (<?= htmlspecialchars($row['email']) ?>)
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit" name="select_donor">Load Donor</button>
    </form>

    <?php if ($donor): ?>
        <hr>
        <form method="POST">
            <input type="hidden" name="donor_id" value="<?= $donor['donor_id'] ?>">

            <label>Name:</label>
            <input type="text" value="<?= htmlspecialchars($donor['name']) ?>" readonly>

            <label>Email:</label>
            <input type="email" value="<?= htmlspecialchars($donor['email']) ?>" readonly>

            <label>Amount:</label>
            <input type="number" name="amount" value="<?= $donor['amount'] ?>" required>

            <label>Date:</label>
            <input type="date" name="date" value="<?= $donor['donation_date'] ?>" required>

            <label>Status:</label>
            <select name="status" required>
                <option value="pending" <?= $donor['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="approved" <?= $donor['status'] === 'approved' ? 'selected' : '' ?>>Approved</option>
                <option value="rejected" <?= $donor['status'] === 'rejected' ? 'selected' : '' ?>>Rejected</option>
            </select>

            <button type="submit" name="update_donation">Update</button>
        </form>
    <?php endif; ?>

    <a href="admin_dashboard.php">← Back to Dashboard</a>
</div>

</body>
</html>
