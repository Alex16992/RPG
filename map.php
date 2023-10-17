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
		<div class="locations" id="locations">
			<h2 class="title">Select location</h2>
			<div class="locations__list" id="locationsList">

			</div>
		</div>
		<div class="detail" id="detail">
			<h2 class="title">About location</h2>
			<div class="detail-border" id="detail-border">
				<h3 class="detail-name">
					
				</h3>
				<p class="detail-description">
					
				</p>
				<div class="detail__footer">
					<p class="detail__footer-start">Start the adventure</p>
					<!-- <p class="detail__footer-lvl">Recommended level 0-10</p> -->
				</div>
			</div>
		</div>
	</main>
	<? include 'footer.php'; ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script src="assets/JS/script.js"></script>
	<script src="assets/JS/map.js"></script>
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
