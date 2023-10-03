<? include 'user_info.php'; ?>

<?php
$link = mysqli_connect("localhost", "root", "", "rpg");
$itemsql = "SELECT * FROM `users` WHERE id = $userId";
$itemresult = mysqli_query($link, $itemsql);

if (!$itemresult) {
    die("Error in SQL query: " . mysqli_error($link));
}

$itemrow = mysqli_fetch_assoc($itemresult);


function itemImage($item_id, $userId) {
    $link = mysqli_connect("localhost", "root", "", "rpg");

    if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $item_id = mysqli_real_escape_string($link, $item_id);
    $userId = mysqli_real_escape_string($link, $userId);

    $itemsql = "SELECT * FROM `users` WHERE id = '$userId'";
    $itemresult = mysqli_query($link, $itemsql);

    if (!$itemresult) {
        die("Error in SQL query: " . mysqli_error($link));
    }

    $itemrow = mysqli_fetch_assoc($itemresult);
    $equippedItems = json_decode($item_id, true);  // Используем переданный item_id
    $itemId = $equippedItems[0];

    $sqlItems = "SELECT image FROM items WHERE id = '$itemId'";
    $resultItems = mysqli_query($link, $sqlItems);

    if (!$resultItems) {
        die("Error in SQL query: " . mysqli_error($link));
    }

    $rowItems = mysqli_fetch_assoc($resultItems);
    mysqli_close($link);

    return $rowItems['image'];
}


$jewelry_left = itemImage($itemrow['jewelry_left'], $userId);
$jewelry_right = itemImage($itemrow['jewelry_right'], $userId);
$helmet = itemImage($itemrow['helmet'], $userId);
$body = itemImage($itemrow['body'], $userId);
$weapon_left = itemImage($itemrow['weapon_left'], $userId);
$weapon_right = itemImage($itemrow['weapon_right'], $userId);

$response = array(
    'jewelry_left' => $jewelry_left,
    'jewelry_right' => $jewelry_right,
    'helmet' => $helmet,
    'body' => $body,
    'weapon_left' => $weapon_left,
    'weapon_right' => $weapon_right,
);

header('Content-Type: application/json');
echo json_encode($response);

?>