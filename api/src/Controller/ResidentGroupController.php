<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ResidentGroupRepository;
use App\Entity\User;
use App\Entity\ResidentGroup;
use App\Security\Voter\ResidentGroupVoter;
use Symfony\Component\HttpFoundation\Response;

#[Route('api/resident_group')]
class ResidentGroupController extends AbstractController
{
    #[Route('/api/create', name: 'create_resident_group', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $requestData = $request->getContent();
        $residentGroup = $serializer->deserialize($requestData, ResidentGroup::class, 'json');
    
        if (!$residentGroup->getNameGroup() || !$residentGroup->getIdAddress()) {
            return new JsonResponse(['error' => 'Il manque des champs'], 400);
        }
    
        $residentGroup->setUser($this->getUser());
    
        $entityManager->persist($residentGroup);
        $entityManager->flush();
    
        $data = $serializer->serialize($residentGroup, 'json');
    
        return new JsonResponse(['message' => 'Groupe de résidents créé avec succès', 'residentGroup' => json_decode($data)], 201);
    }
    
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(ResidentGroupRepository $residentGroupRepository, SerializerInterface $serializer): Response
    {
        if(!$this->isGranted(ResidentGroupVoter::LIST)) {
                  throw $this->createNotFoundException();
            }
        $residentGroups = $residentGroupRepository->findAll();
        $data = $serializer->serialize($residentGroups, 'json');
    
        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }
    
    
    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(ResidentGroup $residentGroup, SerializerInterface $serializer): Response
    {
            if(!$this->isGranted(ResidentGroupVoter::SHOW)) {
                throw $this->createNotFoundException();
            }
        $data = $serializer->serialize($residentGroup, 'json');
    
        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }
    
    
    #[Route('/{id}', name: 'update', methods: ['PUT'])]
    public function update(ResidentGroup $residentGroup, 
                            Request $request, 
                            EntityManagerInterface $entityManager, 
                            SerializerInterface $serializer): Response
    {
            if(!$this->isGranted(ResidentGroupVoter::MODIFY)) {
                throw $this->createNotFoundException();
            }
        $requestData = $request->getContent();
        $updatedResidentGroup = $serializer->deserialize($requestData, ResidentGroup::class, 'json');
    
        $residentGroup->setNameGroup($updatedResidentGroup->getNameGroup());
        $residentGroup->setImageGroup($updatedResidentGroup->getImageGroup());
    
        $entityManager->flush();
    
        return new Response('Groupe de résidents a été mis à jour.', 200);
    }
}
