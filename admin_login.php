<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND role='admin'");
    $admin = mysqli_fetch_assoc($result);

    if ($admin && password_verify($pass, $admin['password'])) {
        $_SESSION['id'] = $admin['id'];
        $_SESSION['name'] = $admin['name'];
        $_SESSION['role'] = $admin['role'];

        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Invalid credentials or not an admin!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body { 
            font-family: Arial; 
            background: #f2f2f2; 
            padding: 40px; 
        }
        form { 
            max-width: 400px; 
            margin: auto; 
            background: #fff; 
            padding: 20px; 
            border-radius: 10px;  
        }
        input, button { 
            width: 100%; 
            padding: 10px; 
            margin: 10px 0;
        }
        button {
            background-color: #28a745; /* Green */
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #218838; /* Darker green */
        }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Admin Login</h2>
        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
        Email: <input type="email" name="email" required>
        Password: <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>

