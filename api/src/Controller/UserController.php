<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Nonstandard\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Serializer\denormalize;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController
{
    // Display all users
    #[Route('api/user', name: 'users', methods: ['GET'])]
    public function getAllUser(UserRepository $userRepository, SerializerInterface $serializer): JsonResponse
    {
        $userList = $userRepository->findAll();
        $jsonUserList = $serializer->serialize($userList, 'json');
        return new JsonResponse($jsonUserList, Response::HTTP_OK, [], true);
    }

    // Display user by id
    #[Route('api/user/{id}', name: 'UserDetails', methods: ['GET'])]
    public function getUserDetails(Uuid $uuid_user, SerializerInterface $serializer, UserRepository $userRepository){
        $user = $userRepository->find(($uuid_user));
        if($user){
            $jsonUser = $serializer->serialize($user, 'json');
            return new JsonResponse($jsonUser, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }

    // Create a new user
    #[Route('api/user', name: 'createUser', methods: ['POST'])]
    public function createUser(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $user = $serializer->deserialize($data, User::class);

        $entityManager->persist($user);
        $entityManager->flush();

        $jsonUser = $serializer->serialize($user, 'json');
        return new JsonResponse($jsonUser, Response::HTTP_CREATED, [], true);
    }

    // Update a user
    #[Route('api/user/{id}', name: 'updateUser', methods: ['PUT'])]
    public function updateUser(Uuid $uuid_user, Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager, UserRepository $userRepository): JsonResponse
    {
        $user = $userRepository->find($uuid_user);
        if (!$user) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);
        $serializer->deserialize($data, User::class, null, [
            'object_to_populate' => $user,
        ]);

        $entityManager->flush();

        $jsonUser = $serializer->serialize($user, 'json');
        return new JsonResponse($jsonUser, Response::HTTP_OK, [], true);
    }
    
    // Delete a user
    #[Route('api/user/{id}', name: 'deleteUser', methods: ['DELETE'])]
    public function deleteUser(Uuid $uuid_user, EntityManagerInterface $entityManager, UserRepository $userRepository): JsonResponse
    {
        $user = $userRepository->find($uuid_user);
        if (!$user) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($user);
        $entityManager->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
