<?php
declare(strict_types=1);
function parseDictionaryFile(string $filepath): array
{
    $dictionary = array();

    $file = fopen($filepath, "r");
    if ($file) {
        while (($line = fgets($file)) !== false) {
            $line = trim($line);
            $parts = explode(":", $line, 2);
            if (count($parts) === 2) {
                $key = trim($parts[0]);
                $value = trim($parts[1]);
                $dictionary[$key] = $value;
            }
        }
        fclose($file);
    }

    return $dictionary;
}

function mergeDictionaries(array $dictories): array
{
    $mergedDict = [];

    for ($i = 0; $i < count($dictories); $i++) {
        $mergedDict = array_merge($mergedDict, parseDictionaryFile($dictories[$i]));
    }
    return $mergedDict;
}

function sortDictionaries(array $dictories): string
{
    $mergedDict = mergeDictionaries($dictories);

    ksort($mergedDict);
    $text = "";

    foreach ($mergedDict as $key => $value) {
        $text .= $key . ": " . $value . "\n";
    }
    return $text;
}