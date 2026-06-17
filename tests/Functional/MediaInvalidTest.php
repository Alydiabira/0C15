<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;
use App\Entity\Media;

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
        ]);

        $client->submit($form);

        // Le controller redirige → 302
        $this->assertResponseRedirects('/admin/media');
        $client->followRedirect();

        // Vérifier qu’aucun media n’a été créé
        $media = static::getContainer()
            ->get('doctrine')
            ->getRepository(Media::class)
            ->findOneBy(['title' => 'Test']);

        $this->assertNull($media);
    }
}
