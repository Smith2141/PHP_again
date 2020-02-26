<?php
require_once './class_save_json.php';

$current_date =  date("Ymd");//актуальная дата
$current_filename = "SKM_TP_$current_date.json";//формирование актуального имени файла
$current_filename = "SKM_TP_20200104.json";//тестовое имя файла на сервере Панорамы
$url = "http://172.17.188.163/share/$current_filename";
// $url = "http://10.19.206.50/share/$filename";//сервер МЧС
function check_json_exist ($current_filename, $url) {
    $Headers = get_headers($url, 1);//чтение заголовков для проверки наличия файла
    if ($Headers[0] !== 'HTTP/1.1 200 OK') {
        echo "<i>Запрашиваемый файл:<br>$url<br><b>отсутствует</b> на сервере.</i>";//TODO:добавить кейсы по возможным статусам
        return FALSE;
    }
    else {
        echo "<i>Файл $current_filename найден</i>";
        return trim($Headers['ETag'], '""');
    }
}

$log_path = './log/json_log.xml';//FIXME:Путь к лог-файлу 
$check_file = check_json_exist($current_filename, $url);
echo $check_file;
if ($check_file) {
    $ETag = $check_file;
    $test_obj = new SaveAndLog($log_path);
    $test_obj->open_xml_log();
    $test_obj->check_the_current_year();
    $test_obj->check_the_current_month();
    $test_obj->check_the_current_day();
    $test_obj->check_the_current_request($current_filename, $url);
}
?>