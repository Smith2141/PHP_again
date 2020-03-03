<?php
$first = 100;
$second = 400;
$command = "php ./t_file2.php $first $second";
$escaped_command = escapeshellcmd($command);
system($command);
?>