<?php
require_once("2-Task-concatenate.php");
$filename = __DIR__ . '/2-Task-texts/result.txt';
$fh = fopen($filename, 'w');

fwrite($fh, mergeDictionaries(['2-Task-texts/dict1.txt', '2-Task-texts/dict2.txt', '2-Task-texts/dict3.txt', '2-Task-texts/dict4.txt']));
fclose($fh);