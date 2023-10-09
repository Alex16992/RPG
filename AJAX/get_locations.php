<? include 'user_info.php'; ?>

<?php
$query = "SELECT id, image, name FROM location";
$result = mysqli_query($link, $query);

$images = array();

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $htmlOutput .= '<img src="assets/Image/Interface/'.$row['image'].'"class="locations__list-image" onclick="showLocationDetail('.$row['id'].')" alt="'.$row['name'].'">';
    }
} 
else {
    echo "Error: " . mysqli_error($link);
}

echo $htmlOutput;
mysqli_close($link);
?>
