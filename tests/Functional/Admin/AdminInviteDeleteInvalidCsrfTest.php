<?php

namespace App\Tests\Functional\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class AdminInviteDeleteInvalidCsrfTest extends WebTestCase
{
    private function loginAdmin($client)
    {
        $admin = static::getContainer()->get(UserRepository::class)
            ->findOneByEmail('ina@test.com');

        $client->loginUser($admin);
    }

    public function testDeleteInviteInvalidCsrf(): void
    {
        $client = static::createClient();
        $this->loginAdmin($client);

        $em = static::getContainer()->get(EntityManagerInterface::class);

        // Email unique pour éviter les collisions
        $uniqueEmail = 'test-csrf-' . uniqid() . '@invite.com';

        $invite = new User();
        $invite->setEmail($uniqueEmail);
        $invite->setName('Test Invite');
        $invite->setType('invite');
        $invite->setIsBlocked(false);
        $invite->setPassword('dummy');

        $em->persist($invite);
        $em->flush();

        $url = static::getContainer()->get('router')->generate('admin_invite_delete', [
            'id' => $invite->getId()
        ]);

        // Token CSRF invalide
        $client->request('POST', $url, [
            '_token' => 'invalid_token'
        ]);

        // Ton contrôleur renvoie 302 → on attend 302
        $this->assertResponseRedirects('/admin/invites', 302);

        // L’invitation ne doit PAS être supprimée
        $this->assertNotNull(
            $em->getRepository(User::class)->find($invite->getId())
        );
    }
}
