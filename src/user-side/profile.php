<?php
include "../backend/session.php";
include "../backend/functions.php";
include "../backend/check_login.php";

if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($connection, "SELECT * FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
}
$profilePicture = !empty($row['filename']) ? $row['filename'] : '../assets/img/main_page/profile_icon.png';

if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
}

?>

<?php include "../layouts/_main_page_header.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>User Profile</title>

    
  <script type="text/javascript">
        function confirmLogout() {
            if (confirm("Are you sure you want to log out?")) {
                window.location.href = "../backend/logout.php?logout=true";
            }
        }
  </script>

      <!-- Favicons -->
  <link href="../assets/img/main_page/turtle.png" rel="icon">
  <link href="../assets/img/main_page/turtle.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/main_page/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/main_page/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/main_page/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/main_page/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/main_page/swiper/swiper-bundle.min.css" rel="stylesheet">


    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="../assets/css/main_page/profile_.css" rel="stylesheet">
</head>


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
      <!--<li><a href="landing.php">PROGRAMS</a></li>-->
      <!--<li><a href="training.php">TRAININGS</a></li>-->
      <!--<li><a href="volunteer.php">VOLUNTEER</a></li>-->
      <!--<li><a href="awareness.php">AWARENESS</a></li>-->
      <!--<li><a href="news.php">NEWS</a></li>-->
      <!--<li><a href=" about.php" style="margin-right:  50px;">ABOUT</a></li>-->

      <!--<li class="dropdown">-->
      <!--  <a href="#">-->
      <!--    <span class="user-icon" style="display: inline-block; width: 50px; height: 50px; overflow: hidden; border-radius: 50%;">-->
      <!--       <img src="<?php echo htmlspecialchars($profilePicture, ENT_QUOTES, 'UTF-8'); ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="Profile Picture">-->
      <!--    </span>-->
      <!--    <span class="user-name" style="margin-left: 10px;">-->
      <!--      <?php echo $row['firstName'] ?> <?php echo $row['lastName'] ?>-->
      <!--    </span></a>-->
      <!--  <ul>-->
      <!--    <li><a href="profile.php">Profile</a></li>-->
      <!--    <li><a href="#">Setting</a></li>-->
      <!--    <li><a href="contact.php">Report/Feedback</a></li>-->
      <!--    <li><a onclick="confirmLogout()">Logout</a></li>-->
        </ul>
      </li>
    </ul>
  </nav><!-- .navbar -->

  <!--<i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>-->
  <!--<i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i> <!-- .buttons-->

</div>
    </header>
    <!-- End Header -->

    <main id="main">
        <!-- ======= Portfolio Section ======= -->
        <div class="main-content">
      <!-- Top navbar -->
      <!-- Header -->
    
      <!-- Page content -->
      <div class="container-fluid mt--7">
        <div class="row">
          <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
            <div class="card card-profile shadow">
              <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                  <div class="card-profile-image">
                    <a href="#">
                    <img src="<?php echo htmlspecialchars($profilePicture, ENT_QUOTES, 'UTF-8'); ?>" class="rounded-circle" alt="Profile Picture">
                    </a>
                  </div>
                </div>
              </div>
              <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <div class="d-flex justify-content-between">
                 
                </div>
              </div>
              <div class="card-body pt-0 pt-md-4">
                <div class="row">
                  <div class="col">
                    <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                      
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <h3>
                    <?php echo $row['firstName'] ?>
                    <?php echo $row['lastName'] ?>
                  </h3>
                  <div class="h5 font-weight-300">
                    <i class="ni location_pin mr-2"></i>
                    <?php echo $row['barangay'] ?>,
                    <?php echo $row['municipality'] ?>,
                    <?php echo $row['province'] ?>
                  </div>
                  <div class="h5 mt-4">
                    <i class="ni business_briefcase-24 mr-2"></i> Volunteer
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-8 order-xl-1">
            <div class="card bg-secondary shadow">
              <div class="card-header bg-white border-0">
                <div class="row align-items-center">
                  <div class="col-8">
                    <h3 class="mb-0">My account</h3>
                  </div>
                 <div class="col-4 text-right">
                    <a href="update-profile.php?id=<?= $_SESSION["id"] ?>" class="btn btn-sm btn-primary" style="text-align: center">Edit</a>
                    <a href="index.php"><img style="width: 50px; height:auto; margin-left: auto;" src="../assets/img/form_page/icons/home.png"></a>
                </div
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form>
                  <h6 class="heading-small text-muted mb-4">User information</h6>
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group focused">
                          <label class="form-control-label" for="input-username">Last name</label>
                          <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="Username" value="<?php echo $row['lastName'] ?>" readonly>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group focused">
                          <label class="form-control-label" for="input-username">First Name</label>
                          <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="Username" value=" <?php echo $row['firstName'] ?>" readonly>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group focused">
                          <label class="form-control-label" for="input-username">Middle initial</label>
                          <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="Username" value=" <?php echo $row['middleInitial'] ?>" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                        <div class="form-group focused">
                          <label class="form-control-label" for="input-first-name">Birthdate</label>
                          <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="Birthdate" value="<?php echo $row['birthdate'] ?>" readonly>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group focused">
                          <label class="form-control-label" for="input-first-name">Age</label>
                          <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="Age" value="<?php echo $row['age'] ?>" readonly>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group focused">
                          <label class="form-control-label" for="input-last-name">Sex</label>
                          <input type="text" id="input-last-name" class="form-control form-control-alternative" placeholder="Sex" value="<?php echo $row['sex'] ?>" readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr class="my-4">
                  <!-- Address -->
                  <h6 class="heading-small text-muted mb-4">Address</h6>
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group focused">
                          <label class="form-control-label" for="input-city">Barangay</label>
                          <input type="text" id="input-city" class="form-control form-control-alternative" placeholder="City" value="<?php echo $row['barangay'] ?>" readonly>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group focused">
                          <label class="form-control-label" for="input-country">Municipality</label>
                          <input type="text" id="input-country" class="form-control form-control-alternative" placeholder="Country" value="<?php echo $row['municipality'] ?>" readonly>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label" for="input-country">Province</label>
                          <input type="text" id="input-postal-code" class="form-control form-control-alternative" placeholder="Province"  value="<?php echo $row['province'] ?>" readonly>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label" for="input-country">Region</label>
                          <input type="text" id="input-postal-code" class="form-control form-control-alternative" placeholder="Province"  value="<?php echo $row['region'] ?>" readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                   <!-- Address -->
                  <h6 class="heading-small text-muted mb-4">Contact information</h6>
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group focused">
                          <label class="form-control-label" for="input-address">Contact number</label>
                          <input id="input-address" class="form-control form-control-alternative" placeholder="Contact number" value="<?php echo $row['contactNumber'] ?>" type="text" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group focused">
                          <label class="form-control-label" for="input-address">Email address</label>
                          <input id="input-address" class="form-control form-control-alternative" placeholder="Contact number" value="<?php echo $row['email'] ?>" type="text" readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </main>
    <!-- End #main -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>
    <?php include "../layouts/_main_page_footer.php"; ?>