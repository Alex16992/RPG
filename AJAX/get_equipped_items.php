<?php include 'user_info.php'; ?>

<?php

if ($result) {
    $equippedItems = mysqli_fetch_assoc($result);
    echo json_encode($equippedItems);
} else {
    echo json_encode(["error" => "Unable to fetch equipped items."]);
}

// Close the connection
mysqli_close($link);
?>
