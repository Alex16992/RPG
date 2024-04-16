<?php include 'user_info.php'; ?>

<?php

$htmlOutput .= '<h2 class="title">Craft / Upgrade</h2>';
$htmlOutput .= '<div class="potion-border">';

        $htmlOutput .= '<div class="potion__craft">
                    <p class="potion__craft-text">
                        Craft 1 potion<br>You need 2 Herbs '. $row["potion_lvl"] .' lvl
                    </p>
                    <p class="potion__craft-button" onclick="craftPotion();">
                        Craft
                    </p>
                </div>
                <div class="potion__craft">
                    <p class="potion__craft-text">
                        Upgrade potions<br>
                        For '. 30 * $row["potion_lvl"] .'  coins<br>
                        You lose all potions
                    </p>
                    <p class="potion__craft-button" onclick="upgradePotion();">
                        Upgrade
                    </p>
                </div>
                <div class="potion__craft">
                    <p class="potion__craft-text">
                        You have '. $row["potion"] .' potion<br>
                        Lvl - '. $row["potion_lvl"] .'<br>
                        Price - '. $row["potion_lvl"] * 10 .' coins
                    </p>
                    <p class="potion__craft-button" onclick="sellPotion();">
                        Sell 1 potion
                    </p>
                </div>';

$htmlOutput .= '</div>';

echo $htmlOutput;

mysqli_close($link);
?>