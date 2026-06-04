<?php

namespace App\Tests\Functional;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaUploadTest extends WebTestCase
{
    use AuthenticatedTestTrait;

    private \Symfony\Bundle\FrameworkBundle\KernelBrowser $client;
    private EntityManagerInterface $em;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->em = static::getContainer()->get('doctrine')->getManager();
    }

    public function testUploadValidImage(): void
    {
        $this->loginAsAdmin($this->client);

        $path = __DIR__ . '/files/0001.jpg';

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
