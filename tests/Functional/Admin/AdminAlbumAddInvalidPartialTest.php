<?php

namespace App\Tests\Functional\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;
use App\Repository\AlbumRepository;

class AdminAlbumAddInvalidPartialTest extends WebTestCase
{
    private function loginAdmin($client)
    {
        $admin = static::getContainer()->get(UserRepository::class)
            ->findOneByEmail('ina@test.com');

        $client->loginUser($admin);
    }

    public function testAlbumAddPartiallyInvalid(): void
    {
        $client = static::createClient();
        $this->loginAdmin($client);

        $crawler = $client->request('GET', '/admin/album/add');

        $form = $crawler->filter('form')->form([
            'album[name]' => '',   // invalide
        ]);

        $client->submit($form);

        // Le formulaire doit revenir sur la page
        $this->assertResponseStatusCodeSame(200);

        // Vérifier qu'une erreur est affichée
        $this->assertSelectorExists('.invalid-feedback, .form-errors');

        // Vérifier qu'aucun album n'a été créé
        $repo = static::getContainer()->get(AlbumRepository::class);
        $this->assertNull($repo->findOneBy(['name' => '']));
    }
}
