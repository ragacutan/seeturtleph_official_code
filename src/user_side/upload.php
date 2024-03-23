<?php
include "../backend/session.php";
include "../backend/functions.php";
include "../backend/check_login.php";

// Start the session before any output
session_start();

if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
    // $connection needs to be defined; adjust it according to your setup
    include "../backend/db.php";

    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];

    if ($error === 0) {
        if ($img_size > 1250000) {
            $em = "Sorry, your file is too large.";
            header("Location: profile.php?error=$em");
            exit(); // Make sure to exit after sending a header
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = '../upload/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                // Insert into Database using prepared statement to prevent SQL injection
                $stmt = mysqli_prepare($connection, "UPDATE `users` SET `image_url` = ? WHERE `id` = id");
                
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "si", $new_img_name, $id);

                    if (mysqli_stmt_execute($stmt)) {
                        header("Location: profile.php");
                        exit(); // Make sure to exit after sending a header
                    } else {
                        $em = "Error updating database: " . mysqli_stmt_error($stmt);
                        header("Location: profile.php?error=$em");
                        exit(); // Make sure to exit after sending a header
                    }
                    
                    mysqli_stmt_close($stmt);
                } else {
                    $em = "Error preparing statement: " . mysqli_error($connection);
                    header("Location: profile.php?error=$em");
                    exit(); // Make sure to exit after sending a header
                }
            } else {
                $em = "You can't upload files of this type";
                header("Location: profile.php?error=$em");
                exit(); // Make sure to exit after sending a header
            }
        }
    } else {
        $em = "Unknown error occurred!";
        header("Location: profile.php?error=$em");
        exit(); // Make sure to exit after sending a header
    }
} else {
    header("Location: profile.php");
    exit(); // Make sure to exit after sending a header
}
?>
