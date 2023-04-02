<?php
session_start();
if ($_SESSION['user']) {
    header('Location: profile.php');
}
?>

<!doctype html>
<html lang="en">

<head>
    <link rel="icon" href="data:;base64,=">
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="assets1/css/style.css">
</head>

<body>

    <form>
        <label>ФИО<span class="red-star">*</span></label>
        <input type="text" name="full_name" placeholder="Введите свое полное имя">
        <label>Логин<span class="red-star">*</span></label>
        <input type="text" name="login" placeholder="Введите свой логин">
        <label>Почта<span class="red-star">*</span></label>
        <input type="email" name="email" placeholder="Введите адрес своей почты">
        <label>Пароль<span class="red-star">*</span></label>
        <input type="password" name="password" placeholder="Введите пароль">
        <label>Подтверждение пароля<span class="red-star">*</span></label>
        <input type="password" name="password_confirm" placeholder="Подтвердите пароль">
        <button type="submit" class="register-btn">Зарегистрироваться</button>
        <p>
            У вас уже есть аккаунт? - <a href="/">авторизируйтесь</a>!
        </p>
        <p class="msg none">Lorem ipsum.</p>
    </form>
    <script src="assets1/js/jquery-3.6.4.min.js"></script>
    <script src="assets1/js/main.js"></script>
</body>

</html>