<?php include 'user_info.php'; ?>

<?php
$link = mysqli_connect("localhost", "root", "", "rpg");
$itemsql = "SELECT * FROM `users` WHERE id = $userId";
$itemresult = mysqli_query($link, $itemsql);
$itemrow = mysqli_fetch_assoc($itemresult);


function itemImage($item_id, $userId, $link) {
    $item_id = mysqli_real_escape_string($link, $item_id);
    $userId = mysqli_real_escape_string($link, $userId);

    $itemsql = "SELECT * FROM `users` WHERE id = '$userId'";
    $itemresult = mysqli_query($link, $itemsql);

    if (!$itemresult) {
        die("Error in SQL query: " . mysqli_error($link));
    }

    $itemrow = mysqli_fetch_assoc($itemresult);
    $equippedItems = json_decode($item_id, true);
    $itemId = $equippedItems[0];

    $sqlItems = "SELECT image FROM items WHERE id = '$itemId'";
    $resultItems = mysqli_query($link, $sqlItems);

    if (!$resultItems) {
        die("Error in SQL query: " . mysqli_error($link));
    }

    $rowItems = mysqli_fetch_assoc($resultItems);
    if ($rowItems['image'] != null) {
        return $rowItems['image'];
    }
    else{
        return "frame.png";
    }
    
}

function itemLvl($item_id, $userId, $link) {
    $item_id = mysqli_real_escape_string($link, $item_id);
    $userId = mysqli_real_escape_string($link, $userId);

    $itemsql = "SELECT * FROM `users` WHERE id = '$userId'";
    $itemresult = mysqli_query($link, $itemsql);

    if (!$itemresult) {
        die("Error in SQL query: " . mysqli_error($link));
    }

    $itemrow = mysqli_fetch_assoc($itemresult);
    $equippedItems = json_decode($item_id, true);
    $itemLvl = $equippedItems[1];

    if ($itemLvl != null) {
        return "lvl: $itemLvl";
    }
    else{
        return "";
    }
}


$jewelry_left = itemImage($itemrow['jewelry_left'], $userId, $link);
$jewelry_right = itemImage($itemrow['jewelry_right'], $userId, $link);
$helmet = itemImage($itemrow['helmet'], $userId, $link);
$body = itemImage($itemrow['body'], $userId, $link);
$weapon_left = itemImage($itemrow['weapon_left'], $userId, $link);
$weapon_right = itemImage($itemrow['weapon_right'], $userId, $link);

$jewelry_left_lvl = itemLvl($itemrow['jewelry_left'], $userId, $link);
$jewelry_right_lvl = itemLvl($itemrow['jewelry_right'], $userId, $link);
$helmet_lvl = itemLvl($itemrow['helmet'], $userId, $link);
$body_lvl = itemLvl($itemrow['body'], $userId, $link);
$weapon_left_lvl = itemLvl($itemrow['weapon_left'], $userId, $link);
$weapon_right_lvl = itemLvl($itemrow['weapon_right'], $userId, $link);

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

mysqli_close($link);
header('Content-Type: application/json');
echo json_encode($response);

?>