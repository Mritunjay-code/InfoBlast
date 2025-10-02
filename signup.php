<?php
session_start();

if ($_POST) {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Simple validation
    if (empty($username) || empty($email) || empty($password)) {
        $error = 'All fields are required';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters';
    } else {
        // In production, save to database with password hashing
        $success = 'Account created successfully! You can now log in.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - College Notice Board</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .auth-form {
            max-width: 400px;
            margin: 80px auto;
            background: rgba(255,255,255,0.9);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 600;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #8de08d;
            border-radius: 10px;
            font-size: 16px;
            outline: none;
        }
        .form-group input:focus {
            border-color: #68ac75;
        }
        .auth-btn {
            width: 100%;
            padding: 12px;
            background-color: #68ac75;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-bottom: 15px;
        }
        .auth-btn:hover {
            background-color: #5a9b60;
        }
        .error {
            color: #e74c3c;
            margin-bottom: 15px;
            text-align: center;
        }
        .success {
            color: #27ae60;
            margin-bottom: 15px;
            text-align: center;
        }
        .auth-link {
            text-align: center;
            color: #2c3e50;
        }
        .auth-link a {
            color: #4a90e2;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <div class="logo-circle">📋</div>
        </div>
        <nav>
            <a href="index.html">Home</a>
            <a href="login.php">log In</a>
        </nav>
    </header>

    <div class="auth-form">
        <h2 style="text-align: center; margin-bottom: 30px; color: #2c3e50;">Sign Up</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <div class="success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" required>
            </div>
            <button type="submit" class="auth-btn">Sign Up</button>
        </form>
        <div class="auth-link">
            Already have an account? <a href="login.php">log In</a>
        </div>
    </div>
</body>
</html>