<?php

namespace App\Tests\Functional\Security;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;

class RoleHierarchyTest extends WebTestCase
{
    public function testAdminHasUserRights(): void
    {
        $client = static::createClient();
        $admin = static::getContainer()->get(UserRepository::class)->findOneByEmail('ina@test.com');
        $client->loginUser($admin);

        $client->request('GET', '/guests');

        $this->assertResponseIsSuccessful();
    }
}
