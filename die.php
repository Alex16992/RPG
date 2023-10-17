<? include 'AJAX/user_info.php'; ?>

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
	<link rel="stylesheet" type="text/css" href="assets/CSS/win.css">
</head>
<body>
	<main class="main">
		<div class="loot">
			<?php
			if ($combat == 1) {
				$query = "SELECT enemy, max_health, exp, balance, health FROM users WHERE id = $userId";
				$result = mysqli_query($link, $query);
				$row = mysqli_fetch_assoc($result);
				$enemys = json_decode($row['enemy'], true);

				if ($row['health'] <= 0) {
					if ($enemys) {
						foreach ($enemys as $enemy) {
							$enemyId = $enemy[0];
							$enemyLevel = $enemy[1];
							$enemyquery = "SELECT items, name, exp FROM enemy WHERE id='$enemyId'";
							$enemyresult = mysqli_query($link, $enemyquery);
							$enemyrow = mysqli_fetch_assoc($enemyresult);
							$newBalance = $row['balance'] / 2;
							$query = "UPDATE users SET combat = 0, location = null, enemy = null, enemy_hp = null, enemy_max_hp = null, health = '$row[max_health]', exp = 0, balance = $newBalance WHERE id = $userId";
							$result = mysqli_query($link, $query);
							$htmlOutput .= '<p>You lost the fight with the '. $enemyrow["name"] .' and lost all your experience, as well as half of your coins went to healing.</p>';
							$htmlOutput .= '<a href="inventory.php" class="loot__link">Back to inventory</a>';
							echo $htmlOutput;
						}
					}
				} else {
					header("Location: fight.php");
					exit();
				}
				
			}
			mysqli_close($link);
			?>
		</div>
	</main>
	<footer class="footer">

	</footer>
</body>
</html>
