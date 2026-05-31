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
        // ADMIN TEST
        $admin = new User();
        $admin->setEmail('admin_test@example.com');
        $admin->setName('Admin Test');
        $admin->setType('ina');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->hasher->hashPassword($admin, 'password'));
        $manager->persist($admin);

        // INVITE TEST
        $invite = new User();
        $invite->setEmail('invite_test@example.com');
        $invite->setName('Invite Test');
        $invite->setType('invite');
        $invite->setRoles(['ROLE_USER']);
        $invite->setPassword($this->hasher->hashPassword($invite, 'password'));
        $manager->persist($invite);

        // GUEST TEST
        $guest = new User();
        $guest->setEmail('guest_test@example.com');
        $guest->setName('Guest Test');
        $guest->setType('guest');
        $guest->setRoles(['ROLE_USER']);
        $guest->setPassword($this->hasher->hashPassword($guest, 'password'));
        $manager->persist($guest);

        // MEDIA lié à invite_test@example.com
        $media = new Media();
        $media->setTitle('Media test');
        $media->setPath('uploads/test.jpg');
        $media->setUser($invite);
        $manager->persist($media);

        $manager->flush();
    }
}
