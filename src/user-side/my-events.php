<?php
include "../backend/session.php";
include "../backend/functions.php";
include "../backend/check_login.php";



if (!empty($_SESSION["id"])) {
  $id = $_SESSION["id"];
  $result = mysqli_query($connection, "SELECT * FROM users WHERE id = $id");
  $row = mysqli_fetch_assoc($result);
}

$id = $_SESSION["id"];
$result2 = mysqli_query($connection, "SELECT * FROM participants WHERE user_id = $id");

?>

<?php include "../layouts/_main_page_header.php"; ?>

<body id="hero">

  <!-- ======= Header ======= -->

  <header id="header" class="header d-flex align-items-center">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img class="see_logo" src="../assets/img/main_page/see_logo.png" alt="">
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="landing.php">PROGRAMS</a></li>
          <li><a href="training.php">TRAININGS</a></li>
          <li><a href="volunteer.php">VOLUNTEER</a></li>
          <li><a href="awareness.php">AWARENESS</a></li>
          <li><a href="news.php">NEWS</a></li>
          <li><a href=" about.php" style="margin-right:  50px;">ABOUT</a></li>

          <li class="dropdown">
            <a href="#">
              <span class="user-icon"
                style="display: inline-block; width: 50px; height: 50px; overflow: hidden; border-radius: 50%;">
                <img src="../assets/img/main_page/profile_icon.png" alt=""
                  style="width: 100%; height: 100%; object-fit: cover;">
              </span>
              <span class="user-name" style="margin-left: 10px;">
                <?php echo $row['firstName'] ?>
                <?php echo $row['lastName'] ?>
              </span></a>
            <ul>
              <li><a href="profile.php">Profile</a></li>
              <li><a href="my-events.php">My Events</a></li>
              <li><a href="contact.php">Report/Feedback</a></li>
              <li><a onclick="confirmLogout()">Logout</a></li>
            </ul>
          </li>
        </ul>
      </nav><!-- .navbar -->

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i> <!-- .buttons-->

    </div>
  </header><!-- End Header -->
  <!-- End Header -->

  <section id="recent-posts" class="recent-posts sections-bg" style="background-color:#E5F9FA;">
    <div class="container" data-aos="fade-up">

      <div class="section-header">
        <h1 style="text-align:center; font-weight: 900; text-decoration: none;"> My Upcoming Volunteer Programs</h1>
      </div>

      <div class="row gy-4">
          <?php
  $num = mysqli_num_rows($result2);
  if ($num > 0) {
    while ($row = mysqli_fetch_array($result2)) {
      echo '<div class="col-xl-4 col-md-6">';
        echo '<article>';
          echo '<div class="post-img">';
            echo '<img src="../upload/cta-bg.jpg" alt="" class="img-fluid">';
          echo '</div>';
          echo '<h2 class="title">'. $row['event_title'].'</h2>';
          echo '<p class="post-author" style="color: red;"> Schedule:'. $row['date'] .' || '.$row['time'].'</p>';
          echo '<br>';
          echo '<p>' . substr($row['body'], 0, 400) . '</p>';
        

      echo '</article>';
   echo '</div>';
    }
  }
  ?>

      </div>
  </section><!-- End Recent Blog Posts Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-info">
          <a href="index.html" class="logo d-flex align-items-center">
            <span>SEE TURTLE PH</span>
          </a>
          <p>We work to protect sea turtle populations and their
            habitats from threats such as pollution, habitat destruction,
            and climate change. We also raise public awareness about
            the importance of sea turtles and their role in maintaining
            healthy marine ecosystems. </p>
          <div class="social-links d-flex mt-4">
            <a href="https://www.facebook.com/projectcurma" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/projectcurma" class="instagram"><i class="bi bi-instagram"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="training.php">Trainings</a></li>
            <li><a href="volunteer.php">Volunteer</a></li>
            <li><a href="awareness.php">Awareness</a></li>
            <li><a href="news.php">News</a></li>
            <li><a href="about.php">About</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <!--
          <h4>Our Services</h4>
          <ul>

            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
            -->
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>
            374 St. Jude Subdivision<br>
            Ili Norte, 2514 San Juan, La Union<br>
            Philippines <br><br>
            <strong>Phone:</strong> +63 9423664519<br>
            <strong>Email:</strong> seeturtle2023@gmail.com<br>
          </p>

        </div>

      </div>
    </div>

    <div class="container mt-4">
      <div class="copyright">
        &copy; Copyright <strong><span>Impact</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/impact-bootstrap-business-website-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

    <section id="topbar" class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
      </div>
    </section><!-- End Top Bar -->

  </footer><!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>
  <?php include "../layouts/_main_page_footer.php"; ?>