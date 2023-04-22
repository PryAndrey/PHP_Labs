<?php
$lastName = "не определено";
$firstName = "не определено";
$patronymic = "не определено";
$gender = "не определено";
$birthDay = "не определено";
$email = "не определено";
$phoneNumber = "не определено";
$filename = "не определено";

if (isset($_POST["last-name"]))
    $lastName = $_POST["last-name"];
if (isset($_POST["first-name"]))
    $firstName = $_POST["first-name"];
if (isset($_POST["patronymic"]))
    $patronymic = $_POST["patronymic"];
if (isset($_POST["gender"]))
    $gender = $_POST["gender"];
if (isset($_POST["birth-day"]))
    $birthDay = $_POST["birth-day"];
if (isset($_POST["email"]))
    $email = $_POST["email"];
if (isset($_POST["phone-number"]))
    $phoneNumber = $_POST["phone-number"];
if (isset($_POST["filename"]))
    $filename = $_POST["filename"];

$json_arr_elem = array(
    'lastName' => $lastName,
    'firstName' => $firstName,
    'patronymic' => $patronymic,
    'gender' => $gender,
    'birthDay' => $birthDay,
    'email' => $email,
    'phoneNumber' => $phoneNumber,
    'filename' => $filename,
);

$file = "3-Task-result.json";
$json_arr = json_decode(file_get_contents($file), TRUE);

$check = true;
foreach ($json_arr as $key => $value) {
    if ($value === $json_arr_elem) {
        $check = false;
    }
}

if ($check) {
    $json_arr[] = $json_arr_elem;
} else {
    echo "Такой пользователь уже зарегистрирован <br>";
}

foreach ($json_arr as $key => $value) {
    print_r($value);
    echo "<br><br>";
}

file_put_contents($file, json_encode($json_arr));

// http://localhost:8000/3-Task.php
// php -S localhost:8000