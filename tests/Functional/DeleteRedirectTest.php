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

        // Token valide
        $client->request('POST', '/admin/album/delete/' . $album->getId(), [
            '_token' => 'delete_album_' . $album->getId(),
        ]);

        $this->assertResponseRedirects('/admin/album');
    }
}
