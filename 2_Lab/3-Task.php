<?php 
if ($argc < 2){
  echo "Incorrect number of parametrs";
  return;
}
echo "'", preg_replace('/\s+/', ' ',  trim($argv[1])), "'";
//echo "'", preg_replace('/[^\S\r\n]+/', ' ',  trim($argv[1])), "'";
