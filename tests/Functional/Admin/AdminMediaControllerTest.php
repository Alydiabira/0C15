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

    public function testIndexAsAdmin(): void
    {
        $client = static::createClient();
        $client->loginUser($this->getAdminUser());

        $client->request('GET', '/admin/media?page=1');
        $this->assertResponseIsSuccessful();
    }

    public function testIndexAsUser(): void
    {
        $client = static::createClient();
        $client->loginUser($this->getUser());

        $client->request('GET', '/admin/media?page=1');
        $this->assertResponseStatusCodeSame(403);
    }

    public function test_media_index_denied_for_guest(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->loginAsGuest($client);

        $client->request('GET', '/admin/media');
        $this->assertResponseStatusCodeSame(403);
    }

    public function testAdminMediaAdd(): void
    {
        $client = static::createClient();
        $this->loginAsAdmin($client);

        $client->request('GET', '/admin/media/add');
        $this->assertResponseIsSuccessful();
    }

    public function test_media_add_denied_for_guest(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->loginAsGuest($client);

        $client->request('GET', '/admin/media/add');
        $this->assertResponseStatusCodeSame(403);
    }

    public function testAddInvalid(): void
    {
        $client = static::createClient();
        $client->loginUser($this->getUser());

        $client->request('POST', '/admin/media/add', [
            'media' => ['title' => '']
        ]);

        $this->assertResponseStatusCodeSame(403);
    }

    public function testDeleteValid(): void
    {
        $client = static::createClient();
        $user = $this->getUser(); // ROLE_USER
        $client->loginUser($user);

        $client->request('GET', '/'); // session OK

        $media = $this->createMediaForUser($user);

        $client->request('POST', '/admin/media/delete/' . $media->getId(), [
            '_token' => $this->generateCsrfToken('delete_media_' . $media->getId(), $client)
        ]);

        // Un utilisateur normal n'a PAS accès à /admin/media/delete
        $this->assertResponseStatusCodeSame(403);
    }


    public function testUpdateInvalid(): void
    {
        $client = static::createClient();
        $user = $this->getUser();
        $client->loginUser($user);

        $client->request('GET', '/');

        $media = $this->createMediaForUser($user);

        $client->request('POST', '/admin/media/edit/' . $media->getId(), [
            'media' => ['title' => '']
        ]);

        $this->assertResponseStatusCodeSame(403);
    }
}
