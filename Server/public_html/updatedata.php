<?php

$data = $_POST['data'];
$pass = $_POST['password'];
$id = $_POST['id'];

require_once "db-controller.php";
echo update_data_controller($id, $pass, $data);

?>