<?php include 'AJAX/user_info.php'; ?>
<?php
if ($combat == 1) {
    header("Location: fight.php");
    exit();
}
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