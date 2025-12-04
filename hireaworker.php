<?php
session_start();
include "db.php";

// Require login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch worker applications + profile details
$sql = "
SELECT 
    wa.id AS application_id,
    wa.worker_id,
    wa.work_name,
    wa.description AS work_description,
    wa.classification,
    wa.sub_classification,
    wa.date_submitted,
    p.fname,
    p.lname,
    p.job_title,
    p.start_month,
    p.start_year,
    p.end_month,
    p.end_year
FROM worker_applications wa
LEFT JOIN profiles p ON wa.worker_id = p.id
ORDER BY wa.date_submitted DESC
";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hire a Worker</title>

    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/site.css">
    <link rel="stylesheet" href="assets/profile.css">
    <link rel="stylesheet" href="profile-setup/spinner.css">

    <style>
        .content-area {
            padding: 30px;
            transition: margin-left .3s, width .3s;
        }

        .card-grid {
            margin-left: 100px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
        }

        .employee-card {
            background: #c8b6ff;
            border-radius: 12px;
            padding: 18px;
            text-align: center;
            transition: .2s;
            min-height: 240px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .employee-card:hover {
            transform: translateY(-5px);
        }

        .employee-avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: #ffe082;
            margin: 0 auto 10px;
        }

        .employee-name {
            font-weight: bold;
            margin-bottom: 4px;
        }

        .employee-role {
            font-size: .9rem;
            color: #4b3fbd;
            margin-bottom: 6px;
        }

        .small-desc {
            font-size: .85rem;
            color: #222;
            margin-top: 6px;
            text-align: left;
        }

        .btn-hire {
            background: #5c33cf;
            color: #fff;
            border-radius: 20px;
            padding: 6px 12px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>


<!-- Hammering Preloader Modal -->
<div id="hammerSpinnerModal" class="spinner-modal">
    <div class="spinner-box">
        <div class="hammer"></div>
    </div>
</div>



<body>

    <div class="d-flex">
        <?php include "navbar.php"; ?>

        <div class="content-area">
            <h2 style="margin-left: 100px;">Hire a Worker</h2>

            <div class="card-grid">

                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>

                        <?php
                        $appId  = $row['application_id'];
                        $workerId = $row['worker_id'];

                        // FIXED: name error
                        $fname = $row['fname'] ?? "";
                        $lname = $row['lname'] ?? "";
                        $name  = trim($fname . " " . $lname);
                        if ($name === "") $name = "Unnamed Worker";

                        $workName = $row['work_name'] ?? "No Work Name";
                        $workDesc = $row['work_description'] ?? "No description";
                        $classification = $row['classification'] ?? "";
                        $subcategory = $row['sub_classification'] ?? "";

                        ?>

                        <div class="employee-card">
                            <div>
                                <div class="employee-avatar"></div>

                                <div class="employee-name"><?= htmlspecialchars($name) ?></div>

                                <div class="employee-role">
                                    @<?= htmlspecialchars($classification ?: "Worker") ?>
                                </div>

                                <div class="small-desc"><strong>Work:</strong>
                                    <?= htmlspecialchars($workName) ?>
                                </div>

                                <div class="small-desc"><strong>Category:</strong>
                                    <?= htmlspecialchars($classification) ?>
                                    <?= $subcategory ? " / " . htmlspecialchars($subcategory) : "" ?>
                                </div>

                                <div class="small-desc"><strong>Description:</strong><br>
                                    <?= nl2br(htmlspecialchars($workDesc)) ?>
                                </div>
                            </div>

                            <div style="margin-top:12px;">
                                <a href="hire_worker_action.php?worker_id=<?= urlencode($workerId) ?>&app_id=<?= urlencode($appId) ?>"
                                    class="btn-hire">Hire Worker</a>
                            </div>
                        </div>

                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No worker applications yet.</p>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <!-- POPUP -->
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div id="hireSuccessPopup" class="popup-overlay" style="display:flex;">
        <?php else: ?>
            <div id="hireSuccessPopup" class="popup-overlay" style="display:none;">
            <?php endif; ?>
            <div class="popup-box">
                <h3>Notification Sent!</h3>
                <p>The worker has been notified of your employment request.</p>
                <button onclick="closeHirePopup()">OK</button>
            </div>
            </div>

            <style>
                .popup-overlay {
                    position: fixed;
                    inset: 0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    background: rgba(0, 0, 0, 0.45);
                    z-index: 9999;
                }

                .popup-box {
                    background: #fff;
                    padding: 22px;
                    border-radius: 10px;
                    width: 360px;
                    text-align: center;
                    box-shadow: 0 6px 18px rgba(0, 0, 0, .18);
                }

                .popup-box h3 {
                    color: #5a3fff;
                    margin-bottom: 8px;
                }

                .popup-box button {
                    background: #5a3fff;
                    color: #fff;
                    padding: 8px 16px;
                    border: none;
                    border-radius: 8px;
                    cursor: pointer;
                }

                #sidebarMenu {
                    flex-shrink: 0;
                    display: flex;
                    min-width: 80px;
                    width: 330px;
                    height: 20%;
                    overflow-y: auto;
                    overflow-x: hidden;
                    transition: width 0.3s ease;
                    z-index: 12;
                }
            </style>

            <script>
                function closeHirePopup() {
                    document.getElementById('hireSuccessPopup').style.display = 'none';
                }






                window.addEventListener('DOMContentLoaded', () => {
                    const preloader = document.getElementById('hammerSpinnerModal');
                    preloader.style.transition = 'opacity 0.5s';
                    preloader.style.opacity = '0';
                    setTimeout(() => preloader.style.display = 'none', 500);
                });
            </script>

</body>

</html>