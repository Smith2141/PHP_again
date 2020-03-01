<?php
class KmlProcessing {
    public $kml_path;
    public function __construct($kml_path) {
        $this->kml_path = $kml_path;
    }
    public function kml_correction() {
        if (file_exists($this->kml_path)) {
            $kml_content = new SimpleXMLElement($this->kml_path, NULL, TRUE);
            print_r('<h3>Содержимое  kml файла успешно прочитано!</h3>');
            // print_r($kml_content);

        } else {
            exit("<h3>Не удалось открыть файл $this->kml_path.</h3>");
        }
        // $date = $kml_content->xpath(".//*[self::SimpleData[@name='date']]");
        $simple_data = $kml_content->Document->Folder->Placemark->ExtendedData->SchemaData->SimpleData;
        foreach ($simple_data as $key) {
            switch ((string) $key['name']) {
            case 'date':
                $date = $key;
            break;
            case 'datemin':
                $datemin = $key;
            break;
            }
        }
        echo "<h1>$date & $datemin</h1>";
        $kml_content->Document->Folder->name = $date;
        $exiting_placemarks = $kml_content->Document->Folder->Placemark;
        foreach ($exiting_placemarks as $placemark) {
            $placemark->addChild('name');
            $placemark->name = $datemin;
        }
    file_put_contents($this->kml_path, $kml_content->asXML());
    return TRUE;
    }
}
$kml_path = './file_output/SKM_TP_20200105.kml';
$kml_obj = new KmlProcessing($kml_path);
$kml_obj->kml_correction();
?>

<!--
<hr>
получить контент<br>
получить значения date и datemin<br>
записать date в текст <Folder><name><br>
записать datemin в текст каждого узла <Placemark><name><br>
перезаписать контент в файл kml<br>-->