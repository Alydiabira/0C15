<?php

namespace App\Tests\Functional\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;

class AdminAlbum404Test extends WebTestCase
{
    private function loginAdmin($client)
    {
        $admin = static::getContainer()->get(UserRepository::class)->findOneByEmail('ina@test.com');
        $client->loginUser($admin);
    }

    public function testShowAlbumNotFound(): void
    {
        $client = static::createClient();
        $this->loginAdmin($client);

        $client->request('GET', '/admin/album/999999');
        $this->assertResponseStatusCodeSame(404);
    }

    public function testEditAlbumNotFound(): void
    {
        $client = static::createClient();
        $this->loginAdmin($client);

        $client->request('GET', '/admin/album/999999/edit');
        $this->assertResponseStatusCodeSame(404);
    }

    public function testDeleteAlbumNotFound(): void
    {
        $client = static::createClient();
        $this->loginAdmin($client);

        $client->request('POST', '/admin/album/999999/delete', [
            '_token' => 'invalid'
        ]);

        $this->assertResponseStatusCodeSame(404);
    }
}
