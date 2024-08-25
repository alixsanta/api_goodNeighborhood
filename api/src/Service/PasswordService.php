<?php

namespace App\Service;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class PasswordService
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function hashPassword(PasswordAuthenticatedUserInterface $user, string $plainPassword): string
    {
        return $this->passwordHasher->hashPassword($user, $plainPassword);
    }

    public function isPasswordValid(PasswordAuthenticatedUserInterface $user, string $plainPassword): bool
    {
        return $this->passwordHasher->isPasswordValid($user, $plainPassword);
    }

    public function validatePasswordComplexity(string $plainPassword): bool
    {
        // Check that the password respects the length criteria
        if (strlen($plainPassword) < 11) {
            throw new \Exception('Le mot de passe doit contenir au moins 11 caractères');
        }

        // checks password for special characters
        $hasUppercase = preg_match('/[A-Z]/', $plainPassword);
        if(!$hasUppercase) {
            throw new \Exception('Le mot de passe doit contenir au moins un caractère en majuscule');
        }

        // checks password for special characters
        $hasSpecialChar = preg_match('/[\W_]/', $plainPassword);
        if(!$hasSpecialChar) {
            throw new \Exception('Le mot de passe doit contenir au moins un caractère spécial');
        }

        return $hasUppercase && $hasSpecialChar;
    }

}