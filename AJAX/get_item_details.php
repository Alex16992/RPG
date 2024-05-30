<?php include 'user_info.php'; ?>

<?php

$itemId = $_GET['itemId'];
$query = "SELECT * FROM items WHERE id = $itemId";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($result);
$effectId = $row['effect'];
$effectquery = "SELECT name FROM effect WHERE id='$effectId'";
$effectresult = mysqli_query($link, $effectquery);
$effectrow = mysqli_fetch_assoc($effectresult);
$effectName = $effectrow['name'];
mysqli_data_seek($result, 0);
$selectedItem = mysqli_fetch_assoc($result);

$selectedItem['effectName'] = $effectName;

if ($selectedItem) {
    echo json_encode($selectedItem);
} else {
    echo "Error: " . mysqli_error($link);
}

mysqli_close($link);
?>
