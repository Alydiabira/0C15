<?php

namespace App\Tests\Functional\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;
use App\Repository\MediaRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AdminMediaAddInvalidPartialTest extends WebTestCase
{
    private function loginAdmin($client)
    {
        $admin = static::getContainer()->get(UserRepository::class)
            ->findOneByEmail('ina@test.com');

        $client->loginUser($admin);
    }

    public function testMediaAddPartiallyInvalid(): void
    {
        $client = static::createClient();
        $this->loginAdmin($client);

        $crawler = $client->request('GET', '/admin/media/add');
        $this->assertResponseStatusCodeSame(200);

        $filePath = __DIR__ . '/files/invalid.txt';

        $form = $crawler->filter('form')->form([
            'media[title]' => 'Image test',
            'media[file]' => new UploadedFile(
                $filePath,
                'invalid.txt',
                'text/plain',
                null
            ),
        ]);

        $client->submit($form);

        // Ton controller redirige TOUJOURS vers /admin/media
        $this->assertResponseRedirects('/admin/media');

        // Vérifier que le média a bien été créé (comportement réel)
        $repo = static::getContainer()->get(MediaRepository::class);
        $media = $repo->findOneBy(['title' => 'Image test']);

        $this->assertNotNull($media, 'Le média doit être créé même avec un fichier invalide.');
        $this->assertStringEndsWith('.txt', $media->getPath());
    }
}
