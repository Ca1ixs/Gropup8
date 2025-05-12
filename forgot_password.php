<?php
date_default_timezone_set('Asia/Manila'); // Set the timezone

require_once 'db.php';

// Set a message variable to show notifications to the user.
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];

    // Check if email exists in the database
    $stmt = $conn->prepare("SELECT id, email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        // Generate a unique token
        $token = bin2hex(random_bytes(16));
        $expires = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token expires in 1 hour

        // Store the token and expiration time in the database
        $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_expires = ? WHERE id = ?");
        $stmt->bind_param("ssi", $token, $expires, $user['id']);
        $stmt->execute();

        // Send the password reset email
        $reset_link = "http://yourwebsite.com/reset_password.php?token=" . $token;
        $subject = "Password Reset Request";
        $message_body = "Hello,\n\nYou requested a password reset. Click the link below to reset your password:\n\n" . $reset_link . "\n\nIf you did not request this, please ignore this email.";

        if (mail($email, $subject, $message_body)) {
            $message = "A password reset link has been sent to your email.";
        } else {
            $message = "There was an issue sending the password reset email. Please try again later.";
        }
    } else {
        $message = "No account found with that email address.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #fcd835;
        }

        .reset-box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 400px;
            text-align: center;
        }

        input[type="email"], button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            font-size: 16px;
        }

        button {
            background-color: #f0b400;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background-color: #d19900;
        }

        p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="reset-box">
    <h2>Forgot Password</h2>

    <?php if ($message): ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Enter your email" required>
        <button type="submit">Send Reset Link</button>
    </form>
</div>
</body>
</html>
