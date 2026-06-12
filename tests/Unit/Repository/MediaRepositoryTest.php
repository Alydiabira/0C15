<?php

namespace App\Tests\Functional\Repository;

use App\Entity\Media;
use App\Entity\User;
use App\Repository\MediaRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MediaRepositoryTest extends KernelTestCase
{
    private function resetDatabase(): void
    {
        $em = static::getContainer()->get('doctrine')->getManager();
        $connection = $em->getConnection();

        // Désactiver les FK
        $connection->executeStatement('SET FOREIGN_KEY_CHECKS = 0');

        // Supprimer les données
        $connection->executeStatement('DELETE FROM media');
        $connection->executeStatement('DELETE FROM user');

        // Réactiver les FK
        $connection->executeStatement('SET FOREIGN_KEY_CHECKS = 1');
    }


    public function testFindVisibleForAdmin(): void
    {
        self::bootKernel();
        $this->resetDatabase();

        $container = static::getContainer();
        $repo = $container->get(MediaRepository::class);
        $em = $container->get('doctrine')->getManager();

        $user = new User();
        $user->setEmail('a@test.com');
        $user->setPassword('x');
        $user->setIsBlocked(false);

        $media = new Media();
        $media->setUser($user);
        $media->setTitle('Test');
        $media->setPath('x.jpg');

        $em->persist($user);
        $em->persist($media);
        $em->flush();

        $results = $repo->findVisibleForAdmin(10, 0);

        $this->assertCount(1, $results);
        $this->assertSame($media, $results[0]);
    }

    public function testCountVisibleForAdmin(): void
    {
        self::bootKernel();
        $this->resetDatabase();

        $container = static::getContainer();
        $repo = $container->get(MediaRepository::class);
        $em = $container->get('doctrine')->getManager();

        $user = new User();
        $user->setEmail('b@test.com');
        $user->setPassword('x');
        $user->setIsBlocked(false);

        $media = new Media();
        $media->setUser($user);
        $media->setTitle('Test2');
        $media->setPath('y.jpg');

        $em->persist($user);
        $em->persist($media);
        $em->flush();

        $count = $repo->countVisibleForAdmin();

        $this->assertSame(1, $count);
    }
}
