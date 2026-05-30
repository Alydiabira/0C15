<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminAlbumControllerTest extends WebTestCase
{
    use AuthenticatedTestTrait;

    public function testAdminAlbumIndex(): void
    {
        $client = static::createClient();
        $this->loginAsAdmin($client);

        $client->request('GET', '/admin/album');
        $this->assertResponseIsSuccessful();
    }

    public function testAdminAlbumAdd(): void
    {
        $client = static::createClient();
        $this->loginAsAdmin($client);

        $client->request('GET', '/admin/album/add');
        $this->assertResponseIsSuccessful();
    }
}
