
<?php
/*
include 'functions.php';
include 'session.php';

$errors = [];

if ($_POST['submit']) {
	if (!$_POST['lastName']) {
		$errors[] = "Last Name is Required";
	}

	if (!$_POST['firstName']) {
		$errors[] = "First Name is Required";
	}

	if (!$_POST['middleInitial']) {
		$errors[] = "Middle Initial is Required";
	}

	if (!$_POST['age']) {
		$errors[] = "Age is Required";
	}

	if (!$_POST['sex']) {
		$errors[] = "Sex is Required";
	}

	if (!$_POST['homeAddress']) {
		$errors[] = "Home Address is Required";
	}

	if (!$_POST['organization']) {
		$errors[] = "School/Organization/University/Office is Required";
	}

	if (!$_POST['contactNumber']) {
		$errors[] = "Contact Number is Required";
	}

	if (!$_POST['email']) {
		$errors[] = "Email is Required";
	}

	if (!$_POST['password']) {
		$errors[] = "password is Required";
	}

	if (!$_POST['confirm_password']) {
		$errors[] = "Confirm Password is Required";
	}

	if ($_POST['password'] != $_POST['confirm_password']) {
		$errors[] = "Password doesn't match";
	}

	if (empty($errors)) {
		if (!check_existing_email($_POST['email'])) {
			$user = save_registration($_POST['lastName'], $_POST['firstName'], $_POST['middleInitial'], $_POST['age'], $_POST['sex'], $_POST['homeAddress'], $_POST['organization'], $_POST['contactNumber'], $_POST['email'], $_POST['password']);
			if (!empty($user)) {
				$_SESSION['id'] = $user['id'];
				$_SESSION['$email'] = $user['$email'];

				header("Location: verify.php?email=" . $email);
			}
		}
	} else {
		$errors[] = "The email address is already existing.";
	}
} */
?>



<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post">
					<span class="login100-form-title p-b-43">
						<a href="index.php"><img style="width: 50px; height:auto; float: right" src="assets/img/form_page/icons/home.png"></a>
						<h1>CREATE AN ACCOUNT</h1>
						<p>Fill out the following information</p>
						<span style="font-size: 20px;">
							<?php if (!empty($errors)) { ?>
								<?php include "layouts/_error-messages.php" ?>
							<?php } ?>
						</span>
					</span>

					<div class="wrap-input200">
						<input class="input100" type="text" name="lastName" value="<?= $_POST['lastName'] ?>" placeholder="Last Name"/>
					</div>


					<div class="wrap-input200">
						<input class="input100" type="text" name="firstName" value="<?= $_POST['firstName'] ?>" placeholder="First Name"/>
					</div>

					<div class="wrap-input200">
						<input class="input100" type="text" name="middleInitial" value="<?= $_POST['middleInitial'] ?>" placeholder="Middle Initial"/>
					</div>

					<div class="wrap-input300">
						<input class="input100" type="number" name="age" value="<?= $_POST['age'] ?>" placeholder="Age"/>
					</div>

					<select type="text" name="sex" value="<?= $_POST['sex'] ?>" class="wrap-input300" />
                            <option value="" disabled selected>Sex</option>
                            <option value=" Male">Male</option>
						<option value="Female">Female</option>
					</select>

					<div class="wrap-input300">
						<input class="input100" type="text" name="homeAddress" value="<?= $_POST['homeAddress'] ?>" placeholder="Home Address" />
					</div>

					<div class="wrap-input100">
						<input class="input100" type="text" name="organization" value="<?= $_POST['organization'] ?>" placeholder="School/Organization/University/Office" />
					</div>

					<div class="wrap-input100">
						<input class="input100" type="text" name="contactNumber" value="<?= $_POST['contactNumber'] ?>" placeholder="Contact Number" />
					</div>

					<div class="wrap-input100">
						<input class="input100" type="email" name="email" value="<?= $_POST['email'] ?>" placeholder="Email" />
					</div>

					<div class="wrap-input100">
						<input class="input100" type="password" name="password" value="<?= $_POST['password'] ?>" placeholder="Password"/>
					</div>

					<div class="wrap-input100">
						<input class="input100" type="password" name="confirm_password" value="<?= $_POST['confirm_password'] ?>" placeholder="Confirm Password" />
					</div>

					<div class="container-login100-form-btn">
						<input type="submit" class="login100-form-btn" name="submit" value="SIGN UP" />
					</div>

					<div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							Already have an account? <a href="login.php">Login Here</a>
							</p>
						</span>
					</div>

					<div class="text-center p-t-46 p-b-20">

					</div>


				</form>

				<div class="login100-more" style="background-image: url('assets/img/form_page/bg-01.jpg');">
				</div>
			</div>
		</div>
	</div>
	<?php include "layouts/_form_page_footer.php"; ?>