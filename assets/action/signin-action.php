<?php

// запуск сессий
session_start();
// подключаем бд
include ('../database/database.php');
// чистим сесию
unset($_SESSION['message']);







///// ОШИБКА 1 /////
////валидация на пусыте поля
// цикл. перебираем все наши $_POST и записываем их в $el ($el - каждый отдьельный элемент), $value ($value - его значение кажого $el)
foreach ($_POST as $el => $value) {
    // если значение $value пустое то выводим сообщение об ошибке и перенаправляем на страницу регистрации
    if ($value == '') {
        $_SESSION['message'] = 'Запоните все поля';
        header("Location: /?page=signin");
        die();
    }
}
//////////////////////////////////







// записывем наши post запросы в переменные (для дальнейшего использования)
$phone = $_POST['phone'];
$password = $_POST['password'];





///// ОШИБКА 2 /////
// Получем пользваотеля по телефону
$user = $database->query("SELECT * FROM `users` WHERE `phone` = '$phone'")->fetch();


// если пользователь существует то переменная не пустая
if (empty($user)) {
    $_SESSION['message'] = 'Пользователя с данным номером не существует';
    header("Location: /?page=signin");
    die();
}
//////////////////////////////////







///// ОШИБКА 3 /////
// проверка на совпадение пароля (то что ввёл пользвоатель и то что есть в БД)
$hash_password = md5($password);
if ($hash_password != $user['password']) {
    $_SESSION['message'] = 'Неверный пароль';
    header("Location: /?page=signin");
    die();
}
//////////////////////////////////







// АВТОРИЗИРУЕМ ПОЛЬЗОВАТЕЛЯ

// в сеесию с пользователем записываем id пользователя из бд
$_SESSION['AUTH_ID'] = $user['id'];

// перенаправляем пользователя с БД
$_SESSION['message'] = 'Вы успешно авторизировались';
header("Location: /");
die();





?>