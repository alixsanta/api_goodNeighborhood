<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\PasswordService;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Nonstandard\Uuid;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer as NormalizerAbstractNormalizer;

class UserController extends AbstractController
{
    // Display all users
    #[Route('api/user', name: 'user', methods: ['GET'])]
    public function getUserList(UserRepository $userRepository): JsonResponse
    {
        $userList = $userRepository->findAll();
        return new JsonResponse([
            'liste des utilisateurs' => $userList,
        ]);
    }

    // Display user
    #[Route("/user/{id}", name:"user_show")]

    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    // Update a user
    #[Route('api/user/{id}', name: 'updateUser', methods: ['PUT'])]
    public function updateUser(User $user, Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager, UserRepository $userRepository): JsonResponse
    {
        if (!$user) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }
        $user = $serializer->deserialize($request->getContent(), User::class, 'json', [
            NormalizerAbstractNormalizer::OBJECT_TO_POPULATE => $user
        ]);

        $entityManager->flush();

        $jsonUser = $serializer->serialize($user, 'json');
        return new JsonResponse($jsonUser, Response::HTTP_OK, [], true);
    }


    // Delete user
    #[Route("/user/{id}", name:"user_delete")]

     public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getUUIDUser(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
    }

    // Create User
    #[Route('/api/create', name: 'create', methods: ['POST'])]
    public function create(Request $request, 
                        EntityManagerInterface $entityManager, 
                        SerializerInterface $serializer, 
                        UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true);
        
        $firstName = $requestData['firstName'] ?? null;
        $lastName = $requestData['lastName'] ?? null;
        $mail = $requestData['mail'] ?? null;
        $plaintextPassword = $requestData['password'] ?? null;
        $imageProfil = $requestData['imageProfil'] ?? null;

        if (!$firstName || !$lastName || !$mail || !$plaintextPassword) {
            return new JsonResponse(['error' => 'Missing required fields'], 400);
        }

        $this->passwordService->validatePasswordComplexity($plaintextPassword);
        $user = new User();
        $hashedPassword = $this->passwordService->hashPassword($user, $plaintextPassword);

        $user->setFirstNameUser($firstName);
        $user->setLastNameUser($lastName);
        $user->setMailUser($mail);
        $user->setImageProfil($imageProfil);
        $user->setPassword($hashedPassword);

        $entityManager->persist($user);
        $entityManager->flush();

        $data = $serializer->serialize($user, 'json');

        return new JsonResponse(['message' => 'Utilisateur créé avec succès', 'user' => json_decode($data)], 201); 
    }
    
    public function __construct(private readonly PasswordService $passwordService)
    {

    }
}
