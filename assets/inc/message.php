<!-- если у нас есть сессия с уведолмением -->
<? if (isset($_SESSION['message'])): ?>
    <div class="message">
        <p>
            <!-- выводим уведомление -->
            <?= $_SESSION['message']; ?>
            <!-- удаляем все уведомления так как уже вывели его -->
            <? unset($_SESSION['message']) ?>
        </p>
    </div>
<? endif; ?>