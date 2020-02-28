<?php
// function defination to convert array to xml
function array_to_xml( $data, &$xml_data ) {
    foreach( $data as $key => $value ) {
        if( is_array($value) ) {
            if( is_numeric($key) ){
                $key = 'item'.$key; //dealing with <0/>..<n/> issues
            }
            $subnode = $xml_data->addChild($key);
            array_to_xml($value, $subnode);
        } else {
            $xml_data->addChild("$key",htmlspecialchars("$value"));
        }
     }
}


$file = file_get_contents('other\SKM_TP_20200101.json');
$json_array = json_decode($file,TRUE);        // Декодировать в массив
unset($file);                               // Очистить переменную $file

// creating object of SimpleXMLElement
$xml_data = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><root></root>');
// function call to convert array to xml
array_to_xml($json_array, $xml_data);

//saving generated xml file;
$result = $xml_data->asXML('other\name.kml');
?>