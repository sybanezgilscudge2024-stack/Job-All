<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// get user info
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Main Page</title>
</head>

<body>

    <h2>Welcome, <?php echo $user['name']; ?>!</h2>

    <h3>Main Navigation</h3>

    <ul>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="post_job.php">Post a Job</a></li>
        <li><a href="hire_worker.php">Hire a Worker</a></li>
        <li><a href="job_list.php">Job Listing</a></li>
        <li><a href="apply_skill.php">Apply Work/Skill</a></li>
        <li><a href="contact_admin.php">Contact Admin</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>

</body>

</html>