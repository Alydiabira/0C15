<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MediaControllerTest extends WebTestCase
{
    use AuthenticatedTestTrait;

    public function testAdminMediaIndex(): void
    {
        $client = static::createClient();
        $this->loginAsAdmin($client);

        $client->request('GET', '/admin/media');

        $this->assertResponseIsSuccessful();
    }
}
