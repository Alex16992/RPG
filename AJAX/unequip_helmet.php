<? include 'user_info.php'; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    // Fetch the helmet item from the database
    $query = "SELECT helmet FROM users WHERE id = $userId";
    $result = mysqli_query($link, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $helmetItem = json_decode($row['helmet'], true);

        // Use the values from the helmet item
        $itemId = $helmetItem[0];
        $lvl = $helmetItem[1];
        if ($itemId) {
                    // Remove the equipped item from the helmet slot
        $removeQuery = "UPDATE users SET helmet = NULL WHERE id = $userId"; // Убедитесь, что есть присвоенное значение для $userId
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
        }

} else {

}
}
mysqli_close($link);
?>

