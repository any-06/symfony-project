<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $hasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new User();
        $user->setPrenom('Anyou')
            ->setNom('Ali')
            ->setAge(27)
            ->setUsername('any-06')
            ->setEmail('anyou@anyou.com')
            ->setPassword($this->hasher->hashPassword($user, 'test1234'))
            ->setRoles(["ROLE_ADMIN"])
            ->setVille('VALENCE');

        $manager->persist($user);

        $manager->flush();
    }
}
