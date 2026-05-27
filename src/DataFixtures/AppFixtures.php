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
        // INA (admin)
        $ina = new User();
        $ina->setEmail('ina@test.com');
        $ina->setName('Ina');
        $ina->setType('ina');
        $ina->setRoles(['ROLE_INA']); // ← indispensable
        $ina->setPassword($this->hasher->hashPassword($ina, 'password'));
        $manager->persist($ina);

        // INVITE (guest)
        $invite = new User();
        $invite->setEmail('invite@test.com');
        $invite->setName('Invite');
        $invite->setType('invite');
        $invite->setRoles(['ROLE_USER']); // ← indispensable
        $invite->setPassword($this->hasher->hashPassword($invite, 'password'));
        $manager->persist($invite);

        // MEDIA pour les tests
        $media = new Media();
        $media->setTitle("Media test");
        $media->setPath("uploads/test.jpg");
        $media->setUser($invite);
        $manager->persist($media);

        $manager->flush();
    }
}
