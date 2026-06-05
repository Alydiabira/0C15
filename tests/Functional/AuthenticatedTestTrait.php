<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;

trait AuthenticatedTestTrait
{
    private function authenticateUser(KernelBrowser $client, string $email): void
    {
        $container = static::getContainer();

        $user = $container->get('doctrine')
            ->getRepository(\App\Entity\User::class)
            ->findOneBy(['email' => $email]);

        $client->loginUser($user, 'main');
    }

    public function loginAsAdmin(KernelBrowser $client): void
    {
        $this->authenticateUser($client, 'ina@test.com');
    }

    public function loginAsGuest(KernelBrowser $client): void
    {
        $this->authenticateUser($client, 'guest@test.com');
    }
}
