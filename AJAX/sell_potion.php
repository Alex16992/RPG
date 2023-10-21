<?php include 'user_info.php'; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($row['potion'] >= 1) {
        $newPotionCount = $row['potion'] - 1;
        $newBalance = $row['balance'] + $row['lvl'] * 10;
        $updateQuery = "UPDATE users SET potion = $newPotionCount, balance = $newBalance WHERE id = $userId";
        $updateResult = mysqli_query($link, $updateQuery);
    }
}

mysqli_close($link);
?>