<?php
require_once "./init.php";
$likes = new Likes($db);

$user_id = $_POST["user_id"] ?? null;
$post_id = $_POST["post_id"] ?? null;

if (is_null($user_id)) { echo json_encode(["liked" => false]); return; }
if (is_null($post_id)) { echo json_encode(["liked" => false]); return; }

#####################
# Check like
#####################

$hasLiked = $likes->hasUserLikedPost($user_id, $post_id);

echo json_encode(["liked" => $hasLiked]);
