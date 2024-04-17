<?
// получаем id из url, который мы записали в <a> на странице каталога в href
$id = $_GET['id'];
// получаем один товар
$product = $database->query("SELECT * FROM `products` WHERE `id` = $id")->fetch();


// получаем номер категории из товара
$cat_id = $product['category_id'];
// получаем категория
$cat = $database->query("SELECT * FROM `categories` WHERE `id` = $cat_id")->fetch();





?>

<div class="container">
    <div class="single-product">
        <img src="assets/public/<?= $product['img_path'] ?>" alt="">
        <h1><?= $product['name'] ?></h1>
        <p>Цена: <?= $product['price'] ?> ₽</p>
        <p>Категория: <?= $cat['name'] ?></p>
        <p style="margin-bottom: 10px"><?= $product['about'] ?></p>

        <!-- кнопка для добавления в корзину  страницы - баскет, доп. гет параметр - add_id-->
        <a class="btn-primary" href="?page=basket&add_id=<?= $product['id'] ?>">Добавить в корзину</a>
    </div>
</div>