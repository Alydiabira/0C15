<?php

namespace App\Tests\Functional;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

trait AuthenticatedTestTrait
{
    private function getTestUser(): User
    {
        $user = self::getContainer()
            ->get('doctrine')
            ->getRepository(User::class)
            ->findOneBy(['email' => 'ina@test.com']);

        if (!$user) {
            throw new \Exception("User 'ina@test.com' not found in test database.");
        }

        return $user;
    }

    protected function loginAsAdmin(KernelBrowser $client): void
    {
        $client->loginUser($this->getTestUser(), 'admin');
    }

    protected function loginAsUser(KernelBrowser $client): void
    {
        $client->loginUser($this->getTestUser(), 'main');
    }
}
