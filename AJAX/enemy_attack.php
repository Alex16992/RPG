<?php include 'user_info.php'; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = "SELECT health, armor, enemy_hp, enemy FROM users WHERE id = $userId";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);
    $enemys = json_decode($row['enemy'], true);
    if ($row['health'] <= 0) {
        echo 66666;
        exit();
    }
    else if ($row['enemy_hp'] <= 0) {
        echo 77777;
        exit();
    }
    else if ($enemys) {
        foreach ($enemys as $enemy) {
            $enemyId = $enemy[0];
            $enemyLevel = $enemy[1];
            $enemyquery = "SELECT damage FROM enemy WHERE id='$enemyId'";
            $enemyresult = mysqli_query($link, $enemyquery);
            $enemyrow = mysqli_fetch_assoc($enemyresult);
            $enemydamage = round($enemyrow['damage'] * $enemyLevel / 1.5);
            $randomDamage = rand($enemydamage-1, $enemydamage+2);
            $randomDamageArmor = rand($randomDamage - $row['armor'], $randomDamage - $row['armor'] / 1.5);
            if ($randomDamageArmor <= 0) {
            	$randomDamageArmor = 1;
            }
            $resultDamage = round($row['health'] - $randomDamageArmor);
            $updateQuery = "UPDATE users SET health = $resultDamage, turn = 1 WHERE id = $userId";
            $updateResult = mysqli_query($link, $updateQuery);
            if ($resultDamage <= 0) {
                echo 66666;
            } else {
                echo $randomDamageArmor;
            }
        }
    }
}

mysqli_close($link);
?>
