<?php

namespace App\Tests\Functional\Traits;

trait ErrorTestTrait
{
    protected function assert404(string $url): void
    {
        $client = static::createClient();
        $client->request('GET', $url);

        $this->assertResponseStatusCodeSame(404);
    }
}
