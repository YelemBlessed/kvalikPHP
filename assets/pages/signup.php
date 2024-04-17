<div class="container">


    <!-- форма регистрации -->
    <form method="post" action="assets/action/signup-action.php" class="form">
        <h1>Регситарция</h1>
        <p>Если у вас уже есть аккаунт <a href="?page=signin">Войти</a></p>
        <input name='fio' type="text" placeholder="ФИО:" class="input">
        <input name="phone" type="text" placeholder="+7XXXXXXXXXX" class="input">
        <input name="password" type="password" placeholder="Пароль:" class="input">
        <input name="re_password" type="password" placeholder="Повторите пароль:" class="input">
        <div class="chekbox">
            <input name="check" type="checkbox" name="" id="">
            <p>Нажимая вы соглашаетесь с <a href="">Политикой конфиденциальности</a></p>
        </div>

        <button class="btn-primary">Зарегистрировать</button>
    </form>



</div>