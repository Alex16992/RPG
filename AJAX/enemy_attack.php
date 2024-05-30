<?php include 'user_info.php'; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enemys = json_decode($row['enemy'], true);
    if ($row['health'] <= 0) {
        $damage = 66666;
        exit();
    } else if ($row['enemy_hp'] <= 0) {
        $damage = 77777;
        exit();
    } else if ($row['turn'] == 0) {
        foreach ($enemys as $enemy) {
            $enemyId = $enemy[0];
            $enemyLevel = $enemy[1];
            $enemyquery = "SELECT damage, crit, sound FROM enemy WHERE id='$enemyId'";
            $enemyresult = mysqli_query($link, $enemyquery);
            $enemyrow = mysqli_fetch_assoc($enemyresult);
            $enemydamage = round($enemyrow['damage'] * $enemyLevel / 1.5);
            $randomDamage = rand($enemydamage - 1, $enemydamage + 2);
            $randomDamageArmor = rand($randomDamage - $row['armor'], $randomDamage - $row['armor'] / 3);
            if ($randomDamageArmor <= 0) {
                $randomDamageArmor = 1;
            }
            $critChance = $enemyrow['crit'];
            $randomNumber = rand(1, 100);
            if ($randomNumber <= $critChance) {
                $randomDamageArmor = $randomDamageArmor * 2;
            }
            $resultDamage = round($row['health'] - $randomDamageArmor);
            $updateQuery = "UPDATE users SET health = $resultDamage, turn = 1 WHERE id = $userId";
            $updateResult = mysqli_query($link, $updateQuery);
            if ($resultDamage <= 0) {
                $damage = 66666;
            } else if ($randomNumber <= $critChance) {
                $damage = "CRIT! -" . $randomDamageArmor;
            } else {
                $damage = "-" . $randomDamageArmor;
            }

            $sound = $enemyrow['sound'];
            $response = array(
                'damage' => $damage,
                'sound' => $sound
            );
            $response_json = json_encode($response);
            echo $response_json;
        }
    }
}

mysqli_close($link);
?>