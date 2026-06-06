<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;

trait AuthenticatedTestTrait
{
    private function authenticateUser(KernelBrowser $client, string $email): void
    {
        // IMPORTANT : utiliser le container du client
        $container = $client->getContainer();

        $user = $container->get('doctrine')
            ->getRepository(\App\Entity\User::class)
            ->findOneBy(['email' => $email]);

        // loginUser écrit dans la session du client
        $client->loginUser($user);
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
