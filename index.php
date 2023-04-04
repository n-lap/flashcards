<?php
session_start();

if ($_SESSION['user']) {
    header('Location: /cards.html');
}

?>

<!doctype html>
<html lang="en">

<head>
    <link rel="icon" href="data:;base64,=">
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="assets1/css/style.css">
</head>

<body>

    <form>
        <label>Логин <span class="red-star">*</span></label>
        <input type="text" name="login" placeholder="Введите свой логин">
        <label>Пароль <span class="red-star">*</span></label>
        <input type="password" name="password" placeholder="Введите пароль">
        <button type="submit" class="login-btn">Войти</button>
        <p>
            У вас нет аккаунта? - <a href="/register.php">зарегистрируйтесь</a>!
        </p>
        <p class="msg none">Lorem ipsum dolor sit amet.</p>
    </form>

    <script src="assets1/js/jquery-3.6.4.min.js"></script>
    <script src="assets1/js/main.js"></script>

</body>

</html>
