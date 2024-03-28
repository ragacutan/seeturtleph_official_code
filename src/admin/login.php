<?php
require '../backend/db.php';
include "../backend/functions.php";
include "../backend/session.php";

$errors = [];

if ($_POST['submit']) {

	if (!$_POST['email']) {
		$errors[] = "Email is Required";
	}

	if (!$_POST['password']) {
		$errors[] = "Password is Required";
	}

	global $connection;
	$sql = "SELECT * FROM users WHERE email = '" . $_POST['email'] . "'";
	$result = mysqli_query($connection, $sql);

	$user = mysqli_fetch_object($result);
	if ($user->email == null) {
		$errors[] = "Email Not Found";
	}

	if ($user->email != null && $user->email_verified_at == null) {
		$errors[] = "Please verify Your Email";
	}

	//Redirect to Admin
	if (empty($errors) && $user->account_type == "admin") {
		$user = login_account($_POST['email'], $_POST['password']);
		if (!empty($user)) {
			$_SESSION['id'] = $user['id'];
			$_SESSION['lastName'] = $user['lastName'];
			$_SESSION['firstName'] = $user['firstName'];

			header("Location: index.php");
		} else {
			$errors[] = "The email address or password that you've entered does not match any account.";
		}
	}

	//Redirect to Staff
	if (empty($errors) && $user->account_type == "staff") {
		$user = login_account($_POST['email'], $_POST['password']);
		if (!empty($user)) {
			$_SESSION['id'] = $user['id'];
			$_SESSION['lastName'] = $user['lastName'];
			$_SESSION['firstName'] = $user['firstName'];

			header("Location: ../staff/index.php");
		} else {
			$errors[] = "The email address or password that you've entered does not match any account.";
		}
	}

	//Redirect to Super Admin
	if (empty($errors) && $user->account_type == "superadmin") {
		$user = login_account($_POST['email'], $_POST['password']);
		if (!empty($user)) {
			$_SESSION['id'] = $user['id'];
			$_SESSION['lastName'] = $user['lastName'];
			$_SESSION['firstName'] = $user['firstName'];

			header("Location: ../superadmin/index.php");
		} else {
			$errors[] = "The email address or password that you've entered does not match any account.";
		}
	}

	//Redirect to government Account
	if (empty($errors) && $user->account_type == "government") {
		$user = login_account($_POST['email'], $_POST['password']);
		if (!empty($user)) {
			$_SESSION['id'] = $user['id'];
			$_SESSION['lastName'] = $user['lastName'];
			$_SESSION['firstName'] = $user['firstName'];

			header("Location: ../government/index.php");
		} else {
			$errors[] = "The email address or password that you've entered does not match any account.";
		}
	}
}
?>


<?php include "layouts/_header.php" ?>
    <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo"><img src="src/images/curma_logo2.png" alt=""></div>
            <div class='loader-progress' id="progress_div">
                <div class='bar' id='bar1'></div>
            </div>
            <div class='percent' id='percent1'>0%</div>
            <div class="loading-text">
                Loading...
            </div>
        </div>
    </div>
<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="../index.php">
					<img src="src/images/curma-logo-dark.png" alt="">

				</a>
			</div>
			<div class="login-menu">
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="vendors/images/login-page-img.png" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<form method="POST">
							<div class="login-title">
								<h2 class="text-center text-primary">Login To See Turtles</h2>
								<span style="font-size: 20px;">
									<?php if (!empty($errors)) { ?>
										<?php include "../layouts/_error-messages.php" ?>
									<?php } ?>
								</span>
							</div>
							<div class="input-group custom">
								<input type="email" name="email" class="form-control form-control-lg" value="<?= $_POST['email'] ?>" placeholder="Username">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" name="password" value="<?= $_POST['password'] ?>" placeholder="**********">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
							<!--<div class="row pb-30">-->
							<!--	<div class="col-6">-->
							<!--		<div class="custom-control custom-checkbox">-->
										<!--<input type="checkbox" class="custom-control-input" id="customCheck1">-->
										<!--<label class="custom-control-label" for="customCheck1">Remember</label>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--	<div class="col-6">-->
									<!--<div class="forgot-password"><a href="forgot-password.html">Forgot Password</a></div>-->
							<!--	</div>-->
							<!--</div>-->
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="Sign In">
									</div>
	
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include "layouts/_footer.php" ?>