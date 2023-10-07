<?php

$id = $_POST['id'];
$pass = $_POST['password'];

require_once "db-controller.php";
$row = read_controller($id, $pass);

echo "{\"Data\":" . $row['Data'] . "}";

?>