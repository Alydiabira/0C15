<?php

namespace App\Service;

use App\DataFixtures\AppFixtures;
use Doctrine\ORM\EntityManagerInterface;

class FixtureLoader
{
    public function __construct(
        private EntityManagerInterface $em,
        private AppFixtures $fixtures
    ) {}

    public function load(): void
    {
        $this->fixtures->load($this->em);
    }
}
