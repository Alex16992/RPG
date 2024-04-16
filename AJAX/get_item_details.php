<?php include 'user_info.php'; ?>

<?php

$itemId = $_GET['itemId'];
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