<?php

namespace App\Tests\Functional\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;

class AdminMedia404Test extends WebTestCase
{
    private function loginAdmin($client)
    {
        $admin = static::getContainer()->get(UserRepository::class)->findOneByEmail('ina@test.com');
        $client->loginUser($admin);
    }

    public function testEditMediaNotFound(): void
    {
        $client = static::createClient();
        $this->loginAdmin($client);

        $client->request('GET', '/admin/media/999999/edit');
        $this->assertResponseStatusCodeSame(404);
    }

    public function testDeleteMediaNotFound(): void
    {
        $client = static::createClient();
        $this->loginAdmin($client);

        $client->request('POST', '/admin/media/999999/delete', [
            '_token' => 'invalid'
        ]);

        $this->assertResponseStatusCodeSame(404);
    }
}
