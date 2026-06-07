<?php

namespace App\Tests\Functional\Admin;

use App\Tests\Functional\AuthenticatedTestTrait;
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

    public function test_media_index_denied_for_guest(): void
    {
        $client = static::createClient();

        $client->request('GET', '/'); // initialise la session
        $this->loginAsGuest($client);

        $client->request('GET', '/admin/media');

        $this->assertResponseStatusCodeSame(403);
    }

    public function test_media_add_denied_for_guest(): void
    {
        $client = static::createClient();

        $client->request('GET', '/'); // initialise la session
        $this->loginAsGuest($client);

        $client->request('GET', '/admin/media/add');

        $this->assertResponseStatusCodeSame(403);
    }
}
