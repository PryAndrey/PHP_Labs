<?php
declare(strict_types=1);

namespace App\Service;

use App\Service\Data\UserData;

interface UserServiceInterface
{
  public function saveUser(string $firstName, string $secondName, string $email, string $password, string $phone, ?string $userAvatar): int;
  public function getUser(int $userId): UserData;
  public function getUserByEmail(string $email): UserData|null;
  public function deleteUser(int $userId): void;

  public function listUsers(): array;
}