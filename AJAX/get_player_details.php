<?php include 'user_info.php'; ?>

<?php

$userId = $_SESSION['user_id'];

$query = "SELECT items, balance FROM users WHERE id = $userId";
$result = mysqli_query($link, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $inventory = json_decode($row['items'], true);
    mysqli_free_result($result);

    // Function to compare items by level in descending order
    function compareItems($item1, $item2) {
        return $item2[1] - $item1[1];
    }

    // Sort the inventory using the compareItems function
    usort($inventory, 'compareItems');

    $htmlOutput .= '<h2 class="title">Your inventory | Balance: '.$row["balance"].'</h2>';
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
            $htmlOutput .= '<img src="assets/Image/Interface/Detail.png" alt="detail" class="inventory__item-detail" onclick="showItemDetail(' . $itemId . ', ' . $itemLevel . ')">';
            $htmlOutput .= '</div>';
        }
    }

    $htmlOutput .= '</div>';

    echo $htmlOutput;
} else {
    echo "Error: " . mysqli_error($link);
}
mysqli_close($link);
?>

