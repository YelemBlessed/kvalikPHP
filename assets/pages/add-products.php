<?
// получаем все категории
$cats = $database->query("SELECT * FROM `categories`")->fetchAll() ?>

<div class="container">
    <!-- форма доавбления товара -->
    <!-- ВАЖНО: enctype="multipart/form-data"  
    для того что бы форма принимала картинки -->
    <form method="post" action="assets/action/add-product-action.php" class="form" enctype="multipart/form-data">
        <h1>Добавление товара</h1>
        
        <!-- поля для товара -->
        <input name="title" type="text" placeholder="Название" class="input">
        <input name="about" type="text" placeholder="Описание:" class="input">
        <input name="price" type="text" placeholder="Цена:" class="input">


        <select class="input" name="category_id" id="">
            <!-- перебераем все категории-->
            <? foreach ($cats as $cat): ?>
                <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
            <? endforeach; ?>
        </select>


        <!-- инпут для доавбления картинки -->
        <input type="file" name="image" class="input">
       


        <button class="btn-primary">Добавить</button>
    </form>



</div>