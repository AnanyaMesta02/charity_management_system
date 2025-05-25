<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address']; // New
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'user';

    // Check if email already exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check) > 0) {
        $message = "Error: Email already registered. Please use a different email.";
    } else {
        $query = "INSERT INTO users (name, email, phone, place, password, role) 
                  VALUES ('$name', '$email', '$phone', '$address', '$password', '$role')";
        if (mysqli_query($conn, $query)) {
            $message = "Registration successful. <a href='index.php'>Login here</a>.";
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <style>
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-container {
            background-color: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            margin-top: 15px;
            color: red;
        }
        .success {
            color: green;
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2>User Registration</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required><br>
        <input type="email" name="email" placeholder="Email Address" required><br>
        <input type="text" name="phone" placeholder="Phone Number" required><br>
        <input type="text" name="address" placeholder="Address" required><br> <!-- New field -->
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
    </form>

    <?php if (isset($message)): ?>
        <div class="message <?= strpos($message, 'successful') !== false ? 'success' : '' ?>">
            <?= $message ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
