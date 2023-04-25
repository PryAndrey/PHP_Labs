<?php

namespace App\Model;

class User
{
    private ?int $userId;
    private string $firstName;
    private string $secondName;
    private string $email;
    private string $password;
    private string $phone;
    private string $avatarPath;

    public function __construct(
        ?int $userId,
        string $firstName,
        string $secondName,
        string $email,
        string $password,
        string $phone,
        string $avatarPath
    ) {
        $this->userId = $userId;
        $this->firstName = $firstName;
        $this->secondName = $secondName;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->avatarPath = $avatarPath;
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
        return "/uploads/$fileName";
    }

}