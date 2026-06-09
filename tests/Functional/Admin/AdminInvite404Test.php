<?php

namespace App\Tests\Functional\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;

class AdminInvite404Test extends WebTestCase
{
    private function loginAdmin($client)
    {
        $admin = static::getContainer()->get(UserRepository::class)->findOneByEmail('ina@test.com');
        $client->loginUser($admin);
    }

    public function testEditInviteNotFound(): void
    {
        $client = static::createClient();
        $this->loginAdmin($client);

        $client->request('GET', '/admin/invites/999999/edit');
        $this->assertResponseStatusCodeSame(404);
    }

    public function testDeleteInviteNotFound(): void
    {
        $client = static::createClient();
        $this->loginAdmin($client);

        $client->request('POST', '/admin/invites/999999/delete', [
            '_token' => 'invalid'
        ]);

        $this->assertResponseStatusCodeSame(404);
    }
}
