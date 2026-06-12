<?php

namespace App\Tests\Functional\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;
use App\Entity\Media;

class AdminMediaRedirectTest extends WebTestCase
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

    public function testEditMediaRedirectsToIndex(): void
    {
        $client = static::createClient();
        $this->loginAdmin($client);

        $em = static::getContainer()->get('doctrine')->getManager();

        // Créer un media
        $media = new Media();
        $media->setTitle('Test');
        $media->setPath('x.jpg');
        $media->setUser($em->getRepository(User::class)->findOneBy(['email' => 'ina@test.com']));

        $em->persist($media);
        $em->flush();

        // Accès à la page d’édition
        $crawler = $client->request('GET', '/admin/media/edit/' . $media->getId());

        // Sélection FIABLE du formulaire
        $form = $crawler->filter('form[name="media"]')->form([
            'media[title]' => 'Updated title',
        ]);

        $client->submit($form);

        // Redirection attendue
        $this->assertResponseRedirects('/admin/media');
    }
}
