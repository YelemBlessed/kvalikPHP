<?

// функция для создания случайного имени с сохраненим расширения
function generateFileName($file)
{
    // обращаемя с name потому что именно ключа name хранит название и расшируение
    $format = pathinfo($file['name'], PATHINFO_EXTENSION); // получаем формат например: png 
    // uniqid() - геренарирует случайный набор символов например: 1u4bf934ff
    $filename = uniqid() . '.' . $format; // 1u4bf934ff.png

    // что бы функция нам что то вернула, а не делала всё просто так
    return $filename;
}

function zagruziteFile($file)
{
    $filename = generateFileName($file);//получаем имя файла
    // move_uploaded_file (откуда, куда)
    //  конечный путь выглядит как public/1u4bf934ff.png
    move_uploaded_file($file['tmp_name'], '../public/' . $filename);

    return $filename;
}




?>