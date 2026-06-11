<?php

namespace App\Tests\Unit\Security;

use App\Entity\User;
use App\Security\UserChecker;
use PHPUnit\Framework\TestCase;

class UserCheckerTest extends TestCase
{
    public function testCheckPreAuthAllowsNormalUser(): void
    {
        $user = (new User())->setType('user');

        $checker = new UserChecker();
        $checker->checkPreAuth($user);

        $this->assertTrue(true);
    }

    public function testCheckPreAuthAllowsBlockedUser(): void
    {
        $user = (new User())->setType('blocked');

        $checker = new UserChecker();
        $checker->checkPreAuth($user);

        // Si aucune exception n’est lancée → OK
        $this->assertTrue(true);
    }

    public function testCheckPostAuthDoesNothing(): void
    {
        $user = (new User())->setType('user');

        $checker = new UserChecker();
        $checker->checkPostAuth($user);

        $this->assertTrue(true);
    }
}
