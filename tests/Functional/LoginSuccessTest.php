<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Tests\Functional\Traits\AdminTestTrait;

class LoginSuccessTest extends WebTestCase
{
    use AdminTestTrait;

    public function testLoginSuccess(): void
    {
        $client = static::createClient();

        $this->createIna();

        $crawler = $client->request('GET', '/admin/login');

        $form = $crawler->filter('form')->form([
            'email' => 'ina@test.com',
            'password' => 'password',
        ]);

        $client->submit($form);

        $this->assertResponseRedirects('/admin/media');
    }
}
