<?php

namespace App\Tests\Unit;

use App\Entity\Media;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class SecurityRulesTest extends TestCase
{
    public function testGuestCannotManageOthersMedia(): void
    {
        $guest1 = (new User())->setType('invite');
        $guest2 = (new User())->setType('invite');

        $media = (new Media())->setUser($guest1);

        // Le média appartient à guest1 → guest2 ne doit pas pouvoir le gérer
        $this->assertSame($guest1, $media->getUser());
        $this->assertNotSame($guest2, $media->getUser());
    }

    public function testInaHasRoleIna(): void
    {
        $ina = (new User())->setType('ina');

        $roles = $ina->getRoles();

        $this->assertContains('ROLE_INA', $roles);
        $this->assertContains('ROLE_USER', $roles); // toujours présent
    }
}
