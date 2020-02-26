<?php
require_once './class_save_json.php';
include_once ("./gisconverter.php-master/gisconverter.php");

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
//Проверка файла на сервере и скачивание в ./input
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
    $new_file_receive = $test_obj->check_the_current_request($current_filename, $url);
}

$decoder = new gisconverter\WKT(); # create a WKT decoder in gisconverter namespace
$geometry = $decoder->geomFromText('MULTIPOLYGON(((10 10,10 20,20 20,20 15,10 10)))'); # create a geometry from a given string input
echo "<h3>Новая библиотека</h3.";
print_r($geometry->toGeoJSON());      # output geometry in GeoJSON format
// print_r(geojson_to_kml('{"type":"LinearRing","coordinates":[[3.5,5.6],[4.8,10.5],[10,10],[3.5,5.6]]}'));
print "\n\n";

// if ($new_file_receive) {
//     $json = file_get_contents("./file_input/$current_filename");
//     $json = file_get_contents("../other/old.json");
//     $res = geojson_to_kml ($json);
//     print_r($res);
// }
?>