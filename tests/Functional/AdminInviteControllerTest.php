<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminInviteControllerTest extends WebTestCase
{
    use AuthenticatedTestTrait;

    public function testAdminInviteIndex(): void
    {
        $client = static::createClient();
        $this->loginAsAdmin($client);

        $client->request('GET', '/admin/invites');
        $this->assertResponseIsSuccessful();
    }

    public function testAdminInviteNew(): void
    {
        $client = static::createClient();
        $this->loginAsAdmin($client);

        $client->request('GET', '/admin/invites/new');
        $this->assertResponseIsSuccessful();
    }
}
