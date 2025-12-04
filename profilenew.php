<?php
session_start();
include "db.php";

// Redirect if not logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION["user_id"];

// Fetch user profile data
$stmt = $conn->prepare("SELECT * FROM profiles WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Variables
$fullName = $user["fname"] . " " . $user["lname"];
$jobTitle = $user["job_title"] ?: "No Job Title";
$address  = $user["home_address"] ?: "Not Set";
$joined   = date("F Y", strtotime($user["created_at"]));
$experience = ($user["has_experience"] == 1) ? "Has Experience" : "No Experience";
$classification = $user["classification"] ?: "Not Set";
$subclassification = $user["subclassification"] ?: "Not Set";
$about = $user["description"] ?? "No description set.";

// Fetch notifications with employer’s name
$notifQuery = $conn->prepare("
    SELECT n.*, 
      p.fname AS employer_fname,
      p.lname AS employer_lname
    FROM notifications n
    LEFT JOIN profiles p 
        ON p.id = n.from_user_id
    WHERE n.user_id = ?
    ORDER BY n.created_at DESC
");
$notifQuery->bind_param("i", $userId);
$notifQuery->execute();
$notifResult = $notifQuery->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="assets/site.css">
    <link rel="stylesheet" href="assets/profile.css">
    <link rel="stylesheet" href="profile-setup/spinner.css">




    <style>
        /* ——— SAME CSS YOU PROVIDED ——— */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Archivo', sans-serif;
        }

       body {
    background: linear-gradient(180deg, #f9f9ff 0%, #e0d9ff 100%);
    min-height: 100vh;
    height: 100%;
    width: 100%;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    background-repeat: no-repeat;      /* prevent repeating */
    background-attachment: fixed;      /* stays fixed when scrolling */
    background-size: cover;            /* ensures full coverage even on zoom */
}


        .profile-container-inner {
            display: flex;
            gap: 40px;
            
            width: 90%;
        }

        .profile-card {
            background: #cbbaff;
            padding: 30px 20px;
            border-radius: 12px;
            width: 300px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-card {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }


        .profile-card img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 3px solid #6a4fff;
            margin-bottom: 15px;
        }

        .profile-card h2 {
            font-size: 24px;
            color: #fff;
            margin-bottom: 5px;
        }

        .profile-card p.username {
            color: #ddd;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .profile-info {
            width: 100%;
            font-size: 14px;
            color: #fff;
            margin-bottom: 20px;
        }

        .profile-info p {
            margin: 5px 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .skills span {
            display: inline-block;
            background: #fff;
            color: #6a4fff;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            margin: 5px 5px 0 0;
        }

        .account-info {
            background: #A294F9;
            width: 100%;
            padding: 15px;
            border-radius: 8px;
            color: #fff;
            font-size: 12px;
        }

        .account-info p {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 5px;
        }

        .profile-right {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .about-me {
            background: #f4eaff;
            padding: 20px;
            border-radius: 12px;
            color: #2b2b7f;
            font-size: 14px;
            line-height: 1.5;
        }

        .job-sections {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .job-sections div {
            flex: 1;
            border-radius: 12px;
            padding: 15px;
            color: #2b2b7f;
            font-size: 14px;
        }

        .edit-btn {
            align-self: flex-end;
            background: #6a4fff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 30px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 200px;
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
        .profile-table {
    /* border: 20px solid green; */
    display: flex;
    width: 90%;
    height: auto;
    z-index: 10;
    top: 10px;
    left: 10%;
    color: white;
    font-size: 1rem;
    overflow: hidden;
    gap: 10%;
    justify-content: space-between;
    align-items: stretch;
    overflow-y: auto;
}






















/* Tablet: medium screens */
@media (max-width: 992px) {
    .profile-container-inner {
        flex-direction: column;
        align-items: center;
        gap: 20px;
        
    }

    .profile-card {
        width: 90% !important;
        /* max-width: 500px; */
    }

    .profile-right {
        width: 90%;
    }

    .profile-table {
        flex-direction: column;
        gap: 20px;
        left: 5%;
        width: 90%;
        margin-left: 50px;
    }

    .edit-btn {
        margin-top: 20px;
        align-self: center;
    }
}

/* Mobile: small screens */
@media (max-width: 576px) {
    .profile-card img {
        width: 100px;
        height: 100px;
    }

    .profile-card h2 {
        font-size: 20px;
        text-align: center;
    }

    .profile-card p.username {
        font-size: 12px;
        text-align: center;
    }

    .profile-info p {
        font-size: 12px;
    }

    .skills span {
        font-size: 10px;
        padding: 4px 8px;
    }

    .account-info {
        font-size: 11px;
        padding: 10px;
    }

    .about-me {
        font-size: 13px;
        padding: 15px;
    }

    .job-sections {
        flex-direction: column;
        gap: 15px;
    }

    .job-sections div {
        width: 100%;
    }

    .edit-btn {
        width: 100%;
        justify-content: center;
        font-size: 12px;
        padding: 8px 12px;
        margin-top: 10px;
    }

    
    .notifications-box {
        width: 100%;
        padding: 15px;
    }
}

/* Extra small screens: very small phones */
@media (max-width: 400px) {
    .profile-card {
        padding: 15px;
    }

    .profile-right {
        padding: 10px;
    }

    .profile-table {
        flex-direction: column;
        gap: 20px;
        left: 10%;
        width: 90%;
        margin-left: 50px;
    }

    .profile-card img {
        width: 80px;
        height: 80px;
    }

    .profile-card h2 {
        font-size: 18px;
    }

    .profile-card p.username {
        font-size: 11px;
    }

    .skills span {
        font-size: 9px;
    }

    .account-info {
        font-size: 10px;
    }

    .about-me {
        font-size: 12px;
    }
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
    
    <div class="profile-container">
        <?php include 'navbar.php'; ?>

        <div class="profile-table">
            
            <div class="profile-container-inner">

                <!-- LEFT PANEL -->
                <div class="profile-card" style="width: 500px !important">

                    <!-- <img src="uploads/profile_photos/<?= htmlspecialchars($user['profile_photo']); ?>" 
                        class="rounded-circle" 
                        width="140" height="140"
                        alt="Profile Photo"> -->
<img src="uploads/profile_photos/<?= htmlspecialchars($user['profile_photo']); ?>" 
     class="rounded-circle" 
     width="140" height="140"
     alt="Profile Photo">

                    <img src="uploads/profile_photos/<?= $user['profile_photo'] ?: 'profile-picture.png' ?>" 
     class="rounded-circle" width="140" height="140">



                    <h2><?= htmlspecialchars($fullName) ?> <i class="bi bi-patch-check-fill" style="color:#55417F"></i></h2>

                    <p class="username">@<?= strtolower(str_replace(" ", "", $user["fname"])) ?></p>

                    <div class="profile-info">
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name: <?= htmlspecialchars($fullName) ?></p>
                        <p><i class="bi bi-geo-alt-fill" style="color:#55417F"></i> <?= htmlspecialchars($address) ?></p>
                        <p><i class="bi bi-briefcase-fill" style="color:#55417F"></i> <?= htmlspecialchars($jobTitle) ?></p>
                        <p><i class="bi bi-tag-fill" style="color:#55417F"></i> <?= htmlspecialchars($classification) ?> → <?= htmlspecialchars($subclassification) ?></p>

                        <h2><br>Skills</h2>
                    </div>

                    <div class="skills">
                        <span><?= htmlspecialchars($jobTitle) ?></span>
                        <span><?= htmlspecialchars($experience) ?></span>
                    </div>

                    <div class="account-info">
                        <p>ACCOUNT INFO</p>
                        <p>-----------------------------------------------------------------------------</p>
                        <p><i class="bi bi-calendar3" style="color:#55417F"></i> Joined on <?= $joined ?></p>
                        <p><i class="bi bi-calendar-check-fill" style="color:#55417F"></i> Last Updated: <?= $joined ?></p>
                    </div>
                </div>

                <!-- RIGHT PANEL -->
                <div class="profile-right">

                    <h3 style="color:#1C0C81 !important;">About Me</h3>

                    <div class="about-me">
                        <p><?= nl2br(htmlspecialchars($about)) ?></p>
                    </div>

                    <div class="job-sections">
                        <div>
                            <h4>Applied Jobs</h4>
                        </div>
                        <div>
                            <h4>Recent Jobs</h4>
                        </div>
                    </div>

                    <button class="edit-btn" onclick="openEditModal()">
                        <i class="bi bi-pencil-fill"></i> Edit Profile
                    </button>
                    <div class="notifications-box"
                        style="
        background:#fff; 
        padding:20px; 
        margin-top:20px; 
        border-radius:10px; 
        width:100%;
     ">
                        <h3 style="color:#1C0C81; margin-bottom:15px;">Notifications</h3>

                        <?php while ($notif = $notifResult->fetch_assoc()): ?>

                            <?php
                            // Display employer name if exists
                            $employerName = "";
                            if (!empty($notif["employer_fname"])) {
                                $employerName = $notif["employer_fname"] . " " . $notif["employer_lname"];
                            }
                            ?>

                            <div class="alert alert-info" style="border-radius:8px;">
                                <!-- Notification Message -->
                                <?= htmlspecialchars($notif["message"]) ?>

                                <!-- Show employer name if it's a hire notification -->
                                <?php if ($employerName): ?>
                                    <br><strong>Employer:</strong> <?= htmlspecialchars($employerName) ?>
                                <?php endif; ?>

                                <br><small class="text-muted"><?= $notif["created_at"] ?></small>
                            </div>

                        <?php endwhile; ?>

                        <?php if ($notifResult->num_rows === 0): ?>
                            <p class="text-muted">No notifications yet.</p>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>


<!-- HIDDEN IFRAME MODAL -->
<iframe id="editModalFrame"
        src=""
        style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; 
               border:none; z-index:9999; background:rgba(0,0,0,0.6);"
        frameborder="0">
</iframe>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    
window.addEventListener('DOMContentLoaded', () => {
  const preloader = document.getElementById('hammerSpinnerModal');
  preloader.style.transition = 'opacity 0.5s';
  preloader.style.opacity = '0';
  setTimeout(() => preloader.style.display = 'none', 500);
});



function openEditModal() {
    const iframe = document.getElementById('editModalFrame');
    iframe.src = 'edit-profile-modal.php'; // or .html
    iframe.style.display = 'block';
    document.body.style.overflow = 'hidden'; // freeze background scroll
}

function closeEditModal() {
    const iframe = document.getElementById('editModalFrame');
    iframe.style.display = 'none';
    iframe.src = '';
    document.body.style.overflow = ''; // restore scrolling
}

// Close when pressing Escape
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeEditModal();
});

// Allow iframe to tell parent to close
window.addEventListener('message', (event) => {
    if (event.data === 'closeModal') {
        closeEditModal();
    }
});
</script>

</body>


</html>




