<?php

namespace App\Tests\Functional\Security;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class BlockedUserTest extends WebTestCase
{
    private function createBlockedUser(): User
    {
        $em = static::getContainer()->get(EntityManagerInterface::class);
        $repo = $em->getRepository(User::class);

        $user = $repo->findOneBy(['email' => 'blocked@test.com']);

        if (!$user) {
            $user = new User();
            $user->setEmail('blocked@test.com');
            $user->setPassword('x');
            $user->setRoles(['ROLE_USER']);
            $user->setIsBlocked(true);

            $em->persist($user);
            $em->flush();
        }

        return $user;
    }

    public function testBlockedUserCannotAccessProtectedRoutes(): void
    {
        $client = static::createClient();
        $blocked = $this->createBlockedUser();

        $client->loginUser($blocked);

        $client->request('GET', '/admin/media');

        $this->assertResponseStatusCodeSame(403);
    }
}
