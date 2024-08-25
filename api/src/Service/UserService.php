<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserService
{
    private $entityManager;
    private $userRepository;
    private $passwordEncoder;
    private $validator;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
        ValidatorInterface $validator
    ) {
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
        $this->validator = $validator;
    }
    public function createUser(string $name, string $email, string $password): User
    {
        // Vérifiez si l'utilisateur existe déjà
        if ($this->userRepository->findOneBy(['email' => $email])) {
            throw new \Exception('User already exists');
        }

        // Vérifiez si tous les champs sont remplis
        if (empty($name) || empty($email) || empty($password)) {
            throw new \Exception('All fields are required');
        }

        // Créez un nouvel utilisateur
        $user = new User();
        $user->setFirstNameUser($name);
        $user->setLastNameUser($lastName);
        $user->setMailUser($mail);
        $user->setImageProfil($imageProfil);
        $user->setPassword($this->passwordEncoder->encodePassword($user, $password));

        // Validez l'utilisateur
        $errors = $this->validator->validate($user);
        if (count($errors) > 0) {
            throw new \Exception((string) $errors);
        }

        // Persistez et enregistrez l'utilisateur
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}