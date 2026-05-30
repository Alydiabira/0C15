<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminMediaControllerTest extends WebTestCase
{
    use AuthenticatedTestTrait;

    public function testAdminMediaIndex(): void
    {
        $client = static::createClient();
        $this->loginAsAdmin($client);

        $client->request('GET', '/admin/media');
        $this->assertResponseIsSuccessful();
    }

    public function testAdminMediaAdd(): void
    {
        $client = static::createClient();
        $this->loginAsAdmin($client);

        $client->request('GET', '/admin/media/add');
        $this->assertResponseIsSuccessful();
    }
}
