<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    die("You must be logged in to post a job.");
}

$employer_id = $_SESSION["user_id"];  // <-- THIS IS THE FIX

// DB connection
$host = "localhost";
$user = "root";
$pass = "";
$db   = "joball_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("DB connection error: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: postajob.php");
    exit;
}

// gather & sanitize
$title = trim($_POST['job_name'] ?? '');
$description = trim($_POST['description'] ?? '');
$city = trim($_POST['city'] ?? '');
$barangay = trim($_POST['barangay'] ?? '');
$province = trim($_POST['province'] ?? '');
$postal_code = trim($_POST['postal_code'] ?? '');
$salary = $_POST['salary'] !== '' ? floatval($_POST['salary']) : null;
$salary_type = $_POST['salary_type'] ?? '';
$employment_type = $_POST['employment_type'] ?? 'Part Time';
$urgent = isset($_POST['urgent']) ? 1 : 0;

$date_type = $_POST['date_type'] ?? 'single';
$single_date = null; 
$range_start = null; 
$range_end = null; 
$multiple_dates = null;

if ($date_type === 'single') {
    $single_date = $_POST['single_date'] ?: null;
}
if ($date_type === 'range') {
    $range_start = $_POST['range_start'] ?: null;
    $range_end = $_POST['range_end'] ?: null;
}
if ($date_type === 'multiple') {
    $multiple_dates = trim($_POST['multiple_dates'] ?? '');
}

$start_time = $_POST['start_time'] ?? null;
$end_time = $_POST['end_time'] ?? null;

$date_posted = date("Y-m-d H:i:s");

// INSERT query
$sql = "INSERT INTO job_posts
(employer_id, job_title, job_description, city, barangay, province, postal_code, salary, salary_type,
 employment_type, urgent, date_type, single_date, range_start, range_end, multiple_dates,
 start_time, end_time, date_posted)
 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "issssssdissssssssss",
    $employer_id,
    $title,
    $description,
    $city,
    $barangay,
    $province,
    $postal_code,
    $salary,
    $salary_type,
    $employment_type,
    $urgent,
    $date_type,
    $single_date,
    $range_start,
    $range_end,
    $multiple_dates,
    $start_time,
    $end_time,
    $date_posted
);

if ($stmt->execute()) {
    header("Location: postajob.php?success=1");
    exit;
} else {
    die("Insert failed: " . $stmt->error);
}
