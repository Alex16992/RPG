<?php
$link = mysqli_connect("localhost", "root", "", "rpg");

if ($link === false) {
    die("Failed to connect to the database: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = mysqli_real_escape_string($link, $_POST['login']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $password = mysqli_real_escape_string($link, $_POST['password']);

    // Check for empty fields
    if (empty($login) || empty($email) || empty($password)) {
        echo "Please fill in all the fields.";
        mysqli_close($link);
        exit();
    }

    // Check login length
    if (strlen($login) < 4 || strlen($login) > 18) {
        echo "Login length should be between 4 and 18 characters.";
        mysqli_close($link);
        exit();
    }

    // Check email length
    if (strlen($email) > 50) {
        echo "Email length should not exceed 50 characters.";
        mysqli_close($link);
        exit();
    }

    // Check password length
    if (strlen($password) < 6 || strlen($password) > 50) {
        echo "Password length should be between 6 and 50 characters.";
        mysqli_close($link);
        exit();
    }

    // Rest of the validation logic

    if (!preg_match("/^[0-9a-zA-Z]+$/", $login)) {
        echo "Login can only contain alphanumeric characters.";
        mysqli_close($link);
        exit();
    }

    if (!preg_match("/^[0-9a-zA-Z!@#$%^&*()_+=\-[\]{};':\"\\|,.<>\/?]+$/", $password)) {
        echo "Password can only contain alphanumeric characters and symbols.";
        mysqli_close($link);
        exit();
    }

    $check_query = "SELECT * FROM users WHERE login='$login' OR email='$email'";
    $result = mysqli_query($link, $check_query);
    if (mysqli_num_rows($result) > 0) {
        echo "Login or email already exists in the database.";
        mysqli_close($link);
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        mysqli_close($link);
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (login, email, password) VALUES ('$login', '$email', '$hashed_password')";

    if (mysqli_query($link, $sql)) {
        echo "Registration successful.";
    } else {
        echo "Error during registration: " . mysqli_error($link);
    }
}

mysqli_close($link);
?>
