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
	<link rel="stylesheet" type="text/css" href="assets/CSS/map.css">
</head>
<body>
<? include 'header.php'; ?>
	<main class="main">
		<div class="locations">
			<h2 class="title">Select location</h2>
			<div class="locations__list">
				<img src="assets/Image/Interface/forest.png" alt="">
				<img src="assets/Image/Interface/forest.png" alt="">
				<img src="assets/Image/Interface/forest.png" alt="">
				<img src="assets/Image/Interface/forest.png" alt="">
				<img src="assets/Image/Interface/forest.png" alt="">
				<img src="assets/Image/Interface/forest.png" alt="">
			</div>
		</div>
		<div class="detail">
			<h2 class="title">About location</h2>
			<div class="detail-border">
				<h3 class="detail-name">
					Location - cemetery
				</h3>
				<p class="detail-description">
					The dark and gloomy cemetery, shrouded in the shroud of night, is a testament to mystical past events and sinister secrets lurking in its hidden corners. The shadows of trees and graves seem like ghosts, captivated by the eternal gloom. The dark and gloomy cemetery, shrouded in the shroud of night, is a testament to mystical past events and sinister secrets lurking in its hidden corners. The shadows of trees and graves seem like ghosts, captivated by the eternal gloom.
				</p>
				<div class="detail__footer">
					<a href="" class="detail__footer-start">Start the adventure</a>
					<p class="detail__footer-lvl">Recommended level 0-10</p>
				</div>
			</div>
		</div>
		</main>
<? include 'footer.php'; ?>
		<script src="assets/JS/script.js"></script>
			<script type="text/javascript">
		document.addEventListener('DOMContentLoaded', function() {
			const iconElement = document.querySelector('#map');
			if (iconElement) {
				iconElement.classList.add('icon_active');
			}
		});
	</script>
	</body>
	</html>
