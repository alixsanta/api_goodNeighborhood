<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\PasswordService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Doctrine\ORM\EntityManagerInterface;

class AuthController extends AbstractController
{
    private $passwordService;
    private $jwtManager;
    private $userAuthenticator;
    private $entityManager;

    public function __construct(
        PasswordService $passwordService,
        JWTTokenManagerInterface $jwtManager,
        UserAuthenticatorInterface $userAuthenticator,
        EntityManagerInterface $entityManager
    ) {
        $this->passwordService = $passwordService;
        $this->jwtManager = $jwtManager;
        $this->userAuthenticator = $userAuthenticator;
        $this->entityManager = $entityManager;
    }

    // User authentification with JWT
    #[Route('/api/login', name: 'login', methods: ['POST'])]
    public function login(Request $request): JsonResponse
    {
        // Retrieves query data
        $requestData = json_decode($request->getContent(), true);

        $email = $requestData['mailUser'] ?? null;
        $password = $requestData['password'] ?? null;

        // Checks required fields
        if (!$email || !$password) {
            return new JsonResponse(['error' => 'L\email et le mot de passe sont nécessaires'], 400);
        }

        // Search user by email
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['mailUser' => $email]);

        if (!$user || !$this->passwordService->isPasswordValid($user, $password)) {
            return new JsonResponse(['error' => 'Informations d\'identification invalides'], 401);
        }

        // Generates JWT token
        $token = $this->jwtManager->create($user);
        // Json response with token
        return new JsonResponse(['token' => $token, 'message' => 'Connexion réussie'], 200);
    }
}
