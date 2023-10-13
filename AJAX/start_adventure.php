<?php include 'user_info.php'; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$locationId = $_POST['locationId'];
	$locationquery = "SELECT id FROM location WHERE id = $locationId";
    $locationresult = mysqli_query($link, $locationquery);
    if ($locationresult->num_rows > 0) {
    	$enemyData = [];
		$enemyquery = "SELECT id FROM enemy ORDER BY RAND() LIMIT 1";
        $enemyresult = mysqli_query($link, $enemyquery);
        if ($enemyresult) {
        	$enemylvl = rand($row['lvl']-2, $row['lvl']+2);
        	if ($enemylvl <= 0) {
                $enemylvl = 1;
            }
            $enemyrow = mysqli_fetch_assoc($enemyresult);
            $enemyData[] = [$enemyrow[id], $enemylvl];
            $updatedEnemyData = json_encode($enemyData);
            $query = "UPDATE users SET combat = 1, location = '$locationId', enemy = '$updatedEnemyData' WHERE id = $userId";
            $result = mysqli_query($link, $query);
        } else {
            echo "Error: " . mysqli_error($link);
        }
    }
}

mysqli_close($link);
?>