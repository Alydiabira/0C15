<?php

namespace App\Tests\Functional;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

trait AuthenticatedTestTrait
{
    private function getOrCreateUser(KernelBrowser $client, string $email, array $roles): User
    {
        $container = $client->getContainer();
        $em = $container->get(EntityManagerInterface::class);

        $repo = $em->getRepository(User::class);

        $user = $repo->findOneBy(['email' => $email]);

        if (!$user) {
            $user = new User();
            $user->setEmail($email);
            $user->setPassword('test'); // pas important en test
            $user->setRoles($roles);
            $user->setIsBlocked(false);

            $em->persist($user);
            $em->flush();
        }

        return $user;
    }

    private function authenticateUser(KernelBrowser $client, string $email, array $roles): void
    {
        $user = $this->getOrCreateUser($client, $email, $roles);
        $client->loginUser($user);
    }

    public function loginAsAdmin(KernelBrowser $client): void
    {
        $this->authenticateUser($client, 'ina@test.com', ['ROLE_ADMIN']);
    }

    public function loginAsGuest(KernelBrowser $client): void
    {
        $this->authenticateUser($client, 'guest@test.com', ['ROLE_USER']);
    }
}
