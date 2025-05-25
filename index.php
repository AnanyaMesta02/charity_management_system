<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Charity Donation System</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Roboto', sans-serif;
            background: #f4f7f8;
            margin: 0;
            padding: 0;
        }
        .header {
            background: white;
            height: 280px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white ;
            text-shadow: 0 2px 5px rgba(0,0,0,0.6);
            padding: 20px;
        }
        .header h1 {
            font-size: 2.8rem;
            margin: 0;
            max-width: 700px;
            color: #444;
        }
        .container {
            max-width: 500px;
            margin: -50px auto 40px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            padding: 30px 20px;
            text-align: center;
        }
        .container p {
            color: #444;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .btn {
            display: block;
            width: 85%;
            max-width: 300px;
            margin: 12px auto;
            padding: 12px;
            font-size: 16px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn i {
            margin-right: 8px;
        }
        .image-section {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            padding: 30px 20px;
        }
        .image-section img {
            width: 220px;
            height: 140px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
        footer {
            text-align: center;
            padding: 12px;
            font-size: 14px;
            color: #666;
            border-top: 1px solid #ddd;
            background: #fff;
        }
    </style>
</head>
<body>
<div class="header">
    <img src="https://png.pngtree.com/png-clipart/20190924/original/pngtree-charity-icon-in-trendy-style-isolated-background-png-image_4830017.jpg" alt="Charity Logo" style="width: 80px; height: 80px; margin-bottom: 10px;">
    <h1>Welcome to CareSphere</h1>
</div>



<!-- Action Box -->
<div class="container">
    <p><strong>Join us in making a difference.</strong><br>Select one of the options below to get started:</p>
    <a href="register.php" class="btn"><i class="fas fa-user-plus"></i> User Registration</a>
    <a href="admin_login.php" class="btn"><i class="fas fa-user-shield"></i> Admin Login</a>
    <a href="login.php" class="btn"><i class="fas fa-sign-in-alt"></i> User Login</a>
</div>

<!-- Charity Images -->
<div class="image-section">
    <img src="https://avonriverventures.com/wp-content/uploads/2023/10/donate-sign-charity-campaign.jpg" alt="Helping Children">
    <img src="https://pce.sandiego.edu/wp-content/uploads/2022/11/private-foundation-vs-public-charity.jpg" alt="Community Support">
    <img src="https://tse2.mm.bing.net/th?id=OIP.XjPjgXJp-ZtzVumeKpPEKAHaE8&pid=Api&P=0&h=180" alt="Donation Efforts">
</div>

<!-- Footer -->
<footer>
    &copy; 2025 Charity Donation System. Empowering kindness and support.
</footer>

</body>
</html>
