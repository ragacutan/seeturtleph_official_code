<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include "../backend/functions.php";
include '../backend/session.php';
require '../assets/vendor/php_mailer/autoload.php';

$errors = [];

if (isset($_POST["submit"])) {
	$email = $_POST['email'];
	$lastName = $_POST['lastName'];

	$errors = validate_save_profile($_POST['lastName'], $_POST['firstName'], $_POST['middleInitial'], $_POST['birthday'], $_POST['sex'], $_POST['region'], $_POST['province'], $_POST['municipality'], $_POST['barangay'], $_POST['contactNumber'], $_POST['email'], $_POST['password'], $_POST['confirm_password']);

	try {
		$mail = new PHPMailer(true);

		// Enable verbose debug output
		$mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;

		// Send using SMTP
		$mail->isSMTP();

		// Set the SMTP server to send through
		$mail->Host = 'mail.seeturtleph.com';

		// Enable SMTP authentication
		$mail->SMTPAuth = true;

		// SMTP username and password
		$mail->Username = 'admin@seeturtleph.com';
		$mail->Password = 'VTeCu?BkDoVa';

		// Enable TLS encryption;
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

		// TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
		$mail->Port = 587;

		// Set the sender's email and name
		$mail->setFrom('admin@seeturtleph.com', 'seeturtleph-verification');

		// Add a recipient
		$mail->addAddress($email, $lastName);

		// Set email format to HTML
		$mail->isHTML(true);

		// Generate a verification code
		$verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

		// Set the email subject and body
		$mail->Subject = 'Email verification';

		// HTML body content for the email with added style
		$mail->Body = '
         <div style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; text-align: center;">
        <h2 style="color: #333;">Email Verification</h2>
        <p style="font-size: 16px; color: #555;">Thank you for registering. Please verify your email by entering the code below:</p>
        
        <p style="font-size: 30px; color: #007bff; margin: 20px 0; padding: 10px; background-color: #fff; border-radius: 5px; display: inline-block;">
            <strong>' . $verification_code . '</strong>
        </p>
        
        <p style="font-size: 14px; color: #777;">This code will expire in 5 minutes. If you didn\'t request this verification, please ignore this email.</p>
        
            <p style="font-size: 14px; color: #777;">Best regards,<br> PROJECT CURMA</p>
    </div>';

		// Attempt to send the email
		$mail->send();

		$account_type = "user";


		// Add more validation checks for other fields

		if (empty($errors)) {
			if (!check_existing_email($_POST['email'])) {
				$user = save_registration($_POST['lastName'], $_POST['firstName'], $_POST['middleInitial'], $_POST['birthday'], $_POST['sex'], $_POST['region'], $_POST['province'], $_POST['municipality'], $_POST['barangay'], $_POST['contactNumber'], $_POST['email'], $_POST['password'], $account_type, $verification_code);
				if (!empty($user)) {
					$_SESSION['id'] = $user['id'];
					$_SESSION['email'] = $user['email'];
				}

				// Redirect to the verification page
				header("Location: verify.php?email=" . $email);
			} else {
				$errors[] = "The email address is already existing.";
			}
		}
	} catch (Exception $e) {
		// Handle the exception, e.g., log or display an error message
		//$errors[] = "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
	}
}
?>


<?php include "../layouts/_form_page_header.php"; ?>

