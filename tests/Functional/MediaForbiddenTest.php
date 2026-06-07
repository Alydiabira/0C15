<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MediaForbiddenTest extends WebTestCase
{
    public function testGuestIsRedirectedWhenAccessingMedia(): void
    {
        $client = static::createClient();

        $client->request('GET', '/admin/media');

        $this->assertResponseRedirects('/admin/login');
    }
}
