<?php
session_start();

// Check if the user is logged in (user ID is stored in the session)
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit();
}

// Establish a database connection
$link = mysqli_connect("localhost", "root", "", "rpg");
if ($link === false) {
    die("Failed to connect to the database: " . mysqli_connect_error());
}

// Fetch user data using the stored user ID
$userId = $_SESSION['user_id'];
$sql = "SELECT login, email, health, max_health, lvl FROM users WHERE id='$userId'";
$result = mysqli_query($link, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $login = $row['login'];
    $lvl = $row['lvl'];
    $email = $row['email'];
    $health = $row['health'];
    $max_health = $row['max_health'];
}

mysqli_close($link);
?>

	<header class="header">
		<div class="health">
			<img class="health__image" src="assets/Image/Interface/health.png" alt="HP">
			<div class="health-bar" id="healthBar">
				<span id="healthText"></span>
			</div>
		</div>
		<div class="player">
			<div class="about">
				<p class="about__level">Level: <?php echo $lvl; ?></p>
				<p class="about__class"><?php echo $login; ?></p>
				<a href="logout.php">Logout</a>
			</div>
			<img class="player__avatar" src="assets/Image/Interface/avatar.png" alt="Avatar">
		</div>
	</header>