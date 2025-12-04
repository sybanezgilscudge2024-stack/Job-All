<?php
$categories = include 'categories.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Profile Setup – JobAll</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@300;400;500;600&family=Bowlby+One&display=swap" rel="stylesheet">
</head>

<body>
    <header class="main-header">
        <div class="logo-container">
            <img src="../assets/images/logo.png" alt="JobAll Logo" class="logo">
            <span class="brand-name">JobAll</span>
        </div>
    </header>
    <div class="page-wrapper">
        <section class="section section-1">

            <h1 class="title">You’re one click away</h1>
            <p class="subtitle">Let local employers find YOU on JobAll</p>

            <form action="save_profile.php" method="POST" class="form-box">

                <div class="two-col">
                    <div>
                        <label>First Name</label>
                        <input type="text" name="fname" required>
                    </div>
                    <div>
                        <label>Last Name</label>
                        <input type="text" name="lname" required>
                    </div>
                </div>

                <label>Email Address</label>
                <input type="email" name="email" required>

                <h3 class="section-title">Account Security</h3>

                <div class="two-col">
                    <div>
                        <label>Create Password</label>
                        <input type="password" name="password" required placeholder="Enter password">
                    </div>

                    <div>
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" required placeholder="Confirm password">
                    </div>
                </div>
                <label>Home Address</label>
                <input type="text" name="address" required>

                <!-- EXPERIENCE SWITCH -->
                <label class="exp-label">Recent Experience</label>
                <div class="exp-toggle">
                    <label class="switch">
                        <input type="checkbox" id="expSwitch" name="has_experience">
                        <span class="slider"></span>
                    </label>
                    <span class="exp-text">I have experience</span>
                </div>

                <div id="expFields" class="exp-fields">
                    <label>Job Title</label>
                    <input type="text" name="job_title">

                    <label>Company Name</label>
                    <input type="text" name="company_name">

                    <div class="two-col">
                        <div>
                            <label class="form-label">Start Month</label>
                            <select name="start_month" class="form-select" required>
                                <option value="">Select Month</option>
                                <?php
                                $months = [
                                    "January",
                                    "February",
                                    "March",
                                    "April",
                                    "May",
                                    "June",
                                    "July",
                                    "August",
                                    "September",
                                    "October",
                                    "November",
                                    "December"
                                ];
                                foreach ($months as $m) {
                                    echo "<option value='$m'>$m</option>";
                                }
                                ?>
                            </select>
                            <label class="form-label">Start Year</label>
                            <select name="start_year" class="form-select" required>
                                <option value="">Select Year</option>
                                <?php
                                for ($y = date("Y"); $y >= 1980; $y--) {
                                    echo "<option value='$y'>$y</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">End Month</label>
                            <select name="end_month" class="form-select">
                                <option value="">Select Month</option>
                                <?php
                                foreach ($months as $m) {
                                    echo "<option value='$m'>$m</option>";
                                }
                                ?>
                            </select>
                            <label class="form-label">End Year</label>
                            <select name="end_year" class="form-select">
                                <option value="">Select Year</option>
                                <?php
                                for ($y = date("Y"); $y >= 1980; $y--) {
                                    echo "<option value='$y'>$y</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="reg-section">

                        <label>Classification</label>
                        <select id="classification" name="classification">
                            <option value="">Select classification</option>

                            <?php foreach ($categories as $main => $subs): ?>
                                <option value="<?= $main ?>"><?= $main ?></option>
                            <?php endforeach; ?>
                        </select>

                        <label>Sub-classification</label>
                        <select id="sub_classification" name="sub_classification" disabled>
                            <option value="">Select sub-classification</option>
                        </select>

                    </div>
                </div>



                <div class="visibility-section">

                    <h3 class="section-title">Maximise your chances of being found on JobAll</h3>
                    <p class="section-desc">
                        Control who can search your profile, what information they<br>
                        have access to, and who can contact you.
                    </p>

                    <div class="vis-toggle">
                        <label class="checkbox-item">
                            <input type="checkbox" name="visibility[]" value="public">

                        </label>
                        <span class="checkbox-label">
                            <strong>Public</strong><br>
                            Your profile is publicly searchable. Employers can access your full profile, resume and contact details.
                        </span>
                    </div>

                    <div class="vis-toggle">
                        <label class="checkbox-item">
                            <input type="checkbox" name="visibility[]" value="standard">

                        </label>
                        <span class="checkbox-label">
                            <strong>Standard</strong><br>
                            Employers can review your profile and resume, but they cannot contact you directly via JobAll.
                        </span>
                    </div>

                    <div class="vis-toggle">
                        <label class="checkbox-item">
                            <input type="checkbox" name="visibility[]" value="limited">

                        </label>
                        <span class="checkbox-label">
                            <strong>Limited</strong><br>
                            Some employers can view your profile, but not your resume and contact details.
                        </span>
                    </div>

                    <div class="vis-toggle">
                        <label class="checkbox-item">
                            <input type="checkbox" name="visibility[]" value="hidden">

                        </label>
                        <span class="checkbox-label">
                            <strong>Hidden</strong><br>
                            Employers cannot search for you. Your profile can only be seen by employers as part of job applications.
                        </span>
                    </div>
                </div>
                <p class="visibility-note">
                    For all settings, your Profile including any verified credentials will be sent to the employer with your application.
                    <a href="#" class="learn-more">Learn more about visibility.</a>
                </p>

                <div class="submit-container">
                    <button type="submit" class="submit-btn">Save & Continue</button>
                </div>
            </form>
        </section>
    </div>

    <script>
        document.getElementById("expSwitch").addEventListener("change", function() {
            const expFields = document.getElementById("expFields");
            expFields.style.display = this.checked ? "block" : "none";
        });
    </script>

</body>

</html>

<script>
    const categories = <?php echo json_encode($categories); ?>;

    const classSelect = document.getElementById("classification");
    const subSelect = document.getElementById("sub_classification");

    classSelect.addEventListener("change", function() {
        const chosenClass = this.value;

        // Reset subcategory dropdown
        subSelect.innerHTML = '<option value="">Select sub-classification</option>';

        if (chosenClass === "") {
            subSelect.disabled = true;
            return;
        }

        // Populate subclasses
        const subs = categories[chosenClass];

        subs.forEach(sub => {
            let option = document.createElement("option");
            option.value = sub;
            option.textContent = sub;
            subSelect.appendChild(option);
        });

        subSelect.disabled = false;
    });
</script>