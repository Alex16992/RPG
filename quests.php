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
	<link rel="stylesheet" type="text/css" href="assets/CSS/quests.css">
</head>
<body>
<? include 'header.php'; ?>
	<main class="main">
		<div class="quests">
			<h2 class="title">Your quests</h2>
			<div class="quests-border">
				<div class="quest">
					<p class="quests__text">
						Pesky skeletons. Location - cemetery. 1 / 5
					</p>
					<img src="assets/Image/Interface/Detail.png" alt="" class="quests__detail">
				</div>
				<div class="quest">
					<p class="quests__text">
						Pesky skeletons. Location - cemetery. 1 / 5
					</p>
					<img src="assets/Image/Interface/Detail.png" alt="" class="quests__detail">
				</div>
				<div class="quest">
					<p class="quests__text">
						Pesky skeletons. Location - cemetery. 1 / 5
					</p>
					<img src="assets/Image/Interface/Detail.png" alt="" class="quests__detail">
				</div>
				<div class="quest">
					<p class="quests__text">
						Pesky skeletons. Location - cemetery. 1 / 5
					</p>
					<img src="assets/Image/Interface/Detail.png" alt="" class="quests__detail">
				</div>
				<div class="quest">
					<p class="quests__text">
						Pesky skeletons. Location - cemetery. 1 / 5
					</p>
					<img src="assets/Image/Interface/Detail.png" alt="" class="quests__detail">
				</div>
				<div class="quest">
					<p class="quests__text">
						Pesky skeletons. Location - cemetery. 1 / 5
					</p>
					<img src="assets/Image/Interface/Detail.png" alt="" class="quests__detail">
				</div>
			</div>
		</div>
		<div class="detail">
			<h2 class="title">Details</h2>
			<div class="detail-border">
				<div class="detail__main">
					<p class="detail__main-name">
						Pesky skeletons
					</p>
					<p class="detail__main-location">
						Location - cemetery
					</p>
				</div>
				<p class="detail-description">
					A cemetery forgotten by time, it is now inhabited by dark souls - pesky skeletons rising from their graves. They disturb the peacefulness of the place and threaten the surrounding residents. You are tasked with freeing the cemetery from this curse by destroying 5 pesky skeletons.
				</p>
				<div class="detail__status">
					<p class="detail__status-progress">
						Progress of execution: 5 / 5
					</p>
					<a href="#" class="detail__status-pass">Complete quest</a>
				</div>
			</div>
		</div>
	</main>
<? include 'footer.php'; ?>
	<script src="assets/JS/script.js"></script>
		<script type="text/javascript">
		document.addEventListener('DOMContentLoaded', function() {
			const iconElement = document.querySelector('#quest');
			if (iconElement) {
				iconElement.classList.add('icon_active');
			}
		});
	</script>
</body>
</html>
