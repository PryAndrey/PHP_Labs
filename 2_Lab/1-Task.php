<?php 
if ($argc < 2){
  echo "Incorrect number of parametrs";
  return;
}

$numbers = [];
for($i=1;$i < count($argv);$i++)
{
  if (!is_numeric($argv[$i])) {
    echo "Error: must be numbers";
    return;
  }
    $numbers[] = $argv[$i];
}

echo "min: ", min($numbers);
echo "MAX: ", max($numbers);