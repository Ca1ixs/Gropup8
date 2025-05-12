<?php
require_once 'db.php';

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirmPassword = htmlspecialchars(trim($_POST['confirm_password']));

    if (strlen($password) < 8) {
        $error = "Password must be at least 8 characters long.";
    } elseif ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashedPassword);

        if ($stmt->execute()) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Error: " . $stmt->error;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up</title>
  <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fcd835;
        }

        .split-screen {
            display: flex;
            width: 90%;
            max-width: 950px;
            height: 85vh;
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .left-side {
            flex: 1;
            background-color: skyblue;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
        }

        .left-side h1 {
            font-size: 2.8rem;
            font-weight: 700;
            line-height: 1.3;
        }

        .left-side .brand {
            font-size: 2.3rem;
            color: #fcd835;
            font-family: 'Georgia', serif;
            margin-top: 10px;
        }

        .right-side {
            flex: 1;
            background-color: white;
            padding: 60px 50px 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .right-side h2 {
            font-size: 2rem;
            color: #c69400;
            font-weight: 800;
            margin-bottom: 0.25rem;
        }

        .right-side small {
            margin-bottom: 1.5rem;
            color: #555;
        }

        form {
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
        }

        form button {
            width: 100%;
            padding: 12px;
            background-color: #f0b400;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            margin-bottom: 20px;
        }

        form button:hover {
            background-color: #d19900;
        }

        .right-side label {
            font-size: 0.9rem;
            margin-bottom: 16px;
            color: #555;
            display: flex;
            align-items: center;
        }

        .right-side label input[type="checkbox"] {
            margin-right: 8px;
        }

        .social-button {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: black;
            color: white;
            padding: 10px;
            margin-top: 12px;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .social-button:hover {
            background-color: #333;
        }

        .social-button img {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        p.error {
            color: red;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }

        p.success {
            color: green;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }

        small a {
            color: #c69400;
            text-decoration: none;
        }

        small a:hover {
            text-decoration: underline;
        }

        small:last-child {
            margin-top: 15px;
        }
    </style>
</head>
<body>
  <div class="split-screen">
    <div class="left-side">
      <h1>Join<br>our community</h1>
      <div class="brand">Compass</div>
    </div>
    <div class="right-side">
  <h2>Create Account</h2>
  <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
  <form action="" method="POST">
    <input type="text" name="username" placeholder="Enter your username" required>
    <input type="email" name="email" placeholder="Enter your email" required>
    <input type="password" name="password" placeholder="Enter your password" required>
    <input type="password" name="confirm_password" placeholder="Confirm your password" required>
    <small>By signing up, you agree to our <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a>.</small>
    <button type="submit">Sign Up</button>
  </form>
  <small>Already have an account? <a href="login.php">Sign-in.</a></small>
</div>
  </div>
</body>
</html>
