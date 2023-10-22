<?php include 'user_info.php'; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($result) {
        $bodyItem = json_decode($row['body'], true);

        // Use the values from the body item
        $itemId = $bodyItem[0];
        $lvl = $bodyItem[1];
        if ($itemId) {
            // Remove the equipped item from the body slot
            $removeQuery = "UPDATE users SET body = NULL WHERE id = $userId"; 
            $removeResult = mysqli_query($link, $removeQuery);

            if ($removeResult) {
                $query = "SELECT items FROM users WHERE id = $userId";
                $result = mysqli_query($link, $query);

                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $currentInventory = json_decode($row['items'], true);  
                    mysqli_free_result($result);

                    $newItemsToAdd = [[$itemId, $lvl]];

                    foreach ($newItemsToAdd as $item) {
                        $currentInventory[] = $item;
                    }

                    $updatedInventory = json_encode($currentInventory);
                    $updateQuery = "UPDATE users SET items = '$updatedInventory' WHERE id = $userId";
                    mysqli_query($link, $updateQuery);
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

