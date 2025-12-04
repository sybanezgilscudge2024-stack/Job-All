<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    die("Not logged in.");
}

$workerId = $_SESSION["user_id"];
$workName = $_POST["work_name"];
$desc = $_POST["description"];
$class = $_POST["classification"];
$sub = $_POST["sub_classification"];

$stmt = $conn->prepare("
    INSERT INTO worker_applications (worker_id, work_name, description, classification, sub_classification)
    VALUES (?, ?, ?, ?, ?)
");

$stmt->bind_param("issss", $workerId, $workName, $desc, $class, $sub);

if ($stmt->execute()) {
    header("Location: hireaworker.php?posted=1");
    exit;
} else {
    echo "Error submitting application.";
}
?>
