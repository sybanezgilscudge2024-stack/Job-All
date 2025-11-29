<?php
include 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $password);

    if (mysqli_stmt_execute($stmt)) {
        $message = "Registration Successful! <a href='login.php'>Login Here</a>";
    } else {
        $message = "Error: Email already used!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>

<body>

    <h2>Register</h2>
    <p style="color:green;"><?php echo $message; ?></p>

    <form method="POST">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Create Account</button>
    </form>

    <br>
    <a href="login.php">Already have an account? Login</a>

</body>

</html>