<?php
session_start();

// DB connection — adjust host/user/pass/dbname
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
$single_date = null; $range_start = null; $range_end = null; $multiple_dates = null;

if ($date_type === 'single') {
    $single_date = $_POST['single_date'] ?: null;
}
if ($date_type === 'range') {
    $range_start = $_POST['range_start'] ?: null;
    $range_end = $_POST['range_end'] ?: null;
}
if ($date_type === 'multiple') {
    // expect comma-separated string
    $multiple_dates = $_POST['multiple_dates'] ?? '';
    // sanitize: remove spaces
    $multiple_dates = trim($multiple_dates);
}

// times
$start_time = $_POST['start_time'] ?? null;
$end_time = $_POST['end_time'] ?? null;

// date posted now (DATETIME)
$date_posted = date("Y-m-d H:i:s");

// basic validation
if (empty($title) || empty($description)) {
    die("Job name and description are required.");
}

// prepare insert
$sql = "INSERT INTO job_posts
    (job_title, job_description, city, barangay, province, postal_code, salary, salary_type,
     employment_type, urgent, date_type, single_date, range_start, range_end, multiple_dates,
     start_time, end_time, date_posted)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param(
    "ssssssdissssssssss",
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

$ok = $stmt->execute();
if ($ok) {
    // success - redirect back with success flag
    header("Location: postajob.php?success=1");
    exit;
} else {
    echo "Insert failed: " . $stmt->error;
}
?>
