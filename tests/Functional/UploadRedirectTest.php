<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;

class UploadRedirectTest extends WebTestCase
{
    public function testUploadRedirectsToMediaIndex(): void
    {
        $client = static::createClient();

        $admin = static::getContainer()
            ->get('doctrine')
            ->getRepository(User::class)
            ->findOneByEmail('ina@test.com');

        $client->loginUser($admin);

        $client->request('POST', '/admin/media/upload', [
            'media_upload[file]' => [
                'name' => 'test.jpg',
                'type' => 'image/jpeg',
                'tmp_name' => __DIR__.'/../../fixtures/test.jpg',
                'error' => 0,
                'size' => 1024,
            ],
        ]);

        $this->assertResponseRedirects('/admin/media');
    }
}
