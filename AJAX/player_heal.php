<?php include 'user_info.php'; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($row['potion'] >= 1) {
        $newPotionCount = $row['potion'] - 1;
        $newHP = $row['health'] + $row['potion_lvl'] * 7;
        if ($newHP > $row['max_health']) {
            $newHP = $row['max_health'];
        }
        $updateQuery = "UPDATE users SET potion = $newPotionCount, health = $newHP, turn = 0 WHERE id = $userId";
        $updateResult = mysqli_query($link, $updateQuery);
        echo ($row['potion_lvl'] * 7);
    } else {
        echo 0;
    }
}

mysqli_close($link);
?>