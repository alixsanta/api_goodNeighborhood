<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=0; $i < 20; $i ++){
            $user = new User();
            $user->setFirstNameUser("nom de l'utilisateur " . $i);
            $user->setLastNameUser("prénom de l'utilisateur " . $i);
            $user->setImageProfil("image du profil " . $i);
            $user->setMailUser("mail utilisateur " . $i);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
