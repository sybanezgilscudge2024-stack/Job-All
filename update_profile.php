<?php
session_start();
include "db.php";

// Must be logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION["user_id"];

// Handle form submit
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Collect fields
    $fname              = $_POST["fname"] ?? "";
    $lname              = $_POST["lname"] ?? "";
    $email              = $_POST["email"] ?? "";
    $password           = $_POST["password"] ?? "";
    $home_address       = $_POST["home_address"] ?? "";
    $has_experience     = isset($_POST["has_experience"]) ? 1 : 0;
    $job_title          = $_POST["job_title"] ?? "";
    $company_name       = $_POST["company_name"] ?? "";
    $start_month        = $_POST["start_month"] ?? "";
    $start_year         = $_POST["start_year"] ?? "";
    $end_month          = $_POST["end_month"] ?? "";
    $end_year           = $_POST["end_year"] ?? "";
    $still_in_role      = isset($_POST["still_in_role"]) ? 1 : 0;
    $classification     = $_POST["classification"] ?? "";
    $subclassification  = $_POST["subclassification"] ?? "";
    $visibility         = $_POST["visibility"] ?? "public";

    // Handle password (update only if entered)
    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_BCRYPT);
    } else {
        // Get old password if user did not change
        $getOld = $conn->prepare("SELECT password FROM profiles WHERE id = ?");
        $getOld->bind_param("i", $userId);
        $getOld->execute();
        $old = $getOld->get_result()->fetch_assoc();
        $password = $old["password"];
    }

    // ----------------------------
    // 🖼 HANDLE PROFILE PHOTO UPLOAD
    // ----------------------------

    $profile_photo = null;

    if (!empty($_FILES["profile_photo"]["name"])) {
        $targetDir = "uploads/profile_photos/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = time() . "_" . basename($_FILES["profile_photo"]["name"]);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $targetFile)) {
            $profile_photo = $targetFile;
        }
    }

    // If no new photo, keep old
    if (empty($profile_photo)) {
        $getImg = $conn->prepare("SELECT profile_photo FROM profiles WHERE id = ?");
        $getImg->bind_param("i", $userId);
        $getImg->execute();
        $oldImg = $getImg->get_result()->fetch_assoc();
        $profile_photo = $oldImg["profile_photo"];
    }

    // -----------------------------------------------------------
    // UPDATE QUERY — updates ALL fields including photo + password
    // -----------------------------------------------------------

    $query = $conn->prepare("
        UPDATE profiles SET
            fname = ?, 
            lname = ?, 
            email = ?, 
            password = ?, 
            home_address = ?, 
            has_experience = ?, 
            job_title = ?, 
            company_name = ?, 
            start_month = ?, 
            start_year = ?, 
            end_month = ?, 
            end_year = ?, 
            still_in_role = ?, 
            classification = ?, 
            subclassification = ?, 
            visibility = ?, 
            profile_photo = ?
        WHERE id = ?
    ");

    $query->bind_param(
        "sssssisisssiissssi",
        $fname,
        $lname,
        $email,
        $password,
        $home_address,
        $has_experience,
        $job_title,
        $company_name,
        $start_month,
        $start_year,
        $end_month,
        $end_year,
        $still_in_role,
        $classification,
        $subclassification,
        $visibility,
        $profile_photo,
        $userId
    );

    if ($query->execute()) {
        echo "<script>alert('Profile updated successfully!'); window.location.href='profilenew.php';</script>";
        exit;
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>
