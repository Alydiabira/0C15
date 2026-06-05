<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\BrowserKit\Cookie;

trait AuthenticatedTestTrait
{
    private function authenticateUser(KernelBrowser $client, string $email): void
    {
        $container = static::getContainer();

        // 1) Première requête pour initialiser la session
        $client->request('GET', '/');

        // 2) Récupérer la session RÉELLE du client
        $session = $client->getRequest()->getSession();

        // 3) Charger l'utilisateur
        $user = $container->get('doctrine')->getRepository(\App\Entity\User::class)
            ->findOneBy(['email' => $email]);

        // 4) Créer le token de sécurité
        $token = new UsernamePasswordToken(
            $user,
            'main',
            $user->getRoles()
        );

        // 5) Stocker le token dans la session du client
        $session->set('_security_main', serialize($token));
        $session->save();

        // 6) Mettre à jour le cookie du client
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
