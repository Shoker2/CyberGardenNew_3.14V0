<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="./autoriz.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Oswald:wght@200&display=swap"
    rel="stylesheet">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3.14V0 Авторизация</title>
</head>

<body>
    <div class="main_section_in_autoriz">
        <p class="hello_world">
        <h1>Welcome</h1>
        </p>

        <form id="myForm">

            <div class="input_type_login">
                <input type="text" id="id" name="id" placeholder="Введите логин" class="text_input" id="username"><br>
            </div>
            <div class="input_type_password">
                <input type="password" id="password" name="password" placeholder="Введите пароль" class="password_input" id="password"><br>
            </div>
            <div class="advice_item">
                <input class="agree" type="submit" value="Подтвердить"><br>
            </div>
    
        </form>
        <div id="response"></div>

    </div>


<script>
        document.getElementById("myForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Предотвращаем обычное поведение формы

            // Получаем значения id и password из формы
            var id = document.getElementById("id").value;
            var password = document.getElementById("password").value;

            // Отправляем POST-запрос на сервер
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "authorizeracc.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Выводим ответ от сервера
                    document.getElementById("response").innerHTML = xhr.responseText;
                }
            };
            xhr.send("id=" + id + "&password=" + password);
        });
    </script>

</body>

</html>