<?php
session_start();
include "db.php";

// Check if user is logged in
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'user') {
    header("Location: index.php");
    exit();
}

$userId = $_SESSION['id'];

// Fetch current user info
$result = mysqli_query($conn, "SELECT * FROM users WHERE id = $userId");
$user = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $place = $_POST['place'];

    $update = "UPDATE users SET name='$name', email='$email', phone='$phone', place='$place' WHERE id=$userId";

    if (mysqli_query($conn, $update)) {
        $success = "Profile updated successfully!";
        // Update session data
        $_SESSION['name'] = $name;
    } else {
        $error = "Error updating profile: " . mysqli_error($conn);
    }

    // Refresh user data after update
    $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = $userId"));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f5f7fa; padding: 40px; }
        .form-container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.1);
        }
        h2 { text-align: center; }
        input[type="text"],
        input[type="email"],
        button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #28a745;
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .message {
            text-align: center;
            color: green;
            font-weight: bold;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Edit Your Information</h2>
    <a href="user_dashboard.php"> user_Dashboard</a> |

    <?php if (isset($success)) echo "<p class='message'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p class='message error'>$error</p>"; ?>

    <form method="POST">
        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" placeholder="Full Name" required>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" placeholder="Email" required>
        <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" placeholder="Phone Number" required>
        <input type="text" name="place" value="<?= htmlspecialchars($user['place']) ?>" placeholder="Place" required>
        <button type="submit">Update</button>
    </form>
</div>

</body>
</html>
