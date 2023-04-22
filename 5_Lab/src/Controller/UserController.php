<?php

namespace App\Controller;

use App\Database\ConnectionProvider;
use App\Database\UserTable;
use App\Model\User;
use App\Model\Upload;

class UserController
{
    private const HTTP_STATUS_303_SEE_OTHER = 303;
    private UserTable $userTable;
    private Upload $upload;

    public function __construct()
    {
        $connection = ConnectionProvider::connectDatabase();
        $this->userTable = new UserTable($connection);
        $this->upload = new Upload();
    }

    public function index(): void
    {
        require __DIR__ . "/../View/form.php";
    }

    public function registerUser(array $requestData): void
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            $this->writeRedirectSeeOther("/");
            return;
        }

        if (isset($_POST["email"])) {
            $email = $_POST["email"];
            $email_validation_regex = "/^\\S+@\\S+\\.\\S+$/";
            if (!(preg_match($email_validation_regex, $email))) {
                $this->writeRedirectSeeOther("/");
                exit();
            }
        }

        if (isset($_POST["phone"])) {
            $phone = $_POST["phone"];
            $phoneCheck = substr($phone, 1);
            if (!is_numeric($phoneCheck) && !((is_numeric(substr($phone, 0, 1))) || (substr($phone, 0, 1) === "+"))) {
                $this->writeRedirectSeeOther("/");
                exit();
            }
        }

        $userAvatar = $this->upload->moveImageToUploads($_FILES["avatar_path"]);

        $user = new User(
            null, $requestData["first_name"], $requestData["second_name"],
            $requestData["middle_name"], $requestData["gender"], $requestData["birth_date"],
            $requestData["email"], $requestData["phone"],
            $userAvatar
        );
        $userId = $this->userTable->saveUser($user);
        $this->writeRedirectSeeOther("/showUser.php?user_id=$userId");
    }

    public function showUser(array $queryParams): void
    {
        if ($_SERVER["REQUEST_METHOD"] !== "GET") {
            $this->writeRedirectSeeOther("/");
            exit();
        }
        $userId = (int) $queryParams["user_id"];
        if (!$userId) {
            $this->writeRedirectSeeOther("/");
            exit();
        }
        $user = $this->userTable->findUser($userId);
        if (!$user) {
            $this->writeRedirectSeeOther("/");
            exit();
        }
        require __DIR__ . "/../View/showUser.php";
    }

    private function writeRedirectSeeOther(string $url): void
    {
        header("Location: " . $url, true, self::HTTP_STATUS_303_SEE_OTHER);
    }

}