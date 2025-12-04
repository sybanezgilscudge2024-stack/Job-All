<?php
include "../db.php"; // your database connection

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$address = $_POST['address'];
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';

if ($password !== $confirmPassword) {
    die("Passwords do not match.");
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$hasExp = isset($_POST['has_experience']) ? 1 : 0;

$jobTitle = $_POST['job_title'] ?? null;
$company = $_POST['company_name'] ?? null;
$startMonth = $_POST['start_month'] ?? null;
$startYear = $_POST['start_year'] ?? null;
$endMonth = $_POST['end_month'] ?? null;
$endYear = $_POST['end_year'] ?? null;
$stillInRole = isset($_POST['still_in_role']) ? 1 : 0;

$classification = $_POST['classification'];
$subclassification = $_POST['sub_classification'] ?? '';
$visibility = isset($_POST['visibility'])
    ? implode(",", $_POST['visibility'])
    : '';


$sql = "INSERT INTO profiles 
(fname, lname, email, password, home_address, has_experience, job_title, company_name,
start_month, start_year, end_month, end_year, still_in_role,
classification, subclassification, visibility)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "sssssissssssiiss",
    $fname,
    $lname,
    $email,
    $hashedPassword,
    $address,
    $hasExp,
    $jobTitle,
    $company,
    $startMonth,
    $startYear,
    $endMonth,
    $endYear,
    $stillInRole,
    $classification,
    $subclassification,
    $visibility
);




$stmt->execute();
$stmt->close();

header("Location: ../login.php");
exit;
