<? include 'user_info.php'; ?>

<?php
$link = mysqli_connect("localhost", "root", "", "rpg");
$itemsql = "SELECT * FROM `users` WHERE id = $userId";
$itemresult = mysqli_query($link, $itemsql);

if (!$itemresult) {
	die("Error in SQL query: " . mysqli_error($link));
}

$itemrow = mysqli_fetch_assoc($itemresult);

function itemChar($item_id, $userId) {
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
    $equippedItems = json_decode($item_id, true);  // Use the passed item_id
    $itemId = $equippedItems[0];
    $itemLevel = $equippedItems[1];

    $sqlItems = "SELECT damage, armor FROM items WHERE id = '$itemId'";
    $resultItems = mysqli_query($link, $sqlItems);

    if (!$resultItems) {
    	die("Error in SQL query: " . mysqli_error($link));
    }

    $rowItems = mysqli_fetch_assoc($resultItems);
    mysqli_close($link);

    // Initialize damage and armor
    $damageItem = 0;
    $armorItem = 0;

    // Check if damage and armor are not null, then assign the values
    if ($rowItems['damage'] !== null) {
    	$damageItem = round($rowItems['damage'] * ($itemLevel / 2) + 2);
    } else if ($rowItems['armor'] !== null) {
    	$armorItem = round($rowItems['armor'] * ($itemLevel / 2) + 2);
    }


    return array('damage' => $damageItem, 'armor' => $armorItem);
}

$damage = $itemrow['damage'];
$armor = $itemrow['armor'];

$equippedStats = itemChar($itemrow['jewelry_left'], $userId);
$damage += $equippedStats['damage'];
$armor += $equippedStats['armor'];

$equippedStats = itemChar($itemrow['jewelry_right'], $userId);
$damage += $equippedStats['damage'];
$armor += $equippedStats['armor'];

$equippedStats = itemChar($itemrow['helmet'], $userId);
$damage += $equippedStats['damage'];
$armor += $equippedStats['armor'];

$equippedStats = itemChar($itemrow['body'], $userId);
$damage += $equippedStats['damage'];
$armor += $equippedStats['armor'];

$equippedStats = itemChar($itemrow['weapon_left'], $userId);
$damage += $equippedStats['damage'];
$armor += $equippedStats['armor'];

$equippedStats = itemChar($itemrow['weapon_right'], $userId);
$damage += $equippedStats['damage'];
$armor += $equippedStats['armor'];

$response = array(
	'damage' => $damage,
	'armor' => $armor,
);

header('Content-Type: application/json');
echo json_encode($response);
exit;
?>
