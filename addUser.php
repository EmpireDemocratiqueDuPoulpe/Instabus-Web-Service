<?php
require_once "./init.php";
$users = new User($db);

// Get data
$username = $_POST["username"] ?? null;
$email = $_POST["email"] ?? null;
$password = $_POST["password"] ?? null;

if (is_null($username))    { echo json_encode(["status" => false, "err" => "Empty username."]); }
if (is_null($email))       { echo json_encode(["status" => false, "err" => "Empty email."]); }
if (is_null($password))    { echo json_encode(["status" => false, "err" => "Empty password."]); }

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

if (!$users->checkEmail($email)) {
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

if ($users->add($username, $email, $password)) {
    echo json_encode(["status" => true]);
} else {
    echo json_encode(["status" => false, "err" => "Unknown error on register."]);
}