<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Post a Job • JobAll</title>

    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@300;400;600;700&family=Bowlby+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="style/postajob.css">
    <link rel="stylesheet" href="assets/site.css">
    <link rel="stylesheet" href="assets/profile.css">
    <link rel="stylesheet" href="profile-setup/spinner.css">
<style>
/* POPUP OVERLAY */
.popup-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.55);
    justify-content: center;
    align-items: center;
    z-index: 999999;
}


/* POPUP BOX */
.popup-box {
    background: #fff;
    padding: 35px;
    width: 380px;
    text-align: center;
    border-radius: 14px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.25);
    animation: popupFade 0.25s ease-out;
}

@keyframes popupFade {
    from {opacity: 0; transform: translateY(-10px);}
    to   {opacity: 1; transform: translateY(0);}
}

.popup-icon {
    font-size: 68px;
    color: #4CAF50;
    margin-bottom: 15px;
}

.popup-btn {
    margin-top: 18px;
    padding: 10px 25px;
    border: none;
    background: #6a40ff;
    color: white;
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




/* ---- MOBILE RESPONSIVE ---- */
/* ---- MOBILE & TABLET RESPONSIVE ---- */
@media (max-width: 768px) {
 

    .profile-container {
        flex-direction: column;
    }

    .content-wrapper {
        margin-left: 0;
        padding: 20px;
    }

    .postajob-table {
        margin-left: 40px;
    }

    .grid-2 {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .btn-row {
        flex-direction: column;
        gap: 10px;
    }

    .employment-wrapper {
        flex-direction: column;
        gap: 10px;
    }
}

@media (max-width: 480px) {
    .postajob-table {
        padding: 0 5px;
    }

    .popup-box {
        width: 90%;
        padding: 25px;
    }

    .btn-row button {
        width: 100%;
    }

    input, textarea, select {
        font-size: 0.9rem;
        padding: 8px;
    }

    .lbl {
        font-size: 0.85rem;
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
    <div class=" content-wrapper">
    <div class="postajob-table">
        <main class="modal-card">

            <div class="header-row">
                <h2>Post a Job</h2>
                <button class="close-x" onclick="window.history.back()">✕</button>
            </div>

            <form id="postJobForm" action="postajob_backend.php" method="POST">

                <label class="lbl">NAME</label>
                <input name="job_name" type="text" placeholder="Enter Job Name" required>

                <label class="lbl">DESCRIPTION</label>
                <textarea name="description" placeholder="Description" required></textarea>

                <div class="grid-2">
                    <div>
                        <label class="lbl small">City</label>
                        <input name="city" type="text">
                    </div>
                    <div>
                        <label class="lbl small">Barangay</label>
                        <input name="barangay" type="text">
                    </div>
                </div>

                <div class="grid-2">
                    <div>
                        <label class="lbl small">Province</label>
                        <input name="province" type="text">
                    </div>
                    <div>
                        <label class="lbl small">Postal Code</label>
                        <input name="postal_code" type="text">
                    </div>
                </div>

                <div class="grid-2">
                    <div>
                        <label class="lbl small">Salary Amount</label>
                        <input name="salary" type="number">
                    </div>
                    <div>
                        <label class="lbl small">Salary Type</label>
                        <select name="salary_type">
                            <option value="hour">Per Hour</option>
                            <option value="day">Per Day</option>
                            <option value="week">Per Week</option>
                            <option value="month">Per Month</option>
                        </select>
                    </div>
                </div>

                <div class="grid-2 align-center">
                    <div>
                        <label class="lbl small">Employment Type</label>
                        <div class="employment-wrapper">
                            <button type="button" class="emp-btn" id="btn-full">Full Time</button>
                            <button type="button" class="emp-btn active" id="btn-part">Part Time</button>
                        </div>
                        <input type="hidden" name="employment_type" id="employment_type" value="Part Time">
                    </div>

                    <div class="urgent-block">
                        <label class="lbl small">&nbsp;</label>
                        <div class="urgent-row">
                            <input id="urgent" name="urgent" type="checkbox" value="1">
                            <label for="urgent" class="urgent-label">Urgent</label>
                        </div>
                    </div>
                </div>

                <label class="lbl">Date Type</label>
                <select name="date_type" id="date_type" onchange="onDateTypeChange()">
                    <option value="single">Single Date</option>
                    <option value="range">Date Range</option>
                    <option value="multiple">Multiple Dates</option>
                </select>

                <div id="date_single" class="date-section">
                    <label class="lbl small">Select Date</label>
                    <input type="date" name="single_date">
                </div>

                <div id="date_range" class="date-section" style="display:none;">
                    <div class="grid-2">
                        <div>
                            <label class="lbl small">Start Date</label>
                            <input type="date" name="range_start">
                        </div>
                        <div>
                            <label class="lbl small">End Date</label>
                            <input type="date" name="range_end">
                        </div>
                    </div>
                </div>

                <div id="date_multiple" class="date-section" style="display:none;">
                    <label class="lbl small">Select Multiple Dates</label>
                    <div class="multi-row">
                        <input id="multi_picker" type="date">
                        <button type="button" class="add-date-btn" onclick="addMultiDate()">Add</button>
                    </div>

                    <div id="multi_list" class="multi-list"></div>
                    <input type="hidden" name="multiple_dates" id="multiple_dates_input">
                </div>

                <div class="grid-2">
                    <div>
                        <label class="lbl small">Start Time</label>
                        <input name="start_time" type="time" required>
                    </div>
                    <div>
                        <label class="lbl small">End Time</label>
                        <input name="end_time" type="time" required>
                    </div>
                </div>

                <div class="btn-row">
                    <button type="button" class="btn cancel" onclick="window.history.back()">Cancel</button>
                    <button type="submit" class="btn primary">Post</button>
                </div>

            </form>
        </main>
    </div>
    </div>
</div>



<!-- POPUP -->
<div id="jobPostedModal" class="popup-overlay">
    <div class="popup-box">
        <i class="bi bi-check-circle-fill popup-icon"></i>
        <h3>Job Posted Successfully!</h3>
        <p>Your job listing is now live and visible to applicants.</p>
        <button class="popup-btn" onclick="closePopup()">OK</button>
    </div>
</div>


<script>
    

window.addEventListener('DOMContentLoaded', () => {
  const preloader = document.getElementById('hammerSpinnerModal');
  preloader.style.transition = 'opacity 0.5s';
  preloader.style.opacity = '0';
  setTimeout(() => preloader.style.display = 'none', 500);
});





// Employment type toggle
const btnFull = document.getElementById("btn-full");
const btnPart = document.getElementById("btn-part");
const employmentInput = document.getElementById("employment_type");

btnFull.onclick = () => {
    btnFull.classList.add("active");
    btnPart.classList.remove("active");
    employmentInput.value = "Full Time";
};

btnPart.onclick = () => {
    btnPart.classList.add("active");
    btnFull.classList.remove("active");
    employmentInput.value = "Part Time";
};

// Date type logic
function onDateTypeChange() {
    const type = document.getElementById("date_type").value;
    document.getElementById("date_single").style.display = type === "single" ? "block" : "none";
    document.getElementById("date_range").style.display = type === "range" ? "block" : "none";
    document.getElementById("date_multiple").style.display = type === "multiple" ? "block" : "none";
}

// Popup control
function showPostedPopup() {
    document.getElementById("jobPostedModal").style.display = "flex";
}

function closePopup() {
    document.getElementById("jobPostedModal").style.display = "none";
    window.location.href = "dashboard.php"; 
}

// Auto-show popup if URL contains success=1
document.addEventListener("DOMContentLoaded", () => {
    const url = new URLSearchParams(window.location.search);
    if (url.get("success") === "1") {
        showPostedPopup();
    }
});
</script>

</body>
</html>
