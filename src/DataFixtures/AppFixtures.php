<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new User();
        $user->setPrenom('Stef')
            ->setNom('BK')
            ->setAge(50)
            ->setUsername('stefbk')
            ->setEmail('stef@stef.com')
            ->setPassword('0000')
            ->setRoles(["ROLE_ADMIN"])
            ->setVille('VALENCE');

        $manager->persist($user);

        $manager->flush();
    }
}
