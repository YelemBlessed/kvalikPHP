<?



?>

<header>
    <div class="header-container">
        <a href="/" class="logo">КВАЛИК</a>
        <div class="header-nav">
            <a href="?page=catalog">Каталог</a>
            <a href="">перейти</a>
            <a href="">перейти</a>
        </div>
        <div class="header-icons">


            <!-- если нет сессии с пользователем -->
            <? if (!isset($_SESSION['AUTH_ID'])): ?>
                <a href="?page=signin">авторизация</a>
                <a href="?page=signup">регситарция</a>

                <!-- если есть выводим корзину и выход -->
            <? else: ?>
                <a href="?page=basket">корзина</a>
                <a href="assets/action/logout.php">выход</a>


                
                <?
                // получаем айди активного пользователя
                $user_id = $_SESSION['AUTH_ID'];
                // получаем данные активного пользователя
                $user = $database->query("SELECT * FROM `users` WHERE id = $user_id")->fetch();
                ?>

                <!-- если роль пользователя = 1, тогда покажем кнопку -->
                <? if ($user['role'] == 1): ?>
                    <a href="?page=admin">админ-панель</a>
                <? endif; ?>

            <? endif; ?>


        </div>
    </div>
</header>