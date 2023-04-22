<?php
function passwordStrength($password)
{
  $len = strlen($password);
  $upper = preg_match_all('/[A-Z]/', $password, $matches);
  $lower = preg_match_all('/[a-z]/', $password, $matches);
  $digits = preg_match_all('/[0-9]/', $password, $matches);
  $symbols = $len - $upper - $lower - $digits;
  $repeat = 2*($len - strlen(count_chars($password, 3)));

  // echo "\n", $len, "\n", $upper, "\n", $lower, "\n", $digits, "\n", $symbols, "\n", $repeat, "\n";

  $strength = 0;
  $strength += 4 * $len;
  $strength += 4 * $digits;
  
  if ($upper > 0) {
    $strength += ($len - $upper) * 2;
  }
  if ($lower > 0) {
    $strength += ($len - $lower) * 2;
  }
  if ($digits === $len) {
    $strength -= $len;
  }
  if ($symbols === $len) {
    $strength -= $len;
  }
  $strength -= $repeat;

  return $strength;
}

if ($argc < 2) {
  echo "Incorrect number of parametrs";
  return;
}
echo "PasswordStrength: ", passwordStrength($argv[1]);