<?php

namespace App\Entity;

class User
{
    public function __construct(
        private ?int $userId,
        private string $firstName,
        private string $secondName,
        private string $email,
        private string $password,
        private string $phone,
        private string $avatarPath,
        private bool $adminPrivilege = false
    ) { }

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
        return "/uploads/$fileName";
    }

}