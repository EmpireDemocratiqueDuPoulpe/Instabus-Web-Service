<?php
require_once "./init.php";
$users = new User($db);
$tokens = new Token($db);

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
# Get a token
############################

$newToken = $tokens->create($user["user_id"]);
$selector = $newToken["selector"];
$authToken = $newToken["authenticator"];

############################
# Login user
############################

echo json_encode(["status" => true, "selector" => "$selector", "authenticator" => "$authToken", "user_id" => $user["user_id"], "username" => $user["username"]]);
