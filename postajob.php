<?php
// show navbar
include 'navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Post a Job • JobAll</title>

    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@300;400;600;700&family=Bowlby+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;700&display=swap" rel="stylesheet">


    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link 
    rel="stylesheet" 
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
>

    <!-- CSS -->
    <link rel="stylesheet" href="style/postajob.css">
    <link rel="stylesheet" href="assets/site.css">
</head>
<body>

<div class="page-wrapper">
    <main class="modal-card">

        <div class="header-row">
            <h2>Post a Job</h2>
            <button class="close-x" onclick="window.history.back()">✕</button>
        </div>

        <form id="postJobForm" action="postajob_backend.php" method="POST">

            <!-- NAME -->
            <label class="lbl">NAME</label>
            <input name="job_name" type="text" placeholder="Enter Job Name" required>

            <!-- DESCRIPTION -->
            <label class="lbl">DESCRIPTION</label>
            <textarea name="description" placeholder="Description" required></textarea>

            <!-- LOCATION GRID -->
            <div class="grid-2">
                <div>
                    <label class="lbl small">City</label>
                    <input name="city" type="text" placeholder="Enter City Name">
                </div>
                <div>
                    <label class="lbl small">Barangay</label>
                    <input name="barangay" type="text" placeholder="Enter Barangay Name">
                </div>
            </div>

            <div class="grid-2">
                <div>
                    <label class="lbl small">Province</label>
                    <input name="province" type="text" placeholder="Enter Province Name">
                </div>
                <div>
                    <label class="lbl small">Postal Code</label>
                    <input name="postal_code" type="text" placeholder="Enter Postal Code">
                </div>
            </div>

            <!-- SALARY + SALARY TYPE -->
            <div class="grid-2">
                <div>
                    <label class="lbl small">Salary Amount</label>
                    <input name="salary" type="number" step="0.01" min="0" placeholder="Enter Salary Amount">
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

            <!-- EMPLOYMENT TYPE -->
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

            <!-- DATE TYPE SELECTOR -->
            <label class="lbl">Date Type</label>
            <select name="date_type" id="date_type" onchange="onDateTypeChange()">
                <option value="single">Single Date</option>
                <option value="range">Date Range</option>
                <option value="multiple">Multiple Dates</option>
            </select>

            <!-- SINGLE DATE -->
            <div id="date_single" class="date-section">
                <label class="lbl small">Select Date</label>
                <input type="date" name="single_date">
            </div>

            <!-- DATE RANGE -->
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

            <!-- MULTIPLE DATES -->
            <div id="date_multiple" class="date-section" style="display:none;">
                <label class="lbl small">Select Multiple Dates</label>
                <div class="multi-row">
                    <input id="multi_picker" type="date">
                    <button type="button" class="add-date-btn" onclick="addMultiDate()">Add</button>
                </div>

                <div id="multi_list" class="multi-list"></div>
                <!-- hidden field to submit comma list -->
                <input type="hidden" name="multiple_dates" id="multiple_dates_input" value="">
            </div>

            <!-- TIME INTERVAL -->
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

            <!-- BUTTONS -->
            <div class="btn-row">
                <button type="button" class="btn cancel" onclick="window.history.back()">Cancel</button>
                <button type="submit" class="btn primary">Post</button>
            </div>

        </form>
    </main>
</div>

<script>
/* Employment type toggle */
const btnFull = document.getElementById('btn-full');
const btnPart = document.getElementById('btn-part');
const employmentInput = document.getElementById('employment_type');

btnFull.addEventListener('click', ()=> {
    btnFull.classList.add('active');
    btnPart.classList.remove('active');
    employmentInput.value = "Full Time";
});
btnPart.addEventListener('click', ()=> {
    btnPart.classList.add('active');
    btnFull.classList.remove('active');
    employmentInput.value = "Part Time";
});

/* Date type logic */
function onDateTypeChange(){
    const type = document.getElementById('date_type').value;
    document.getElementById('date_single').style.display = (type==='single') ? 'block' : 'none';
    document.getElementById('date_range').style.display = (type==='range') ? 'block' : 'none';
    document.getElementById('date_multiple').style.display = (type==='multiple') ? 'block' : 'none';
}

/* multiple dates array management */
let multiDates = [];

function addMultiDate(){
    const picker = document.getElementById('multi_picker');
    const val = picker.value;
    if(!val) return;
    if(!multiDates.includes(val)) {
        multiDates.push(val);
    }
    renderMultiList();
    picker.value = '';
}

function renderMultiList(){
    const list = document.getElementById('multi_list');
    list.innerHTML = '';
    multiDates.forEach((d, idx) => {
        const item = document.createElement('div');
        item.className = 'multi-item';
        item.innerHTML = `<span>${d}</span><button type="button" onclick="removeMultiDate(${idx})">✕</button>`;
        list.appendChild(item);
    });
    document.getElementById('multiple_dates_input').value = multiDates.join(',');
}

function removeMultiDate(i){
    multiDates.splice(i,1);
    renderMultiList();
}

/* initial: set date type view */
onDateTypeChange();
</script>

</body>
</html>
