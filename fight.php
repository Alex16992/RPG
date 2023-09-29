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
	<link rel="stylesheet" type="text/css" href="assets/CSS/fight.css">
</head>
<body>
<? include 'header.php'; ?>
	<main class="main">
		<div class="PlayerStats">
			<h3 class="name">
				Player Name
			</h3>
			<div class="stats">
				<div class="stats__name">
					Damage
				</div>
				<div class="stats__value">
					20
				</div>
			</div>
			<div class="stats">
				<div class="stats__name">
					Damage
				</div>
				<div class="stats__value">
					20
				</div>
			</div>
			<div class="stats">
				<div class="stats__name">
					Damage
				</div>
				<div class="stats__value">
					20
				</div>
			</div>
			<div class="stats">
				<div class="stats__name">
					Damage
				</div>
				<div class="stats__value">
					20
				</div>
			</div>
			<h3 class="passive">
				Passive effects
			</h3>
			<div class="stats">
				<div class="stats__name">
					Shield
				</div>
				<div class="stats__value">
					Armor + 5
				</div>
			</div>
			<div class="stats">
				<div class="stats__name">
					Shield
				</div>
				<div class="stats__value">
					Armor + 5
				</div>
			</div>
			<div class="stats">
				<div class="stats__name">
					Shield
				</div>
				<div class="stats__value">
					Armor + 5
				</div>
			</div>
			<div class="stats">
				<div class="stats__name">
					Shield
				</div>
				<div class="stats__value">
					Armor + 5
				</div>
			</div>
			<div class="stats">
				<div class="stats__name">
					Shield
				</div>
				<div class="stats__value">
					Armor + 5
				</div>
			</div>
		</div>
		<div class="BattleField">
			<div class="BattleField__player">
				<div class="PlayerHealth" id="PlayerHealth">
					<span id="PlayerHealthValue"></span>
				</div>
				<img src="assets/Image/Enemy/player.png" alt="" class="BattleField__player__img">
			</div>
			<div class=""></div>
			<div class="BattleField__enemy">
				<div class="EnemyHealth" id="EnemyHealth">
					<span id="EnemyHealthValue"></span>
				</div>
				<img src="assets/Image/Enemy/rat.png" alt="" class="BattleField__enemy__img">
			</div>
		</div>
		<div class="EnemyStats">
			<h3 class="name">
				Rat
			</h3>
			<div class="stats">
				<div class="stats__name">
					Damage
				</div>
				<div class="stats__value">
					5
				</div>
			</div>
			<h3 class="passive">
				Passive effects
			</h3>
			<div class="stats">
				<div class="stats__name">
					Bleeding
				</div>
				<div class="stats__value">
					HP - 3
				</div>
			</div>
		</div>
	</main>
	<footer class="footer">
		<div class=""></div>
		<div class="footer__button">
			<p class="footer__button-attack">
				Attack
			</p>
			<p class="footer__button-shield">
				Shield
			</p>
			<p class="footer__button-heal">
				Heal (You have 4)
			</p>
		</div>
		<div class=""></div>
	</footer>
	<script src="assets/JS/script.js"></script>
	<script src="assets/JS/fight.js"></script>
</body>
</html>
