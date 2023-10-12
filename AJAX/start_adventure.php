<?php include 'user_info.php'; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$locationId = $_POST['locationId'];
	$locationquery = "SELECT id FROM location WHERE id = $locationId";
    $locationresult = mysqli_query($link, $locationquery);
    if ($locationresult->num_rows > 0) {
    	$query = "UPDATE users SET combat = 1 WHERE id = $userId";
		$result = mysqli_query($link, $query);
    }
}

mysqli_close($link);
?>