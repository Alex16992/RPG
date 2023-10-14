<?php include 'user_info.php'; ?>

<?php

// Fetch item information based on itemId from the database
$query = "SELECT enemy_hp, enemy_max_hp FROM users WHERE id = $userId";
$result = mysqli_query($link, $query);

if ($result) {
    $enemyHP = mysqli_fetch_assoc($result);
    echo json_encode($enemyHP);
} else {
    echo "Error: " . mysqli_error($link);
}

mysqli_close($link);
?>