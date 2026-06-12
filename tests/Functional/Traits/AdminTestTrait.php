<?php

namespace App\Tests\Functional\Traits;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

trait AdminTestTrait
{
    private function createIna(): User
    {
        $em = static::getContainer()->get(EntityManagerInterface::class);
        $hasher = static::getContainer()->get(UserPasswordHasherInterface::class);

        $repo = $em->getRepository(User::class);

        $user = $repo->findOneBy(['email' => 'ina@test.com']);

        if (!$user) {
            $user = new User();
            $user->setEmail('ina@test.com');
            $user->setRoles(['ROLE_INA']);
            $user->setIsBlocked(false);
            $hashed = $hasher->hashPassword($user, 'password');
            $user->setPassword($hashed);

            $em->persist($user);
            $em->flush();
        }

        return $user;
    }

    protected function loginAsAdmin($client): void
    {
        $user = $this->createIna();
        $client->loginUser($user);
    }
}
