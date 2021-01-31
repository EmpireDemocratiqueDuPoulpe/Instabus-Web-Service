<?php
require_once "./init.php";
$users = new User($db);
$tokens = new Token($db);

// Get data
$selector = $_POST["selector"] ?? null;
$auth_token= $_POST["auth_token"] ?? null;

if (is_null($selector))    { echo json_encode(["status" => false, "err" => "Empty selector."]); return; }
if (is_null($auth_token))  { echo json_encode(["status" => false, "err" => "Empty token."]); return; }

############################
# Check the token
############################

// Get the token data
$tokenData = $tokens->getTokenBySelector($selector);

if (!$tokenData) {
    echo json_encode(["status" => false, "err" => "Token not found for this selector."]);
    return;
} else {
    $tokenData = $tokenData[0];
}

// Check if the auth token match
if (!$tokens->authTokenMatch($auth_token, $tokenData["token"])) {
    echo json_encode(["status" => false, "err" => "Auth token doesn't match."]);
    return;
}

// Check the expiration date
if (!$tokens->isNotExpired($tokenData["expires"])) {
    echo json_encode(["status" => false, "err" => "Token isn't valid anymore."]);
    return;
}

############################
# Get user data
############################

$user = $users->getById($tokenData["user_id"]);
$user = $user[0];

if (!$user) {
    echo json_encode(["status" => false, "err" => "User not found."]);
    return;
}

############################
# Get a new token
############################

$tokens->deleteBySelector($tokenData["selector"]);
$newToken = $tokens->create($tokenData["user_id"]);
$newSelector = $newToken["selector"];
$newAuthToken = $newToken["authenticator"];

############################
# Login user
############################

echo json_encode(["status" => true, "selector" => "$newSelector", "authenticator" => "$newAuthToken", "user_id" => $user["user_id"], "username" => $user["username"]]);
