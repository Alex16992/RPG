<?php include 'user_info.php'; ?>

<?php
$htmlOutput .= 'Heal (You have '. $row["potion"] .')';
echo $htmlOutput;
mysqli_close($link);
?>