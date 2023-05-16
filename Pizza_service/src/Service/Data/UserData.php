<?php
declare(strict_types=1);

namespace App\Service\Data;

class UserData
{
  public function __construct(
    private ?int $userId,
    private string $firstName,
    private string $secondName,
    private string $email,
    private string $password,
    private string $phone,
    private string $avatarPath,
    private int $role = 1
  ) {
  }

  public function getUserId(): ?int
  {
    return $this->userId;
  }
  public function getFirstName(): string
  {
    return $this->firstName;
  }
  public function getSecondName(): string
  {
    return $this->secondName;
  }
  public function getEmail(): string
  {
    return $this->email;
  }
  public function getPassword(): string
  {
    return $this->password;
  }
  public function getPhone(): string
  {
    return $this->phone;
  }
  public function getAvatarPath(): string
  {
    return $this->avatarPath;
  }
  public function getUploadUrlPath(string $fileName): string
  {
    return "/uploads/user/$fileName";
  }
  public function getRole(): int
  {
    return $this->role;
  }
  public function toArray(): array
  {
    return [
      'userId' => $this->getUserId(),
      'firstName' => $this->getFirstName(),
      'secondName' => $this->getSecondName(),
      'email' => $this->getEmail(),
      'password' => $this->getPassword(),
      'phone' => $this->getPhone(),
      'userAvatar' => $this->getAvatarPath(),

    ];
  }
}