<?php

namespace App\Tests\Functional;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

trait AuthenticatedTestTrait
{
    private function initSession(KernelBrowser $client): void
    {
        $session = $client->getContainer()->get('session');
        $session->start();
    }

    private function getAdminUser(): User
    {
        return self::getContainer()
            ->get('doctrine')
            ->getRepository(User::class)
            ->findOneBy(['email' => 'ina@test.com']);
    }

    private function getGuestUser(): User
    {
        return self::getContainer()
            ->get('doctrine')
            ->getRepository(User::class)
            ->findOneBy(['type' => 'invite']);
    }

    protected function loginAsAdmin(KernelBrowser $client): void
    {
        $this->initSession($client);
        $client->loginUser($this->getAdminUser(), 'main');
    }

    protected function loginAsGuest(KernelBrowser $client): void
    {
        $this->initSession($client);
        $client->loginUser($this->getGuestUser(), 'main');
    }
}
