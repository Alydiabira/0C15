<?php

namespace App\Tests\Functional\Traits;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;

trait ForbiddenTrait
{
    private KernelBrowser $client;

    public function setClient(KernelBrowser $client): void
    {
        $this->client = $client;
    }

    public function assertForbiddenOrRedirectToLogin(): void
    {
        $status = $this->client->getResponse()->getStatusCode();

        if ($status === 302) {
            $this->assertResponseRedirects('/login');
            return;
        }

        $this->assertSame(403, $status);
    }
}
