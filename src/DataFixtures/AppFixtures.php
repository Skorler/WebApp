<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setUsername('name '.$i);
            $user->setPassword(mt_rand(10, 100));
            $user->setRoles((array)'ROLE_USER');
            $manager->persist($user);
        }

        $manager->flush();
    }
}
