<?php

$new_pass = $_POST['new_password'];
$pass = $_POST['password'];
$id = $_POST['id'];

require_once "db-controller.php";
echo update_password_controller($id, $pass, $new_pass);

?>