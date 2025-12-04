<?php
session_start();
$categories = include 'profile-setup/categories.php';

// User must be logged in
if (!isset($_SESSION["user_id"])) {
    die("You must log in first.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply as Worker</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="assets/site.css">
    <link rel="stylesheet" href="assets/profile.css">

    <style>
        .modal-box {
            position: absolute;
            top: 10px;
            left: 400px;
            width: 900px;
            height: 600px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        body {
            height: 100vh;
            font-family: Arial, sans-serif;
        }

        .title {
            font-size: 24px;
            font-weight: 700;
            color: #7d3cff;
        }

        .d-flex {

            min-height: 0vh;
        }

        .close-btn {
            cursor: pointer;
            font-size: 20px;
        }

        .form-label {
            font-weight: 600;
            color: #555;
        }

        .btn-cancel {
            background: white;
            border: 1px solid #7d3cff;
            color: #7d3cff;
            border-radius: 10px;
            width: 120px;
            height: 40px;
        }

        .btn-post {
            background: #7d3cff;
            color: white;
            border-radius: 10px;
            width: 120px;
            height: 40px;
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

    <div class="profile-container">
        <?php include 'navbar.php'; ?>

        <div class="modal-box">

            <div class="justify-content-between align-items-center mb-3">
                <span class="title">Apply as Worker</span>
                <span class="close-btn" onclick="window.history.back()">×</span>
            </div>

            <!-- FORM START (same design) -->
            <form action="apply_work_backend.php" method="POST">

                <div class="mb-3">
                    <label class="form-label">WORK NAME</label>
                    <input type="text" name="work_name" class="form-control" required placeholder="Enter Work">
                </div>

                <div class="mb-3">
                    <label class="form-label">DESCRIPTION</label>
                    <textarea name="description" class="form-control" rows="4" required placeholder="Description"></textarea>
                </div>

                <p class="text-secondary small mb-1">Select your work field</p>

                <div class="mb-3">
                    <label class="form-label">Classification</label>
                    <select id="classification" name="classification" class="form-select" required>
                        <option value="">Select classification</option>
                        <?php foreach ($categories as $main => $subs): ?>
                            <option value="<?= $main ?>"><?= $main ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">Sub-classification</label>
                    <select id="sub_classification" name="sub_classification" class="form-select" disabled required>
                        <option value="">Select sub-classification</option>
                    </select>
                </div>

                <div class="justify-content-center gap-3 d-flex">
                    <button type="button" class="btn-cancel" onclick="window.history.back()">Cancel</button>
                    <button type="submit" class="btn-post">Post</button>
                </div>

            </form>
            <!-- FORM END -->

        </div>
    </div>

    <script>
        const categories = <?php echo json_encode($categories); ?>;

        // Populate sub classification based on classification
        document.getElementById("classification").addEventListener("change", function() {
            let selected = this.value;
            let sub = document.getElementById("sub_classification");

            sub.innerHTML = '<option value="">Select sub-classification</option>';

            if (selected === "") {
                sub.disabled = true;
                return;
            }

            categories[selected].forEach(sc => {
                let opt = document.createElement("option");
                opt.value = sc;
                opt.textContent = sc;
                sub.appendChild(opt);
            });

            sub.disabled = false;
        });
    </script>

</body>

</html>