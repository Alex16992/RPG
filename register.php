<?php


$link = mysqli_connect("localhost", "root", "", "rpg");

if ($link === false) {
	die("Failed to connect to the database: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {


$recaptcha_secret = "SECRET_KEY"; // Ваш секретный ключ reCAPTCHA
$recaptcha_response = $_POST['g-recaptcha-response'];

// Проверка reCAPTCHA
$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
$recaptcha_data = array(
	'secret' => $recaptcha_secret,
	'response' => $recaptcha_response
);

$recaptcha_options = array(
	'http' => array(
		'header' => "Content-type: application/x-www-form-urlencoded\r\n",
		'method' => 'POST',
		'content' => http_build_query($recaptcha_data)
	)
);

$recaptcha_context = stream_context_create($recaptcha_options);
$recaptcha_result = file_get_contents($recaptcha_url, false, $recaptcha_context);
$recaptcha_response_keys = json_decode($recaptcha_result, true);

if (intval($recaptcha_response_keys["success"]) == 1) {
    // Проверка reCAPTCHA не пройдена
	echo "Please complete the reCAPTCHA.";
	mysqli_close($link);
		exit();
} else {
	$login = mysqli_real_escape_string($link, $_POST['login']);
	$email = mysqli_real_escape_string($link, $_POST['email']);
	$password = mysqli_real_escape_string($link, $_POST['password']);

    // Check for empty fields
	if (empty($login) || empty($email) || empty($password)) {
		echo "Please fill in all the fields.";
		mysqli_close($link);
		exit();
	}

    // Check login length
	if (strlen($login) < 4 || strlen($login) > 18) {
		echo "Login length should be between 4 and 18 characters.";
		mysqli_close($link);
		exit();
	}

    // Check email length
	if (strlen($email) > 50) {
		echo "Email length should not exceed 50 characters.";
		mysqli_close($link);
		exit();
	}

    // Check password length
	if (strlen($password) < 6 || strlen($password) > 50) {
		echo "Password length should be between 6 and 50 characters.";
		mysqli_close($link);
		exit();
	}

    // Rest of the validation logic

	if (!preg_match("/^[0-9a-zA-Z]+$/", $login)) {
		echo "Login can only contain alphanumeric characters.";
		mysqli_close($link);
		exit();
	}

	if (!preg_match("/^[0-9a-zA-Z!@#$%^&*()_+=\-[\]{};':\"\\|,.<>\/?]+$/", $password)) {
		echo "Password can only contain alphanumeric characters and symbols.";
		mysqli_close($link);
		exit();
	}

	$check_query = "SELECT * FROM users WHERE login='$login' OR email='$email'";
	$result = mysqli_query($link, $check_query);
	if (mysqli_num_rows($result) > 0) {
		echo "Login or email already exists in the database.";
		mysqli_close($link);
		exit();
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "Invalid email format.";
		mysqli_close($link);
		exit();
	}
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	$sql = "INSERT INTO users (login, email, password) VALUES ('$login', '$email', '$hashed_password')";

	if (mysqli_query($link, $sql)) {
		echo '<script>window.location.href = "login.php";</script>';
	} else {
		echo "Error during registration: " . mysqli_error($link);
	}
}
}

mysqli_close($link);
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>My RPG</title>
	<link rel="stylesheet" type="text/css" href="assets/CSS/null.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Jomhuria&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/CSS/header.css">
	<link rel="stylesheet" type="text/css" href="assets/CSS/footer.css">
	<link rel="stylesheet" type="text/css" href="assets/CSS/log_reg.css">
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
	<main class="main">
		<div class="form">
			<div id="err" class="err">
			</div>
			<form id="register-form">
				<input name='login' class="input" type='text' placeholder='Login...' autocomplete="off">
				<input name='email' class="input" type='email' placeholder='Email...' autocomplete="off">
				<input name='password' class="input" type='password' placeholder='Password...' autocomplete="new-password">
				<!-- <div class="g-recaptcha" data-sitekey="PUBLIC_KEY" data-theme="dark"></div> -->
				<input name="send" class="submit" type="submit" value="Register">
			</form>
			<p class="form__text">
				Have account? <a href="login.php">Login</a>
			</p>
		</div>
	</main>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#register-form").submit(function(event) {
            event.preventDefault(); 
            var formData = $(this).serialize();

            $.ajax({
                type: "POST",
                url: "register.php",
                data: formData,
                success: function(response) {
                	$("#err").html(response);
                },
                error: function(xhr, textStatus, errorThrown) {
                	console.error("Error: " + errorThrown);
                }
            });
            grecaptcha.reset();
        });
		});
	</script>
</body>
</html>