<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($pass, $user['password'])) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: user_dashboard.php");
        }
        exit();
    } else {
        echo "<script>alert('Invalid credentials');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
     body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-image: url('background.jpg'); /* Replace with your image path */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .form-box {
        width: 350px;
        padding: 20px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        box-shadow: 0 0 10px gray;
    }

    input, button {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    button {
        background-color: #007BFF;
        color: white;
        border: none;
        font-weight: bold;
    }

    button:hover {
        background-color: #004b9a;
    }
    </style>
</head>
<body>

<div class="form-box">
    <h2>Login</h2>
    <form method="POST">
        <input type="email" name="email" required placeholder="Email">
        <input type="password" name="password" required placeholder="Password">
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
