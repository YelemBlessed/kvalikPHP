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
        header("Location: /?page=signup");
        die();
    }
}
//////////////////////////////////








///// ОШИБКА 2 /////
//// валидация на checkbox
if (!isset($_POST['check'])) {
    $_SESSION['message'] = 'Необходимо согласие с политикой';
    header("Location: /?page=signup");
    die();
}
//////////////////////////////////





// записывем наши post запросы в переменные (для дальнейшего использования)
$fio = $_POST['fio'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$re_password = $_POST['re_password'];







///// ОШИБКА 3 /////
//// проверка длины пароля
// strlen - функция которая проверят длину в количестве символов
if (strlen($password) < 8) {
    $_SESSION['message'] = 'Пароль долежен содержать не менее 8 символов';
    header("Location: /?page=signup");
    die();
}
//////////////////////////////////







///// ОШИБКА 4 /////
////проверка на совпадение пароля
if ($password != $re_password) {
    $_SESSION['message'] = 'Пароли не совпадают';
    header("Location: /?page=signup");
    die();
}
//////////////////////////////////







///// ОШИБКА 5 /////
//// проверка на телефон
// прверка формата телефон
// /^ - это начало строки
// \+ - это буквально знак плюса
// \d{1,3} - это от 1 до 3 цифр (первые цифры кода страны)
// \d{9} - это 9 цифр (остальные цифры номера телефона)
// $ - это конец строки
//        /^    \+    \d{1,3}    \d{9}      $/
if (preg_match("/^\+\d{1,3}\d{9}$/", $phone)) {
} else {
    $_SESSION['message'] = 'Неверный формат номера';
    header("Location: /?page=signup");
    die();
}
//////////////////////////////////





///// ОШИБКА 6 /////
// проверка на наличие пользователя в базе

// пытаемся получить пользователя с таким же телефоном
$phoneExist = $database->query("SELECT * FROM `users` WHERE `phone` = '$phone'")->fetch();

// если переменная не пустая, то есть пользователь с таким номером найден
if (!empty($phoneExist)) {
    $_SESSION['message'] = 'Пользователь с этим номером уже зарегестрирован';
    header("Location: /?page=signup");
    die();
}
//////////////////////////////////








// ЕСЛИ ВСЕ ПРОВЕРКИ ПРОЙДЕНЫ УСПЕШНО
// хэшим пароль
$hash_password = md5($password);

// добавляем пользователя
$database->query("INSERT INTO `users`(`fio`, `phone`, `password`) VALUES ('$fio','$phone','$hash_password')");

// записываем id пользователя
$_SESSION['AUTH_ID'] = $database->lastInsertId();
// перенаправляем на главную с увеомлением
$_SESSION['message'] = 'Пользователь создан';
header("Location: /");
die();

//////////////////////////////////








?>