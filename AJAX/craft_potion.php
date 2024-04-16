<?php include 'user_info.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($result) {
        $inventory = json_decode($row['items'], true);
        mysqli_free_result($result);

        if ($inventory) {
            $herbsCount = 0;
            $updatedItems = array();
            foreach ($inventory as $item) {
                $itemId = $item[0];
                $itemLevel = $item[1];
                $sql_item = "SELECT name, image FROM items WHERE id='$itemId'";
                $result_item = mysqli_query($link, $sql_item);
                $row_item = mysqli_fetch_assoc($result_item);
                $itemName = $row_item['name'];

                if ($herbsCount < 2 && $itemName == "Herbs" && $itemLevel == $row['potion_lvl']) {
                    $herbsCount++;
                    continue;
                }
                $updatedItems[] = $item;
            }
            if ($herbsCount >= 2) {
                $newPotionCount = $row['potion'] + 1;
                $newInventoryJSON = json_encode($updatedItems);
                $newItems = mysqli_real_escape_string($link, $newInventoryJSON);
                $query = "UPDATE users SET items = '$newItems', potion = '$newPotionCount' WHERE id = $userId";
                
                if (mysqli_query($link, $query)) {
                    echo 'Items removed successfully!';
                } else {
                    echo 'Error updating items: ' . mysqli_error($link);
                }
            }
        }
    } else {
        echo "Error: " . mysqli_error($link);
    }
}
mysqli_close($link);
?>


