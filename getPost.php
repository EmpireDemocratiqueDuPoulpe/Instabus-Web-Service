<?php
require_once "./init.php";
$posts = new Post($db);

if (isset($_GET["post_id"])) {
    $post_id = $_GET["post_id"];

    if (!is_null($post_id)) {
        echo json_encode($posts->getById($post_id));
    }
} else {
    echo json_encode($posts->getAll());
}