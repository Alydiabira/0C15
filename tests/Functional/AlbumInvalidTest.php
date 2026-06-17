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

        // Création d’un album
        $em = static::getContainer()->get('doctrine')->getManager();
        $album = new Album();
        $album->setName('Test Album');   // <-- CORRECTION ICI
        $album->setUser($admin);
        $em->persist($album);
        $em->flush();

        // Mauvais token
        $client->request('POST', '/admin/album/delete/' . $album->getId(), [
            '_token' => 'invalid_token',
        ]);

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

        $client->request('GET', '/admin/album/edit/999999');

        $this->assertResponseStatusCodeSame(404);
    }
}
