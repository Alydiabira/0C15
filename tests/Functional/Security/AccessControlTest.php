<?php

namespace App\Tests\Functional\Security;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;

class AccessControlTest extends WebTestCase
{
    private function getOrCreateUser(string $email, array $roles): User
    {
        $em = static::getContainer()->get('doctrine')->getManager();
        $repo = $em->getRepository(User::class);

        $user = $repo->findOneBy(['email' => $email]);

        if (!$user) {
            $user = new User();
            $user->setEmail($email);
            $user->setPassword('x'); // pas important en test
            $user->setRoles($roles);
            $user->setIsBlocked(false);

            $em->persist($user);
            $em->flush();
        }

        return $user;
    }

    private function loginUserByEmail($client, string $email, array $roles)
    {
        $em = static::getContainer()->get('doctrine')->getManager();
        $repo = $em->getRepository(User::class);

        $user = $repo->findOneBy(['email' => $email]);

        if (!$user) {
            $user = new User();
            $user->setEmail($email);
            $user->setPassword('x');
        }

        $user->setRoles($roles);
        $user->setIsBlocked(false);

        $em->persist($user);
        $em->flush();

        $client->loginUser($user);
    }


    public function testGuestIsRedirectedFromAdmin(): void
    {
        $client = static::createClient();
        $client->request('GET', '/admin/album');

        $this->assertResponseRedirects('/admin/login');
    }

    public function testUserCannotAccessAdmin(): void
    {
        $client = static::createClient();

        // USER simple → ROLE_USER
        $this->loginUserByEmail($client, 'user@test.com', ['ROLE_USER']);

        $client->request('GET', '/admin/album');

        // Comportement attendu : 403
        $this->assertResponseStatusCodeSame(403);
    }

    public function testAdminCanAccessAdmin(): void
    {
        $client = static::createClient();

        // IMPORTANT : ton contrôleur exige ROLE_INA
        $this->loginUserByEmail($client, 'ina@test.com', ['ROLE_INA']);

        $client->request('GET', '/admin/album');

        $this->assertResponseIsSuccessful();
    }
}
