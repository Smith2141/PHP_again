<?php
$current_date =  date("Ymd");
$current_filename = "SKM_TP_$current_date.json";//формирование актуального имени файла
$current_filename = "SKM_TP_20200102.json";//тестовое имя файла
$url = "http://172.17.188.163/share/$current_filename";
// $url = "http://10.19.206.50/share/$current_filename";//сервер МЧС
//TODO: допилить условие проверок наличия и времени редактирования файла
// FIXME:
$Headers = get_headers($url, 1);//чтение заголовков для проверки наличия файла
foreach ($Headers as $key => $value) {
    echo "$key => $value<br>";
}
echo '<h3>TEST</h3>';
echo trim($Headers['Last-Modified'], '""');
echo $Headers['Last-Modified'];
echo '<h3>TEST</h3>';
$file_content = file_get_contents($url);//получить содержимое файла
$dir_to_record = dirname(__FILE__);//директория запуска скрипта
// file_put_contents("$dir_to_record/$current_filename", $file_content);//save file
?>
<!--TODO: Сделать проверки существования папок input и output рядом с main.php
Конвертирование в kml, если оба события: сохранение в kml и отправка по почте --Ю запись в лог -->

<!-- TODO:
-отправка нового файла по электронке;
-логирование отправки;

0 => HTTP/1.1 200 OK
1 => Server: nginx/1.16.1
2 => Date: Thu, 20 Feb 2020 14:42:52 GMT
3 => Content-Type: application/json
4 => Content-Length: 7236
5 => Last-Modified: Wed, 12 Feb 2020 12:40:59 GMT
6 => Connection: close
7 => ETag: "5e43f25b-1c44"
8 => Accept-Ranges: bytes
 -->