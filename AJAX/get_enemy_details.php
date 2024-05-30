<?php include 'user_info.php'; ?>

<?php
if ($result) {
    $enemys = json_decode($row['enemy'], true);

    if ($enemys) {
        foreach ($enemys as $enemy) {
            $enemyId = $enemy[0];
            $enemyLevel = $enemy[1];

            $enemyquery = "SELECT armor, damage, crit, name FROM enemy WHERE id='$enemyId'";
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
            $enemycrit = $enemyrow['crit'];

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
            $htmlOutput .= '<div class="stats">';
            $htmlOutput .= '<div class="stats__name">Crit</div>';
            $htmlOutput .= '<div class="stats__value">' . $enemycrit . '%</div>';
            $htmlOutput .= '</div>';
            $htmlOutput .= '<br>';
            // Check passive effects
            $enemyEffects = json_decode($enemy_effect_list, true);
            if ($enemyEffects !== null && is_array($enemyEffects)) {
                $htmlOutput .= '<p>Passive effects:</p>';
                foreach ($enemyEffects as $effect) {
                    $effectId = $effect[0];
                    $effectDuration = $effect[1];

                    $effectQuery = "SELECT name FROM effect WHERE id='$effectId'";
                    $effectResult = mysqli_query($link, $effectQuery);
                    $effectRow = mysqli_fetch_assoc($effectResult);

                    if ($effectRow) {
                        $effectName = $effectRow['name'];
                        $htmlOutput .= '<div class="stats">';
                        $htmlOutput .= '<div class="stats__name">' . $effectName . '</div>';
                        $htmlOutput .= '<div class="stats__value">' . $effectDuration . ' turns</div>';
                        $htmlOutput .= '</div>';
                    }
                }
            } else {
                $htmlOutput .= '<p>No passive effects</p>';
            }
        }
    }

    echo $htmlOutput;
} else {
    echo "Error: " . mysqli_error($link);
}

mysqli_close($link);
?>

