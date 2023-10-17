<?php include 'user_info.php'; ?>

<?php

$query = "SELECT enemy FROM users WHERE id = $userId";
$result = mysqli_query($link, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $enemys = json_decode($row['enemy'], true);

    if ($enemys) {
        foreach ($enemys as $enemy) {
            $enemyId = $enemy[0];
            $enemyLevel = $enemy[1];

            $enemyquery = "SELECT armor, damage, name FROM enemy WHERE id='$enemyId'";
            $enemyresult = mysqli_query($link, $enemyquery);
            $enemyrow = mysqli_fetch_assoc($enemyresult);
            if ($enemyLevel != 1) {
                $enemyarmor = round($enemyrow['armor'] * $enemyLevel / 1.5);
                $enemydamage = round($enemyrow['damage'] * $enemyLevel / 1.5);
            } else {
                $enemyarmor = round($enemyrow['armor']);
                $enemydamage = round($enemyrow['damage']);
            }
            
            $enemyname = $enemyrow['name'];

            $htmlOutput .= '<h3 class="name">' . $enemyname . '</h3>';
            $htmlOutput .= '<div class="stats">';
            $htmlOutput .= '<div class="stats__name">Level</div>';
            $htmlOutput .= '<div class="stats__value">' . $enemyLevel . '</div>';
            $htmlOutput .= '</div>';
            $htmlOutput .= '<div class="stats">';
            $htmlOutput .= '<div class="stats__name">Damage</div>';
            $htmlOutput .= '<div class="stats__value">' . $enemydamage . '</div>';
            $htmlOutput .= '</div>';
            $htmlOutput .= '<div class="stats">';
            $htmlOutput .= '<div class="stats__name">Armor</div>';
            $htmlOutput .= '<div class="stats__value">' . $enemyarmor . '</div>';
            $htmlOutput .= '</div>';
            
        }
    }

    echo $htmlOutput;
} else {
    echo "Error: " . mysqli_error($link);
}

mysqli_close($link);
?>

