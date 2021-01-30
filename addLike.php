<?php
require_once "./init.php";
$likes = new Likes($db);
$response = ["add" => false];

// Get data
$post_id = $_POST["post_id"] ?? null;
$user_id = $_POST["user_id"] ?? null;

if (is_null($post_id))    { echo json_encode($response); return; }
if (is_null($user_id))    { echo json_encode($response); return; }

// Add the like
$response["add"] = $likes->addOrDelete($post_id, $user_id);
$response["count"] = $likes->getCount($post_id);

echo json_encode($response);
