<?



// из url($_GET['id']) получаем id
$id = $_GET['id'];
// получаем товар который редактируем
$product = $database->query("SELECT * FROM `products` WHERE `id` = '$id'")->fetch();


// получаем все категории
$cats = $database->query("SELECT * FROM `categories`")->fetchAll() ?>

<div class="container">
    <!-- форма редактирования товара -->
    <!-- ВАЖНО: enctype="multipart/form-data"  
    для того что бы форма принимала картинки -->
    <form name="update" method="post" action="assets/action/update-product-action.php" class="form" enctype="multipart/form-data">
        <h1>Редактирование товара</h1>
        <!-- передайём айди в скрытом инпуте что бы в action файле понять какой товар нам надо редактровать -->
        <input type="hidden" name="id" value='<?= $product['id'] ?>'>
        <!-- поля для товара -->
        <!-- подставляем значения товара в поля (в value) -->
        <input value="<?= $product['name'] ?>" name="title" type="text" placeholder="Название" class="input">
        <input value="<?= $product['about'] ?>" name="about" type="text" placeholder="Описание:" class="input">
        <input value="<?= $product['price'] ?>" name="price" type="text" placeholder="Цена:" class="input">


        <select class="input" name="category_id" id="">
            <!-- перебераем все категории-->
            <? foreach ($cats as $cat): ?>
                <!-- если категория товара совпадает с id категориию, то выводим selected -->
                <option <? if ($cat['id'] == $product['category_id'])
                    echo 'selected' ?> value="<?= $cat['id'] ?>">
                    <?= $cat['name'] ?>
                </option>
            <? endforeach; ?>
        </select>



        <!-- инпут для доавбления картинки -->
        <input type="file" name="image" class="input">
        <img height="200px" src="assets/public/<?= $product['img_path'] ?>" alt="">
        <!-- предыдущая картинка, для того что бы не было необходимости загружать картинку каждый раз -->
        <input type="hidden" name="old_image" value="<?= $product['img_path'] ?>">




        <button class="btn-primary">Редактировать</button>
    </form>



</div>