<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post" autocomplete="on">
					<span class="login100-form-title p-b-43">
						<a href="../index.php"><img style="width: 50px; height:auto; float: right"
								src="../assets/img/form_page/icons/home.png"></a>
						<h1>CREATE AN ACCOUNT</h1>
						<p>Fill out the following information</p>
						<span style="font-size: 20px;">
							<?php if (!empty($errors)) { ?>
								<?php include "../layouts/_error-messages.php" ?>
							<?php } ?>
						</span>
					</span>

					<div class="wrap-input100-signup">
						<input class="input100-signup" type="text" name="lastName" value="<?= $_POST['lastName'] ?>"
							placeholder="Last Name" />
					</div>


					<div class="wrap-input100-signup">
						<input class="input100-signup" type="text" name="firstName" value="<?= $_POST['firstName'] ?>"
							placeholder="First Name" />
					</div>

					<div class="wrap-input100-signup">
						<input class="input100-signup" type="text" name="middleInitial"
							value="<?= $_POST['middleInitial'] ?>" placeholder="Middle Initial" />
					</div>

					<div class="wrap-input100-signup">
						<input class="input100-signup" type="text" onfocus="this.type='date'" onblur="this.blur='text'"
							name="birthday" value="<?= $_POST['birthday'] ?>" placeholder="Birthday" />
					</div>

					<div class="wrap-input100-signup">
						<select type="text" name="sex" value="<?= $_POST['sex'] ?>" class="input100-signup" />
						<div class="input100">
							<option value="" disabled selected>Sex</option>
							<option value=" Male">Male</option>
							<option value="Female">Female</option>
						</div>
						</select>
					</div>
					<div class="wrap-input100-signup">
						<select type="text" name="region" id="region" value="<?= $_POST['region'] ?>"
							class="input100-signup" />
						<option value="" disabled selected>Region</option>
						</select>
					</div>
					<div class="wrap-input100-signup">
						<select type="text" name="province" id="province" value="<?= $_POST['province'] ?>"
							class="input100-signup" disabled />
						<option value="">Province</option>
						</select>
					</div>
					<div class="wrap-input100-signup">
						<select type="text" name="municipality" id="municipality" value="<?= $_POST['municipality'] ?>"
							class="input100-signup" disabled />
						<option value="">Municipality</option>
						</select>
					</div>
					<div class="wrap-input100-signup">
						<select type="text" name="barangay" id="barangay" value="<?= $_POST['barangay'] ?>"
							class="input100-signup" disabled />
						<option value="">Barangay</option>
						</select>
					</div>
					<div class="wrap-input100-signup">
						<input class="input100-signup" type="number" name="contactNumber"
							value="<?= $_POST['contactNumber'] ?>" placeholder="Contact Number" />
					</div>

					<div class="wrap-input100-signup">
						<input class="input100-signup type=" email" name="email" value="<?= $_POST['email'] ?>"
							placeholder="Email" />
					</div>

					<div class="wrap-input100-signup">
						<input class="input100-signup" type="password" name="password" value="<?= $_POST['password'] ?>"
							placeholder="Password" />
					</div>

					<div class="wrap-input100-signup">
						<input class="input100-signup" type="password" name="confirm_password"
							value="<?= $_POST['confirm_password'] ?>" placeholder="Confirm Password" />
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

					<style>
						/* Style for the overlay */
						#overlay {
							display: none;
							position: fixed;
							top: 0;
							left: 0;
							width: 100%;
							height: 100%;
							background-color: rgba(0, 0, 0, 0.7);
							justify-content: center;
							align-items: center;
							z-index: 999;
						}

						/* Style for the modal */
						#modal {
							background-color: #fff;
							padding: 20px;
							border-radius: 5px;
							box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
							text-align: center;
							max-width: 80%;
							margin: auto;
						}

						/* Style for the close button */
						#closeButton {
							cursor: pointer;
							color: #333;
							font-size: 18px;
							margin-top: 10px;
						}

						/* Style for the privacy policy checkbox */
						.privacy-policy-checkbox {
							position: relative;
							margin-bottom: 20px;
						}
					</style>
					</style>

					<!-- Privacy Policy Checkbox and Label -->
					<div class="privacy-policy-checkbox">
						<input type="checkbox" name="privacyCheckbox" id="privacyCheckbox" required>
						<label for="privacyCheckbox" style="font-family: 'Poppins', sans-serif; font-size: 16px;">
							I agree to the <a href="#" id="showPrivacyModal"
								style="font-family: 'Poppins', sans-serif; font-size: 16px;">Privacy Policy</a>
						</label>
					</div>

					<!-- Privacy Policy Modal -->
					<div id="overlay">
						<div id="modal">
							<span id="closeButton">&times;</span>
							<!-- Replace the following line with an iframe pointing to your privacy policy page -->
							<iframe src="privacy_policy.php" style="width: 100%; height: 600px; border: none;"></iframe>
							<span
								style="cursor: pointer; color: #fff; background-color: #70cbcf; border: none; padding: 10px 20px; font-size: 16px; border-radius: 5px; margin-top: 100px;"
								id="agreeButton">I Agree</span>
						</div>
					</div>

					<script>
						// Get the modal elements
						const overlay = document.getElementById('overlay');
						const closeButton = document.getElementById('closeButton');
						const agreeButton = document.getElementById('agreeButton');
						const showPrivacyModal = document.getElementById('showPrivacyModal');
						const privacyCheckbox = document.getElementById('privacyCheckbox');

						// Function to show the modal and check the checkbox
						function showModal() {
							overlay.style.display = 'flex';
						}

						// Function to close the modal and check the checkbox
						function closeModalAndAgree() {
							overlay.style.display = 'none';
							privacyCheckbox.checked = true;
							privacyCheckbox.disabled = true;
						}

						function closeModalAndNotAgree() {
							overlay.style.display = 'none';
							privacyCheckbox.checked = false;
							privacyCheckbox.disabled = false;
						}

						// Event listener for the "Show Privacy Modal" link
						showPrivacyModal.addEventListener('click', function (event) {
							event.preventDefault();
							showModal();
						});

						// Event listener for the close button
						closeButton.addEventListener('click', closeModalAndNotAgree);

						// Event listener for the agree button
						agreeButton.addEventListener('click', closeModalAndAgree);

						// Event listener to close the modal when clicking outside the modal
						window.addEventListener('click', function (event) {
							if (event.target === overlay) {
								closeModalAndAgree();
							}
						});
					</script>

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

				<div class="login100-more" style="background-image: url('../assets/img/form_page/bg-01.jpg');">
				</div>
			</div>
		</div>
	</div>
	<div id="preloader"></div>
	<script>
		const addresses = <?php echo json_encode(json_decode(file_get_contents('../assets/js/form_page/add.json')), JSON_PRETTY_PRINT); ?>;
		initializeDropdowns(addresses);
	</script>
	<?php include "../layouts/_form_page_footer.php"; ?>