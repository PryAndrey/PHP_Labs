<?php
declare(strict_types=1);
function getJsonObject(array $POST): array
{
    $lastName = "не определено";
    $firstName = "не определено";
    $patronymic = "не определено";
    $gender = "не определено";
    $birthDay = "не определено";
    $email = "не определено";
    $phoneNumber = "не определено";
    $filename = "не определено";

    if (isset($POST["last-name"]))
        $lastName = $POST["last-name"];
    if (isset($POST["first-name"]))
        $firstName = $POST["first-name"];
    if (isset($POST["patronymic"]))
        $patronymic = $POST["patronymic"];
    if (isset($POST["gender"]))
        $gender = $POST["gender"];
    if (isset($POST["birth-day"]))
        $birthDay = $POST["birth-day"];
    if (isset($POST["email"]))
        $email = $POST["email"];
    if (isset($POST["phone-number"]))
        $phoneNumber = $POST["phone-number"];
    if (isset($POST["filename"]))
        $filename = $POST["filename"];

    return array(
        'lastName' => $lastName,
        'firstName' => $firstName,
        'patronymic' => $patronymic,
        'gender' => $gender,
        'birthDay' => $birthDay,
        'email' => $email,
        'phoneNumber' => $phoneNumber,
        'filename' => $filename,
    );
}
function checkUser(array $json_arr_elem, array|null $json_arr): bool
{
    $check = true;
    if ($json_arr === null) {
        return $check;
    }
    foreach ($json_arr as $key => $value) {
        if (($value['email'] === $json_arr_elem['email']) || ($value['phoneNumber'] === $json_arr_elem['phoneNumber'])) {
            $check = false;
        }
    }
    return $check;
}

$json_arr_elem = getJsonObject($_POST);
$file = "3-Task-result.json";
$json_arr = json_decode(file_get_contents($file), TRUE);

if (checkUser($json_arr_elem, $json_arr)) {
    $json_arr[] = $json_arr_elem;
} else {
    echo "Такой пользователь уже зарегистрирован <br>";
}

foreach ($json_arr as $key => $value) {
    print_r($value);
    echo "<br><br>";
}

file_put_contents($file, json_encode($json_arr));

// http://localhost:8000/3-Task-form.php
// php -S localhost:8000