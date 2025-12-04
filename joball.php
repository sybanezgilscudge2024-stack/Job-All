<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Professional Services | Worker Frontpage</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@300;400;600;700;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="assets/site.css">
  <style>
    html,
    body {
      min-height: 100%;
    }

    body {
      font-family: 'Archivo', sans-serif;
      background: linear-gradient(to top, #c0b5ff, #d9d2ff);
      background-repeat: no-repeat;
      background-attachment: fixed;
      display: flex;
      flex-direction: column;
      gap: 200px;
      /* keeps the gradient fixed on scroll */
    }


    /* HERO */
    .hero {
      min-height: 100vh;
      background:
        linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.55)),
        url("assets/images/newdashboard.jpg");
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 60px 20px;
      position: relative;
      overflow: hidden;
    }

    .hero h1 {
      font-size: 3rem;
      font-weight: 800;
    }

    .hero p {
      max-width: 600px;
      margin: 20px auto;
      opacity: 0.95;
    }

    .scroll-indicator {
      position: absolute;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      font-size: 14px;
      opacity: 0.8;
      animation: bounce 1.5s infinite;
    }

    @keyframes bounce {

      0%,
      100% {
        transform: translate(-50%, 0);
      }

      50% {
        transform: translate(-50%, 8px);
      }
    }

    .btn-main {
      background: white;
      color: #5f46e8;
      font-weight: 600;
      border-radius: 50px;
      padding: 12px 28px;
      border: none;
    }

    section {
      padding: 80px 20px;
    }

    .section-title {
      text-align: center;
      margin-bottom: 60px;
    }

    .btn {
      border-radius: 10px !important;
    }

    .service-card,
    .feature-card,
    .testimonial-card {
      background: white;
      border-radius: 18px;
      padding: 30px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
      transition: 0.5s ease;
      opacity: 0;
      transform: translateY(60px);
    }

    .show {
      opacity: 1;
      transform: translateY(0);
    }

    .service-card:hover,
    .feature-card:hover,
    .testimonial-card:hover {
      transform: translateY(-10px) scale(1.02);
    }

    .about-box {
      background: white;
      border-radius: 20px;
      padding: 50px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .popup {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 999;
    }

    .popup-box {
      background: white;
      border-radius: 20px;
      padding: 40px;
      width: 90%;
      max-width: 400px;
      text-align: center;
      animation: popupFade 0.3s ease;
    }

    @keyframes popupFade {
      from {
        transform: scale(0.8);
        opacity: 0;
      }

      to {
        transform: scale(1);
        opacity: 1;
      }
    }

    footer {
      background: #15152a;
      color: white;
      padding: 50px 20px 20px;
    }

    .footer-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 30px;
      margin-bottom: 30px;
    }

    .back-to-top {
      
      position: fixed;
      bottom: 10%;
      left: 50%;
      background: #5f46e8;
      color: white;
      border: none;
      border-radius: 50px;
      padding: 10px 18px;
      display: none;
      z-index: 999;
    }
    
section {
  padding: 140px 20px; /* more top & bottom padding */
}

/* Hero section extra bottom space */
.hero {
  padding: 100px 20px 150px 20px;
}





  </style>
</head>

<body>

  <!-- HERO -->
  <!-- HERO -->
<div class="hero d-flex flex-column flex-md-row align-items-center justify-content-between">
  <div class="hero-text text-center text-md-start">
    <h1><b>Local Work. Real Skills. <br>Found Here.</b></h1>
    <p>JobAll connects farmers, carpenters, electricians, mechanics, welders, and every local trade with real jobs in your town. No corporate noise. Just honest work, close to home. Apply in seconds. Get hired fast.</p>
    <div class="dashboard-buttons">
      <button onclick="window.location.href='login.php'" class="btn btn-light btn-lg me-2">Sign In</button>
      <button onclick="window.location.href='profile-setup/index.php'" class="btn btn-primary btn-lg">Register</button>
    </div>
  </div>

    
</div>

<!-- SERVICES -->
<section class="bg-light py-5">
  <div class="container">
    <div class="section-title mb-5 text-center">
      <h2><b>My Services</b></h2>
      <p>Professional solutions tailored for your needs</p>
    </div>
    <div class="row g-4">
      <div class="col-md-3">
        <div class="service-card text-center">
          
          <h5>Consultation</h5>
          <p>Expert advice to solve problems efficiently.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="service-card text-center">
          <h5>Technical Work</h5>
          <p>High-quality technical execution.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="service-card text-center">
          <h5>Maintenance</h5>
          <p>Long-term system reliability.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="service-card text-center">
          <h5>Training</h5>
          <p>Upskill your team for better efficiency.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FEATURES -->
