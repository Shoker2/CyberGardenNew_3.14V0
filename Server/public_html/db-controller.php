<?php

function db_connect()
{
    $servername = "localhost";
    $username = "zaskamilma";
    $password = "L36KF_TFBQYWSLk1";
    $database_name = "zaskamilma";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database_name);

    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    // mysqli_set_charset($conn, "utf8");

    return $conn;
}

function test($new_password)
{
    $conn = db_connect();

    $sql = "UPDATE `sesorControlers` SET `Password` = '" . $new_password . "' WHERE `sesorControlers`.`id` = 7";

    if ($conn->query(($sql)) == TRUE) {
        echo "OK";
    } else {
        echo $conn->error;
    }

    $conn->close();
}

function add_controller($password)
{
    $conn = db_connect();
    $sql = "INSERT INTO `sesorControlers` (`id`, `Password`, `Data`) VALUES (NULL, '" . $password . "', '{\"temper\": 10.47, \"humidity\": 10.71}');";
   
    if ($conn->query(($sql)) == TRUE) {
        echo "OK";
    } else {    
        echo $conn->error;
    }

    $conn->close();
}

function update_data_controller($sesor_control_id, $password, $json)
{
    $row = read_controller($sesor_control_id, $password);

    $conn = db_connect();
    $sql = "UPDATE `sesorControlers` SET Data = '" . $json . "' WHERE id=".$sesor_control_id;

    if ($conn->query(($sql)) == TRUE) {
        echo "OK";
    } else {
        echo $conn->error;
    }

    $conn->close();
}

function update_password_controller($sesor_control_id, $password, $new_password)
{
    $row = read_controller($sesor_control_id, $password);

    $conn = db_connect();

    $sql = "UPDATE `sesorControlers` SET `Password` = '" . $new_password . "' WHERE `sesorControlers`.`id` = ". $sesor_control_id;

    if ($conn->query(($sql)) == TRUE) {
        echo "OK";
    } else {
        echo $conn->error;
    }

    $conn->close();
}

function read_controller($sesor_control_id, $password)
{
    $conn = db_connect();
    
    $sql = "SELECT * FROM sesorControlers WHERE id=".$sesor_control_id;

    $result = $conn->query($sql);
    
    $row = $result->fetch_assoc();

    $conn->close();

    if ($row["Password"] == $password) {
        return $row;
    } else {
        die("Incorrect password or id");
    }
}

?>