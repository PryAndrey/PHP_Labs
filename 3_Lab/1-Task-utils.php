<?php 
function compareFloats(float $value1, float $value2): int
{
    return (abs($value1 - $value2) < 0.00000001) ? 0 : (($value1 - $value2 > 0) ? -1 : 1);
}

function arrayEquals(array $left, array $rights): bool
{
    return $left === $rights ? true : false;
}

function arrayNumberFilter(array $data): array {
    $numbers = [];
    foreach ($data as $element) {
        if (is_numeric($element)) {
            $numbers[] = $element;
        } 
    }
    return $numbers;
}
