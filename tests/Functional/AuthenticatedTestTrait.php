<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\BrowserKit\Cookie;

trait AuthenticatedTestTrait
{
    private function createSession(KernelBrowser $client): SessionInterface
    {
        $container = static::getContainer();

        // Symfony 6.3+ : session.factory obligatoire
        $sessionFactory = $container->get('session.factory');
        $session = $sessionFactory->createSession();
        $session->start();

        return $session;
    }

    private function authenticateUser(KernelBrowser $client, string $email): void
    {
        $container = static::getContainer();
        $session = $this->createSession($client);

        $user = $container->get('doctrine')->getRepository(\App\Entity\User::class)
            ->findOneBy(['email' => $email]);

        $token = new UsernamePasswordToken(
            $user,
            'main',
            $user->getRoles()
        );

        $session->set('_security_main', serialize($token));
        $session->save();

        $client->getCookieJar()->set(
            new Cookie($session->getName(), $session->getId())
        );
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
