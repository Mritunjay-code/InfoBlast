<?php
session_start();

if ($_POST) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Simple validation (in production, use secure password hashing)
    if ($username === 'admin' && $password === 'password') {
        $_SESSION['user'] = $username;
        header('Location: index.html');
        exit;
    } else {
        $error = 'Invalid credentials';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>log In - College Notice Board</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .auth-form {
            max-width: 400px;
            margin: 100px auto;
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
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-bottom: 15px;
        }
        .auth-btn:hover {
            background-color: #357abd;
        }
        .error {
            color: #e74c3c;
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
            <a href="signup.php">Sign Up</a>
        </nav>
    </header>

    <div class="auth-form">
        <h2 style="text-align: center; margin-bottom: 30px; color: #2c3e50;">log In</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="auth-btn">log In</button>
        </form>
        <div class="auth-link">
            Don't have an account? <a href="signup.php">Sign Up</a>
        </div>
    </div>
</body>
</html>