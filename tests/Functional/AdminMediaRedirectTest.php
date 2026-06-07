<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;
use App\Entity\Media;

class AdminMediaRedirectTest extends WebTestCase
{
    public function testEditMediaRedirectsToIndex(): void
    {
        $client = static::createClient();

        // Connexion admin
        $admin = static::getContainer()
            ->get('doctrine')
            ->getRepository(User::class)
            ->findOneByEmail('ina@test.com');

        $client->loginUser($admin);

        // Récupération d'un média existant
        $media = static::getContainer()
            ->get('doctrine')
            ->getRepository(Media::class)
            ->findOneBy([]);

        // Accès à la bonne route
        $crawler = $client->request('GET', '/admin/media/edit/' . $media->getId());

        // Sélection FIABLE du formulaire
        $form = $crawler->filter('form')->form([
            'media[title]' => 'Updated title',
        ]);

        $client->submit($form);

        // Redirection attendue
        $this->assertResponseRedirects('/admin/media');
    }
}
