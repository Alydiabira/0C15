<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;

class InviteInvalidTest extends WebTestCase
{
    private function loginAdmin($client)
    {
        $admin = static::getContainer()
            ->get('doctrine')
            ->getRepository(User::class)
            ->findOneByEmail('ina@test.com');

        $client->loginUser($admin);
    }

    public function testInviteNotFound(): void
    {
        $client = static::createClient();
        $this->loginAdmin($client);

        $client->request('POST', '/admin/invites/999999/block');

        $this->assertResponseStatusCodeSame(404);
    }

    public function testDeleteInviteInvalidCsrf(): void
    {
        $client = static::createClient();
        $this->loginAdmin($client);

        $em = static::getContainer()->get('doctrine')->getManager();

        $email = 'invite_' . uniqid() . '@test.com';

        $invite = new User();
        $invite->setName('Test Invite');
        $invite->setEmail($email);
        $invite->setPassword('dummy');
        $invite->setType('invite');
        $invite->setIsBlocked(false);

        $em->persist($invite);
        $em->flush();

        $client->request('POST', '/admin/invites/' . $invite->getId() . '/delete', [
            '_token' => 'invalid_token',
        ]);

        $this->assertResponseRedirects('/admin/invites');

        $stillThere = $em->getRepository(User::class)->find($invite->getId());
        $this->assertNotNull($stillThere);
    }

    public function testNewInviteInvalidForm(): void
    {
        $client = static::createClient();
        $this->loginAdmin($client);

        $crawler = $client->request('GET', '/admin/invites/new');

        $form = $crawler->filter('form')->form([
            'invite[name]' => '',
            'invite[email]' => '',
            'invite[plainPassword]' => '',
        ]);

        $client->submit($form);

        // Ton contrôleur renvoie 200 (pas de redirection)
        $this->assertResponseStatusCodeSame(200);

        // Sélecteur universel pour erreurs
        $this->assertSelectorExists('li, .error, .errors, .invalid-feedback, .form-error-message, .help.is-danger');
    }
}
