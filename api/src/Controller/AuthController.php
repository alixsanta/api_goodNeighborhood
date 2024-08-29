<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuthController extends AbstractController
{   
    // User authentification with JWT
    #[Route('/api/login_check', name: 'api_login', methods: ['POST'])]
    public function login(
        Request $request, 
        EntityManagerInterface $entityManager, 
        UserPasswordHasherInterface $passwordHasher, 
        JWTTokenManagerInterface $jwtManager
    ): JsonResponse {
        // Retrieves the contents of the query
        $requestData = json_decode($request->getContent(), true);
        $email = $requestData['mailUser'] ?? null;
        $password = $requestData['password'] ?? null;

        // Check required fields
        if (!$email || !$password) {
            return new JsonResponse(['error' => 'l\'E-mail et mot de passe est requis'], 400);
        }

        // Surch user by e-mail
        $user = $entityManager->getRepository(User::class)->findOneBy(['mailUser' => $email]);

        // Checks if user exists
        if (!$user) {
            return new JsonResponse(['error' => 'L\'utilisateur n\'existe pas'], 404);
        }

        // Checks if password is correct
        if (!$passwordHasher->isPasswordValid($user, $password)) {
            return new JsonResponse(['error' => 'Le mot de passe est incorrect'], 401);
        }

        // Generates JWT token
        $token = $jwtManager->create($user);

        // JSON response with token
        return new JsonResponse([
            'token' => $token,
            'message' => 'Connexion réussie',
        ], 200);
    }
}
