<?php

namespace App\Tests\Unit\DataFixtures;

use App\DataFixtures\AppFixtures;
use App\Entity\User;
use App\Entity\Media;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\ReferenceRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixturesTest extends TestCase
{
    public function testLoadCreatesEntities(): void
    {
        $hasher = $this->createMock(UserPasswordHasherInterface::class);
        $hasher->method('hashPassword')->willReturn('hashed');

        $manager = $this->createMock(ObjectManager::class);

        // persist() doit être appelé 4 fois (3 users + 1 media)
        $manager->expects($this->exactly(4))
            ->method('persist')
            ->with($this->callback(
                fn($entity) =>
                $entity instanceof User || $entity instanceof Media
            ));

        $manager->expects($this->once())
            ->method('flush');

        // Mock du ReferenceRepository
        $referenceRepo = $this->createMock(ReferenceRepository::class);
        $referenceRepo->expects($this->exactly(4))
            ->method('addReference')
            ->with(
                $this->isType('string'),
                $this->callback(
                    fn($entity) =>
                    $entity instanceof User || $entity instanceof Media
                )
            );

        $fixtures = new AppFixtures($hasher);

        // Injection du ReferenceRepository dans la fixture
        $fixtures->setReferenceRepository($referenceRepo);

        // Exécution
        $fixtures->load($manager);

        $this->assertTrue(true);
    }
}
