<?php include 'AJAX/user_info.php'; ?>
<?php

if ($combat == 0) {
	header("Location: index.php");
	exit();
	mysqli_close($link);
}

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
	<link rel="stylesheet" type="text/css" href="assets/CSS/fight.css">
</head>
<body>
	<main class="main">
		<div class="PlayerStats" id="PlayerStats">
			<h3 class="name">
				<?php echo $login; ?>
			</h3>
			<div class="stats">
				<div class="stats__name">
					Level
				</div>
				<div class="stats__value">
					<?php echo $lvl; ?>
				</div>
			</div>
			<div class="stats">
				<div class="stats__name">
					Damage
				</div>
				<div class="stats__value">
					<?php echo $damage; ?>
				</div>
			</div>
			<div class="stats">
				<div class="stats__name">
					Armor
				</div>
				<div class="stats__value">
					<?php echo $armor; ?>
				</div>
			</div>
			<h3 class="passive">
				
			</h3>
		</div>
		<div class="BattleField">
			<div class="BattleField__player">
				<div class="damagePlayer"><span id="damagePlayerText"></span></div>
				<div class="PlayerHealth" id="PlayerHealth">
					<span id="PlayerHealthValue"></span>
				</div>
				<img src="assets/Image/Enemy/player.png" alt="" class="BattleField__player__img">
			</div>
			<div class=""></div>
			<div class="BattleField__enemy">
				<div class="damageEnemy"><span id="damageEnemyText"></span></div>
				
				<div class="EnemyHealth" id="EnemyHealth">
					<span id="EnemyHealthValue"></span>
				</div>
				<?php
				$enemys = json_decode($row['enemy'], true);

				if ($enemys) {
					foreach ($enemys as $enemy) {
						$enemyId = $enemy[0];
						$enemyquery = "SELECT image FROM enemy WHERE id='$enemyId'";
						$enemyresult = mysqli_query($link, $enemyquery);
						$enemyrow = mysqli_fetch_assoc($enemyresult);
						echo '<img src="assets/Image/Enemy/'. $enemyrow['image'] .'" alt="" class="BattleField__enemy__img">
						</div>';
						mysqli_close($link);
					}
				}
				?>
				
			</div>
			<div class="EnemyStats" id="EnemyStats">
			</div>
		</main>
		<footer class="footer">
			<div class=""></div>
			<div class="footer__button">
				<p class="footer__button-attack" onclick="checkTurn()">
					Attack
				</p>
				<p class="footer__button-heal" id="footer__button-heal" onclick="playerHeal()">
					Heal (You have <?php echo $potion; ?>)
				</p>
			</div>
			<div class=""></div>
		</footer>
		<script src="assets/JS/fight.js"></script>
	</body>
	</html>
