<?php
require_once(__DIR__ . "/User.php");
require_once(__DIR__ . "/databaseConnection.php");

// 2 Task
// function collectData(array $userParams): array
// {
//   $USER_FIELDS = ["second_name", "first_name", "middle_name", "gender", "birth_date", "avatar_path"];
//   foreach ($USER_FIELDS as $key) {
//     if (isset($_POST[$key])) {
//       $userParams[$key] = $_POST[$key];
//     }
//   }

//   if (isset($_POST["email"])) {
//     $email = $_POST["email"];
//     $email_validation_regex = "/^\\S+@\\S+\\.\\S+$/";
//     if (!(preg_match($email_validation_regex, $email))) {
//       throw new RuntimeException("Неккоректный ввод email");
//     }
//     $userParams["email"] = $email;
//   }
//   if (isset($_POST["phone"])) {
//     $phone = $_POST["phone"];
//     if (!is_numeric($phone)) {
//       throw new RuntimeException("Неккоректный ввод phone");
//     }
//     $userParams["phone"] = (int) $phone;

//   }
//   return $userParams;
// }
// function saveUserToDatabase(PDO $connection, array $userParams): int
// {
//   $query = <<<SQL
//         INSERT INTO user (first_name, second_name, middle_name, gender, birth_date, email, phone, avatar_path)
//         VALUES (:first_name, :second_name, :middle_name, :gender, :birth_date, :email, :phone, :avatar_path)
//     SQL;
//   //print_r($userParams);
//   try {
//     $statement = $connection->prepare($query);
//     $statement->execute([
//       ":first_name" => $userParams["first_name"],
//       ":second_name" => $userParams["second_name"],
//       ":middle_name" => $userParams["middle_name"],
//       ":gender" => $userParams["gender"],
//       ":birth_date" => $userParams["birth_date"],
//       ":email" => $userParams["email"],
//       ":phone" => $userParams["phone"],
//       ":avatar_path" => $userParams["avatar_path"]
//     ]);
//   } catch (Exception $e) {
//     echo "Такой пользователь уже создан ";
//     header("Status: 400 Bad Request", true, 400);
//     exit();
//   }

//   return $connection->lastInsertId();
// }

// $userParams = [];
// $userParams = collectData($userParams);
// $connection = connectDatabase();
// $userId = saveUserToDatabase($connection, $userParams);

// 4 Task
function saveUserToDatabase(PDO $connection, User $user): int
{
  $query = <<<SQL
        INSERT INTO user (first_name, second_name, middle_name, gender, birth_date, email, phone, avatar_path)
        VALUES (:first_name, :second_name, :middle_name, :gender, :birth_date, :email, :phone, :avatar_path)
    SQL;
  try {
    $statement = $connection->prepare($query);
    $statement->execute([
      ":first_name" => $user->getFirstName(),
      ":second_name" => $user->getSecondName(),
      ":middle_name" => $user->getMiddleName(),
      ":gender" => $user->getGender(),
      ":birth_date" => $user->getBirthDate(),
      ":email" => $user->getEmail(),
      ":phone" => $user->getPhone(),
      ":avatar_path" => $user->getAvatarPath()
    ]);
  } catch (Exception $e) {
    echo "Такой пользователь уже создан ";
    header("Status: 400 Bad Request", true, 400);
    exit();
  }

  return $connection->lastInsertId();
}
function collectData(array $userParams): User
{
  $USER_FIELDS = ["second_name", "first_name", "middle_name", "gender", "birth_date", "avatar_path"];
  foreach ($USER_FIELDS as $key) {
    if (isset($_POST[$key])) {
      $userParams[$key] = $_POST[$key];
    }
  }

  if (isset($_POST["email"])) {
    $email = $_POST["email"];
    $email_validation_regex = "/^\\S+@\\S+\\.\\S+$/";
    if (!(preg_match($email_validation_regex, $email))) {
      throw new RuntimeException("Неккоректный ввод");
    }
    $userParams["email"] = $email;
  }
  if (isset($_POST["phone"])) {
    $phone = $_POST["phone"];
    $phoneCheck = substr($phone, 1);
    if (!is_numeric($phoneCheck) && !(is_numeric($phone[0]) || ($phone[0] === "+"))) {
      throw new RuntimeException("Неккоректный ввод");
    }
    $userParams["phone"] = $phone;

  }
  return new User(null, $userParams["first_name"], $userParams["second_name"], $userParams["middle_name"], $userParams["gender"], $userParams["birth_date"], $userParams["email"], $userParams["phone"], $userParams["avatar_path"]);
}

$userParams = [];
$user = collectData($userParams);
$connection = connectDatabase();
$userId = saveUserToDatabase($connection, $user);

$redirectUrl = "showUserModule.php/?user_id=$userId";
header("Location: " . $redirectUrl, true, 303);
die();