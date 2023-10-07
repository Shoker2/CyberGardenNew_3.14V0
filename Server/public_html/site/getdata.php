<!DOCTYPE html>

<html lang="en">

<link rel="stylesheet" href="./main.css">

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Oswald:wght@200&display=swap" rel="stylesheet">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3.14VO weather</title>
</head>
<body>
    <!-- <div class="main_section_in_header">
        <div class="logo_section">
            <a href="."><p class="logo">Для чего этот сайт</p></a>
            <a href="."><p class="logo">Комплектация</p></a>
            <a href="."><p class="logo">О нас</p></a>
        </div>
    </div> -->

    <div class="main_table">

        <?php

        $id = $_COOKIE['id'];
        $pass = $_COOKIE['password'];
        // $id = "5";
        // $pass = "sxfcgj";

        require_once "../db-controller.php";
        $row = read_controller($id, $pass);

        $data = json_decode($row['Data'], true);

        echo '
        <div class="data_base_1"> 
            <p class="logo_data_base_item"><h1>Устройство ' . $id . '</h1></p>
            <p class="data_base_item">Температура: '. $data["temper"] . '</p>
            <p class="data_base_item">Влажность: '. $data['humidity'] . ' </p>
            <div class="reboot_data"><a href="./getdata.php">Обновить информацию</a></div>
            <div class="reboot_data"><a href="./autoriz.php">Сменить устройств</a></div>
        </div>
        ';

        ?>

    </div>
</body>
</html>