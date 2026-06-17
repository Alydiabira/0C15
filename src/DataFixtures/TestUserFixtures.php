<?php

namespace App\DataFixtures;

use App\Entity\Album;
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
        $ina->setRoles(['ROLE_ADMIN', 'ROLE_INA']);
        $ina->setPassword($this->hasher->hashPassword($ina, 'password'));
        $manager->persist($ina);

        // USER simple
        $user = new User();
        $user->setEmail('user@test.com');
        $user->setName('User');
        $user->setType('user');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->hasher->hashPassword($user, 'password'));
        $manager->persist($user);

        // BLOCKED USER
        $blocked = new User();
        $blocked->setEmail('blocked@test.com');
        $blocked->setName('Blocked');
        $blocked->setType('user');
        $blocked->setRoles(['ROLE_USER']);
        $blocked->setIsBlocked(true);
        $blocked->setPassword($this->hasher->hashPassword($blocked, 'password'));
        $manager->persist($blocked);

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

        // ALBUM lié à INA
        $album = new Album();
        $album->setName('Album Test');
        $album->setUser($ina);
        $manager->persist($album);

        // MEDIA lié à INA + Album
        $media1 = new Media();
        $media1->setTitle('Media Test');
        $media1->setPath('uploads/test.jpg');
        $media1->setUser($ina);
        $media1->setAlbum($album);
        $manager->persist($media1);

        // MEDIA lié à invite@test.com
        $media2 = new Media();
        $media2->setTitle('Media Invite');
        $media2->setPath('uploads/test2.jpg');
        $media2->setUser($invite);
        $manager->persist($media2);

        $manager->flush();
    }
}
