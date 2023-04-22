<?php 
require_once("1-Task-utils.php");
 
echo compareFloats(2.01, 2.09999999999), "\n";
echo arrayEquals([1,2,3], [1,2,3]) ? "1" : "0", "\n";
print_r(arrayNumberFilter(['1', 2, "acd", "33", 4.4]));
