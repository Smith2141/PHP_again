<?php
// $file = file_get_contents('./dev/old.json');  // Открыть файл data.json
$file = file_get_contents('./Update.json');
$taskList = json_decode($file,TRUE);        // Декодировать в массив 
unset($file);                               // Очистить переменную $file
// foreach ($taskList as $key => $value) {
//     echo "$key => $value<br>";
// }
echo $taskList[0];
// foreach ($taskList as $elem) {
//     echo $elem;
    // foreach ($elem as $key => $value) {
        // echo "$key => $value<br>";
    // }
// }
print_r($taskList); echo '<br>';
// print_r($taskList['id']);
           
// $taskList[] = array('name'=>$name);        // Представить новую переменную как элемент массива, в формате 'ключ'=>'имя переменной'
          
// file_put_contents('php/data.json',json_encode($taskList));  // Перекодировать в формат и записать в файл.
          
// unset($taskList);
/*
$item = new GJSON_NEW_FORMAT();
$item->$properties['id'] = 
class GJSON_NEW_FORMAT {
    const TYPE = "Feature";
    public $properties = array(
        'id'=> NAN,
        'datemin'=> NAN,
        'date'=> NAN,
        'lon'=> NAN,
        'lat'=> NAN
    );
    public $geometry = array(
        'type' => NAN,
        'coordinates' => NAN

    );

}*/
?>