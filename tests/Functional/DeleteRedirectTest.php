<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;
use App\Entity\Album;

class DeleteRedirectTest extends WebTestCase
{
    public function testDeleteAlbumRedirectsToIndex(): void
    {
        $client = static::createClient();

        // Connexion admin
        $admin = static::getContainer()
            ->get('doctrine')
            ->getRepository(User::class)
            ->findOneByEmail('ina@test.com');

        $client->loginUser($admin);

        // Récupération d'un album existant
        $album = static::getContainer()
            ->get('doctrine')
            ->getRepository(Album::class)
            ->findOneBy([]);

        // Envoi du POST vers la bonne route + bon token
        $client->request('POST', '/admin/album/delete/'.$album->getId(), [
            '_token' => 'delete_album_'.$album->getId(),
        ]);

        // Vérification de la redirection
        $this->assertResponseRedirects('/admin/album');
    }
}
