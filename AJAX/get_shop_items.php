<? include 'user_info.php'; ?>

<?php
$link = mysqli_connect("localhost", "root", "", "rpg");

if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$userId = $_SESSION['user_id'];
$query = "SELECT update_shop, shop FROM users WHERE id = $userId";
$result = mysqli_query($link, $query);

if ($result) {
    $currentTimestamp = $_SERVER['REQUEST_TIME'];

    $row = mysqli_fetch_assoc($result);
    $updateShopTimestamp = strtotime($row['update_shop']);
    $shopData = json_decode($row['shop'], true);

    $queryId = "SELECT id FROM items ORDER BY RAND() LIMIT 100";  // Fetch a larger set of IDs
    $resultId = mysqli_query($link, $queryId);

    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    $randomItemIds = array();

    for ($i = 0; $i < 10; $i++) {
        $query = "SELECT id FROM items ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($link, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $randomItemIds[] = $row['id'];
        } else {
            echo "Error: " . mysqli_error($link);
        }
    }

    if ($updateShopTimestamp === null || $currentTimestamp >= $updateShopTimestamp) {
        $shopData = [];

        for ($i = 0; $i < 10; $i++) {
            $randomIndex = array_rand($randomItemIds);
            $randomItemId = $randomItemIds[$randomIndex];
            $randomItemLevel = rand(1, 10);
            $shopData[] = [$randomItemId, $randomItemLevel];
        }

        // Update the shop and set a new update_shop time (1 hour from now)
        $updateShopTimestamp = $currentTimestamp - 3600;
        $updatedShopData = json_encode($shopData);
        $query = "UPDATE users SET shop = '$updatedShopData', update_shop = FROM_UNIXTIME($updateShopTimestamp) WHERE id = $userId";
        $updateResult = mysqli_query($link, $query);

        if (!$updateResult) {
            echo "Error updating shop: " . mysqli_error($link);
        }
    }
    $query = "SELECT update_shop, shop FROM users WHERE id = $userId";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);
    $inventory = json_decode($row['shop'], true);
    mysqli_free_result($result);
    $currentTimestamp = $_SERVER['REQUEST_TIME'];
    $nextUpdateTimestamp = $row['update_shop'];
    $nextUpdateTimestamp = strtotime($nextUpdateTimestamp);
    $timeDifference = $nextUpdateTimestamp - $currentTimestamp;
    $timeDifferenceMinutes = round($timeDifference / 60);
    // Function to compare items by level in descending order
    function compareItems($item1, $item2) {
        return $item2[1] - $item1[1];
    }

    // Sort the inventory using the compareItems function
    if ($inventory != null) {
        usort($inventory, 'compareItems');
    }
    

    $htmlOutput .= '<h2 class="title">Seller | Store update in '. $timeDifferenceMinutes .' minutes</h2>';
    $htmlOutput .= '<div class="inventory-border">';

    if ($inventory) {
        foreach ($inventory as $item) {
            $itemId = $item[0];
            $itemLevel = $item[1];

            $sql_item = "SELECT name, image FROM items WHERE id='$itemId'";
            $result_item = mysqli_query($link, $sql_item);
            $row_item = mysqli_fetch_assoc($result_item);
            $itemName =  $row_item['name'];
            $itemImage =  $row_item['image'];

            $htmlOutput .= '<div class="inventory__item">';
            $htmlOutput .= '<img src="assets/Image/Items/' . $itemImage . '" alt="Item" class="inventory__item-image">';
            $htmlOutput .= '<div class="inventory__item-about">';
            $htmlOutput .= '<p class="inventory__item-name">' . $itemName . '</p>';
            $htmlOutput .= '<p class="inventory__item-lvl">Level - ' . $itemLevel . '</p>';
            $htmlOutput .= '</div>';
            $htmlOutput .= '<img src="assets/Image/Interface/Detail.png" alt="detail" class="inventory__item-detail" onclick="showSellItemDetail(' . $itemId . ', ' . $itemLevel . ')">';
            $htmlOutput .= '</div>';
        }
    }

    $htmlOutput .= '</div>';

    echo $htmlOutput;
} else {
    echo "Error: " . mysqli_error($link);
}

mysqli_close($link);