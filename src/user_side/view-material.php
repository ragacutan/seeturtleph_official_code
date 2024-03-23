<?php
include "../backend/session.php";
include "../backend/functions.php";
include "../backend/check_login.php";


if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($connection, "SELECT * FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result2 = mysqli_query($connection, "SELECT * FROM materials WHERE id = $id");
    $materials = mysqli_fetch_assoc($result2);
}

if (isset($_POST['submit'])) {

    $user_id = $_SESSION['id'];
    $event_id = $_GET['id'];
    $fullname = $row['firstName'].' '.$row['lastName'];
    $sex = $row['sex'];
    $address = $row['address'];
    $email = $row['email'];
    $contactNumber = $row['contactNumber'];
    $title = $materials['title'];
    $date = $materials['date'];
    $time = $materials['time'];
    $body = mysqli_real_escape_string($connection, $materials['body']);

    $query = "INSERT INTO participants (event_id, user_id, name, sex, address, contactNumber, email, event_title, date, time, body) VALUES ('$event_id', '$user_id', '$fullname', '$sex', '$address', '$contactNumber', '$email', '$title', '$date', '$time', '$body')";
    mysqli_query($connection, $query);

    if (mysqli_error($connection)) {
        echo "Error description: " . mysqli_error($connection);
        exit;
    }
  
    echo '<script>
            alert("You Successfully Join The Event!");
            window.location.href = "my-events.php";
    </script>';
}
    

?>

<?php include "../layouts/_form_page_header.php"; ?>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" method="POST">
                    <span class="login100-form-title p-b-43">
                    <a href="javascript:history.go(-1)"><img style="width: 50px; height:auto; float: right" src="../assets/img/form_page/icons/home.png"></a>
                        <h1>LET'S GET STARTED</h1>
                        <p>You're About to Join on <br>
                            <span style="font-weight: bold;">
                                <?php echo $materials['title'] ?>
                            </span>
                        </p>
                        <p style="font-size: 15px;">Please provide the following information to proceed</p>
                    </span>

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="fullname"
                            value="<?php echo $row['firstName'] . ' ' . $row['lastName'] ?>" />
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="sex" value="<?php echo $row['sex'] ?>" />
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="address"
                            value="<?php echo $row['barangay'] . ', ' . $row['municipality'] . ', ' . $row['province'] . ', ' . $row['region'] ?>" />
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="email" name="email" value="<?php echo $row['email'] ?>" />
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="contactNumber"
                            value="<?php echo $row['contactNumber'] ?>" />
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <input class="login100-form-btn" type="submit" name="submit" value="Join Event" />
                    </div>
                </form>

                <div class="login100-more"
                    style="background: #16839A; display: flex; justify-content: center; align-items: center; height: 100vh;">
                    <div  style="background-color: #FFFFFF; width: 800px; padding: 20px; border-radius: 30px;">
                        <div style="padding: 20px;">
                            <h2><b>Event Title:</b>  <?php echo $materials['title'] ?></h2>
                        </div>
                        <!-- Image Box -->
                        <div style="text-align: center;">
                            <img src="../upload/cta-bg.jpg" alt="Event Image" object-fit="cover" style="max-width: 90%; height: auto;">
                        </div>

                        <!-- Event Information -->
                        <div style="padding: 20px;">
                            <p style="font-size: 20px; font-family: poppins;"><span style="font-weight: bold;">Date:</span> <?php echo $materials['date'] ?></p>
                            <p style="font-size: 20px; font-family: poppins;"><b>Time:</b> <?php echo $materials['time'] ?></p>
                            <p style="font-size: 15px; text-align: justify; font-family: poppins;"><?php echo $materials['body'] ?></p>

                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>

    <div id="preloader"></div>
    <script>
    function showAlert(message) {
        alert(message);
   	 }
	</script>
    <?php include "../layouts/_form_page_footer.php"; ?>