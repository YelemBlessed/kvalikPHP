<?

// переменные которые нам будут даны на экзамене
$host = 'localhost';
$dbname = 'kvalik';
$user = 'root';
$password = '';
try {
    $database = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    // PDOException это просто обработчик ошибок (а саму ошибку записываем в переменную $err)
} catch (PDOException $err) {
    // а тут выводим ошибку
    die("Ошибка БД ------>" . $err);
}

?>