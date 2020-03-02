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

        } else {
            exit("<h3>Не удалось открыть файл $this->kml_path.</h3>");
        }
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
        unset($simple_data, $key);
        $node_skips = FALSE;
        $kml_content->Document->Folder->name = $date;
        $exiting_placemarks = $kml_content->Document->Folder->Placemark;
        foreach ($exiting_placemarks as $placemark) {
            if (array_key_exists('name', $placemark)) {//защита от повторной обработки
                $node_skips = TRUE;
                continue;
            }
            $placemark->addChild('name');
            $placemark->name = $datemin;
        }
    file_put_contents($this->kml_path, $kml_content->asXML());
    if (!$node_skips) {
        echo "Файл успешно обработан и обновлён";
    } else {
        echo "Файл успешно обработан и обновлён.<br>Ранее обработанные ноды были пропущены.";
    }
    return TRUE;
    }
}
?>