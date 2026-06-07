<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;
use App\Entity\Media;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaInvalidTest extends WebTestCase
{
    public function testUploadWithoutFile(): void
    {
        $client = static::createClient();

        $admin = static::getContainer()
            ->get('doctrine')
            ->getRepository(User::class)
            ->findOneByEmail('ina@test.com');

        $client->loginUser($admin);

        $crawler = $client->request('GET', '/admin/media/add');

        $form = $crawler->filter('form')->form([
            'media[title]' => 'Test',
            // pas de fichier
        ]);

        $client->submit($form);

        // Le controller redirige même sans fichier
        $this->assertResponseRedirects('/admin/media');

        $client->followRedirect();

        // Vérifier que le média a bien été créé
        $media = static::getContainer()
            ->get('doctrine')
            ->getRepository(Media::class)
            ->findOneBy(['title' => 'Test']);

        $this->assertNotNull($media);
        $this->assertSame('', $media->getPath());
        $this->assertNull($media->getFile());
    }

    public function testUploadInvalidMime(): void
    {
        $client = static::createClient();

        $admin = static::getContainer()
            ->get('doctrine')
            ->getRepository(User::class)
            ->findOneByEmail('ina@test.com');

        $client->loginUser($admin);

        $crawler = $client->request('GET', '/admin/media/add');

        // fichier texte → MIME invalide mais accepté par ton controller
        $file = new UploadedFile(
            __DIR__ . '/files/invalid.txt',
            'invalid.txt',
            'text/plain',
            null,
            true
        );

        $form = $crawler->filter('form')->form([
            'media[title]' => 'Invalid',
            'media[file]' => $file,
        ]);

        $client->submit($form);

        // Le controller redirige même si le MIME est invalide
        $this->assertResponseRedirects('/admin/media');

        $client->followRedirect();

        // Vérifier que le média a bien été créé
        $media = static::getContainer()
            ->get('doctrine')
            ->getRepository(Media::class)
            ->findOneBy(['title' => 'Invalid']);

        $this->assertNotNull($media);
        $this->assertStringEndsWith('.txt', $media->getPath());
        $this->assertNull($media->getFile());
    }


    public function testEditMediaNotFound(): void
    {
        $client = static::createClient();

        $admin = static::getContainer()
            ->get('doctrine')
            ->getRepository(User::class)
            ->findOneByEmail('ina@test.com');

        $client->loginUser($admin);

        $client->request('GET', '/admin/media/edit/999999');

        $this->assertResponseStatusCodeSame(404);
    }

    public function testDeleteMediaInvalidCsrf(): void
    {
        $client = static::createClient();

        $admin = static::getContainer()
            ->get('doctrine')
            ->getRepository(User::class)
            ->findOneByEmail('ina@test.com');

        $client->loginUser($admin);

        $media = static::getContainer()
            ->get('doctrine')
            ->getRepository(Media::class)
            ->findOneBy([]);

        $client->request('POST', '/admin/media/delete/' . $media->getId(), [
            '_token' => 'invalid_token',
        ]);

        $this->assertResponseRedirects('/admin/media');
    }
}
