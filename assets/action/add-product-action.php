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



///// ОШИБКА 1 /////
////валидация на пусыте поля
// цикл. перебираем все наши $_POST и записываем их в $el ($el - каждый отдьельный элемент), $value ($value - его значение кажого $el)
foreach ($_POST as $el => $value) {
    // если значение $value пустое то выводим сообщение об ошибке и перенаправляем на страницу регистрации
    if ($value == '') {
        $_SESSION['message'] = 'Запоните все поля';
        header("Location: /?page=add-products");
        die();
    }
}
//////////////////////////////////






///// ОШИБКА 2 /////
// проверка на наличие картинки
// image - это имя нашего инпута с картинкой
// size - это размер картинки в байтах
if ($_FILES['image']['size'] <= 0) {
    $_SESSION['message'] = 'Картинка должна быть загружена';
    header("Location: /?page=add-products");
    die();
}
//////////////////////////////////








// получаем все пост запросы в переменные
$title = $_POST['title'];
$about = $_POST['about'];
$price = $_POST['price'];
$cat_id = $_POST['category_id'];

// пишем image потому что name="image"
$img = zagruziteFile($_FILES['image']);




// добовляем в бд
$database->query("INSERT INTO `products`(`name`, `about`, `price`, `img_path`, `category_id`) VALUES ('$title','$about','$price','$img','$cat_id ')");
$_SESSION['message'] = 'Товар добавлен';
header('Location: /?page=admin');
?>