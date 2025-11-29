<?php
session_start();
include "db.php";

// When login form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = $_POST["password"];

    // Check if user exists
    $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // Validate password
        if (password_verify($password, $user["password"])) {
            // Create session
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];
            $_SESSION["user_role"] = $user["role"]; // applicant/employer/admin

            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>JobAll Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@300;400;600;700;800;900&family=Bowlby+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/login.css">
</head>

<body>

    <div class="login-container">

        <div class="logo-title-wrapper">
            <img class="logo" src="assets/images/logo.png" alt="JobAll Logo">
            <h2 class="login-title">JobAll</h2>
        </div>

        <?php if (!empty($error)) : ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" action="">

            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" required placeholder="Enter your email">
            </div>

            <div class="label-row">
                <label for="password">Password</label>
                <a href="forgot_password.php" class="forgot">Forgot Password?</a>
            </div>

            <div class="input-group">
                <input type="password" name="password" required placeholder="Enter your password">
            </div>

            <div class="remember-wrapper">
                <label class="remember-me">
                    <input type="checkbox" name="remember"> Remember me
                </label>
            </div>


            <button type="submit" class="login-btn">Login</button>
        </form>

        <p class="register-text">
            Don’t have an account? <a href="register.php">Sign up</a>
        </p>
    </div>

</body>

</html>