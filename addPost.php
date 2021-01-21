<?php
require_once "./init.php";
$posts = new Post($db);

$upload_path = "http://".SERVER_IP.":8080/".$config["upload"]["path"];
$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data
    $user_id = $_POST["user_id"] ?? null;
    $station_id = $_POST["station_id"] ?? null;
    $title = $_POST["title"] ?? null;
    $img_file = $_FILES["image"]["name"] ?? null;

    if (is_null($user_id))      { return; }
    if (is_null($station_id))   { return; }
    if (is_null($title))        { return; }
    if (is_null($img_file))     { return; }

    $file_info = pathinfo($_FILES["image"]["name"]);
    $file_ext = $file_info["extension"];
    $img_name = $posts->getFileName();
    $img_uri = $upload_path . $img_name . "." . $file_ext;
    $img_path = $config["upload"]["path"] . $img_name . "." . $file_ext;

    // Save the file
    try {
        $response["status"] = move_uploaded_file($_FILES["image"]["tmp_name"], $img_path);

        if ($_FILES['image']['error']) {
            switch ($_FILES['image']['error']) {
                case 1: // UPLOAD_ERR_INI_SIZE
                    $response["err"] = "Le fichier dépasse la taille autorisée par le serveur";
                    break;

                case 2: // UPLOAD_ERR_FORM_SIZE
                    $response["err"] = "Le fichier dépasse la limite autorisée dans le formulaire HTML";
                    break;

                case 3: // UPLOAD_ERR_PARTIAL
                    $response["err"] = "L'envoi du fichier à été intérrompu pendant le transfert";
                    break;
                case 4: // UPLOAD_ERR_NO_FILE
                    $response["err"] = "Le fichier que vous avez uploadé a une taille nulle";
                    break;
            }
        }

        $posts->add($user_id, $station_id, $title, $img_uri);
        $response["error"] = false;
        $response["uri"] = $img_uri;
        $response["message"] = $img_path;
        $response["message2"] = $_FILES["image"]["tmp_name"];
    } catch (Exception $err) {
        $response["error"] = true;
        $response["message"] = $err->getMessage();
    } finally {
        echo json_encode($response);
    }
}