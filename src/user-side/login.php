<?php
    require '../backend/db.php';
    include "../backend/functions.php";
    include "../backend/session.php";

    $errors = [];

    if($_POST['submit']){
        

        if(!$_POST['email']){
            $errors[] = "Email is Required";
        }

        if(!$_POST['password']){
            $errors[] = "Password is Required";
        }

        global $connection;
        $sql = "SELECT * FROM users WHERE email = '".$_POST['email']."'";
        $result = mysqli_query($connection, $sql);

        $user = mysqli_fetch_object($result);
        if($user-> email == null){
            $errors[] = "Email Not Found";
        }

        if($user->email != null && $user -> email_verified_at == null){
            $errors[]= "Please verify Your Email";
        }
        
        if(empty($errors) && $user->account_type == "user") {
            $user = login_account($_POST['email'], $_POST['password']);
            if(!empty($user)) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['lastName'] = $user['lastName'];
                $_SESSION['firstName'] = $user['firstName'];
                $_SESSION['email'] = $user['email'];

                header("Location: index.php");
            } else{
                $errors[] = "The email address or password that you've entered does not match any account.";
            }
        }
    }
?>

<?php include "../layouts/_form_page_header.php"; ?>
<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" method="POST">
                    <span class="login100-form-title p-b-43">
                        <a href="../index.php"><img style="width: 50px; height:auto; float: right" src="../assets/img/form_page/icons/home.png"></a>
                        <h1>WELCOME BACK!</h1>
                        <p>Login to continue</p>
                        <span style="font-size: 20px;">
							<?php if (!empty($errors)) { ?>
								<?php include "../layouts/_error-messages.php" ?>
							<?php } ?>
						</span>
                    </span>

                 <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                    <div class="icon-input100">
                        <i class="fa fa-envelope icon-custom"></i>
                    </div>
                    <input class="input100" type="email" name="email" value="<?= $_POST['email'] ?>" placeholder="Enter Email"/>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <div class="icon-input100">
                        <i class="fa fa-lock icon-custom"></i>
                    </div>
                    <input class="input100" type="password" name="password" value="<?= $_POST['password'] ?>" placeholder="Enter Password"/>
                        <i class="fa fa-eye-slash show-password-icon" onclick="togglePasswordVisibility()"></i> <!-- Add this line for the show password icon -->
                    <span class="focus-input100"></span>
                </div>  

                <script>
                    function togglePasswordVisibility() {
                        var passwordInput = document.querySelector("input[name='password']");
                        var passwordIcon = document.querySelector(".show-password-icon");

                        if (passwordInput.type === "password") {
                            passwordInput.type = "text";
                            passwordIcon.classList.remove("fa-eye-slash");
                            passwordIcon.classList.add("fa-eye");
                        } else {
                            passwordInput.type = "password";
                            passwordIcon.classList.remove("fa-eye");
                            passwordIcon.classList.add("fa-eye-slash");
                        }
                    }
                </script>

                    <div class="flex-sb-m w-full p-t-3 p-b-32">
                        <div class="contact100-form-checkbox">

                        </div>

                        <div>
                            <a href="#" class="txt1">
                                
                            </a>
                        </div>
                    </div>


                    <div class="container-login100-form-btn">
                         <input class="login100-form-btn" type="submit" name="submit" value="Login" />
                    </div>

                    <div class="text-center p-t-46 p-b-20">
                        <span class="txt2">
                            Don't have an Account? <a href="signup.php"> Create Here</a>
                        </span>
                    </div>

                    <div class="text-center  p-b-20">

                    </div>

                </form>

                <div class="login100-more" style="background-image: url('../assets/img/form_page/bg-01.jpg');">
                </div>
            </div>
        </div>
    </div>
    <div id="preloader"></div>
<?php include "../layouts/_form_page_footer.php"; ?>