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

$profilePicture = !empty($row['filename']) ? $row['filename'] : '../assets/img/main_page/profile_icon.png';

?>

<?php include "../layouts/_main_page_header.php"; ?>

<body id="hero2">

  <!-- ======= Header ======= -->

    <header id="header" class="header d-flex align-items-center">

<div class="container-fluid container-xl d-flex align-items-center justify-content-between">
  <a href="index.php" class="logo d-flex align-items-center">
    <!-- Uncomment the line below if you also wish to use an image logo -->
    <img  class="see_logo" src="../assets/img/main_page/see_logo.png" alt="">
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
            <img src="<?php echo htmlspecialchars($profilePicture, ENT_QUOTES, 'UTF-8'); ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="Profile Picture">
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

  <!-- ======= Hero Section ======= -->
  <section id="" class="hero2">
    <div class="container position-relative">
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
          <h2>CURMA PROGRAMS</span></h2>
          <p>We have various programs to prevent the extinction of
            these species by protecting their habitats, reducing human impacts,
            and increasing public awareness about their conservation status. We
            also promote sustainable practices that benefit both turtles and the
            communities that depend on them. </span>
          </p>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="#recent-posts" class="btn-get-started">SEE ALL PROGRAMS</a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2">
          <img src="../assets/img/main_page/turtle-landing.svg" class="img-fluid" alt="" data-aos="zoom-out"
            data-aos-delay="100">
        </div>
      </div>
    </div>
    </div>
    </div>
    </div>
    <br>
    <br>
    <br>
    </div>
  </section>
  </section><!-- End Portfolio Section -->

  <!-- ======= Our Services Section ======= -->
  <section id="services" class="services sections-bg" style="background-color:#E5F9FA;">
    <div class="container" data-aos="fade-up">

      <div class="section-header">
        <h4 style="font-family: Poppins;">WHAT WE DO</h4>
        <h2 style="font-family: Poppins; font-weight: bold;">OUR PROGRAMS AND SERVICES</h2>
        <p>We provide a wide range of services aimed at protecting and preserving turtle populations
          and their habitats. Here are some of the services that we offer:</p>
      </div>

      <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">

        <div class="col-lg-4 col-md-6">
          <div class="service-item-1  position-relative">
            <div class="icon">
              <i class="bi bi-activity"></i>
            </div>
            <h3>Research</h3>
            <p>We conduct scientific research to
              better understand turtle populations,
              their habitats, and the threats they face.</p>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-4 col-md-6">
          <div class="service-item-1 position-relative">
            <div class="icon">
              <i class="bi bi-broadcast"></i>
            </div>
            <h3>Habitat Protection</h3>
            <p>work to protect critical turtle habitats,
              including nesting beaches, feeding
              areas, and migration routes</p>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-4 col-md-6">
          <div class="service-item-1 position-relative">
            <div class="icon">
              <i class="bi bi-easel"></i>
            </div>
            <h3>Conservation Education</h3>
            <p>We provide educational resources and
              programs to raise awareness about the
              importance of turtle conservation</p>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-4 col-md-6">
          <div class="service-item-1 position-relative">
            <div class="icon">
              <i class="bi bi-bounding-box-circles"></i>
            </div>
            <h3>Advocacy</h3>
            <p>We work with policymakers and
              government agencies to advocate for
              policies that protect turtle populations </p>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-4 col-md-6">
          <div class="service-item-1 position-relative">
            <div class="icon">
              <i class="bi bi-calendar4-week"></i>
            </div>
            <h3>Rescue and Rehabilition</h3>
            <p>We provide rescue and rehabilitation
              services for injured or sick turtles,
              helping to rehabilitate them</p>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-4 col-md-6">
          <div class="service-item-1 position-relative">
            <div class="icon">
              <i class="bi bi-chat-square-text"></i>
            </div>
            <h3>Community Engagement</h3>
            <p>We work with local communities to
              promote sustainable fishing practices,
              reduce pollution, and raise awareness.</p>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-4 col-md-6">
          <div class="service-item-1 position-relative">
            <div class="icon">
              <i class="bi bi-chat-square-text"></i>
            </div>
            <h3>Community Engagement</h3>
            <p>We work with local communities to
              promote sustainable fishing practices,
              reduce pollution, and raise awareness.</p>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-4 col-md-6">
          <div class="service-item-1 position-relative">
            <div class="icon">
              <i class="bi bi-chat-square-text"></i>
            </div>
            <h3>Community Engagement</h3>
            <p>We work with local communities to
              promote sustainable fishing practices,
              reduce pollution, and raise awareness.</p>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-4 col-md-6">
          <div class="service-item-1 position-relative">
            <div class="icon">
              <i class="bi bi-chat-square-text"></i>
            </div>
            <h3>Community Engagement</h3>
            <p>We work with local communities to
              promote sustainable fishing practices,
              reduce pollution, and raise awareness.</p>
          </div>
        </div><!-- End Service Item -->

      </div>
  </section><!-- End Our Team Section -->
  <!-- ======= Recent Blog Posts Section ======= -->
  <section id="recent-posts" class="recent-posts sections-bg" style="background-color:#E5F9FA;">
    <div class="container" data-aos="fade-up">

      <div class="section-header">
        <h1 style="text-align:left; font-weight: 900; text-decoration: none;">Latest Updates</h1>
      </div>

      <div class="row gy-4">
        <?php if (!empty($material)) { ?>
          <?php foreach ($material as $row) { ?>
            <div class="col-xl-4 col-md-6">
              <article>
                <div class="post-img">
                  <img src="../upload/cta-bg.jpg" alt="" class="img-fluid">
                </div>

                <p class="post-category">
                  <?= $row['category_name'] ?>
                </p>

                <h2 class="title">
                <a href="view-materials.php?id=<?= $row['material_id'] ?>">
                    <?= display_material_preview($row['title'], 50) . '...' ?>
                  </a>
                </h2>
                    <p class="post-date" style="font-style: italic ;">by :
                      <?= $row['lastName'] ?>
                      (
                      <?= $row['email'] ?>)
                    </p>
                    <p class="post-date">
                      <?= date("F m, Y @ g:H a", strtotime($row['date_created'])); ?>
                    </p>
                  <br>
                <p class="post-author" style="text-align: justify;">
                  <?= display_material_preview($row['body'], 255) . '...' ?>
                </p>

              </article>
            </div><!-- End post list item -->
          <?php } ?>
        <?php } else { ?>
          <p> No latest update as of the moment...</p>
        <?php } ?>

      </div>
  </section><!-- End Recent Blog Posts Section -->
  <a id="message-button" onclick="toggleChat()"
    style="position: fixed; bottom: 20px; right: 20px; z-index: 999; background-color: #f85a40; color: #fff; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
    <i class="bi bi-chat-left-text" style="font-size: 25px;"></i>
  </a>

  <!-- Chat container -->
  <div class="chat-container" id="chat-container">
    <div class="chat-header">
      <h1>SEE ChatBot</h1>
      <a style="color: #fff; cursor: pointer;" onclick="hideChat()">Hide</a>
    </div>
    <div class="chat-box" id="chat-box">
      <!-- Chat content goes here -->
    </div>
    <div class="chat-input">
      <input type="text" id="user-input" placeholder="Type a message...">
      <button id="send-button">Send</button>
    </div>
  </div>

  <script src="../assets/css/chatbot/script.js"></script>
  <script>
    function toggleChat() {
      var chatContainer = document.getElementById('chat-container');
      var messageButton = document.getElementById('message-button');

      if (chatContainer.style.display === 'none') {
        chatContainer.style.display = 'block';
        messageButton.style.visibility = 'hidden';
      } else {
        chatContainer.style.display = 'none';
        messageButton.style.visibility = 'visible';
      }
    }

    function hideChat() {
      var chatContainer = document.getElementById('chat-container');
      var messageButton = document.getElementById('message-button');

      chatContainer.style.display = 'none';
      messageButton.style.visibility = 'visible';
    }
  </script>
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

  <div id="preloader"></div>
  <?php include "../layouts/_main_page_footer.php"; ?>