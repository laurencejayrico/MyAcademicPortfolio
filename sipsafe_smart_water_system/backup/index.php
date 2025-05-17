<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to SIPSAFE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #56ccf2, #2f80ed);
            color: #fff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hero {
            text-align: center;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }
        .btn-custom {
            padding: 0.8rem 2rem;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: bold;
        }
        .btn-login {
            background-color: #fff;
            color: #2f80ed;
            border: none;
        }
        .btn-register {
            background-color: #2f80ed;
            color: #fff;
            border: 1px solid #fff;
        }
        .btn-login:hover {
            background-color: #f2f2f2;
        }
        .btn-register:hover {
            background-color: #1c5db8;
        }
    </style>
</head>
<body>
    <div class="container hero">
        <h1>Welcome to SIPSAFE</h1>
        <p>Your trusted solution for smarter water filtration and monitoring.</p>
        <div>
            <a href="login.php" class="btn btn-custom btn-login">Login</a>
            <a href="register.php" class="btn btn-custom btn-register ms-3">Register</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
