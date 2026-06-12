<?php

namespace App\Tests\Functional\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;
use App\Tests\Functional\Traits\AdminTestTrait;

class AdminError404Test extends WebTestCase
{
    use AdminTestTrait;
    
    public function testAdminUnknownRouteReturns404(): void
    {
        $client = static::createClient();

        $admin = static::getContainer()
            ->get('doctrine')
            ->getRepository(User::class)
            ->findOneByEmail('ina@test.com');

        $client->loginUser($admin);

        $client->request('GET', '/admin/does-not-exist');

        $this->assertResponseStatusCodeSame(404);
    }
}
