<?

// получение всех категорий
$cats = $database->query('SELECT * FROM `categories`')->fetchAll(2);

// получение всех товаров
$products = $database->query('SELECT * FROM `products`')->fetchAll(2);


// если есть $_GET запрос cat_id
if (isset($_GET['cat_id'])) {
    $id = $_GET['cat_id'];
    // получаем все товары, только теперь только те где категория id совпадает
    $products = $database->query("SELECT * FROM `products` WHERE `category_id` = $id")->fetchAll(2);
}

// если у нас есть запрос $_GET search
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    // вместо строго = теперь мы используем LIKE(проще говоря 'похоже на'), а также используем % - это говорит что до и псоле нашего search может быть любой другой текст
    $products = $database->query("SELECT * FROM `products` WHERE `name` LIKE '%$search%'")->fetchAll(2);

}


?>

<div class="container">
    <div class="catalog-container">
        <div class="filtration">

            <div class="categories">

                <!-- ВЫВОДИТЬ КАКАЯ КАТЕГОРИЯ АКТИВНА - ЭТО ОПЦИАЛНАЛЬНО, ДУМАЮ ЭТО НЕ ВАЖНО -->

                <!-- вывод всех категорий -->
                <a <? if (!isset($_GET['cat_id']))
                    echo 'class="cat-active"' ?> href="?page=catalog" class="cat">Все</a>
                <? foreach ($cats as $cat): ?>
                    <!-- в href записываем $_GET страницу каталог (что бы мы остались на этой же страницу), а также cat_id с номером id категории -->
                    <!-- если у нас есть $_GET cat_id и он совпадает с id категории, тогда выводим класс active -->
                    <a <?
                    if (isset($_GET['cat_id']) and $_GET['cat_id'] == $cat['id'])
                        echo 'class="cat-active"' ?> href="?page=catalog&cat_id=<?= $cat['id']
                        ?>" class="cat"><?= $cat['name'] ?></a>
                <? endforeach; ?>


            </div>


            <!-- форма у которой по умолчанию метод GET -->
            <!-- занчение name у input в url будет - ?чтото, а value - это то что мы пишем или задаёим изначально и в url будет =чтото -->
            <!-- ?`поле:name`=`поле:value` -->
            <form class="search" action="">

                <!-- ?page=catalog -->
                <!-- нужен что бы мы также оставались на странице каталога -->
                <input type="hidden" name="page" value="catalog" id="">
                <!-- ?search=чтото -->
                <input name="search" class="input" placeholder="Поиск" type="text">

                <button style="margin: 0px" class="btn-primary">Поиск</button>
            </form>
        </div>


        <div class="product-container">

            <? if (!empty($products)): // ОПЦИАНАЛЬНО, ПРОСТО ЧТО БЫ ВЫВОДИТЬ ЕСЛИ НЕТ ТОВАРОВ?>      


                <!-- выводим все товары -->
                <? foreach ($products as $product): ?>
                    <a href="?page=product&id=<?= $product['id'] ?>" class="product">
                        <img src="assets/public/<?= $product['img_path'] ?>" alt="">
                        <div class="product-title">
                            <span><?= $product['name']; ?></span>
                            <p><?= $product['price']; ?> ₽</p>
                        </div>
                    </a>
                <? endforeach; ?>

            <? else: // ОПЦИАНАЛЬНО, ПРОСТО ЧТО БЫ ВЫВОДИТЬ ЕСЛИ НЕТ ТОВАРОВ?>
                <p>Слажлеем, товары не найдены :(</p>
            <? endif; // ОПЦИАНАЛЬНО, ПРОСТО ЧТО БЫ ВЫВОДИТЬ ЕСЛИ НЕТ ТОВАРОВ?>
        </div>
    </div>
</div>