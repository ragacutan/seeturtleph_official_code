<?php
require '../backend/db.php';
include "../backend/session.php";
include "../backend/functions.php";
include "../backend/check_login.php";

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
    exit; // Stop execution after redirect
}

if (!empty($_SESSION["id"])) {
  $id = $_SESSION["id"];
  $result = mysqli_query($connection, "SELECT * FROM users WHERE id = $id");
  $row = mysqli_fetch_assoc($result);
}
$profilePicture = !empty($row['filename']) ? $row['filename'] : '../assets/img/main_page/profile_icon.png';

$errors = [];

// Get user information
$id = $_SESSION["id"];
$result = mysqli_query($connection, "SELECT * FROM users WHERE id = $id");

// Check if the form is submitted
if (isset($_POST['submit'])) {

    $lastName = $_POST['lastName'];
    $firstName = $_POST['firstName'];
    $middleInitial = $_POST['middleInitial'];
    $birthday = $_POST['birthday'];
    $sex = $_POST['sex'];
    $barangay = $_POST['barangay'];
    $municipality = $_POST['municipality'];
    $province = $_POST['province'];
    $region = $_POST['region'];
    $contactNumber = $_POST['contactNumber'];
    $email = $_POST['email'];
    
    
    $birthdate = new DateTime($birthday);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthdate)->y;

    $birthdateString = $birthdate->format('Y-m-d');
    

    $errors = validate_edit_profile($_POST['lastName'], $_POST['firstName'], $_POST['middleInitial'], $_POST['sex'], $_POST['birthday'], $_POST['region'], $_POST['province'], $_POST['municipality'], $_POST['barangay'], $_POST['contactNumber'], $_POST['email']);

    if (empty($errors)) {
        $query = "UPDATE `users` SET `lastName` = '$lastName', `firstName` = '$firstName', `middleInitial` = '$middleInitial', `sex` = '$sex',`birthdate` = '$birthdateString', `age` = '$age', `region` = '$region', `province` = '$province', `municipality` = '$municipality', `barangay` = '$barangay', `contactNumber` = '$contactNumber', `email` = '$email' WHERE `id` = '$id' ";
        if (mysqli_query($connection, $query)) {
            header("Location: profile.php");
        } else {
            echo ("Error description: " . mysqli_error($connection));
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_profile"])) {
  $description = $_POST["description"];

  // File upload handling
  $targetDirectory = "profile/";
  $targetFile = $targetDirectory . basename($_FILES["file"]["name"]);
  move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile);

  // Database update
  $filename = $targetFile;

  // Assuming you have a user ID stored in the session
  $userId = $_SESSION["id"];

  $query = "UPDATE `users` SET `filename` = '$filename' WHERE `id` = $userId";
  mysqli_query($connection, $query);

  if (mysqli_error($connection)) {
      echo "Error description: " . mysqli_error($connection);
      exit;
  }

  header("Location: profile.php"); // Redirect to the profile page after the upload
}

?>

