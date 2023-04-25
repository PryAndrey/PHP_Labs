<?php

namespace App\Database;

use App\Model\User;

class UserTable
{
    private const MYSQL_DATETIME_FORMAT = "Y-m-d H:i:s";
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findUser(int $userId): ?User
    {
        $query = <<<SQL
            SELECT user_id, first_name, second_name, user_email, user_password, user_phone, user_avatar
            FROM user
            WHERE user_id = $userId
        SQL;

        $statement = $this->connection->query($query);
        if ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            return $this->createUserFromRow($row);
        }

        return null;
    }

    public function saveUser(User $user): int
    { 
        $query = <<<SQL
            INSERT INTO user (first_name, second_name, user_email, user_password, user_phone, user_avatar)
            VALUES (:first_name, :second_name, :user_email, :user_password, :user_phone, :user_avatar)
        SQL;
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute([
                ":first_name" => $user->getFirstName(),
                ":second_name" => $user->getSecondName(),
                ":user_email" => $user->getEmail(),
                ":user_password" => $user->getPassword(),
                ":user_phone" => $user->getPhone(),
                ":user_avatar" => $user->getAvatarPath()
            ]);
        } catch (\Exception $e) {
            echo "Такой пользователь уже существует";
            header("Status: 400 Bad Request", true, 400);
            exit();
        }

        return (int) $this->connection->lastInsertId();
    }

    private function createUserFromRow(array $row): User
    {
        return new User(
            (int) $row["user_id"], $row["first_name"], $row["second_name"],
            $row["user_email"], $row["user_password"], $row["user_phone"], $row["user_avatar"]
        );
    }
}