<?php

session_start();
require_once 'connect.php';

$login = mysqli_real_escape_string($connect, $_POST['login']);
$password = mysqli_real_escape_string($connect, $_POST['password']);

$error_fields = [];

if ($login === '') {
    $error_fields[] = 'login';
}

if ($password === '') {
    $error_fields[] = 'password';
}

if (!empty($error_fields)) {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Проверьте правильность полей",
        "fields" => $error_fields
    ];

    echo json_encode($response);

    die();
}



$check_user = mysqli_query($connect, "SELECT * FROM `users_info` WHERE `login` = '$login' AND `password` = '$password'");

if (mysqli_num_rows($check_user) > 0) {
    $user = mysqli_fetch_assoc($check_user);

    $_SESSION['user'] = [
        "id_user" => $user['id_user'],
        "full_name" => $user['full_name'],
        "email" => $user['email']
    ];

    $response = [
        "status" => true
    ];

    echo json_encode($response);
} else {

    $response = [
        "status" => false,
        "message" => 'Не верный логин или пароль '
    ];

    echo json_encode($response);
}
