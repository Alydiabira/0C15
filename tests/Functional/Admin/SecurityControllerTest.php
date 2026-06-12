<?php

namespace App\Tests\Functional\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Tests\Functional\Traits\AdminTestTrait;

class SecurityControllerTest extends WebTestCase
{
    use AdminTestTrait;

    public function testAdminLoginPageLoads(): void
    {
        $client = static::createClient();

        $client->request('GET', '/admin/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('form');
    }

    public function testAdminLoginInvalid(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/login');

        $form = $crawler->filter('form')->form([
            'email' => 'wrong@test.com',
            'password' => 'wrongpass',
        ]);

        $client->submit($form);

        $this->assertResponseRedirects('/admin/login');

        $crawler = $client->followRedirect();
        $this->assertSelectorExists('.alert-danger');
    }

    public function testAdminLoginSuccess(): void
    {
        $client = static::createClient();

        $this->createIna(); // ← obligatoire

        $crawler = $client->request('GET', '/admin/login');

        $form = $crawler->filter('form')->form([
            'email' => 'ina@test.com',
            'password' => 'password',
        ]);

        $client->submit($form);

        $this->assertResponseRedirects('/admin/media');
    }
}