<section class="py-5">
  <div class="container">
    <div class="section-title text-center mb-5">
      <h2><b>Why Choose Me?</b></h2>
      <p>Fast, reliable, and professional services for all trades.</p>
    </div>
    <div class="row g-4 justify-content-center">
      <div class="col-md-4">
        <div class="feature-card text-center">
          <h5>Fast Response Guarantee</h5>
          <p>Every inquiry is answered within 24 hours.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature-card text-center">
          <h5>Quality Work</h5>
          <p>Consistent high-quality results in every project.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature-card text-center">
          <h5>Continuous Support</h5>
          <p>Support throughout the project lifecycle.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- GALLERY -->
<section class="bg-light py-5">
  <div class="container">
    <div class="section-title text-center mb-5">
      <h2><b>Our Work</b></h2>
      <p>Explore some of the jobs we have successfully completed.</p>
    </div>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="gallery-card position-relative overflow-hidden">
          <div class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center">
            <p class="text-white fs-5">Electrical Work</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="gallery-card position-relative overflow-hidden">
          <div class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center">
            <p class="text-white fs-5">Carpentry</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="gallery-card position-relative overflow-hidden">
           <div class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center">
            <p class="text-white fs-5">Welding</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- TESTIMONIALS -->
<section class="py-5">
  <div class="container">
    <div class="section-title text-center mb-5">
      <h2><b>Client Feedback</b></h2>
    </div>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="testimonial-card text-center p-4">
          <p>"Super professional and fast!"</p>
          <h6 class="mt-2">– John D.</h6>
        </div>
      </div>
      <div class="col-md-4">
        <div class="testimonial-card text-center p-4">
          <p>"Excellent communication and quality work."</p>
          <h6 class="mt-2">– Sarah K.</h6>
        </div>
      </div>
      <div class="col-md-4">
        <div class="testimonial-card text-center p-4">
          <p>"Highly recommended service."</p>
          <h6 class="mt-2">– Michael L.</h6>
        </div>
      </div>
    </div>
  </div>
</section>


  <!-- ABOUT -->
  <section>
    <div class="container">
      <div class="about-box text-center">
        <h2>Why Choose Me?</h2>
        <p>I bring years of experience, fast response, and attention to detail in every project.</p>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="footer-grid">
      <div>
        <h5>About</h5>
        <p>Professional freelance worker delivering consistent quality.</p>
      </div>
      <div>
        <h5>Services</h5>
        <p>Consultation<br>Technical Work<br>Maintenance</p>
      </div>
      <div>
        <h5>Contact</h5>
        <p>Email: info@example.com<br>Phone: 123-456-7890</p>
      </div>
    </div>
    <p class="text-center">© 2025 Professional Worker</p>


    <button class="back-to-top scroll-indicator" id="topBtn" > ↑ Top ↑</button>




  </footer>

  
  <!-- POPUP -->
  <div class="popup" id="popup">
    <div class="popup-box">
      <h4>Contact Me</h4>
      <p>Send a message to start your project.</p><input type="text" class="form-control mb-2" placeholder="Your Name"><input type="email" class="form-control mb-3" placeholder="Email Address"><button class="btn btn-primary w-100 mb-2">Send</button><button class="btn btn-outline-secondary w-100" onclick="closePopup()">Close</button>
    </div>
  </div>



  
 <script>
const revealItems = document.querySelectorAll(
  '.service-card, .feature-card, .testimonial-card'
);

const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      // Get all items in this section that are intersecting
      const items = Array.from(revealItems).filter(item => !item.classList.contains('show'));
      
      items.forEach((item, index) => {
        setTimeout(() => {
          item.classList.add('show');   // Animate IN with stagger
        }, index * 200); // 200ms interval between each card
      });
    }
  });
}, {
  threshold: 0.2
});

revealItems.forEach(item => observer.observe(item));

// BACK TO TOP BUTTON
const topBtn = document.getElementById("topBtn");
window.addEventListener("scroll", () => {
  topBtn.style.display = window.scrollY > 400 ? "block" : "none";
});

topBtn.onclick = () => window.scrollTo({
  top: 0,
  behavior: 'smooth'
});
</script>



</body>

</html>