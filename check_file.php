<?php
$current_date =  date("Ymd");
$current_filename = "SKM_TP_$current_date.json";//формирование актуального имени файла
$current_filename = "SKM_TP_20200102.json";//тестовое имя файла
$url = "http://172.17.188.163/share/$current_filename";
// $url = "http://10.19.206.50/share/$current_filename";//сервер МЧС
//TODO: допилить условие проверок наличия и времени редактирования файла
// FIXME:
$Headers = get_headers($url);//чтение заголовков для проверки наличия файла
foreach ($Headers as $key => $value) {
    echo "$key => $value<br>";
}
$file_content = file_get_contents($url);
$dir_to_record = dirname(__FILE__);
// file_put_contents("$dir_to_record/$current_filename", $file_content);//save file
?>