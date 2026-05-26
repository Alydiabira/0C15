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
        // INA
        $ina = new User();
        $ina->setEmail('ina@test.com');   // ← attendu par les tests
        $ina->setName('Ina');
        $ina->setType('ina');
        $ina->setPassword($this->hasher->hashPassword($ina, 'password'));
        $manager->persist($ina);

        // INVITE
        $invite = new User();
        $invite->setEmail('invite@test.com'); // ← attendu par les tests
        $invite->setName('Invite');
        $invite->setType('invite');
        $invite->setPassword($this->hasher->hashPassword($invite, 'password'));
        $manager->persist($invite);

        // MEDIA pour les tests
        $media = new Media();
        $media->setTitle("Media test");
        $media->setPath("uploads/test.jpg");
        $media->setUser($invite); // un média appartenant à l'invité
        $manager->persist($media);

        $manager->flush();
    }
}
