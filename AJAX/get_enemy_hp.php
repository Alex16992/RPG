<?php include 'user_info.php'; ?>

<?php
if ($row) {
    echo json_encode($row);
} else {
    echo "Error: " . mysqli_error($link);
}

mysqli_close($link);
?>