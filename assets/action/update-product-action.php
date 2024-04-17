<?

// запуск сессий
session_start();
// подключаем бд
include ('../database/database.php');
// чистим сесию
unset($_SESSION['message']);
// подключаем функции
include ('../function/function.php');


var_dump($_FILES);


// номер товара который мы получаем из инпута
$id = $_POST['id'];




///// ОШИБКА 1 /////
////валидация на пусыте поля
// цикл. перебираем все наши $_POST и записываем их в $el ($el - каждый отдьельный элемент), $value ($value - его значение кажого $el)
foreach ($_POST as $el => $value) {
    // если значение $value пустое то выводим сообщение об ошибке и перенаправляем на страницу регистрации
    if ($value == '') {
        $_SESSION['message'] = 'Запоните все поля';
        header("Location: /?page=update-products&id=$id");
        die();
    }
}
//////////////////////////////////






///// ОШИБКА 2 /////
// проверка на наличие картинки
// image - это имя нашего инпута с картинкой
// size - это размер картинки в байтах

//если пользователь выбрал картинку то размер будет больше 0
if ($_FILES['image']['size'] <= 0) {

    // выбираем старую картинку
    $img = $_POST['old_image'];
} else {
    // пишем image потому что name="image"
    $img = zagruziteFile($_FILES['image']);
}
//////////////////////////////////








// получаем все пост запросы в переменные
$title = $_POST['title'];
$about = $_POST['about'];
$price = $_POST['price'];
$cat_id = $_POST['category_id'];






// редактируем товар в бд
$database->query("UPDATE `products` SET `name`='$title',`about`='$about',`price`='$price',`img_path`='$img',`category_id`='$cat_id' WHERE `id` = $id");
$_SESSION['message'] = 'Товар отредактирован';
header('Location: /?page=admin');
?>