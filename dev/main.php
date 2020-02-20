<?php
require_once './class_save_json.php';

$current_date =  date("Ymd");//актуальная дата
$current_filename = "SKM_TP_$current_date.json";//формирование актуального имени файла
$current_filename = "SKM_TP_20200106.json";//тестовое имя файла на сервере Панорамы
function check_json_exist ($filename) {
    $url = "http://172.17.188.163/share/$filename";
    // $url = "http://10.19.206.50/share/$filename";//сервер МЧС
    $Headers = get_headers($url);//чтение заголовков для проверки наличия файла
    if ($Headers[0] !== 'HTTP/1.1 200 OK') {
        echo "<i>Запрашиваемый файл:<br>$url<br><b>отсутствует</b> на сервере.</i>";//TODO:добавить кейсы по возможным статусам
        return FALSE;
    }
    else {
        echo "<i>Файл $filename найден</i>";
        return TRUE;
    }
}

check_json_exist($current_filename);
$log_path = '../json_log.xml';//FIXME:Путь к лог-файлу 
$test_obj = new SaveAndLog($log_path);
$test_obj->open_xml_log();

?>