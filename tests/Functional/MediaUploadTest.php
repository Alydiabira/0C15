<?php

namespace App\Tests\Functional;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaUploadTest extends WebTestCase
{
    private \Symfony\Bundle\FrameworkBundle\KernelBrowser $client;
    private EntityManagerInterface $em;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->em = static::getContainer()->get('doctrine')->getManager();
    }

    private function getUserByEmail(string $email): User
    {
        return $this->em->getRepository(User::class)->findOneBy(['email' => $email]);
    }

    public function testUploadValidImage(): void
    {
        $ina = $this->getUserByEmail('ina@test.com');

        // Authentification sur le firewall admin
        $this->client->loginUser($ina, 'admin');

        $path = __DIR__.'/files/0001.jpg';

        $file = new UploadedFile(
            $path,
            '0001.jpg',
            'image/jpeg',
            null,
            true
        );

        $this->client->request('POST', '/admin/media/upload', [], [
            'media' => $file,
        ]);

        $this->assertResponseRedirects('/admin/media');
    }
}
