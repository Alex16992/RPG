<? include 'user_info.php'; ?>

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
	<link rel="stylesheet" type="text/css" href="assets/CSS/style.css">
</head>
<body>
	<? include 'header.php'; ?>
	<main class="main">
		<div class="update">
			<h2 class="title">Last update</h2>
			<div class="update-log">
				<h3 class="update-log__title">
					First update / Fix bugs
				</h3>
				<h4 class="update-log__date">
					18.09.2023
				</h4>
				<p class="update-log__text">
					Fixed bugs related to game performance and stability to provide smoother gameplay.
					Improved balancing of the combat system, taking into account player feedback to provide more interesting and fair battles.
					Made minor changes to the interface and gameplay to make the gameplay more intuitive and engaging.Fixed bugs related to game performance and stability to provide smoother gameplay.
					Improved balancing of the combat system, taking into account player feedback to provide more interesting and fair battles.
					Made minor changes to the interface and gameplay to make the gameplay more intuitive and engaging.Fixed bugs related to game performance and stability to provide smoother gameplay.
					Improved balancing of the combat system, taking into account player feedback to provide more interesting and fair battles.
					Made minor changes to the interface and gameplay to make the gameplay more intuitive and engaging.Fixed bugs related to game performance and stability to provide smoother gameplay.
					Improved balancing of the combat system, taking into account player feedback to provide more interesting and fair battles.
					Made minor changes to the interface and gameplay to make the gameplay more intuitive and engaging.
				</p>
			</div>
		</div>
		<div class="contact">
			<h2 class="title">Contact</h2>
			<div class="contact__border">
				<div class="our-contact">
					<img src="assets/Image/Interface/github.png" alt="GitHub" class="our-contact__logo">
					<div class="contact__text">
						<p class="contact__name">GitHub</p>
						<a href="https://github.com/Alex16992" class="contact__link">https://github.com/Alex16992</a>
					</div>
				</div>			
				<div class="our-contact">
					<img src="assets/Image/Interface/discord.png" alt="Discord" class="our-contact__logo">
					<div class="contact__text">
						<p class="contact__name">Discord</p>
						<a href="#" class="contact__link">alex_1699</a>
					</div>
				</div>
				<div class="our-contact">
					<img src="assets/Image/Interface/vk.png" alt="VK" class="our-contact__logo">
					<div class="contact__text">
						<p class="contact__name">VK</p>
						<a href="https://vk.com/nealex1699" class="contact__link">https://vk.com/nealex1699</a>
					</div>
				</div>
				<div class="our-contact">
					<img src="assets/Image/Interface/mail.png" alt="E-Mail" class="our-contact__logo">
					<div class="contact__text">
						<p class="contact__name">E-Mail</p>
						<a href="mailto:lehad600@gmail.com" class="contact__link">lehad600@gmail.com</a>
					</div>
				</div>
			</div>
		</div>
	</main>
	<? include 'footer.php'; ?>
	<script src="assets/JS/script.js"></script>
	<script type="text/javascript">
		document.addEventListener('DOMContentLoaded', function() {
			const iconElement = document.querySelector('#update');
			if (iconElement) {
				iconElement.classList.add('icon_active');
			}
		});
	</script>
</body>
</html>
