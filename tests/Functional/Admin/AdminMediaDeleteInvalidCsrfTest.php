<?php

namespace App\Tests\Functional\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;
use App\Repository\MediaRepository;

class AdminMediaDeleteInvalidCsrfTest extends WebTestCase
{
    private function loginAdmin($client)
    {
        $admin = static::getContainer()->get(UserRepository::class)
            ->findOneByEmail('ina@test.com');

        $client->loginUser($admin);
    }

    public function testDeleteMediaInvalidCsrf(): void
    {
        $client = static::createClient();
        $this->loginAdmin($client);

        $mediaRepo = static::getContainer()->get(MediaRepository::class);
        $media = $mediaRepo->findOneBy([]);

        // Génère automatiquement la bonne route delete
        $url = static::getContainer()->get('router')->generate('admin_media_delete', [
            'id' => $media->getId()
        ]);

        $client->request('POST', $url, [
            '_token' => 'invalid_token'
        ]);

        // Ton controller redirige TOUJOURS vers admin_media_index
        $this->assertTrue(
            $client->getResponse()->isRedirection() ||
                $client->getResponse()->isSuccessful()
        );

        // Vérifier que le média n’a PAS été supprimé
        $this->assertNotNull(
            $mediaRepo->find($media->getId()),
            'Le média ne doit PAS être supprimé si le CSRF est invalide.'
        );
    }
}
