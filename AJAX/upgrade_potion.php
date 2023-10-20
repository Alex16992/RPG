<?php include 'user_info.php'; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $potionPrice = 20 * $row['potion_lvl'];
    if ($row['balance'] >= $potionPrice) {
        $newPotionLvl = $row['potion_lvl'] + 1;
        $newBalance = $row['balance'] - $potionPrice;
        $updateQuery = "UPDATE users SET potion = 0, potion_lvl = $newPotionLvl, balance = $newBalance WHERE id = $userId";
        $updateResult = mysqli_query($link, $updateQuery);
    }
}

mysqli_close($link);
?>