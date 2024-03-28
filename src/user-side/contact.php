<?php
include "../backend/session.php";
include "../backend/functions.php";
include "../backend/check_login.php";


$material = get_all_materials();

if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($connection, "SELECT * FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
}

$name = $row['firstName'] . ' ' . $row['lastName'];

if ($_POST['submit']) {
  $errors = validate_report($_POST['subject'], $_POST['message']);
  if (empty($errors)) {
    $save_report = save_report($name, $_SESSION['email'], $_POST['subject'], $_POST['message']);
    if ($save_report) {
      header("Location: index.php");
    } else {
      $errors[] = "Could not create a report post. Please try again later.";
    }
  }
}

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
          <span class="user-icon" style="display: inline-block; width: 50px; height: 50px; overflow: hidden; border-radius: 50%;">
            <img src="../assets/img/main_page/profile_icon.png" alt="" style="width: 100%; height: 100%; object-fit: cover;">
          </span>
          <span class="user-name" style="margin-left: 10px;">
              <?php echo $row['firstName'] ?> <?php echo $row['lastName'] ?>
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

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact" style="background-color:#E5F9FA;">
    <div class="container" data-aos="fade-up">

      <div class="section-header">
        <h2>WHAT'S ON YOUR MIND?</h2>
        <p>"Got questions or feedback? Reach out to us – we're here to help!"</p>
      </div>

      <div class="row gx-lg-0 gy-4">

        <div class="col-lg-4">

          <div class="info-container d-flex flex-column align-items-center justify-content-center">
            <div class="info-item d-flex">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h4>Location:</h4>
                <p>374 St. Jude Subdivision, Ili Norte, 2514 San Juan, La Union</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h4>Email:</h4>
                <p>seeturtle2023@gmail.com</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex">
              <i class="bi bi-phone flex-shrink-0"></i>
              <div>
                <h4>Call:</h4>
                <p>+63 9423664519</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex">
              <i class="bi bi-clock flex-shrink-0"></i>
              <div>
                <h4>Open Hours:</h4>
                <p>Mon-Sat: 11AM - 23PM</p>
              </div>
            </div><!-- End Info Item -->
          </div>

        </div>

        <div class="col-lg-8">
          <div class="php-email-form">
            <form method="POST">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" value="<?php echo $row['firstName'] ?> <?php echo $row['lastName'] ?>"
                    class="form-control" id="name" placeholder="Your Name" readonly>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>" id="email"
                    placeholder="Your Email" readonly>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" value="<?= $_POST['subject']?>" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" id="message" value="<?= $_POST['message'] ?>" rows="7" placeholder="Message" required></textarea>
              </div>
              <span>
                <?php if (!empty($errors)) { ?>
                  <?php include "../layouts/_error-messages.php" ?>
                <?php } ?>
              </span>
              <div class="text-center"><button type="submit" id="submit" value="submit" name="submit">Send
                  Message</button></div>
            </form>
          </div>
        </div><!-- End Contact Form -->

      </div>

    </div>
  </section><!-- End Contact Section -->

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