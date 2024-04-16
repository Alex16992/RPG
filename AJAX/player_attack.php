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
	            $updateQuery = "UPDATE users SET enemy_hp = $resultDamage, turn = 0 WHERE id = $userId";
	            $updateResult = mysqli_query($link, $updateQuery);
	            if ($resultDamage <= 0) {
	            	echo 77777;
	            } else if ($randomNumber <= $critChance) {
				    echo "CRIT! -" . $randomDamageArmor;
				} else {
	            	echo "-" . $randomDamageArmor;
	            }
	        }
    	}
    } else {
    	echo 0;
    }
    
}

mysqli_close($link);
?>
