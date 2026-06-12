<?php

namespace App\Tests\Functional\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Media;
use App\Entity\User;

class AdminMediaDeleteInvalidCsrfTest extends WebTestCase
{
    private function loginAdmin($client)
    {
        $em = static::getContainer()->get('doctrine')->getManager();

        $admin = $em->getRepository(User::class)->findOneBy(['email' => 'ina@test.com']);

        if (!$admin) {
            $admin = new User();
            $admin->setEmail('ina@test.com');
            $admin->setPassword('x');
            $admin->setRoles(['ROLE_ADMIN']);
            $em->persist($admin);
            $em->flush();
        }

        $client->loginUser($admin);
    }

    public function testDeleteMediaInvalidCsrf(): void
    {
        $client = static::createClient();
        $this->loginAdmin($client);

        $em = static::getContainer()->get('doctrine')->getManager();

        // Toujours créer un media pour le test
        $media = new Media();
        $media->setTitle('Test');
        $media->setPath('x.jpg');
        $media->setUser($em->getRepository(User::class)->findOneBy(['email' => 'ina@test.com']));

        $em->persist($media);
        $em->flush();

        $url = static::getContainer()->get('router')->generate('admin_media_delete', [
            'id' => $media->getId()
        ]);

        $client->request('POST', $url, [
            '_token' => 'invalid_token'
        ]);

        // Redirection attendue
        $this->assertResponseRedirects('/admin/media');

        // Vérifier que le média existe toujours
        $this->assertNotNull(
            $em->getRepository(Media::class)->find($media->getId())
        );
    }
}
