<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ErrorControllerTest extends WebTestCase
{
    public function testNotFoundPage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/route-inexistante-123');

        $this->assertResponseStatusCodeSame(404);
    }
}
