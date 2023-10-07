<?php

$postData = file_get_contents('php://input');
$Post = json_decode($postData, true);

$data = $Post['data'];
$pass = $Post['password'];
$id = $Post['id'];

require_once "db-controller.php";
echo update_data_controller($id, $pass, $data);

?>