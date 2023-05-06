<?php

namespace App\Service;

use App\Repository\UserRepository;
use App\Entity\User;
use App\Service\Data\UserData;

class UserService implements UserServiceInterface
{
  private UserRepository $userRepository;

  public function __construct(UserRepository $userRepository)
  {
    $this->userRepository = $userRepository;
  }
  public function saveUser(string $firstName, string $secondName, string $email, string $password, string $phone, ?string $userAvatar): int
  {
    $user = new User(
      null,
      $firstName,
      $secondName,
      $email,
      $password,
      $phone,
      $userAvatar
    );

    return $this->userRepository->store($user);
  }
  public function getUser(int $userId): UserData
  {
    $user = $this->userRepository->findById($userId);
    if ($user === null) {
      throw $this->createNotFoundException();
    }

    return new UserData(
      $user->getUserId(),
      $user->getFirstName(),
      $user->getSecondName(),
      $user->getEmail(),
      $user->getPassword(),
      $user->getPhone(),
      $user->getAvatarPath(),
    );
  }
  public function deleteUser(int $userId): void
  {
    $user = $this->userRepository->findById($userId);
    if ($user === null) {
      throw $this->createNotFoundException();
    }

    $this->userRepository->delete($user);
  }
  public function listUsers(): array
  {
    $users = $this->userRepository->getListAll();

    $usersView = [];
    foreach ($users as $user) {
      $usersView[] = new UserData(
        $user->getUserId(),
        $user->getFirstName(),
        $user->getSecondName(),
        $user->getEmail(),
        $user->getPassword(),
        $user->getPhone(),
        $user->getAvatarPath(),
      );
    }

    return $usersView;
  }
}