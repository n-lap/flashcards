<?php
session_start();
require_once 'connect.php';
if (!$_SESSION['user']) {
    header('Location: /');
}



$question = $_POST['question'];
$answer = $_POST['answer'];

$error_fields = [];

if ($question === '') {
    $error_fields[] = 'question';
}

if ($answer === '') {
    $error_fields[] = 'answer';
}

if (!empty($error_fields)) {
    $response = [
        "status" => false,
    ];

    echo json_encode($response);

    die();
}

$id_user = $_SESSION['user']['id_user'];
settype($id_user, 'integer');
$check_card = mysqli_query($connect, "SELECT * FROM `users_flashcard` WHERE `question` = '$question' AND `answer` = '$answer' AND `id_user` = '$id_user'");


if (mysqli_num_rows($check_card) > 0) {

    $response = [
        "status" => false,
        "message" => "Такая карточка уже существует"
    ];

    echo json_encode($response);
} else {

    $response = [
        "status" => true
    ];
    mysqli_query($connect, "INSERT INTO `users_flashcard` (`id_card`, `id_user`, `question`, `answer`) VALUES (NULL, '$id_user', '$question', '$answer')");

    echo json_encode($response);
}
