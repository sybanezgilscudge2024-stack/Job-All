<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    die('Not logged in.');
}

if (!isset($_GET['app_id'])) {
    die('Application id missing.');
}

$app_id = intval($_GET['app_id']);
$employer_id = intval($_SESSION['user_id']);

// Fetch application row to get worker id, work name, classification and description
$stmt = $conn->prepare("SELECT worker_id, work_name, description, classification, sub_classification FROM worker_applications WHERE id = ?");
$stmt->bind_param("i", $app_id);
$stmt->execute();
$app = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$app) {
    die('Application not found.');
}

$worker_id = intval($app['worker_id']);
$work_name = $app['work_name'] ?? '';
$desc = $app['description'] ?? '';
$category = $app['classification'] ?? '';
$sub = $app['sub_classification'] ?? '';

// Get employer full name
$stmt = $conn->prepare("SELECT fname, lname FROM profiles WHERE id = ?");
$stmt->bind_param("i", $employer_id);
$stmt->execute();
$emp = $stmt->get_result()->fetch_assoc();
$stmt->close();

$emp_name = trim(($emp['fname'] ?? '') . ' ' . ($emp['lname'] ?? ''));
if ($emp_name === '') $emp_name = 'An employer';

// Compose message (customize as needed)
$message = $emp_name . " has hired you for \"" . $work_name . "\".";
if ($category || $sub) $message .= " (" . trim($category . ' ' . ($sub ? "→ {$sub}" : '')) . ")";
if ($desc) $message .= " — " . (strlen($desc) > 120 ? substr($desc,0,120) . '...' : $desc);

// Insert notification (includes from_user_id)
$notif = $conn->prepare("INSERT INTO notifications (user_id, from_user_id, message, is_read, created_at) VALUES (?, ?, ?, 0, NOW())");
$notif->bind_param("iis", $worker_id, $employer_id, $message);

if ($notif->execute()) {
    // redirect back with success flag so page can show popup
    header("Location: hireaworker.php?success=1");
    exit;
} else {
    die("Error sending notification: " . $notif->error);
}
