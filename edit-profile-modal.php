<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    die("Not logged in.");
}

$userId = $_SESSION["user_id"];

// Fetch user data
$stmt = $conn->prepare("SELECT * FROM profiles WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Profile</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: transparent !important;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .btn-purple {
      background: linear-gradient(135deg, #8a6de9, #6b46c1);
      border: none;
    }
    .btn-purple:hover {
      background: linear-gradient(135deg, #7a5ad4, #5a38a8);
      transform: translateY(-1px);
    }
    .modal-dialog {
      max-width: 95%;
      width: 800px;
    }
    .modal-content {
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }
    .modal {
      display: block !important;
      background-color: rgba(0,0,0,0.5);
    }
  </style>
</head>

<body class="bg-light">

<div class="modal fade show" id="editProfileModalStandalone" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content border-0 shadow-lg overflow-hidden">
      
      <div class="modal-header text-white" style="background: linear-gradient(135deg, #8a6de9, #6b46c1);">
        <h5 class="modal-title fw-bold fs-4">Edit Profile</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body p-4 p-lg-5">

        <form id="editProfileForm" method="POST" action="update_profile.php" enctype="multipart/form-data">

          <div class="row g-3">

            <!-- FIRST & LAST NAME -->
            <div class="col-md-6">
              <label class="form-label fw-semibold">First Name</label>
              <input type="text" name="fname" class="form-control form-control-lg rounded-3"
                     value="<?= htmlspecialchars($user['fname']); ?>">
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Last Name</label>
              <input type="text" name="lname" class="form-control form-control-lg rounded-3"
                     value="<?= htmlspecialchars($user['lname']); ?>">
            </div>

            <!-- EMAIL -->
            <div class="col-md-6">
              <label class="form-label fw-semibold">Email</label>
              <input type="email" name="email" class="form-control form-control-lg rounded-3"
                     value="<?= htmlspecialchars($user['email']); ?>">
            </div>

            <!-- PASSWORD -->
            <div class="col-md-6">
              <label class="form-label fw-semibold">Password</label>
              <input type="password" name="password" class="form-control form-control-lg rounded-3"
                     placeholder="Leave blank to keep current password">
            </div>

            <!-- ADDRESS -->
            <div class="col-12">
              <label class="form-label fw-semibold">Home Address</label>
              <input type="text" name="home_address" class="form-control form-control-lg rounded-3"
                     value="<?= htmlspecialchars($user['home_address']); ?>">
            </div>

            <!-- EXPERIENCE -->
            <div class="col-md-6">
              <label class="form-label fw-semibold">Has Experience</label>
              <select name="has_experience" class="form-control form-control-lg rounded-3">
                <option value="Yes" <?= $user['has_experience']=="Yes"?"selected":""; ?>>Yes</option>
                <option value="No" <?= $user['has_experience']=="No"?"selected":""; ?>>No</option>
              </select>
            </div>

            <!-- JOB TITLE -->
            <div class="col-md-6">
              <label class="form-label fw-semibold">Job Title</label>
              <input type="text" name="job_title" class="form-control form-control-lg rounded-3"
                     value="<?= htmlspecialchars($user['job_title']); ?>">
            </div>

            <!-- COMPANY NAME -->
            <div class="col-12">
              <label class="form-label fw-semibold">Company Name</label>
              <input type="text" name="company_name" class="form-control form-control-lg rounded-3"
                     value="<?= htmlspecialchars($user['company_name']); ?>">
            </div>

            <!-- START MONTH & YEAR -->
            <div class="col-md-6">
              <label class="form-label fw-semibold">Start Month</label>
              <input type="text" name="start_month" class="form-control form-control-lg rounded-3"
                     value="<?= htmlspecialchars($user['start_month']); ?>">
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Start Year</label>
              <input type="number" name="start_year" class="form-control form-control-lg rounded-3"
                     value="<?= htmlspecialchars($user['start_year']); ?>">
            </div>

            <!-- END MONTH & YEAR -->
            <div class="col-md-6">
              <label class="form-label fw-semibold">End Month</label>
              <input type="text" name="end_month" class="form-control form-control-lg rounded-3"
                     value="<?= htmlspecialchars($user['end_month']); ?>">
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">End Year</label>
              <input type="number" name="end_year" class="form-control form-control-lg rounded-3"
                     value="<?= htmlspecialchars($user['end_year']); ?>">
            </div>

            <!-- STILL IN ROLE -->
            <div class="col-md-12">
              <label class="form-label fw-semibold">Still in Role?</label>
              <select name="still_in_role" class="form-control form-control-lg rounded-3">
                <option value="1" <?= $user['still_in_role'] ? "selected" : "" ?>>Yes</option>
                <option value="0" <?= !$user['still_in_role'] ? "selected" : "" ?>>No</option>
              </select>
            </div>

            <!-- CLASSIFICATION -->
            <div class="col-md-6">
              <label class="form-label fw-semibold">Classification</label>
              <input type="text" name="classification" class="form-control form-control-lg rounded-3"
                     value="<?= htmlspecialchars($user['classification']); ?>">
            </div>

            <!-- SUB CLASSIFICATION -->
            <div class="col-md-6">
              <label class="form-label fw-semibold">Sub Classification</label>
              <input type="text" name="subclassification" class="form-control form-control-lg rounded-3"
                     value="<?= htmlspecialchars($user['subclassification']); ?>">
            </div>

            <!-- VISIBILITY -->
            <div class="col-12">
              <label class="form-label fw-semibold">Visibility (Descending)</label>
              <select name="visibility" class="form-control form-control-lg rounded-3">
                <option value="Public" <?= $user['visibility']=="Public"?"selected":""; ?>>Public</option>
                <option value="Private" <?= $user['visibility']=="Private"?"selected":""; ?>>Private</option>
              </select>
            </div>

            PROFILE PHOTO
            <div class="col-12">
              <label class="form-label fw-semibold">Profile Photo</label>
              <input class="form-control form-control-lg" type="file" name="profile_photo">

              <div class="form-check mt-3">
                <input class="form-check-input" type="checkbox" name="remove_bg" id="removeBg">
                <label class="form-check-label text-danger fw-medium" for="removeBg">
                  Remove Background
                </label>
              </div>
            </div>

          </div>

          <input type="hidden" name="user_id" value="<?= $userId ?>">

        </form>
      </div>

      <div class="modal-footer bg-light border-0 justify-content-end gap-3 pb-4 px-4">
        <button type="button" class="btn btn-lg btn-outline-secondary px-4 rounded-pill" data-bs-dismiss="modal">
          Cancel
        </button>

        <button type="submit" form="editProfileForm" class="btn btn-lg btn-purple text-white px-5 rounded-pill shadow-sm">
          Save Changes
        </button>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const modal = new bootstrap.Modal(document.getElementById('editProfileModalStandalone'));
  modal.show();
});
</script>

</body>
</html>
