<?php
require_once "./init.php";
$posts = new Post($db);

$post_id = $_GET["post_id"] ?? null;
$user_id = $_GET["user_id"] ?? null;

if (!is_null($post_id) && !is_null($user_id)) {
    $posts->deleteById($post_id, $user_id);
    echo json_encode(true);
} else {
    echo json_encode(false);
}
