<?php include 'user_info.php'; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = "SELECT health, armor, enemy FROM users WHERE id = $userId";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);
    $enemys = json_decode($row['enemy'], true);

    if ($enemys) {
        foreach ($enemys as $enemy) {
            $enemyId = $enemy[0];
            $enemyLevel = $enemy[1];
            $enemyquery = "SELECT damage FROM enemy WHERE id='$enemyId'";
            $enemyresult = mysqli_query($link, $enemyquery);
            $enemyrow = mysqli_fetch_assoc($enemyresult);

            if ($enemyLevel != 1) {
                $enemydamage = round($enemyrow['damage'] * ($enemyLevel / 2) + 1.5);
            } else {
                $enemydamage = round($enemyrow['damage']);
            }

            $randomDamage = rand($enemydamage-3, $enemydamage+1);
            $randomDamageArmor = rand($randomDamage - $row['armor'], $randomDamage - $row['armor'] * $lvl / 2);
            if ($randomDamageArmor <= 0) {
            	$randomDamageArmor = 1;
            }
            $resultDamage = round($row['health'] - $randomDamageArmor);
            $updateQuery = "UPDATE users SET health = $resultDamage, turn = 1 WHERE id = $userId";
            $updateResult = mysqli_query($link, $updateQuery);
            echo $randomDamageArmor;
        }
    }
}

mysqli_close($link);
?>
