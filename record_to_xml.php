<?php
$current_filename = 'json_log.xml';
if (file_exists($current_filename)) {
    $xml_content = simplexml_load_file($current_filename);
 
    print_r($xml_content);
} else {
    exit("Не удалось открыть файл $current_filename.");
}
echo '<hr>';
echo $xml_content->year['current_year'] . '<br>';
echo $xml_content->year->month['current_month'] . '<br>';
echo $xml_content->year->month->day['current_day'] . '<br>';
echo $xml_content->year->month->day->request['event'] . '<br>';
echo $xml_content->year->month->day->request['filename'] . '<br>';
echo $xml_content->year->month->day->request . '<br>';
echo "Запись" . '<br>';
$xml_content->year->month->day->request[1] = 777 . '<br>';
echo $xml_content->year->month->day->request[0] . '<br>';
echo $xml_content->year->month->day->request[1] . '<br>';
print_r($xml_content);
$current_filename = 'json_log2.xml';
$dir_to_record = dirname(__FILE__);
$new_xml = new SimpleXMLElement($xml_content);
file_put_contents("$dir_to_record/$current_filename", $new_xml);//save file
?>