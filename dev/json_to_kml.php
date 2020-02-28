<?php
$filename_to_convert = "SKM_TP_20200105";//имя файла для конвертации без расширения
$name_kml = dirname(__FILE__) . "\\file_output\\$filename_to_convert.kml";
$name_json = dirname(__FILE__) . "\\file_input\\$filename_to_convert.json";
// echo $name_kml;
// echo $name_json;
// $line =  "ogr2ogr -f KML $name_kml $name_json";
$line = "dir";
// $line = "c:";
// echo shell_exec(mb_convert_encoding("$line", 'ASCII'));
echo shell_exec("$line");
// $line = "dir";

?>