<?php
include "db.php"; // your DB connection

// Fetch all jobs sorted by newest
$sql = "SELECT * FROM job_posts ORDER BY date_posted DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listing</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="assets/site.css">
    <link rel="stylesheet" href="assets/joblisting.css">

    <style>
        body {
            background: linear-gradient(#f3e8ff, #e3d1ff);
            min-height: 100vh;
            font-family: Arial, sans-serif;
        }

        .job-card {
            margin-left: 200px;
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
            border-left: 5px solid #b08dff;
        }

        .job-icon {
            width: 55px;
            height: 55px;
            object-fit: contain;
        }

        .job-title {
            font-size: 20px;
            font-weight: bold;
            color: #5c33cf;
        }

        .job-meta {
            font-size: 14px;
            color: #7a7a7a;
        }

        .apply-btn {
            background: #7d3cff;
            color: white;
            border-radius: 20px;
            padding: 5px 18px;
            font-size: 14px;
        }

        .save-btn {
            font-size: 20px;
            color: #7d3cff;
            cursor: pointer;
        }

        .tab-link {
            color: #7d3cff;
            font-weight: 600;
            cursor: pointer;
            padding: 0 15px;
        }

        .tab-link.active {
            text-decoration: underline;
        }

        .browse-btn {
            background: #7d3cff;
            color: white;
            border-radius: 8px;
            padding: 10px 25px;
        }

         .apply-btn:hover{
            background-color:#5c33cf !important;
            
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

    <div class="d-flex">

        <!-- NAVBAR -->
        <?php include 'navbar.php'; ?>

        <!-- MAIN CONTENT -->
        <div class="content-area p-4">

            <div class="container-fluid py-3">

                <h2 class="text-center fw-bold mb-3" style="color:#5c33cf;">Job Listing</h2>

                <div class="d-flex justify-content-center mb-4">
                    <span class="tab-link active">Featured</span>
                    <span class="tab-link">Full Time</span>
                    <span class="tab-link">Part Time</span>
                </div>

                <!-- ========================= -->
                <!-- JOB CARDS FROM DATABASE -->
                <!-- ========================= -->

                <?php while ($row = $result->fetch_assoc()): ?>

                    <div class="job-card d-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center gap-3">
                            <img src="https://cdn-icons-png.flaticon.com/512/1995/1995574.png" class="job-icon">

                            <div>
                                <div class="job-title"><?= htmlspecialchars($row['job_title']) ?></div>

                                <div class="job-meta">
                                    📍 <?= $row['city'] ?>, <?= $row['province'] ?>
                                    &nbsp;&nbsp; ⏱ <?= $row['employment_type'] ?>
                                    &nbsp;&nbsp; 💰
                                    <?= number_format($row['salary'], 0) ?> / <?= $row['salary_type'] ?>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <div class="save-btn">♡</div>
                            <a href="job_details.php?id=<?= $row['id'] ?>" class="apply-btn mt-2 btn btn-sm">
                                Apply Now
                            </a>

                            <div class="job-meta mt-1">
                                📅 Posted: <?= date("M d, Y", strtotime($row['date_posted'])) ?>
                            </div>
                        </div>

                    </div>

                <?php endwhile; ?>

                <!-- If no results -->
                <?php if ($result->num_rows === 0): ?>
                    <p class="text-center mt-4">No jobs posted yet.</p>
                <?php endif; ?>

                <!-- BROWSE MORE -->
                <div class="text-center mt-4">
                    <button class="browse-btn">Browse More Jobs</button>
                </div>

            </div>

        </div>

    </div>

</body>

</html>