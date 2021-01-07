<?php
require_once "./init.php";
$users = new User($db);

if (isset($_GET["user_id"])) {
    $user_id = $_GET["user_id"];

    if (!is_null($user_id)) {
        echo json_encode($users->getById($user_id));
    }
} else {
    echo json_encode($users->getAll());
}