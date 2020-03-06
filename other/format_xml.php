<?php
$log_file = __DIR__ . '/json_log.xml';
$log_file2 = __DIR__ . '/json_log2.xml';
$xml = simplexml_load_file($log_file);

$dom = new DOMDocument('1.0', 'UTF-8');
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xml->saveXML());
file_put_contents($log_file2, $dom->saveXML());
?>