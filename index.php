<?
// запускаем сессии
// Например: что бы в хедере у нас работал $_SESSION['AUTH_ID'] а в message.php работал вывод уведомлений
session_start();
include ('assets/database/database.php');
?>





<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- стили и скрипты -->
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/main.js" defer></script>
    <title>Квалик</title>
</head>

<body>
    <!-- подключаем уведомления -->
    <? include ('assets/inc/message.php') ?>

    <!-- подключаем шапку -->
    <? include ('assets/inc/header.php') ?>

    <?

    // если у нас есть запрос ?page=
    // его не будет например если пользователь только зашел на сайт
    if (isset($_GET['page'])) {

        // перебераем чему равен page то и выводим
        switch ($_GET['page']) {
            case 'main':
                include ('assets/pages/main.php');
                break;
            case 'catalog';
                include ('assets/pages/catalog.php');
                break;
            case 'signin';
                include ('assets/pages/signin.php');
                break;
            case 'signup';
                include ('assets/pages/signup.php');
                break;
            case 'about';
                include ('assets/pages/about.php');
                break;
            case 'product';
                include ('assets/pages/product.php');
                break;
            case 'basket';
                include ('assets/pages/basket.php');
                break;
            // страницы админки
            case 'admin';
                include ('assets/pages/admin.php');
                break;
            case 'add-products';
                include ('assets/pages/add-products.php');
                break;
            case 'update-products';
                include ('assets/pages/update-products.php');
                break;
            // дефолтное значение если у нас нет такого запроса (?page=такого_запроса)
            default:
                include ('assets/pages/404.php');
        }

        // если у нас нет запроса page (например только зашли на сайт)
    } else {
        // подключаем главную страницу
        include ('assets/pages/main.php');
    }




    ?>

    <!-- подключаем футер -->
    <? include ('assets/inc/footer.php') ?>
</body>

</html>