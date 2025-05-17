<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        $query = $conn->prepare("INSERT INTO Users (username, password) VALUES (?, ?)");
        $query->bind_param("ss", $username, $password);
        if ($query->execute()) {
            header("Location: login.php");
            exit();
        } else {
            $error_message = "An error occurred. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SIPSAFE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom right, #56ccf2, #2f80ed);
            color: #fff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .register-container {
            background-color: #fff;
            color: #333;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .register-container h1 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .form-control {
            border-radius: 10px;
        }
        .btn-primary {
            background-color: #2f80ed;
            border: none;
            border-radius: 10px;
            padding: 0.8rem;
            font-weight: bold;
        }
        .btn-primary:hover {
            background-color: #1c5db8;
        }
        .error-message {
            color: red;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1>Create an Account</h1>
        <?php if (isset($error_message)): ?>
            <div class="error-message"><?= htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm your password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
        <div class="mt-3 text-center">
            <p>Already have an account? <a href="login.php" style="color: #2f80ed;">Login here</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
