<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Media;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $manager): void
    {
        // Ina
        $ina = new User();
        $ina->setEmail('ina@example.com');
        $ina->setName('Ina');
        $ina->setType('ina');
        $ina->setPassword($this->hasher->hashPassword($ina, 'password'));
        $manager->persist($ina);

        // Invités
        $invites = [];
        for ($i = 1; $i <= 3; $i++) {
            $guest = new User();
            $guest->setEmail("guest$i@example.com");
            $guest->setName("Guest $i");
            $guest->setType('invite');
            $guest->setPassword($this->hasher->hashPassword($guest, 'password'));
            $manager->persist($guest);
            $invites[] = $guest;
        }

        // Médias
        for ($i = 1; $i <= 10; $i++) {
            $media = new Media();
            $media->setTitle("Media $i");
            $media->setPath("uploads/test$i.jpg");
            $media->setUser($invites[array_rand($invites)]);
            $manager->persist($media);
        }

        $manager->flush();
    }
}
