<?php
require_once "./init.php";
$users = new User($db);

// Get data
$username = $_POST["username"] ?? null;
$mail = $_POST["mail"] ?? null;
$password = $_POST["password"] ?? null;

if (is_null($username))    { echo json_encode(["status" => false, "err" => "Empty username."]); return; }
if (is_null($mail))       { echo json_encode(["status" => false, "err" => "Empty email.", "e" => $mail]); return; }
if (is_null($password))    { echo json_encode(["status" => false, "err" => "Empty password."]); return; }

############################
# Check username
############################

if (!$users->checkUsername($username)) {
    echo json_encode(["status" => false, "err" => "Not valid username."]);
    return;
}

############################
# Check email
############################

if (!$users->checkEmail($mail)) {
    echo json_encode(["status" => false, "err" => "Not valid email."]);
    return;
}

############################
# Hash password
############################

$password_hashed = $users->hashPassword($password, $config["security"]["pepper"]);

############################
# Add user
############################

if ($users->add($username, $mail, $password)) {
    echo json_encode(["status" => true]);
} else {
    echo json_encode(["status" => false, "err" => "Unknown error on register."]);
}