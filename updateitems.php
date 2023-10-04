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
    if ($rowItems['image'] != null) {
        return $rowItems['image'];
    }
    else{
        return "frame.png";
    }
    
}

function itemLvl($item_id, $userId) {
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
    $itemLvl = $equippedItems[1];

    mysqli_close($link);
    if ($itemLvl != null) {
        return "lvl: $itemLvl";
    }
    else{
        return "";
    }
}


$jewelry_left = itemImage($itemrow['jewelry_left'], $userId);
$jewelry_right = itemImage($itemrow['jewelry_right'], $userId);
$helmet = itemImage($itemrow['helmet'], $userId);
$body = itemImage($itemrow['body'], $userId);
$weapon_left = itemImage($itemrow['weapon_left'], $userId);
$weapon_right = itemImage($itemrow['weapon_right'], $userId);

$jewelry_left_lvl = itemLvl($itemrow['jewelry_left'], $userId);
$jewelry_right_lvl = itemLvl($itemrow['jewelry_right'], $userId);
$helmet_lvl = itemLvl($itemrow['helmet'], $userId);
$body_lvl = itemLvl($itemrow['body'], $userId);
$weapon_left_lvl = itemLvl($itemrow['weapon_left'], $userId);
$weapon_right_lvl = itemLvl($itemrow['weapon_right'], $userId);

$response = array(
    'jewelry_left' => $jewelry_left,
    'jewelry_right' => $jewelry_right,
    'helmet' => $helmet,
    'body' => $body,
    'weapon_left' => $weapon_left,
    'weapon_right' => $weapon_right,
    'jewelry_left_lvl' => $jewelry_left_lvl,
    'jewelry_right_lvl' => $jewelry_right_lvl,
    'helmet_lvl' => $helmet_lvl,
    'body_lvl' => $body_lvl,
    'weapon_left_lvl' => $weapon_left_lvl,
    'weapon_right_lvl' => $weapon_right_lvl,
);

header('Content-Type: application/json');
echo json_encode($response);

?>