<!-- The rest of your HTML code follows... -->


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
  <script src="../assets/js/form_page/address.js"></script>

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
          <!--<li><a href="#">VOLUNTEER</a></li>-->
          <!--<li><a href="#">AWARENESS</a></li>-->
          <!--<li><a href="#">NEWS</a></li>-->
          <!--<li><a href=" about.php" style="margin-right:  30px;">ABOUT</a></li>-->

          <!--<a href="../backend/logout.php?logout=true" class="btn-join">LOGOUT</a>-->
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
                    <form action="" method="POST" autocomplete="off" enctype="multipart/form-data">
                                <div class="card-profile-image">
                                  <input type="file" id="file" name="file" style="display: none;" onchange="previewImage()" accept="image/*">
                                
                                  <a href="#" onclick="document.getElementById('file').click();">
                                    <img src="<?php echo htmlspecialchars($profilePicture, ENT_QUOTES, 'UTF-8'); ?>" class="rounded-circle" alt="Profile Picture" id="defaultProfile">
                                  </a>
                                
                                  <div id="imagePreview" style="display: none;">
                                    <h3>Preview:</h3>
                                    <img id="preview" class="rounded-circle" alt="Preview">
                                  </div>
                                
                                  <script>
                                    function previewImage() {
                                      const fileInput = document.getElementById('file');
                                      const preview = document.getElementById('preview');
                                      const imagePreview = document.getElementById('imagePreview');
                                      const defaultProfile = document.getElementById('defaultProfile');
                                
                                      const file = fileInput.files[0];
                                
                                      // Check if a file is selected
                                      if (file) {
                                        const reader = new FileReader();
                                
                                        reader.onload = function (e) {
                                          // Display the uploaded image in the preview
                                          preview.src = e.target.result;
                                          imagePreview.style.display = 'block';
                                          defaultProfile.style.display = 'none'; // Hide the default profile image
                                        };
                                
                                        reader.readAsDataURL(file);
                                      }
                                    }
                                  </script>
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
                            <input class="login100-form-btn" type="submit" name="update_profile" value="Update Profile" style="background-color: #007bff; color: #fff; border: none; padding: 15px 40px; font-size: 14px;" />
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
                </form>
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
                    <a href="profile.php"><img style="width: 50px; height:auto; float: right"
                        src="../assets/img/form_page/icons/home.png"></a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form action="" method="POST" autocomplete="off" enctype="multipart/form-data">
                  <h6 class="heading-small text-muted mb-4">User information</h6>
                  <?php if (!empty($errors)) { ?>
                    <?php include "../layouts/_error-messages.php" ?>
                  <?php }
                  while ($row2 = mysqli_fetch_array($result)) {
                    ?>

                    <div class="pl-lg-4">
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group focused">
                            <label class="form-control-label" for="input-username">Last name</label>
                            <input type="text" id="lastName" name="lastName" class="form-control form-control-alternative" placeholder="Last name" value="<?php echo $row2['lastName']; ?>">
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group focused">
                            <label class="form-control-label" for="input-username">First Name</label>
                            <input type="text" id="firstName" name="firstName" class="form-control form-control-alternative" placeholder="First name"  value="<?php echo $row2['firstName']; ?>">
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group focused">
                            <label class="form-control-label" for="input-username">Middle initial</label>
                            <input type="text" id="middleInitial" name="middleInitial" class="form-control form-control-alternative" placeholder="Middle initial"  value="<?php echo $row2['middleInitial']; ?>">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group focused">
                            <label class="form-control-label" for="input-first-name">Age</label>
                            <input type="date" id="birthday" name="birthday" class="form-control form-control-alternative" placeholder="birthday" value="<?php echo $row2['birthdate']; ?>">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group focused">
                            <label class="form-control-label" for="input-first-name">Sex</label>
                            <input type="text" id="age" name="sex" class="form-control form-control-alternative" placeholder="Sex" value="<?php echo $row2['sex']; ?>">
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr class="my-4">
                    <!-- Address -->
                    <h6 class="heading-small text-muted mb-4">Address</h6>
                    <div class="pl-lg-4">
                      <div class="row">
                        <div class="col-lg-3">
                          <div class="form-group focused">
                            <label class="form-control-label" for="input-city">Region</label>
                            <select type="text" name="region" id="region" value="<?php echo $row2['region']; ?>" class="form-control form-control-alternative">
                            <option value="" disabled selected>
                              <?php echo $row2['region'] ?>
                            </option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group focused">
                            <label class="form-control-label" for="input-city">Province</label>
                            <select type="text" name="province" id="province" value="<?= $_POST['province'] ?>"
                              class="form-control form-control-alternative">
                            <option value="" disabled selected>
                              <?php echo $row2['province'] ?>
                            </option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group focused">
                            <label class="form-control-label" for="input-country">Municipality</label>
                            <select type="text" name="municipality" id="municipality" value="<?= $_POST['municipality'] ?>"
                              class="form-control form-control-alternative">
                            <option value="" disabled selected>
                              <?php echo $row2['municipality'] ?>
                            </option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label class="form-control-label" for="input-country">Barangay</label>
                            <select type="text" name="barangay" id="barangay" value="<?= $_POST['barangay'] ?>"
                              class="form-control form-control-alternative">
                            <option value="" disabled selected>
                              <?php echo $row2['barangay'] ?>
                            </option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr class="my-4">
                    <!-- Contact Information -->
                    <h6 class="heading-small text-muted mb-4">Contact Information</h6>
                    <div class="pl-lg-4">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group focused">
                            <label class="form-control-label" for="input-address">Contact number</label>
                            <input id="contactNumber" name="contactNumber" class="form-control form-control-alternative" placeholder="Contact number" value="<?php echo $row2['contactNumber']; ?>" type="text">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group focused">
                            <label class="form-control-label" for="input-address">Email address</label>
                            <input id="email" name="email" class="form-control form-control-alternative" placeholder="Email address" value="<?php echo $row2['email']; ?>" type="text">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="container-login100-form-btn" style="text-align: center;">
                      <input class="login100-form-btn" type="submit" name="submit" value="Update" style="background-color: #007bff; color: #fff; border: none; border-radius: 50px; padding: 15px 40px; font-size: 14px;" />
                    </div>
                  </form>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </main>
  <!-- End #main -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>
  <script>
		const addresses = <?php echo json_encode(json_decode(file_get_contents('../assets/js/form_page/add.json')), JSON_PRETTY_PRINT); ?>;
		initializeDropdowns(addresses);
	</script>
  <?php include "../layouts/_main_page_footer.php"; ?>