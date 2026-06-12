<?php

namespace App\Tests\Functional\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Tests\Functional\Traits\AdminTestTrait;

class AdminInvite404Test extends WebTestCase
{
    use AdminTestTrait;

    public function testEditInviteNotFound(): void
    {
        $client = static::createClient();
        $this->loginAsAdmin($client);

        $client->request('GET', '/admin/invites/999999/edit');
        $this->assertResponseStatusCodeSame(404);
    }

    public function testDeleteInviteNotFound(): void
    {
        $client = static::createClient();
        $this->loginAsAdmin($client);

        $client->request('POST', '/admin/invites/999999/delete', [
            '_token' => 'invalid'
        ]);

        $this->assertResponseStatusCodeSame(404);
    }
}
