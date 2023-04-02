<?php
session_start();
require_once 'connect.php';
if (!$_SESSION['user']) {
    header('Location: /');
}

$id_user = $_SESSION['user']['id_user'];
settype($id_user, 'integer');
$check_card = mysqli_query($connect, "SELECT `question`, `answer` FROM `users_flashcard` WHERE `id_user` = '$id_user'");
$cards = mysqli_fetch_all($check_card);

$response = [
    "status" => true,
    "items" => $cards
];
echo json_encode($response);
