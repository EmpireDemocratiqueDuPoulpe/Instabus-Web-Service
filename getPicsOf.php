<?php
require_once "./init.php";
$posts = new Post($db);

$user_id = $_GET["user_id"] ?? null;

if (!is_null($user_id)) {
    echo json_encode($posts->getAll($user_id));
} else {
    echo json_encode(["error" => "missing user_id"]);
}
