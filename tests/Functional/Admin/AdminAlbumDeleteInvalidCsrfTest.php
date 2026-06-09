<?php

namespace App\Tests\Functional\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;
use App\Repository\AlbumRepository;

class AdminAlbumDeleteInvalidCsrfTest extends WebTestCase
{
    private function loginAdmin($client)
    {
        $admin = static::getContainer()->get(UserRepository::class)
            ->findOneByEmail('ina@test.com');

        $client->loginUser($admin);
    }

    public function testDeleteAlbumInvalidCsrf(): void
    {
        $client = static::createClient();
        $this->loginAdmin($client);

        $albumRepo = static::getContainer()->get(AlbumRepository::class);
        $album = $albumRepo->findOneBy([]);

        // Génère automatiquement la bonne route : /admin/album/delete/{id}
        $url = static::getContainer()->get('router')->generate('admin_album_delete', [
            'id' => $album->getId()
        ]);

        $client->request('POST', $url, [
            '_token' => 'invalid_token'
        ]);

        // Ton controller redirige TOUJOURS vers admin_album_index
        $this->assertResponseRedirects('/admin/album');

        // Vérifier que l’album n’a PAS été supprimé
        $this->assertNotNull(
            $albumRepo->find($album->getId()),
            'L’album ne doit PAS être supprimé si le CSRF est invalide.'
        );
    }
}
