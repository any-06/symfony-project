<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setPrenom('Anyou')
            ->setNom('Ali')
            ->setAge(27)
            ->setUsername('any-06')
            ->setEmail('anyou@anyou.com')
            ->setPassword($this->hasher->hashPassword($user, 'test1234'))
            ->setRoles(["ROLE_ADMIN"])
            ->setVille('Valence');

        $manager->persist($user);

        $manager->flush();
    }
}
