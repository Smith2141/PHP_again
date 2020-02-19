<?php
$current_filename = 'json_log.xml';
if (file_exists($current_filename)) {
    $xml_content = simplexml_load_file($current_filename);
 
    print_r($xml_content);
} else {
    exit("Не удалось открыть файл $current_filename.");
}
echo '<hr>';
echo 'Год: ' . $xml_content->year['current_year'] . '<br>';
echo 'Месяц: ' . $xml_content->year->month['current_month'] . '<br>';
echo 'День: ' . $xml_content->year->month->day['current_day'] . '<br>';
echo 'Событие: ' . $xml_content->year->month->day->request['event'] . '<br>';
echo 'Файл: ' . $xml_content->year->month->day->request['filename'] . '<br>';
echo 'Длина: ' . $xml_content->year->month->day->request . '<br>';
$xml_content->year->month->day->request[1] = 12345;
$dir_to_record = dirname(__FILE__);
// file_put_contents("$dir_to_record/$current_filename", $xml_content->asXML());//save file
?>