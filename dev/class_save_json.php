<?php
class SaveAndLog {
    public $log_file;
    public $xml_content;
    public function __construct($log_file) {
    $this->log_file = $log_file;
    $this->xml_content = null;
    }
    public function open_xml_log() {
        if (file_exists($this->log_file)) {
            $this->xml_content = simplexml_load_file($this->log_file);
            print_r($this->xml_content);
            print_r('<h3>Содержимое лог-файла успешно прочитано!</h3>');
        } else {
            exit("Не удалось открыть файл $this->log_file.");
        }
    }
    public function check_the_current_request($ETag) {
        if (!$this->xml_content->xpath("//year[@current_year='2021']")) {//FIXME:date('Y')
            echo "<p><u>Дописывание года выполняется:</u></p>";
            $new_year = $this->xml_content->addChild('year');//добавление нового года
            $new_year->addAttribute('current_year', "2021");//добавление аттрибута нового года ВАЖНО ->
            $new_month = $new_year->addChild('month');//добавление нового месяца
            $new_month->addAttribute('current_month', date('m'));
            $new_day = $new_month->addChild('day');//добавление нового дня
            $new_day->addAttribute('current_day', date('d'));
            print_r ($this->xml_content);
            file_put_contents($this->log_file, $this->xml_content->asXML());//save file
        }
        $verifiable_month = "//year[@current_year='2021']/month[@current_month='04']";
        if (!$this->xml_content->xpath($verifiable_month)) {//TODO:Сократить ветви, запись вынести отдельно
            echo "<p><u>Дописывание месяца выполняется:</u></p>";
            $new_month = $this->xml_content->xpath("//year[@current_year='2021']")->addChild('month');
            $new_month->addAttribute('current_month', date('04'));
            $new_day = $new_month->addChild('day');//добавление нового дня
            $new_day->addAttribute('current_day', date('d'));
            print_r ($this->xml_content);
            file_put_contents($this->log_file, $this->xml_content->asXML());//save file
        }
        // $request = $this->xml_content->xpath("//day/request[@filename='Xml_1']");
        // print_r ($request);
        // echo '<br>';
        // print_r($this->xml_content);
        // $this->open_xml_log();
        // echo '<br>';
        // print_r($this->xml_content);
        // if (((string) $this->xml_content->year[-1]->month[-1])) {
        //     echo "<p><u>Проверка месяца выполнена</u></p>";
        //     $new_month = $this->xml_content->year[-1]->addChild('month');//добавление нового года
        //     $new_month->addAttribute('current_month', "03");//добавление аттрибута нового месяца ВАЖНО ->
        //     print_r ($this->xml_content);
        //     file_put_contents($this->log_file, $this->xml_content->asXML());//save file
        // }
        // if ($this->xml_content->year[-1]->month[-1]->day[-1]->request['filename']) {
        //     if ($this->xml_content->year[-1]->month[-1]->day[-1]->request[-1] != $ETag) {//json есть и обновился
        //         // TODO:Добавить сохранить новый json
        //         $new_request = $this->xml_content->year[-1]->month[-1]->day[-1]->addChild('request', $ETag);//добавление новой записи
        //         $new_request->addAttribute('event', 'record');//установка аттрибута записи
        //     } else {//json есть и НЕ обновился
        //         $new_request = $this->xml_content->log->year[-1]->month[-1]->day[-1]->addChild('request', $ETag);//добавление новой записи
        //         $new_request->addAttribute('event', 'unchanged');//установка аттрибута записи
        //     }
       // } //else {//json сегодня не скачивался
            //$new_day = $this->xml_content->year[-1]->month[-1]->addChild('day', date("d"));//добавление нового дня
            //$new_day->addAttribute('current_day', date("d"));//установка аттрибута нового дня
        //}
    }
}
$ETag = '5e43f25b-1c44';
$log_path = '../json_log2.xml';//FIXME:Путь к лог-файлу 
$test_obj = new SaveAndLog($log_path);
$test_obj->open_xml_log();
$test_obj->check_the_current_request($ETag);

?>

<!-- <?php
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
$xml_content->year->month->day->request[-1] = 555;
// $new_day = $xml_content->year->month->addChild('day', date("d"));
$new_day = $xml_content->year[-1]->month[-1]->addChild('day', date("d"));//добавление нового дня
$new_day->addAttribute('current_day', date("d"));//установка аттрибута нового дня
// $xml_content->year->month->day->addChild('request', date("Y"));
// print_r($xml_content);
$current_filename = 'json_log2.xml';
$dir_to_record = dirname(__FILE__);
file_put_contents("$dir_to_record/$current_filename", $xml_content->asXML());//save file
?> -->