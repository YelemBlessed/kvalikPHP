<?

// получаем активного польщователя
$user_id = $_SESSION['AUTH_ID'];



////////////////добавление в коризну
// если есть запросс add_id (его можно получить если нажать на доабавить в корзину в странице продукт)
if (isset($_GET['add_id'])) {
    $id = $_GET['add_id'];

    // добавляем в бд торва и номер пользователя
    $database->query("INSERT INTO `basket`(`prduct_id`, `user_id`) VALUES ('$id','$user_id')");
    header("Location: /?page=basket");
}


///////////////уадаляем из корзины
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    $database->query("DELETE FROM `basket` WHERE `id` = $id");
    header("Location: /?page=basket");
}


//////////// получить товары в корзине
// Берём таблицу баскет и объединяем (JOIN) с таблицей продуктов где prduct_id баскета = id продукта, где user_id баскета = наш активный пользователь
// используем   , `basket`.`id` as `basket_id`  потому что id от таблицы basket затирается id от таблицы products
$baskets = $database->query("SELECT *, `basket`.`id` as `basket_id` FROM `basket` JOIN `products` ON `basket`.`prduct_id` = `products`.`id` WHERE `basket`.`user_id` =  $user_id")->fetchAll();





////////////////формирование заказа
// работает след. образом: если есть запросс create_order (его можно получить если нажать на Добавить в корзину в странице продукт)
if (isset($_GET['create_order'])) {

    // перебираем все товары в корзине и добавляем в таблицу orders
    foreach ($baskets as $el) {
        $prduct_id = $el['prduct_id'];
        $database->query("INSERT INTO `orders`(`product_id`, `user_id`) VALUES ('$prduct_id','$user_id')");
    }

    // перебираем все товары в корзине которые принадлежат нашему активному пользователю и удаляем из корзины
    foreach ($baskets as $el) {
        $user_id = $el['user_id'];
        $database->query("DELETE FROM `basket` WHERE `user_id` = $user_id");
    }

    // перенаправляем на страницу корзины (просто обновляем страницу)
    header("location: /?page=basket");
}



/////////////////// получеие заказов
// работает по принципу получение корзины
$orders = $database->query("SELECT *, `orders`.`id` as `order_id` FROM `orders` JOIN `products` ON `orders`.`product_id` = `products`.`id` WHERE `user_id` = $user_id")->fetchAll();


?>





<div class="container">

    <div class="basket">
        <h2>Корзина</h2>



        <? if (!empty($baskets)): //ОПИЦАНАЛЬНО, ПРОСТО ЧТО БЫ НЕ ВЫВОДИТЬ ПУСТЫУЮ КОРЗИНУ С КНОПКОЙ ?>
            <div class="basket-container">

                <!-- выводим все элементы корзины -->
                <? foreach ($baskets as $basket): ?>
                    <div class="basket-item">
                        <div class="basket-item-left">
                            <img src="assets/public/<?= $basket['img_path'] ?>" alt="">
                            <div class="basket-item-title">
                                <p>Навазние: <?= $basket['name'] ?></p>
                                <span>Цена: <?= $basket['price'] ?></span>
                            </div>
                        </div>
                        <div class="basket-item-right">
                            <!-- кнопка удаления элемента из корзины -->
                            <!-- остаёмся на страницы basket и добавляем гет параметр delete_id -->
                            <a class="btn-primary" style="background: red;"
                                href="?page=basket&delete_id=<?= $basket['basket_id'] ?>">Удалить</a>
                        </div>
                    </div>


                <? endforeach; ?>

            </div>
            <!-- кнопка оформелния заказа -->
            <!-- остаёмся на страницы basket и добавляем гет параметр create_order (просто что бы отследить нажатие)-->
            <a class="btn-primary" href="?page=basket&create_order=true">Оформить заказ</a>


        <? else: //ОПИЦАНАЛЬНО, ПРОСТО ЧТО БЫ НЕ ВЫВОДИТЬ ПУСТЫУЮ КОРЗИНУ С КНОПКОЙ ?>
            <p>Корзина пуста</p>
        <? endif; //ОПИЦАНАЛЬНО, ПРОСТО ЧТО БЫ НЕ ВЫВОДИТЬ ПУСТЫУЮ КОРЗИНУ С КНОПКОЙ ?>

    </div>





    <? if (!empty($orders)): //ОПИЦАНАЛЬНО, ПРОСТО ЧТО БЫ НЕ ВЫВОДИТЬ ПУСТЫУЮ ТАБЛИЦУ ?>
        <h2 style="margin-top: 60px">Мои заказы</h2>
        <div class="orders">
            <table>
                <thead>
                    <tr>
                        <th>Номер</th>
                        <th>Название</th>
                        <th>Цена</th>
                        <th>Статус</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- выводим все заказы -->
                    <? foreach ($orders as $order): ?>
                        <tr>
                            <td><?= $order['order_id'] ?></td>
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
                        </tr>
                    <? endforeach; ?>
                </tbody>
            </table>
        </div>
    <? endif; //ОПИЦАНАЛЬНО, ПРОСТО ЧТО БЫ НЕ ВЫВОДИТЬ ПУСТЫУЮ ТАБЛИЦУ?>

</div>