<? include 'user_info.php'; ?>

<?php

$locationId = $_GET['locationId'];

$query = "SELECT name, description FROM location WHERE id = $locationId";
$result = mysqli_query($link, $query);

if ($result) {
    $selectedItem = mysqli_fetch_assoc($result);
    echo json_encode($selectedItem);
} else {
    echo "Error: " . mysqli_error($link);
}

mysqli_close($link);
?>