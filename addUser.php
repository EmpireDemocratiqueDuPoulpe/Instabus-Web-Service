<?php
require_once "./init.php";
$users = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data
    $username = $_POST["username"] ?? null;
    $email = $_POST["email"] ?? null;
    $password = $_POST["password"] ?? null;

    if (is_null($username))    { echo json_encode(false); }
    if (is_null($email))       { echo json_encode(false); }
    if (is_null($password))    { echo json_encode(false); }

    ############################
    # Check username
    ############################

    if (!$users->checkUsername($username)) {
        echo json_encode(false);
        return;
    }

    ############################
    # Check email
    ############################

    if (!$users->checkEmail($email)) {
        echo json_encode(false);
        return;
    }

    ############################
    # Check email
    ############################

    $password_hashed = $users->hashPassword($password, $config["security"]["pepper"]);

    ############################
    # Add user
    ############################

    if ($users->add($username, $email, $password)) {
        echo json_encode(true);
    } else {
        echo json_encode(true);
    }
}
