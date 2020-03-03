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
            // $this->xml_content = simplexml_load_file($this->log_file);
            $this->xml_content = new SimpleXMLElement($this->log_file, NULL, TRUE);
            print_r($this->xml_content);
            print_r('<h3>Содержимое лог-файла успешно прочитано!</h3>');
        } else {
            exit("Не удалось открыть файл $this->log_file.");
        }
    }
    public function check_the_current_year() {//TODO: поубирать итерацию из методов
        $current_year = date('Y');
        $verifiable_year = $this->xml_content->xpath("//year[@current_year=$current_year]");
        if (!$verifiable_year) {
            echo "<p><u>Дописывание года выполняется:</u></p>";
            $new_year = $this->xml_content->addChild('year');//добавление нового года
            $new_year->addAttribute('current_year', date('Y'));//добавление аттрибута нового года ВАЖНО ->
            print_r ($this->xml_content);
        }
    }
    public function check_the_current_month() {
        $current_year = date('Y');
        $current_month = date('Ym');
        $verifiable_year = $this->xml_content->xpath("//year[@current_year=$current_year]");
        $verifiable_month = $this->xml_content->xpath("//month[@current_month=$current_month]");
        if (!$verifiable_month) {
            echo "<p><u>Дописывание месяца выполняется:</u></p>";
            foreach ($verifiable_year as $year) {
                if ((string) $year['current_year'] == $current_year) {
                    $year->addChild('month')->addAttribute('current_month', date('Ym'));
                    print_r ($this->xml_content);
                }
            }
        }
    }
    public function check_the_current_day() {
        $current_month = date('Ym');
        $current_day = date('Ymd');
        $verifiable_month = $this->xml_content->xpath("//month[@current_month=$current_month]");
        $verifiable_day = $this->xml_content->xpath("//day[@current_day=$current_day]");
        if (!$verifiable_day) {
            echo "<p><u>Дописывание дня выполняется:</u></p>";
            foreach ($verifiable_month as $month) {
                if ((string) $month['current_month'] == $current_month) {
                    $month->addChild('day')->addAttribute('current_day', date('Ymd'));
                    print_r ($this->xml_content);
                    file_put_contents($this->log_file, $this->xml_content->asXML());//save file
                }
            }
    
        }
    }
    public function check_the_current_request($current_filename, $url) {
        $current_day = date('Ymd');
        $verifiable_day = $this->xml_content->xpath("//day[@current_day=$current_day]");
        $verifiable_day_expr = $this->xml_content->xpath("//day[last()]");
        $verifiable_request = $this->xml_content->xpath("//request[last()]");
        $Headers = get_headers($url, 1);//чтение заголовков для проверки наличия файла
        $ETag = trim($Headers['ETag'], '""');//значение атрибута ETag
        $ContentLength = $Headers['Content-Length'];//значение атрибута длины файла
        $LastModified = $Headers['Last-Modified'];//значение атрибута редактирования
        if (empty($verifiable_request) or $verifiable_request[0]['ETag'] != $ETag) {
            echo "<p><u>Дописывание запроса record выполняется:</u></p>";
            foreach ($verifiable_day as $day) {
                if ((string) $day['current_day'] == $current_day) {
                    $file_content = file_get_contents($url);//получить содержимое файла json
                    if (!is_dir('in')) {//проверка и создание директории для json
                        mkdir('in', 0777, true);
                    }
                    file_put_contents("in/$current_filename", $file_content);//save json file
                    //добавление события в лог
                    $day->addChild('request')->addAttribute('event', 'record');
                    $verifiable_request = $this->xml_content->xpath("//request[last()]");
                    $verifiable_request[0]->addAttribute('ETag', $ETag);
                    $verifiable_request[0]->addAttribute('filename', $current_filename);
                    $verifiable_request[0]->addAttribute('Content-Length', $ContentLength);
                    $verifiable_request[0]->addAttribute('Last-Modified', $LastModified);
                    print_r ($this->xml_content);
                    file_put_contents($this->log_file, $this->xml_content->asXML());//save log file
                    return TRUE;
                }
            }
        } else {
            $verifiable_day_expr = $this->xml_content->xpath("//day[last()]");
            echo "<p><u>Дописывание запроса unchanged выполняется:</u></p>";
            $verifiable_day_expr[0]->addChild('request');
            $verifiable_request = $this->xml_content->xpath("//request[last()]");
            $verifiable_request[0]->addAttribute('event', 'unchanged');
            $verifiable_request[0]->addAttribute('ETag', $ETag);
            print_r ($this->xml_content);
            file_put_contents($this->log_file, $this->xml_content->asXML());//save log file
            return FALSE;
        }
    }

}
?>