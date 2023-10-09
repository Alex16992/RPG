<? include 'user_info.php'; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemId = $_POST['itemId'];
    $slot = $_POST['slot'];
    $lvl = $_POST['lvl'];
    $itemUpdate = "[$itemId, $lvl]";
    if ($row["lvl"]>=$lvl) {
        $itemquery = "SELECT items FROM users WHERE id = $userId";
        $itemresult = mysqli_query($link, $itemquery);
        if ($itemresult) {

        //Looking for an item in the player's inventory
            $itemrow = mysqli_fetch_assoc($itemresult);
            $items = json_decode($itemrow['items'], true);
            $itemFound = false;
            foreach ($items as $item) {
                if ($item[0] == $itemId && $item[1] == $lvl) {
                    $itemFound = true;
                    break;
                }
            }


            if ($itemFound) {
            // Update the user's equipment based on the slot
                if ($slot == "helmet" && $row['helmet'] == null) {
                    $query = "UPDATE users SET helmet = '$itemUpdate' WHERE id = $userId";
                } else if ($slot == "weapon") {
                    if ($row['weapon_left'] == null) {
                        $query = "UPDATE users SET weapon_left = '$itemUpdate' WHERE id = $userId";
                    } else if ($row['weapon_right'] == null) {
                        $query = "UPDATE users SET weapon_right = '$itemUpdate' WHERE id = $userId";
                    }
                }
                $result = mysqli_query($link, $query);

                if ($result) {
                    $removequery = "SELECT items FROM users WHERE id = $userId";
                    $removeresult = mysqli_query($link, $removequery);

                    if ($removeresult) {
                        $removerow = mysqli_fetch_assoc($removeresult);
                        $removeitems = json_decode($row['items'], true);

                    // Find and remove the equipped item from the inventory
                        foreach ($removeitems as $key => $removeitem) {
                            if ($removeitem == [$itemId, $lvl]) {
                                unset($removeitems[$key]);
                                break;
                            }
                        }

                    // Update the user's inventory in the database
                        $updatedInventory = json_encode(array_values($removeitems));
                        $updateQuery = "UPDATE users SET items = '$updatedInventory' WHERE id = $userId";
                        $updateResult = mysqli_query($link, $updateQuery);

                        if ($updateResult) {
                            echo 'Item equipped successfully!';
                        } else {
                            echo 'Error updating items: ' . mysqli_error($link);
                        }
                    } else {
                        echo 'Error fetching items: ' . mysqli_error($link);
                    }
                    if ($result) {
                        echo 'Item equipped successfully!';
                    } else {
                        echo 'Error: ' . mysqli_error($link);
                    }
                } else {
                    echo 'Error updating user: ' . mysqli_error($link);
                }
            } else {
                echo 'Error: Item not found in user\'s inventory.';
            }
        } else {
            echo 'Error fetching items: ' . mysqli_error($link);
        }
    } else {
        echo 'Error: Level too low.';
    }


    
    
}

mysqli_close($link);
?>
