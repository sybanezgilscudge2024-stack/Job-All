<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
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


    <!-- Your custom styles -->
    <link rel="stylesheet" href="assets/site.css">
    <style>
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

body{
    overflow: auto;
}
</style>

</head>
<body>

<div class = "dashboard-container">
<?php include 'navbar.php'; ?>



 <div class = "dashboard-content transparent-bg">

        <div class = "dashboard_element">
            <img src="assets/images/newdashboard.jpg" alt="Dashboard Image" class="dashboard-image" style="object-fit:cover;">
        </div>
        <div class = "dashboard-text">
        <h1><b>Local Work. Real Skills. <br>Found Here.</b></h1>
        <p>JobAll connects farmers, carpenters, electricians, mechanics, <br>
        welders, and every local trade with real jobs in your town. No <br>
        corporate noise. Just honest work, close to home. Apply in <br>
        seconds. Get hired fast.</p>

        <div class = "dashboard-buttons">
        <button onclick="window.location.href='postajob.php'" class="btn btn-light">Post a Job</button>
        <button onclick="window.location.href='applyworkskill.php'" class="btn btn-primary">Apply a Job</button>
   
        </div>

         </div >
         
       
        

    </div>

</div>























    <!-- <div class="d-flex min-vh-100"> -->

        <!-- Sidebar -->
        

        <!-- Page Content -->
        <!-- <div class="content-area flex-grow-1 p-4"> -->
            <!-- <div class="container-fluid">
                <h2>
                    Welcome,
                    <strong><?php echo htmlspecialchars($user['username']); ?></strong>!
                </h2>

                <div class="row g-4 mt-3">

                    <div class="col-md-6">
                        <div class="card text-white bg-warning">
                            <div class="card-body">
                                <h5>Pending Tasks</h5>
                                <h2><?php echo $pending_count; ?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card text-white bg-danger">
                            <div class="card-body">
                                <h5>Overdue</h5>
                                <h2><?php echo $overdue_count; ?></h2>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="mt-4">
                    <a href="todos.php" class="btn btn-light">Go to TODOs</a>
                </div> -->
            <!-- </div> -->
        <!-- </div> -->
    <!-- </div> -->



   












    <!-- Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="assets/spinner.js"></script> -->
</body>
</html>
