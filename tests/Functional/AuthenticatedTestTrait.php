<?php

namespace App\Tests\Functional;

use App\Entity\User;
use App\Entity\Media;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;

trait AuthenticatedTestTrait
{
    private $databaseTool;

    protected function setUp(): void
    {
        parent::setUp();

        // Charge automatiquement les fixtures test
        $this->databaseTool = static::getContainer()
            ->get(DatabaseToolCollection::class)
            ->get();

        $this->databaseTool->loadFixtures([
            \App\DataFixtures\TestUserFixtures::class,
        ]);
    }

    protected function em(): EntityManagerInterface
    {
        return static::getContainer()->get(EntityManagerInterface::class);
    }

    protected function getAdminUser(): User
    {
        return $this->em()->getRepository(User::class)
            ->findOneBy(['email' => 'ina@test.com']);
    }

    protected function getUser(): User
    {
        return $this->em()->getRepository(User::class)
            ->findOneBy(['email' => 'user@test.com']);
    }

    protected function getGuestUser(): User
    {
        return $this->em()->getRepository(User::class)
            ->findOneBy(['email' => 'guest@test.com']);
    }

    protected function loginAsAdmin(KernelBrowser $client): void
    {
        $client->loginUser($this->getAdminUser());
    }

    protected function loginAsGuest(KernelBrowser $client): void
    {
        $client->loginUser($this->getGuestUser());
    }

    protected function createMediaForUser(User $user): Media
    {
        $media = new Media();
        $media->setTitle('Test media');
        $media->setPath('uploads/test.jpg');
        $media->setUser($user);

        $this->em()->persist($media);
        $this->em()->flush();

        return $media;
    }

    protected function generateCsrfToken(string $id, KernelBrowser $client): string
    {
        $session = $client->getRequest()->getSession();
        if (!$session->isStarted()) {
            $session->start();
        }

        $requestStack = static::getContainer()->get('request_stack');
        $request = $client->getRequest();
        $request->setSession($session);
        $requestStack->push($request);

        return static::getContainer()
            ->get('security.csrf.token_manager')
            ->getToken($id)
            ->getValue();
    }
}
