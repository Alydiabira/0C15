<?php

namespace App\Tests\Functional\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;
use App\Repository\UserRepository as InviteRepository;

class AdminInviteAddInvalidPartialTest extends WebTestCase
{
    private function loginAdmin($client)
    {
        $admin = static::getContainer()->get(UserRepository::class)
            ->findOneByEmail('ina@test.com');

        $client->loginUser($admin);
    }

    public function testInviteAddPartiallyInvalid(): void
    {
        $client = static::createClient();
        $this->loginAdmin($client);

        $crawler = $client->request('GET', '/admin/invites/new');

        $this->assertResponseStatusCodeSame(200);

        // Formulaire partiellement invalide : email invalide
        $form = $crawler->filter('form')->form([
            'invite[email]' => 'not-an-email',   // ❌ invalide
            'invite[name]' => 'OK',              // ✔ valide
            'invite[plainPassword]' => '123456', // ✔ valide
        ]);

        $client->submit($form);

        // Le formulaire doit revenir sur la page
        $this->assertResponseStatusCodeSame(200);

        // Vérifier qu'une erreur est affichée
        $this->assertSelectorExists('.invalid-feedback, .form-errors');

        // Vérifier qu'aucun invité n'a été créé
        $repo = static::getContainer()->get(UserRepository::class);
        $this->assertNull(
            $repo->findOneBy(['name' => 'OK']),
            'Aucun invité ne doit être créé si le formulaire est invalide.'
        );
    }
}
