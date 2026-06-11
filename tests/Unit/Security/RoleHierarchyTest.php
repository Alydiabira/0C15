<?php

namespace App\Tests\Unit\Security;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Role\RoleHierarchy;

class RoleHierarchyTest extends TestCase
{
    private function getHierarchy(): RoleHierarchy
    {
        return new RoleHierarchy([
            'ROLE_ADMIN' => ['ROLE_USER'],
            'ROLE_INA'   => ['ROLE_ADMIN'],
        ]);
    }

    public function testAdminHasUserRole(): void
    {
        $hierarchy = $this->getHierarchy();

        $roles = $hierarchy->getReachableRoleNames(['ROLE_ADMIN']);

        $this->assertContains('ROLE_USER', $roles);
        $this->assertContains('ROLE_ADMIN', $roles);
        $this->assertCount(2, $roles);
    }

    public function testInaHasAdminAndUserRoles(): void
    {
        $hierarchy = $this->getHierarchy();

        $roles = $hierarchy->getReachableRoleNames(['ROLE_INA']);

        $this->assertContains('ROLE_INA', $roles);
        $this->assertContains('ROLE_ADMIN', $roles);
        $this->assertContains('ROLE_USER', $roles);

        // Vérifie la transitivité complète
        $this->assertCount(3, $roles);
    }

    public function testUnknownRoleReturnsItselfOnly(): void
    {
        $hierarchy = new RoleHierarchy([
            'ROLE_ADMIN' => ['ROLE_USER'],
            'ROLE_INA'   => ['ROLE_ADMIN'],
        ]);

        $roles = $hierarchy->getReachableRoleNames(['ROLE_UNKNOWN']);

        $this->assertSame(['ROLE_UNKNOWN'], $roles);
    }
}
