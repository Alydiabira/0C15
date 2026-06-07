<?php

namespace App\Tests\Functional\Traits;

use App\Tests\Functional\Traits\ErrorTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class Error404Test extends WebTestCase
{
    use ErrorTestTrait;

    public function test404(): void
    {
        $this->assert404('/route-inexistante');
    }
}
