<?
///////////////// ТОВАРЫ ////////////////////
// получение всех товаров
$products = $database->query('SELECT * FROM `products`')->fetchAll(2);

// есть есть запрос ?delete_id в url то удаляем товар
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $database->query("DELETE FROM `products` WHERE `id` = $id");
    header('Location: /?page=admin');
}



///////////////// ЗАКАЗЫ ////////////////////
// получаем все заказы
$orders = $database->query('SELECT *, `orders`.`id` as `order_id` FROM `orders` JOIN `products` ON `orders`.`product_id` = `products`.`id`')->fetchAll(2);



// принятие заказа
//получаем id заказа и меняем статус на 1 (Принят)
if (isset($_GET['confirm_id'])) {
    $id = $_GET['confirm_id'];
    $database->query("UPDATE `orders` SET `status`='1' WHERE id = $id");
    header("Location: /?page=admin");
}

//получаем id заказа и меняем статус на 2 (Отказ)
if (isset($_GET['reject_id'])) {
    $id = $_GET['reject_id'];
    $database->query("UPDATE `orders` SET `status`='2' WHERE id = $id");
    header("Location: /?page=admin");
}
?>

<div class="container">
    <div class="admin-title">
        <h1>Работа с товарами</h1>
        <!-- кнопка добавления товара -->
        <a class="btn-primary" href="?page=add-products">Добавить товар</a>
    </div>

    <div class="product-container">
        <!-- выводим все товары -->
        <? foreach ($products as $product): ?>
            <a href="?page=product&id=<?= $product['id'] ?>" class="product">
                <img src="assets/public/<?= $product['img_path'] ?>" alt="">
                <div class="product-title">
                    <span><?= $product['name']; ?></span>
                    <p><?= $product['price']; ?> ₽</p>
                </div>

                <!-- в админке добовляем кнопки Редактировать и Удалить -->
                <div class="product-btns">
                    <a class="btn-primary" href="?page=update-products&id=<?= $product['id'] ?>">Редактировать</a>
                    <a onclick="return confirm('Вы хотите удалить товар?')" style="background: red" class="btn-primary"
                        href="?page=admin&delete_id=<?= $product['id'] ?>">Удалить</a>
                </div>
            </a>
        <? endforeach; ?>


    </div>


    <div class="admin-title">
        <h1>Работа с заказами</h1>
    </div>


    <div class="orders-container">
        <? if (!empty($orders)): //ОПИЦАНАЛЬНО, ПРОСТО ЧТО БЫ НЕ ВЫВОДИТЬ ПУСТЫУЮ ТАБЛИЦУ?>
            <div class="orders">
                <table>
                    <thead>
                        <tr>
                            <th>Номер</th>
                            <th>Название</th>
                            <th>Цена</th>
                            <th>Статус</th>
                            <th>Действия</th>

                        </tr>
                    </thead>
                    <tbody>
                        <!-- перебираем все заказы -->
                        <? foreach ($orders as $order): ?>
                            <tr>
                                <td><?= $order['id'] ?></td>
                                <td><?= $order['name'] ?></td>
                                <td><?= $order['price'] ?> ₽</td>
                                <td>

                                    <?
                                    if ($order['status'] == 0) {
                                        echo 'В обработке';
                                    } elseif ($order['status'] == 1) {
                                        echo 'Подверждено';
                                    } elseif ($order['status'] == 2) {
                                        echo 'Отказано';
                                    }
                                    ?>

                                </td>
                                <td>
                                    <!-- кнопки действия -->
                                    <div class="order-btns">
                                        <!-- остаёмся на странице и задаём гет парамет confirm_id или reject_id c айдишником заказа -->
                                        <a href="?page=admin&confirm_id=<?= $order['order_id'] ?>">Подверить</a>
                                        <a href="?page=admin&reject_id=<?= $order['order_id'] ?>">Отказать</a>
                                    </div>
                                </td>

                            </tr>
                        <? endforeach; ?>
                    </tbody>
                </table>
            </div>
        <? endif; //ОПИЦАНАЛЬНО, ПРОСТО ЧТО БЫ НЕ ВЫВОДИТЬ ПУСТЫУЮ ТАБЛИЦУ?>
    </div>
</div>