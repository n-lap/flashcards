<?php
session_start();
require_once 'connect.php';
if (!$_SESSION['user']) {
    header('Location: /');
}


$question = mysqli_real_escape_string($connect, $_POST['question']);
$answer = mysqli_real_escape_string($connect, $_POST['answer']);

$response = [
    "status" => true,
    "message" => "Регистрация прошла успешно!"
];

$id_user = $_SESSION['user']['id_user'];
settype($id_user, 'integer');

mysqli_query($connect, "DELETE FROM `users_flashcard` WHERE `users_flashcard`.`question` = '$question' AND `users_flashcard`.`answer` ='$answer' AND `users_flashcard`.`id_user` ='$id_user'");

echo json_encode($response);
