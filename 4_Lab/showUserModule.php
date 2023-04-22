<?php
require_once(__DIR__ . "/User.php");
require_once(__DIR__ . "/databaseConnection.php");

// 3 Task
// function findUserInDatabase(PDO $connection, int $userId): ?array
// {
//     $query = <<< SQL
//         SELECT user_id, first_name, second_name, middle_name, gender, birth_date, email, phone, avatar_path
//         FROM user
//         WHERE user_id = $userId
//     SQL;

//     $statement = $connection->query($query);
//     $user = $statement->fetch(PDO::FETCH_ASSOC);
//     if (!$user)
//     {
//         throw new RuntimeException("User with id $userId not found");
//     }
//     return $user;
// }

// $userId = (int) $_GET["user_id"];
// $connection = connectDatabase();
// $user = findUserInDatabase($connection, $userId);
// require_once __DIR__ . "/showUser.php";

// 4 Task
function findUserInDatabase(PDO $connection, int $userId): User
{
    $query = <<< SQL
        SELECT user_id, first_name, second_name, middle_name, gender, birth_date, email, phone, avatar_path
        FROM user
        WHERE user_id = $userId
    SQL;

    $statement = $connection->query($query);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if (!$user)
    {
        throw new RuntimeException("User with id $userId not found");
    }
    return new User($user["user_id"], $user["first_name"], $user["second_name"], $user["middle_name"], $user["gender"], $user["birth_date"], $user["email"], $user["phone"], $user["avatar_path"]);
}

$userId = (int)$_GET["user_id"];
$connection = connectDatabase();
$user = findUserInDatabase($connection, $userId);
require __DIR__ . "/showUserClass.php";