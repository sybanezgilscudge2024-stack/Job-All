<?php
session_start();
include "db.php";

if (!isset($_GET['id'])) {
    die("Job not found.");
}

$job_id = intval($_GET['id']);

// Fetch job + employer name
$stmt = $conn->prepare("
    SELECT jp.*,
           CONCAT(p.fname, ' ', p.lname) AS employer_name,
           p.email AS employer_email
    FROM job_posts jp
    LEFT JOIN profiles p ON jp.employer_id = p.id
    WHERE jp.id = ?
");
$stmt->bind_param("i", $job_id);
$stmt->execute();
$job = $stmt->get_result()->fetch_assoc();

if (!$job) {
    die("Job does not exist.");
}

// Handle APPLY button
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    $applicant_id = $_SESSION['user_id'];
    $message = "A new applicant has applied for your job: " . $job['job_title'];

    // Save application record
    $save = $conn->prepare("
        INSERT INTO applications (job_id, applicant_id, employer_id, date_applied)
        VALUES (?, ?, ?, NOW())
    ");
    $save->bind_param("iii", $job_id, $applicant_id, $job['employer_id']);
    $save->execute();

    // Notify Employer
    $notify = $conn->prepare("
        INSERT INTO notifications (user_id, message, is_read, created_at)
        VALUES (?, ?, 0, NOW())
    ");
    $notify->bind_param("is", $job['employer_id'], $message);
    $notify->execute();

    echo "<script>
            alert('Your application has been sent!');
            window.location.href='joblisting.php';
          </script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($job['job_title']) ?> - Job Details</title>

    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/site.css">
    <link rel="stylesheet" href="assets/profile.css">
    <link 
    rel="stylesheet" 
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    >
    <style>
        .job-card {
            background: white;
            border-radius: 14px;
            padding: 35px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.12);
            max-width: 900px;
            margin: 40px auto;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #5a3fff;
            margin-bottom: 10px;
            border-left: 5px solid #5a3fff;
            padding-left: 10px;
        }
     
        .info-box {
            background: #f7f3ff;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .apply-btn {
            background: #5a3fff;
            color: #fff;
            padding: 12px;
            border-radius: 10px;
            width: 100%;
            font-size: 18px;
            border: none;
        }

        .apply-btn:hover {
            background: #482ecc;
        }

         #sidebarMenu {

            flex-shrink: 0;
            display: flex;
            min-width: 80px;
            width: 330px;
            min-height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
            transition: width 0.3s ease;
            z-index: 12;
        }
    </style>
</head>

<body>

<?php include "navbar.php"; ?>

<div class = "content-area">

    <div class="job-card">

        <h2 class="fw-bold mb-2"><?= htmlspecialchars($job['job_title']) ?></h2>
        <p class="text-muted">Posted on <?= date("F j, Y", strtotime($job['date_posted'])) ?></p>

        <hr>

        <!-- EMPLOYER INFO -->
        <div class="section-title">Employer Information</div>
        <div class="info-box">
            <p><strong>Name:</strong> <?= htmlspecialchars($job['employer_name']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($job['employer_email']) ?></p>
        </div>

        <!-- JOB LOCATION -->
        <div class="section-title">Job Location</div>
        <div class="info-box">
            <p><strong>City:</strong> <?= htmlspecialchars($job['city']) ?></p>
            <p><strong>Barangay:</strong> <?= htmlspecialchars($job['barangay']) ?></p>
            <p><strong>Province:</strong> <?= htmlspecialchars($job['province']) ?></p>
            <p><strong>Postal Code:</strong> <?= htmlspecialchars($job['postal_code']) ?></p>
        </div>

        <!-- JOB DETAILS -->
        <div class="section-title">Job Details</div>
        <div class="info-box">
            <p><strong>Employment Type:</strong> <?= htmlspecialchars($job['employment_type']) ?></p>
            <p><strong>Urgent:</strong> <?= $job['urgent'] ? "Yes" : "No" ?></p>
            <p><strong>Date Type:</strong> <?= htmlspecialchars($job['date_type']) ?></p>
            
            <?php if ($job['date_type'] === "single"): ?>
                <p><strong>Date:</strong> <?= htmlspecialchars($job['single_date']) ?></p>
            <?php endif; ?>

            <?php if ($job['date_type'] === "range"): ?>
                <p><strong>Start:</strong> <?= htmlspecialchars($job['range_start']) ?></p>
                <p><strong>End:</strong> <?= htmlspecialchars($job['range_end']) ?></p>
            <?php endif; ?>

            <?php if ($job['date_type'] === "multiple"): ?>
                <p><strong>Dates:</strong> <?= htmlspecialchars($job['multiple_dates']) ?></p>
            <?php endif; ?>

            <p><strong>Time:</strong> <?= htmlspecialchars($job['start_time']) ?> - <?= htmlspecialchars($job['end_time']) ?></p>
        </div>

        <!-- SALARY SECTION -->
        <div class="section-title">Salary</div>
        <div class="info-box">
            <p><strong>Amount:</strong> ₱<?= number_format($job['salary']) ?></p>
            <p><strong>Type:</strong> <?= htmlspecialchars($job['salary_type']) ?></p>
        </div>

        <!-- JOB DESCRIPTION -->
        <div class="section-title">Job Description</div>
        <div class="info-box">
            <p><?= nl2br(htmlspecialchars($job['job_description'])) ?></p>
        </div>

        <hr>

        <form method="POST">
            <button type="submit" class="apply-btn">Apply For This Job</button>
        </form>

    </div>

</div>

</body>
</html>
