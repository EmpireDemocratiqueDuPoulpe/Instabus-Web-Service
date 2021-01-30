<?php
require_once "./init.php";
$users = new User($db);

// Get data
$username = $_POST["username"] ?? null;
$password = $_POST["password"] ?? null;

if (is_null($username))    { echo json_encode(["status" => false, "err" => "Empty username."]); return; }
if (is_null($password))    { echo json_encode(["status" => false, "err" => "Empty password."]); return; }

############################
# Check username
############################

$user = $users->getByUsername($username);
$user = $user[0];

if (!$user) {
    echo json_encode(["status" => false, "err" => "User not found."]);
    return;
}

############################
# Check password
############################

if (!$users->checkPassword($password, $user["password"], $config["security"]["pepper"])) {
    echo json_encode(["status" => false, "err" => "Wrong password."]);
    return;
}

############################
# Login user
############################

echo json_encode(["status" => true]);
