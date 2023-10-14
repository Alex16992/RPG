<?php include 'user_info.php'; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$locationId = $_POST['locationId'];
	$locationquery = "SELECT id FROM location WHERE id = $locationId";
    $locationresult = mysqli_query($link, $locationquery);
    if ($locationresult->num_rows > 0) {
    	$enemyData = [];
		$enemyquery = "SELECT id, max_health FROM enemy ORDER BY RAND() LIMIT 1";
        $enemyresult = mysqli_query($link, $enemyquery);
        if ($enemyresult) {
        	$enemylvl = rand($row['lvl']-2, $row['lvl']+2);
        	if ($enemylvl <= 0) {
                $enemylvl = 1;
            }
            $enemyrow = mysqli_fetch_assoc($enemyresult);
            $enemyData[] = [$enemyrow['id'], $enemylvl];
            $updatedEnemyData = json_encode($enemyData);
            if ($enemylvl != 1) {
                $enemyHP = round($enemyrow['max_health'] * ($enemylvl / 2) + 1.5);
            } else {
                $enemyHP = $enemyrow['max_health'];
            }
            
            $query = "UPDATE users SET combat = 1, location = '$locationId', enemy = '$updatedEnemyData', enemy_hp = '$enemyHP', enemy_max_hp = '$enemyHP' WHERE id = $userId";
            $result = mysqli_query($link, $query);
        } else {
            echo "Error: " . mysqli_error($link);
        }
    }
}

mysqli_close($link);
header("Location: fight.php");
exit();
?>