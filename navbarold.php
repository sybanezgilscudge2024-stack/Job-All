<nav id="sidebarMenu" class="sidebar sidebar-collapsed bg-primary">
    <div class="d-flex flex-column min-vh-100">
        <ul class="nav flex-column flex-grow-1 sidebar-nav">

            <li class="nav-item">
                <div class="nav-link text-white items">
                    <img src="assets/images/logo.png" 
    style = "display: inline-flex;
    width: 40px;
    justify-content: normal;" 
    alt = "logo">
                    <a class = "label nav-link text-white " href="dashboard.php" style = "font-size: 3rem !important;"><strong> JobAll </strong>
                    <span class="icon"><i class="bi bi-list"></i></span>
                </a>
                </div>
            </li>



            
            <li class="nav-item">
                <div class="nav-link text-white items">
                    <span class="icon"><i class="bi bi-grid-fill"></i></span>
                    <a class = "label nav-link text-white " href="dashboard.php" >Dashboard
                </a>
                </div>
            </li>





            <li class="nav-item">
                <div class="nav-link text-white items">
                    <span class="icon"><i class="bi bi-pencil-square"></i></span>
                    <a class = "label nav-link text-white " href="postajob.php" >Post a Job
                </a>
                </div>
            </li>

           
             <li class="nav-item">
                <div class="nav-link text-white items">
                    <span class="icon"><i class="bi bi-person-badge"></i></span>
                    <a class = "label nav-link text-white " href="hireaworker.php" >Hire a Worker
                </a>
                </div>
            </li>

            <li class="nav-item">
                <div class="nav-link text-white items">
                    <span class="icon"><i class="bi bi-newspaper"></i></span>
                    <a class = "label nav-link text-white " href="joblisting.php" >Job Listing
                </a>
                </div>
            </li>

            <li class="nav-item">
                <div class="nav-link text-white items">
                    <span class="icon"><i class="bi bi-file-earmark-post"></i></span>
                    <a class = "label nav-link text-white " href="applyworkskill.php" >Apply Work/Skill
                </a>
                </div>
            </li>

           
            <li class="nav-item">
                <div class="nav-link text-white items">
                    <span class="icon"><i class="bi bi-send"></i></span>
                    <a class = "label nav-link text-white " href="contact.php" >Contact
                </a>
                </div>
            </li>

            <li class="nav-item">
                <div class="nav-link text-white items">
                    <span class="icon"><i class="bi bi-person-square"></i></span>
                    <a class = "label nav-link text-white " href="profilenew.php" >Profile
                </a>
                </div>
            </li>

         
             <li class="nav-item mt-auto logout items">
                <p class="nav-link text-white">
                    <span class="icon"><i class="bi bi-box-arrow-in-right"></i></span>
                    <a class = "label nav-link text-white " href="logout.php" >logout
                </a>
            </li>

         
        </ul>
    </div>
</nav>





<script>
    const sidebar = document.getElementById('sidebarMenu');
    const links = sidebar.querySelectorAll('.nav-link');

    links.forEach(link => {
        link.addEventListener('click', function(e) {
            // Toggle collapsed class on sidebar
            sidebar.classList.toggle('sidebar-collapsed');
            
        });
    });
    document.addEventListener('click', function(e) {
        if (!sidebar.contains(e.target)) {
            sidebar.classList.add('sidebar-collapsed');
        }
    });
</Script>