<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{
    private  $passwordEncoder;
    public function __construct(UserPasswordHasherInterface $passwordEncoder){
         $this->passwordEncoder = $$passwordEncoder ;
    }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setRole('ROLE_ADMIN');
        $user->setEmail('email@email.com');
        $user->setPassword( $passwordEncoder->hashPassword($user, "123456") );
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setUsername('user');
        $user->setRole('ROLE_USER');
        $user->setEmail('email@email.com');
        $user->setPassword( $this->passwordEncoder->hashPassword($user, "123456") );
        $manager->persist($user);
        $manager->flush();
    }
}
