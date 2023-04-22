<?php

namespace App\Model;

class User
{
    private ?int $userId;
    private string $firstName;
    private string $secondName;
    private string $middleName;
    private string $gender;
    private string $birthDate;
    private string $email;
    private string $phone;
    private string $avatarPath;

    public function __construct(
        ?int $userId, string $firstName, string $secondName,
        string $middleName, string $gender, string $birthDate,
        string $email, string $phone, string $avatarPath
    ) {
        $this->userId = $userId;
        $this->firstName = $firstName;
        $this->secondName = $secondName;
        $this->middleName = $middleName;
        $this->gender = $gender;
        $this->birthDate = $birthDate;
        $this->email = $email;
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

    public function getMiddleName(): string
    {
        return $this->middleName;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getAvatarPath(): string
    {
        return $this->avatarPath;
    }

}