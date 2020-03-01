<?php
public function convertToNewFormat($format) {
    return(
        exec('ogr2ogr -f '
            .$format
            .' '.self::setNewFileLocation()
            .' '.self::setOldFileLocation()));
}
?>