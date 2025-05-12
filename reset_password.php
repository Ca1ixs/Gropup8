<?php
date_default_timezone_set('Asia/Manila'); // Set the timezone

require_once 'db.php';

$message = '';
$show_form = false;

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if token is valid and not expired
    $stmt = $conn->prepare("SELECT * FROM users WHERE reset_token = ? AND reset_expires > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        $show_form = true;
        $user_id = $user['id'];
    } else {
        $message = "Invalid or expired token.";
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'], $_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];

    if (strlen($password) < 6) {
        $message = "Password must be at least 6 characters.";
        $show_form = true;
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_expires = NULL WHERE id = ?");
        $stmt->bind_param("si", $hashed_password, $user_id);

        if ($stmt->execute()) {
            $message = "Password successfully reset! You can now <a href='login.php'>log in</a>.";
            $show_form = false;
        } else {
            $message = "Error updating password. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
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

        input[type="password"], button {
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
    <h2>Reset Your Password</h2>

    <?php if ($message): ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <?php if ($show_form): ?>
        <form method="POST">
            <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id) ?>">
            <input type="password" name="password" placeholder="Enter new password" required>
            <button type="submit">Update Password</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>