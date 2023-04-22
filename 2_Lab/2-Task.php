<?php 
if ($argc < 2){
  echo "Incorrect number of parametrs";
  return;
}

if ((!strstr($argv[1], '=')) || (strpos($argv[1], '=') === strlen($argv[1])-1) || (strpos($argv[1], '=') === 0)) {
  echo "Error: must <key>=<value>";
  return;
} else {

  $min = trim(strstr($argv[1], '='),'=');
  $max = trim(strstr($argv[1], '='),'=');
  for($i=2; $i < count($argv); $i++)
  {
    if ((!strstr($argv[$i], '=')) || (strpos($argv[$i], '=') === strlen($argv[$i])-1) || (strpos($argv[$i], '=') === 0)) {
      echo "Error: must <key>=<value>";
      return;
    }
      
      $value = trim(strstr($argv[$i], '='),'=');
      if (strcmp($min, $value) === 1) {
        $min = $value;
      }
      if (strcmp($max, $value) === -1) {
        $max = $value;
      }
  }
  echo "min: ", $min;
  echo " MAX: ", $max;
}