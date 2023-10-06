<?php
$link = mysqli_connect("localhost", "root", "", "rpg");

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$itemId = $_GET['itemId'];

// Fetch item information based on itemId from the database
$query = "SELECT * FROM items WHERE id = $itemId";
$result = mysqli_query($link, $query);

if ($result) {
    $selectedItem = mysqli_fetch_assoc($result);
    echo json_encode($selectedItem);
} else {
    echo "Error: " . mysqli_error($link);
}

mysqli_close($link);
?>