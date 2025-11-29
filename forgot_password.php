<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password • JobAll</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Bowlby+One&family=Archivo:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="style/forgot.css">
</head>

<body>

    <div class="login-container">

        <!-- LOGO + TITLE -->
        <div class="logo-title-wrapper">
            <img class="logo" src="assets/images/logo.png" alt="JobAll Logo">
            <h2 class="login-title">JobAll</h2>
        </div>

        <!-- Subtitle -->
        <p class="subtitle">Reset your password</p>

        <!-- INPUT -->
        <form action="forgot-process.php" method="POST">

            <div class="input-group">
                <label for="email">Enter your email</label>
                <input type="email" id="email" name="email" placeholder="example@gmail.com" required>
            </div>

            <button class="login-btn" type="submit">Send Reset Link</button>

        </form>

        <!-- Back to login -->
        <p class="register-text">
            Remembered your password?  
            <a href="login.php">Login</a>
        </p>

    </div>

</body>

</html>
