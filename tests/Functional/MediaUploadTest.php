<?php

namespace App\Tests\Functional;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaUploadTest extends WebTestCase
{
    private EntityManagerInterface $em;

    protected function setUp(): void
    {
        self::ensureKernelShutdown();
        $client = static::createClient();

        // Accès à Doctrine
        $this->em = $client->getContainer()->get('doctrine')->getManager();
    }

    private function getIna(): User
    {
        return $this->em->getRepository(User::class)->findOneBy(['type' => 'ina']);
    }

    public function testUploadValidImage(): void
    {
        $client = static::createClient();
        $client->loginUser($this->getIna());

        // Fichier de test
        $file = new UploadedFile(
            __DIR__ . '/files/test.jpg',
            'test.jpg',
            'image/jpeg',
            null,
            true
        );

        $client->request('POST', '/admin/media/add', [], [
            'media[file]' => $file
        ]);

        $this->assertResponseRedirects('/admin/media');
    }
}
