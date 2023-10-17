<?php include 'user_info.php'; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$locationId = $_POST['locationId'];
	$locationquery = "SELECT id, enemys FROM location WHERE id = $locationId";
    $locationresult = mysqli_query($link, $locationquery);
    if ($locationresult->num_rows > 0) {
        $locationrow = mysqli_fetch_assoc($locationresult);
        $enemyData = [];
        $arrayEnemy = json_decode($locationrow['enemys'], true);
        $randomEnemy = array_rand($arrayEnemy);
        $randomEnemyId = $arrayEnemy[$randomEnemy];
        if ($randomEnemyId) {
		$enemyquery = "SELECT id, max_health FROM enemy WHERE id = '$randomEnemyId'";
        $enemyresult = mysqli_query($link, $enemyquery);
            if ($enemyresult) {
            	$enemylvl = rand($lvl-1, $lvl+1);
            	if ($enemylvl <= 0) {
                    $enemylvl = 1;
                }
                $enemyrow = mysqli_fetch_assoc($enemyresult);
                $enemyData[] = [$randomEnemyId, $enemylvl];
                $updatedEnemyData = json_encode($enemyData);
                if ($enemylvl != 1) {
                    $enemyHP = round($enemyrow['max_health'] * ($enemylvl / 1.5) + 3);
                } else {
                    $enemyHP = $enemyrow['max_health'];
                }
                
                $query = "UPDATE users SET combat = 1, location = '$locationId', enemy = '$updatedEnemyData', enemy_hp = '$enemyHP', enemy_max_hp = '$enemyHP', turn = 1 WHERE id = $userId";
                $result = mysqli_query($link, $query);
                echo '<script>window.location.href = "../fight.php";</script>';
            } else {
                echo "Error: " . mysqli_error($link);
            }
        }
    }
}

mysqli_close($link);
?>