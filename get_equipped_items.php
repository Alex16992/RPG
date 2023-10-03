<?php
// Connect to your database
$link = mysqli_connect("localhost", "username", "password", "rpg");

// Check the connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Retrieve equipped items for the user (adjust the query as needed)
$userId = $_SESSION['user_id'];  // Replace with your session handling
$query = "SELECT helmet, jewelry_left, jewelry_right, weapon_left, body, weapon_right FROM users WHERE id = $userId";
$result = mysqli_query($link, $query);

if ($result) {
    $equippedItems = mysqli_fetch_assoc($result);
    echo json_encode($equippedItems);
} else {
    echo json_encode(["error" => "Unable to fetch equipped items."]);
}

// Close the connection
mysqli_close($link);
?>
