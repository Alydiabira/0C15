<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;

class AdminAlbumRedirectTest extends WebTestCase
{
    public function testCreateAlbumRedirectsToIndex(): void
    {
        $client = static::createClient();

        $admin = static::getContainer()
            ->get('doctrine')
            ->getRepository(User::class)
            ->findOneByEmail('ina@test.com');

        $client->loginUser($admin);

        // La bonne route est /admin/album/add
        $crawler = $client->request('GET', '/admin/album/add');

        // Sélection du formulaire par son nom (fiable)
        $form = $crawler->filter('form[name="album"]')->form([
            'album[name]' => 'Album Test',
        ]);

        $client->submit($form);

        $this->assertResponseRedirects('/admin/album');
    }
}
