<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = htmlspecialchars($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fcd835;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .welcome-box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }
        h1 {
            color: #c69400;
            font-size: 2rem;
        }
        a.logout {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background: #c69400;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        a.logout:hover {
            background: #a87600;
        }
    </style>
</head>
<body>
<div class="welcome-box">
    <h1>Login Successful!<br>Welcome, <?= $username ?> 🎉</h1>
    <a href="logout.php" class="logout">Logout</a>
</div>
</body>
</html>
