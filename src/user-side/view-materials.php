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


?>

<?php include "../layouts/_form_page_header.php"; ?>

<body>
    <div class="limiter">
        <div class="container-login100"
            style="background: #16839A; display: flex; justify-content: center; align-items: center; height: 100vh;">
            <div style="background-color: #FFFFFF; width: 800px; padding: 20px; border-radius: 30px;">
            <a href="javascript:history.go(-1)"><img style="width: 50px; height:auto; float: right" src="../assets/img/form_page/icons/home.png"></a>
                <div style="padding: 20px;">
                    <h2><b>Event Title:</b>
                        <?php echo $materials['title'] ?>
                    </h2>
                </div>
                <!-- Image Box -->
                <div style="text-align: center;">
                    <img src="../upload/cta-bg.jpg" alt="Event Image" object-fit="cover"
                        style="max-width: 90%; height: auto;">
                </div>

                <!-- Event Information -->
                <div style="padding: 20px;">
                    <p style="font-size: 20px; font-family: poppins;"><span style="font-weight: bold;">Date:</span>
                        <?php echo $materials['date_created'] ?>
                    </p>
                    <p style="font-size: 15px; text-align: justify; font-family: poppins;">
                        <?php echo $materials['body'] ?>
                    </p>

                </div>

            </div>
        </div>
    </div>

    <div id="preloader"></div>
    <?php include "../layouts/_form_page_footer.php"; ?>