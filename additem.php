<? include 'user_info.php'; ?>

<?php
$link = mysqli_connect("localhost", "root", "", "rpg");

// Предположим, у вас есть строка инвентаря пользователя из базы данных
$query = "SELECT items FROM users WHERE id = $userId";
$result = mysqli_query($link, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $currentInventory = json_decode($row['items'], true);  // Преобразуем JSON строку в массив
    mysqli_free_result($result);

    // Новые предметы для добавления
    $newItemsToAdd = [[5, 1], [6, 2]];

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

mysqli_close($link);
?>