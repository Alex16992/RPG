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
				$query = "SELECT enemy, enemy_hp, items, max_health, exp, lvl FROM users WHERE id = $userId";
				$result = mysqli_query($link, $query);
				$row = mysqli_fetch_assoc($result);
				$enemys = json_decode($row['enemy'], true);

				if ($row['enemy_hp'] <= 0) {
					if ($enemys) {
						foreach ($enemys as $enemy) {
							$enemyId = $enemy[0];
							$enemyLevel = $enemy[1];
							$enemyquery = "SELECT items, name, exp FROM enemy WHERE id='$enemyId'";
							$enemyresult = mysqli_query($link, $enemyquery);
							$enemyrow = mysqli_fetch_assoc($enemyresult);
							$arrayItems = json_decode($enemyrow['items'], true);
							$randomItem = array_rand($arrayItems);
							$randomItemId = $arrayItems[$randomItem];
							$randomLvlItem = rand($enemyLevel-3, $enemyLevel+1);
							if ($randomLvlItem <= 0) {
								$randomLvlItem = 1;
							}
							$itemquery = "SELECT name FROM items WHERE id='$randomItemId'";
							$itemresult = mysqli_query($link, $itemquery);
							$itemrow = mysqli_fetch_assoc($itemresult);
							$currentInventory = json_decode($row['items'], true);
							mysqli_free_result($result);
							$newItemsToAdd = [[$randomItemId, $randomLvlItem]];
							foreach ($newItemsToAdd as $item) {
								$currentInventory[] = $item;
							}
							$getExp = round(rand(($enemyLevel * $enemyrow['exp']) / 1.5, $enemyLevel * $enemyrow['exp']));
							$exp = $row['exp'] + $getExp;
							$remainingExp = $exp;
							$currentLevel = $row['lvl'];
							$currentMaxHealth = $row['max_health'];
							$needExp = $currentLevel * 10;
							if ($exp >= $needExp) {
								for ($i = $exp; $i >= $needExp; $i -= $needExp) {
								$currentLevel++;
								$currentMaxHealth = $currentMaxHealth * 1.25;
								$remainingExp = $i - $needExp;
								$needExp = $currentLevel * 10;
								}
							}
							$updatedInventory = json_encode($currentInventory);
							$query = "UPDATE users SET combat = 0, location = null, enemy = null, enemy_hp = null, enemy_max_hp = null, items = '$updatedInventory', health = '$currentMaxHealth', max_health = '$currentMaxHealth', lvl = '$currentLevel', exp = '$remainingExp' WHERE id = $userId";
							$result = mysqli_query($link, $query);
							$htmlOutput .= '<p>You defeated the '. $enemyrow["name"] .' and get: '.$itemrow["name"].' '. $randomLvlItem .' lvl and '. $getExp .' exp</p>';
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
</body>
</html>
