<?php
require_once 'class_proc_kml.php';

$current_date =  date("Ymd");//актуальная дата
$current_filename = "SKM_TP_$current_date.kml";//формирование актуального имени файла
$current_kml_filename = "SKM_TP_20200110.json.kml";//тестовое имя файла на сервере Панорамы
$current_kml_path = "kml/$current_kml_filename";

if (!is_file($current_kml_path)) {
    echo "<i>Запрашиваемый файл:<br>$current_kml_path<br><b>отсутствует</b>не найден</i>";
} else {
    $kml_obj = new KmlProcessing($current_kml_path);
    $kml_obj->kml_correction();
}
?>