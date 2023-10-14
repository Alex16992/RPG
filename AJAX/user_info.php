<?php
session_start();

// Check if the user is logged in (user ID is stored in the session)
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit();
}

// Establish a database connection
$link = mysqli_connect("localhost", "root", "", "rpg");
if ($link === false) {
    die("Failed to connect to the database: " . mysqli_connect_error());
}

// Fetch user data using the stored user ID
$userId = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id='$userId'";
$result = mysqli_query($link, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $items = $row['items'];
    $login = $row['login'];
    $lvl = $row['lvl'];
    $email = $row['email'];
    $health = $row['health'];
    $max_health = $row['max_health'];
    $combat = $row['combat'];
    $damage = $row['damage'];
    $armor = $row['armor'];
    $potion = $row['potion'];
    $turn = $row['turn'];
}

?>