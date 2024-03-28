<?php
require '../backend/db.php';
include "../backend/functions.php";
include "../backend/session.php";

if (isset($_POST["verify_email"])) {
	$id = $_POST["id"];
	$email = $_POST["email"];
	$verification_code = $_POST["verification_code"];

	// connect with database
	global $connection;

	// mark email as verified
	$sql = "UPDATE users SET email_verified_at = NOW() WHERE email = '" . $email . "' AND verification_code = '" . $verification_code . "'";
	$result = mysqli_query($connection, $sql);

	if (mysqli_affected_rows($connection) != 0) {
		header("location: login.php");
	} else {
		$errors[] = "Verification Failed";
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
						<a href="signup.php"><img style="width: 50px; height:auto; float: right"
								src="../assets/img/form_page/icons/home.png"></a>
						<h1>VERIFY ACCOUNT</h1>
						<p>Check your email and enter the code to verify your account</p>
						<p style="font-size: 15px; color: red;">Note: Check your SPAM messages if the code doesn't
							appear on your inbox <br> Your Code will Expire in: <span id="countdown"></span></p></p>
					</span>
					<span style="font-size: 20px;">
						<?php if (!empty($errors)) { ?>
							<?php include "../layouts/_error-messages.php" ?>
						<?php } ?>
					</span>

					<input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" required>


					<div class="wrap-input100 validate-input">
						<input class="input100" type="number" name="verification_code"
							placeholder="Enter the Six Digit Code" required />
					</div>

					<div class="container-login100-form-btn">
						<input class="login100-form-btn" name="verify_email" type="submit" value="VERIFY EMAIL" />

					</div>
					<div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							Already have an account? <a href="login.php">Login Here</a>
							</p>
						</span>
					</div>
				</form>

				<div class="login100-more" style="background-image: url('../assets/img/form_page/bg-01.jpg');">
				</div>
			</div>
		</div>
	</div>
	<script>
		// Set the target date and time for the countdown (5 minutes from now)
		const targetDate = new Date();
		targetDate.setMinutes(targetDate.getMinutes() + 5);

		// Function to update the countdown
		function updateCountdown() {
			const currentDate = new Date();
			const timeDifference = targetDate - currentDate;

			// Calculate minutes and seconds
			const minutes = Math.floor(timeDifference / (1000 * 60));
			const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

			// Display the countdown in the "countdown" element
			const countdownElement = document.getElementById('countdown');
			countdownElement.innerHTML = `${minutes}m ${seconds}s`;

			// Check if the countdown has reached zero
			if (timeDifference <= 0) {
				countdownElement.innerHTML = "Resend Verification Code";
			}
		}

		// Update the countdown every second
		setInterval(updateCountdown, 1000);

		// Initial call to set the initial countdown display
		updateCountdown();
	</script>

	<?php include "../layouts/_form_page_footer.php"; ?>