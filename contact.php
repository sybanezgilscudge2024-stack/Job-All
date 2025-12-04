<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Us Form</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Your Site CSS (VERY IMPORTANT) -->
<link 
    rel="stylesheet" 
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    >


    <!-- Your custom styles -->
    <link rel="stylesheet" href="assets/site.css">
    <link rel="stylesheet" href="assets/profile.css">

<style>
    /* ---- PAGE-SPECIFIC CONTACT STYLES ---- */

    /* Remove the old full-page flex centering */
    body {
        background: linear-gradient(to bottom, #f8f5ff, #d9cfff) !important;
        padding: 0;
        margin: 0;
    }
    /* DEFAULT — Sidebar expanded */

    
    .contact-wrapper {
        margin-left: 200px;
        padding: 40px;
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .contact-form {
        background: rgba(255, 255, 255, 0.2);
        padding: 30px;
        border-radius: 12px;
        width: 100%;
        max-width: 650px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .contact-form h2 {
        color: #4b3fbd;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .contact-form p {
        font-size: 0.9rem;
        color: #6b5ebf;
        margin-bottom: 20px;
    }

    .form-control,
    .form-select {
        border-radius: 6px;
        border: 1px solid #b7a8f0;
        margin-bottom: 15px;
        padding: 10px;
    }

    .btn-send {
        background-color: #7a51f7;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 10px 20px;
    }

    .btn-send:hover {
        background-color: #5e3bc1;
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

<!-- REQUIRED FLEX CONTAINER (This prevents downward shifting) -->
<div class="d-flex">

    <!-- SIDEBAR -->
    <?php include 'navbar.php'; ?>

    <!-- MAIN CONTENT -->
    <main class="content-area">

        <div class="contact-wrapper">
            <div class="contact-form">

                <h2>Contact Us</h2>
                <p>Got a question? We’re happy to help!<br>
                Just fill out the short form below and we’ll get back to you within 24 hours (often much sooner).</p>

                <form>

                    <div class="row g-2">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="First Name">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Last Name">
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Contact Number (Optional)">
                        </div>
                        <div class="col">
                            <input type="email" class="form-control" placeholder="Email Address">
                        </div>
                    </div>

                    <label for="subject" class="form-label">Subject</label>
                    <select id="subject" class="form-select">
                        <option selected>Please select</option>
                        <option>General Inquiry</option>
                        <option>Support</option>
                        <option>Feedback</option>
                    </select>

                    <label for="additional" class="form-label">Additional Information (Max 1000 characters)</label>
                    <textarea id="additional" class="form-control" rows="4"></textarea>

                    <button type="submit" class="btn btn-send mt-2">Send</button>

                </form>

            </div>
        </div>

    </main>

</div> <!-- END FLEX -->

</body>
</html>
