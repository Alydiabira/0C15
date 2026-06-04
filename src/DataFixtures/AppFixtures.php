<?php

namespace App\DataFixtures;

use App\Entity\Media;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture implements FixtureGroupInterface
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public static function getGroups(): array
    {
        return ['dev'];
    }

    public function load(ObjectManager $manager): void
    {
        // INA (admin)
        $ina = new User();
        $ina->setEmail('ina@test.com');
        $ina->setName('Ina');
        $ina->setType('ina');
        $ina->setRoles(['ROLE_ADMIN', 'ROLE_INA']);
        $ina->setPassword($this->hasher->hashPassword($ina, 'password'));
        $manager->persist($ina);
        $this->addReference('user_ina', $ina);

        // INVITE
        $invite = new User();
        $invite->setEmail('invite@test.com');
        $invite->setName('Invite');
        $invite->setType('invite');
        $invite->setRoles(['ROLE_USER']);
        $invite->setPassword($this->hasher->hashPassword($invite, 'password'));
        $manager->persist($invite);
        $this->addReference('user_invite', $invite);

        // GUEST
        $guest = new User();
        $guest->setEmail('guest@test.com');
        $guest->setName('Guest');
        $guest->setType('guest');
        $guest->setRoles(['ROLE_USER']);
        $guest->setPassword($this->hasher->hashPassword($guest, 'password'));
        $manager->persist($guest);
        $this->addReference('user_guest', $guest);

        // MEDIA
        $media = new Media();
        $media->setTitle('Media test');
        $media->setPath('uploads/test.jpg');
        $media->setUser($invite);
        $manager->persist($media);
        $this->addReference('media_test', $media);

        $manager->flush();
    }
}
