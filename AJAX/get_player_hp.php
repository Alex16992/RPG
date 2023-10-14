<?php include 'user_info.php'; ?>

<?php

// Fetch item information based on itemId from the database
$query = "SELECT health, max_health FROM users WHERE id = $userId";
$result = mysqli_query($link, $query);

if ($result) {
    $playerHP = mysqli_fetch_assoc($result);
    echo json_encode($playerHP);
} else {
    echo "Error: " . mysqli_error($link);
}

mysqli_close($link);
?>