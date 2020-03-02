
<?php
$log = xmlwriter_open_memory();
xmlwriter_set_indent($log, 2);
$res = xmlwriter_set_indent_string($log, ' ');
xmlwriter_start_document($log, '1.0', 'UTF-8');
xmlwriter_start_element($log, 'log');// Корневой элемент
xmlwriter_end_element($log); // testc
xmlwriter_end_document($log);

print_r (xmlwriter_output_memory($log));
?>