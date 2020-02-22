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
        $current_year = date('Y');
        $verifiable_year = $this->xml_content->xpath("//year[@current_year=$current_year]");
        if (!$verifiable_year) {//FIXME:date('Y')
            echo "<p><u>Дописывание года выполняется:</u></p>";
            $new_year = $this->xml_content->addChild('year');//добавление нового года
            $new_year->addAttribute('current_year', date('Y'));//добавление аттрибута нового года ВАЖНО ->
        }
        $current_month = date('Ym');
        $verifiable_month = $this->xml_content->xpath("//month[@current_month=$current_month]");
        if (!$verifiable_month) {//TODO:Сократить ветви, запись вынести отдельно
            echo "<p><u>Дописывание месяца выполняется:</u></p>";
            $new_year = $this->xml_content->xpath("//year[@current_year=$current_year]");
            foreach ($new_year as $year) {
                if ($verifiable_year) {
                    $year->addChild('month')->addAttribute('current_month', date('Ym'));
                }
            }
        }
        $current_day = date('Ymd');
        $verifiable_day = $this->xml_content->xpath("//day[@current_day=$current_day]");
        if (!$verifiable_day) {
            echo "<p><u>Дописывание дня выполняется:</u></p>";
            $new_month = $this->xml_content->xpath("//month[@current_month=$current_month]");
            foreach ($new_month as $month) {
                if ($verifiable_month) {
                    $month->addChild('day')->addAttribute('current_day', date('Ymd'));
                }
            }
        }
        print_r ($this->xml_content);
        file_put_contents($this->log_file, $this->xml_content->asXML());//save file
    }
}

$ETag = '5e43f25b-1c44';
$log_path = '../json_log2.xml';//FIXME:Путь к лог-файлу 
$test_obj = new SaveAndLog($log_path);
$test_obj->open_xml_log();
$test_obj->check_the_current_request($ETag);
?>