<?php
require_once 'class_save_json.php';
require_once 'class_proc_kml.php';

$current_date =  date("Ymd");//актуальная дата
$current_date =  "20200102";//FIXME:тестовая дата
$current_json_filename = "SKM_TP_$current_date.json";//формирование актуального имени json
$url = "http://172.17.188.163/share/$current_json_filename";
// $url = "http://10.19.206.50/share/$filename";//сервер МЧС
function check_json_exist ($current_json_filename, $url) {
    $Headers = get_headers($url, 1);//чтение заголовков для проверки наличия файла
    if ($Headers[0] !== 'HTTP/1.1 200 OK') {
        echo "<i>Запрашиваемый файл:<br>$url<br><b>отсутствует</b> на сервере.</i>";//TODO:добавить кейсы по возможным статусам
        return FALSE;
    }
    else {
        echo "<i>Файл $current_json_filename найден</i>";
        return trim($Headers['ETag'], '""');
    }
}
$log_path = 'log/json_log.xml';//путь к файлу логирования получения json
if (!is_dir('log')) {//проверка и создание директории для лога json
    mkdir('log', 0777, true);
}
if (!is_dir('kml')) {//проверка и создание директории для kml
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
$check_file = check_json_exist($current_json_filename, $url);
echo $check_file;
if ($check_file) {//если запрашиваемый json есть на сервере
    $ETag = $check_file;
    $json_obj = new SaveAndLog($log_path);
    $json_obj->open_xml_log();//открыть файл лога json
    $json_obj->check_the_current_year();
    $json_obj->check_the_current_month();
    $json_obj->check_the_current_day();
    $new_json_receive = $json_obj->check_the_current_request($current_json_filename, $url);//логирование сверки и получения json
}
//Правка тегов kml файла
if ($new_json_receive) {//Проверка на успешное получение json
    $current_kml_filename = "SKM_TP_$current_date.kml";//формирование актуального имени kml
    //Конвертирование kml
    $current_kml_path = "kml\\$current_kml_filename";
    $current_json_path = "in\\$current_json_filename";
    $ogr_path = "ogr2ogr\\ogr2ogr.exe";
    $command =  "$ogr_path -f KML $current_kml_path $current_json_path";
    system($command);
    sleep(2);
    if (!is_file($current_kml_path)) {//Правка тегов kml файла
        echo "<i>Запрашиваемый файл:<br>$current_kml_path<br><b>не найден</b></i>";
    } else {
        $kml_obj = new KmlProcessing($current_kml_path);
        $kml_obj->kml_correction();
    }
}
?>