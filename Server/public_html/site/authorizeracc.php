<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $password = $_POST["password"];
        
    require_once "../db-controller.php";
    $row = read_controller($id, $password);

    if ($row != "Incorrect password or id") {
        setcookie("id", $id);
        setcookie("password", $password);

        header("Location: getdata.php");
        exit;
    }
}
?>