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
	<link rel="stylesheet" type="text/css" href="assets/CSS/potion.css">
</head>
<body>
	<? include 'header.php'; ?>
	<main class="main">
		<div class=""></div>
		<div id="herbs">
			
		</div>
		<div class="potion" id="itemDetail">
			<h2 class="title">Craft / Upgrade </h2>
			<div class="potion-border">
				<div class="potion__craft">
					<p class="potion__craft-text">
						Craft 1 potion<br>You need 2 Herbs 1 lvl
					</p>
					<p class="potion__craft-button" onclick="craftPotion();">
						Craft
					</p>
				</div>
				<div class="potion__craft">
					<p class="potion__craft-text">
						Upgrade potions<br>
						For <?php echo (20 * $row['potion_lvl']); ?> coins<br>
						You lose all potions
					</p>
					<p class="potion__craft-button" onclick="upgradePotion();">
						Upgrade
					</p>
				</div>
				<div class="potion__craft">
					<p class="potion__craft-text">
						You have 3 potion<br>
						Lvl - 1<br>
						Price - 10 coins
					</p>
					<p class="potion__craft-button">
						Sell 1 potion
					</p>
				</div>
			</div>
		</div>
		<div class=""></div>
	</main>
	<? include 'footer.php'; ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script src="assets/JS/script.js"></script>
	<script src="assets/JS/potion.js"></script>
	<script type="text/javascript">
		document.addEventListener('DOMContentLoaded', function() {
			const iconElement = document.querySelector('#potion_icon');
			if (iconElement) {
				iconElement.classList.add('icon_active');
			}
		});
	</script>
</body>
</html>
