<?php

namespace App\DataFixtures;

use App\Entity\Media;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class TestUserFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['test'];
    }

    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $manager): void
    {
        // INA (admin)
        $ina = new User();
        $ina->setEmail('ina@test.com');
        $ina->setName('Ina');
        $ina->setType('ina');
        $ina->setRoles(['ROLE_ADMIN']);
        $ina->setPassword($this->hasher->hashPassword($ina, 'password'));
        $manager->persist($ina);

        // INVITE
        $invite = new User();
        $invite->setEmail('invite@test.com');
        $invite->setName('Invite');
        $invite->setType('invite');
        $invite->setRoles(['ROLE_USER']);
        $invite->setPassword($this->hasher->hashPassword($invite, 'password'));
        $manager->persist($invite);

        // GUEST
        $guest = new User();
        $guest->setEmail('guest@test.com');
        $guest->setName('Guest');
        $guest->setType('guest');
        $guest->setRoles(['ROLE_USER']);
        $guest->setPassword($this->hasher->hashPassword($guest, 'password'));
        $manager->persist($guest);

        // MEDIA lié à invite@test.com
        $media = new Media();
        $media->setTitle('Media test');
        $media->setPath('uploads/test.jpg');
        $media->setUser($invite);
        $manager->persist($media);

        $manager->flush();
    }
}
