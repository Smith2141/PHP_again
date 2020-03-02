<?php
require_once './class_save_json.php';

$current_date =  date("Ymd");//актуальная дата
$current_filename = "SKM_TP_$current_date.json";//формирование актуального имени файла
$current_filename = "SKM_TP_20200103.json";//тестовое имя файла на сервере Панорамы
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
$log_path = 'log/json_log.xml';//путь к файлу логирования получения json
if (!is_dir('log')) {//проверка и создание директории для лога json
    mkdir('log', 0777, true);
}
if (!is_dir('kml')) {//проверка и создание директории для лога json
    mkdir('kml', 0777, true);
}
if (!is_file($log_path)) {
    $log = xmlwriter_open_memory();
    xmlwriter_set_indent($log, 2);
    $res = xmlwriter_set_indent_string($log, ' ');
    xmlwriter_start_document($log, '1.0', 'UTF-8');
    xmlwriter_start_element($log, 'log');// Корневой элемент
    xmlwriter_end_element($log); // testc
    xmlwriter_end_document($log);
    file_put_contents ($log_path, xmlwriter_output_memory($log));
}
//Проверка файла на сервере и скачивание в ./in
$check_file = check_json_exist($current_filename, $url);
echo $check_file;
if ($check_file) {//если запрашиваемый json есть на сервере
    $ETag = $check_file;
    $json_obj = new SaveAndLog($log_path);
    $json_obj->open_xml_log();//открыть файл лога json
    $json_obj->check_the_current_year();
    $json_obj->check_the_current_month();
    $json_obj->check_the_current_day();
    $new_file_receive = $json_obj->check_the_current_request($current_filename, $url);//логирование сверки и получения json
}
?>