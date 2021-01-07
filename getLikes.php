<?php
require_once "./init.php";
$likes = new Likes($db);

if (isset($_GET["post_id"])) {
    $post_id = $_GET["post_id"];

    if (!is_null($post_id)) {
        echo json_encode($likes->getByPostId($post_id));
    }
} else if (isset($_GET["user_id"])) {
    $user_id = $_GET["user_id"];

    if (!is_null($user_id)) {
        echo json_encode($likes->getByUserId($user_id));
    }
}