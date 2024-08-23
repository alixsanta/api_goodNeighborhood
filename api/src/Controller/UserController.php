<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
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

class UserController extends AbstractController
{
    // Display user
    #[Route('api/user', name: 'user', methods: ['GET'])]
    public function getUserList(UserRepository $userRepository, Security $security): JsonResponse
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

    // Add user
    #[Route("/user/new", name:"user_new")]

     public function createUser(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    // Update user
    #[Route("/user/{id}/edit", name:"user_edit")]

    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
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

    #[Route('/api/create', name: 'create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true);
        
        $firstName = $requestData['firstName'] ?? null;
        $lastName = $requestData['lastName'] ?? null;
        $mail = $requestData['mail'] ?? null;
        $plaintextPassword = $requestData['password'] ?? null;
        $imageProfil = $requestData['imageProfil'] ?? null;
        $roles = $requestData['roles'] ?? null;

        if (!$firstName || !$lastName || !$mail || !$plaintextPassword) {
            return new JsonResponse(['error' => 'Missing required fields'], 400);
        }

        $user = new User();
        $hashedPassword = $passwordHasher->hashPassword($user, $plaintextPassword);

        $user->setFirstNameUser($firstName);
        $user->setLastNameUser($lastName);
        $user->setMailUser($mail);
        $user->setImageProfil($imageProfil);
        $user->setPassword($hashedPassword);
        $user->setRoles($roles);

        $entityManager->persist($user);
        $entityManager->flush();

        $data = $serializer->serialize($user, 'json');

        return new JsonResponse(['message' => 'Utilisateur créé avec succès', 'user' => json_decode($data)], 201);
    }
}
