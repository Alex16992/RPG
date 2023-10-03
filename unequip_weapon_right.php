<? include 'user_info.php'; ?>

<?php
$link = mysqli_connect("localhost", "root", "", "rpg");

if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    // Fetch the weapon_right item from the database
    $query = "SELECT weapon_right FROM users WHERE id = $userId";
    $result = mysqli_query($link, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $weapon_rightItem = json_decode($row['weapon_right'], true);

        // Use the values from the weapon_right item
        $itemId = $weapon_rightItem[0];
        $lvl = $weapon_rightItem[1];

        // Remove the equipped item from the weapon_right slot
        $removeQuery = "UPDATE users SET weapon_right = NULL WHERE id = $userId"; // Убедитесь, что есть присвоенное значение для $userId
        $removeResult = mysqli_query($link, $removeQuery);

        if ($removeResult) {
            $query = "SELECT items FROM users WHERE id = $userId";
            $result = mysqli_query($link, $query);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
    $currentInventory = json_decode($row['items'], true);  // Преобразуем JSON строку в массив
    mysqli_free_result($result);

    // Новые предметы для добавления
    $newItemsToAdd = [[$itemId, $lvl]];

    // Добавляем новые предметы в инвентарь
    foreach ($newItemsToAdd as $item) {
        $currentInventory[] = $item;
    }

    // Преобразуем инвентарь в формат JSON
    $updatedInventory = json_encode($currentInventory);

    // Обновляем инвентарь пользователя в базе данных
    $updateQuery = "UPDATE users SET items = '$updatedInventory' WHERE id = $userId";
    mysqli_query($link, $updateQuery);

    // Проверка на ошибки при обновлении
    if (mysqli_error($link)) {
        echo "Failed to update inventory: " . mysqli_error($link);
    } else {

    }
} else {
    echo "Error: " . mysqli_error($link);
}
} else {

}
} else {

}
}
mysqli_close($link);
?>

