<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;
use App\Entity\Album;

class AlbumInvalidTest extends WebTestCase
{
    public function testDeleteAlbumInvalidCsrf(): void
    {
        $client = static::createClient();

        $admin = static::getContainer()
            ->get('doctrine')
            ->getRepository(User::class)
            ->findOneByEmail('ina@test.com');

        $client->loginUser($admin);

        $album = static::getContainer()
            ->get('doctrine')
            ->getRepository(Album::class)
            ->findOneBy([]);

        // Mauvais token
        $client->request('POST', '/admin/album/delete/'.$album->getId(), [
            '_token' => 'invalid_token',
        ]);

        // Le controller ne supprime pas → redirection vers index
        $this->assertResponseRedirects('/admin/album');
    }

    public function testAlbumNotFound(): void
    {
        $client = static::createClient();

        $admin = static::getContainer()
            ->get('doctrine')
            ->getRepository(User::class)
            ->findOneByEmail('ina@test.com');

        $client->loginUser($admin);

        // ID impossible
        $client->request('GET', '/admin/album/edit/999999');

        $this->assertResponseStatusCodeSame(404);
    }
}
