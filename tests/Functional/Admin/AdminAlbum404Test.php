<?php

namespace App\Tests\Functional\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Tests\Functional\Traits\AdminTestTrait;

class AdminAlbum404Test extends WebTestCase
{
    use AdminTestTrait;

    public function testShowAlbumNotFound(): void
    {
        $client = static::createClient();
        $this->loginAsAdmin($client);

        $client->request('GET', '/admin/album/999999');
        $this->assertResponseStatusCodeSame(404);
    }

    public function testEditAlbumNotFound(): void
    {
        $client = static::createClient();
        $this->loginAsAdmin($client);

        $client->request('GET', '/admin/album/999999/edit');
        $this->assertResponseStatusCodeSame(404);
    }

    public function testDeleteAlbumNotFound(): void
    {
        $client = static::createClient();
        $this->loginAsAdmin($client);

        $client->request('POST', '/admin/album/999999/delete', [
            '_token' => 'invalid'
        ]);

        $this->assertResponseStatusCodeSame(404);
    }
}
