<?php
session_start();

$link = mysqli_connect("localhost", "root", "", "rpg");

if ($link === false) {
	die("Failed to connect to the database: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$login = mysqli_real_escape_string($link, $_POST['login']);
	$password = mysqli_real_escape_string($link, $_POST['password']);

	if (empty($login) || empty($password)) {
		echo "Please fill in all the fields.";
		exit();
	}

	$sql = "SELECT id, password FROM users WHERE login='$login'";
	$result = mysqli_query($link, $sql);

	if ($result) {
		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
			if (password_verify($password, $row['password'])) {
				$_SESSION['user_id'] = $row['id']; 
				echo "Login successful.";
				echo '<script>window.location.href = "index.php";</script>';
				exit();
			} else {
				echo "Incorrect password.";
				exit();
			}
		} else {
			echo "User not found.";
			exit();
		}
	} else {
		echo "Error: " . mysqli_error($link);
		exit();
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
</head>
<body>
	<main class="main">
		<div class="form">
			<div id="err" class="err">
			</div>
			<form id="login-form">
				<input name='login' class="input" type='text' placeholder='Login...'>
				<input name='password' class="input" type='password' placeholder='Password...'>
				<input name="send" class="submit" type="submit" value="Login">
			</form>
			<p class="form__text">
				Don't have account? <a href="register.php">Register</a>
			</p>
		</div>
	</main>
	<script src="assets/JS/script.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		    $("#login-form").submit(function(event) {
		        event.preventDefault();

		        var formData = $(this).serialize();
		        $.ajax({
		            type: "POST",
		            url: "login.php",
		            data: formData,
		            success: function(response) {
		                $("#err").html(response);
		                if (response.trim() === "Login successful.") {
		                    window.location.href = "index.php";
		                }
		            },
		            error: function(xhr, textStatus, errorThrown) {
		                console.error("Error: " + errorThrown);
		            }
		        });
		    });
		});

	</script>
</body>

</html>
