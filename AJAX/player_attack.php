<?php include 'user_info.php'; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enemys = json_decode($row['enemy'], true);
    if ($row['enemy_hp'] <= 0) {
    	echo 77777;
    }
    else if ($row['health'] <= 0) {
    	echo 66666;
    }
    else if ($row['turn'] == 1) {
    	if ($enemys) {
	        foreach ($enemys as $enemy) {
	            $enemyId = $enemy[0];
	            $enemyLevel = $enemy[1];
	            $enemyquery = "SELECT armor FROM enemy WHERE id='$enemyId'";
	            $enemyresult = mysqli_query($link, $enemyquery);
	            $enemyrow = mysqli_fetch_assoc($enemyresult);

	            if ($enemyLevel != 1) {
	                $enemyarmor = round($enemyrow['armor'] * $enemyLevel / 1.5);
	            } else {
	                $enemyarmor = round($enemyrow['armor']);
	            }

	            $randomDamage = rand($damage-3, $damage+1);
	            $randomDamageArmor = rand($randomDamage - $enemyrow['armor'], $randomDamage - $enemyrow['armor'] * $enemyLevel / 2);
	            if ($randomDamageArmor <= 0) {
	            	$randomDamageArmor = 1;
	            }
	            $critChance = $row['crit'];
				$randomNumber = rand(1, 100);
				if ($randomNumber <= $critChance) {
				    $randomDamageArmor = $randomDamageArmor * 2;
				}
	            $resultDamage = round($row['enemy_hp'] - $randomDamageArmor);
				$effect_list = unserialize($row['effect_list']);
				$currentEffects = json_decode($row['enemy_effect_list'], true);
				$effectName;

				// effects
				foreach ($effect_list as $effect) {
					$effectId = $effect[0];
					$effectquery = "SELECT time, chance, name FROM effect WHERE id='$effectId'";
					$effectresult = mysqli_query($link, $effectquery);
					$effectrow = mysqli_fetch_assoc($effectresult);
					$effectChance = $effectrow['chance'];
					$randomEffect = rand(1, 100);
					if ($randomEffect <= $effectChance) {
						$effectTime = $effectrow['time'];
						$currentEffects[] = array($effectId, $effectTime);
					}
				}
				$updateEffectQuery = "UPDATE users SET enemy_effect_list='" . mysqli_real_escape_string($link, json_encode($currentEffects)) . "' WHERE id = $userId";
				mysqli_query($link, $updateEffectQuery);
				$enemy_effect_list_sql = "SELECT enemy_effect_list FROM users WHERE id='$userId'";
				$enemy_effect_list_result = mysqli_query($link, $enemy_effect_list_sql);
				$enemy_effect_list_row = mysqli_fetch_assoc($enemy_effect_list_result);
				$enemy_effect_list = $enemy_effect_list_row['enemy_effect_list'];
				$currentEffects = json_decode($enemy_effect_list, true);

				
				$effectDamage = 0;
				$newhealth = $health;
				if (is_array($currentEffects)) {
					foreach ($currentEffects as $key => &$effect) {
						$effect[1]--;
						if ($effect[1] <= 0) {
							unset($currentEffects[$key]);
						}
						$effectId = $effect[0];
						$effectquery = "SELECT name, damage, heal FROM effect WHERE id='$effectId'";
						$effectresult = mysqli_query($link, $effectquery);
						$effectrow = mysqli_fetch_assoc($effectresult);
						if($effectrow['damage']){
							$effectDamage += $effectrow['damage'] * $lvl;
							$effectName .= $effectrow['name'] . "-" . $effectrow['damage'] * $lvl . "\n";
						} else if ($effectrow['heal']) {
							$effectDamage += $effectrow['damage'] * $lvl;
							$effectName .= $effectrow['name'] . "-" . $effectrow['heal'] * $lvl . "\n";
							$newhealth = $health + $effectrow['heal'] * $lvl;
						}
					}
					if ($newhealth > $max_health) {
						$newhealth = $max_health;
					}

					$updatedEnemyEffectList = json_encode($currentEffects);

					$updateEffectQuery = "UPDATE users SET health = $newhealth, enemy_effect_list='" . mysqli_real_escape_string($link, $updatedEnemyEffectList) . "' WHERE id = $userId";
					$updateResult = mysqli_query($link, $updateEffectQuery);
				}

				$resultDamage -= $effectDamage;

	            $updateQuery = "UPDATE users SET enemy_hp = $resultDamage, turn = 0 WHERE id = $userId";
	            $updateResult = mysqli_query($link, $updateQuery);
	            if ($resultDamage <= 0) {
	            	echo 77777;
	            } else if ($randomNumber <= $critChance) {
				    echo $effectName . "CRIT! -" . $randomDamageArmor;
				} else {
	            	echo $effectName . "Attack -" . $randomDamageArmor;
	            }
	        }
    	}
    } else {
    	echo 0;
    }
    
}

mysqli_close($link);
?>
