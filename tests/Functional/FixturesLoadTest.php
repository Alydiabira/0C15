<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;
use App\Entity\Album;
use App\Entity\Media;

class FixturesLoadTest extends WebTestCase
{
    public function testFixturesLoad(): void
    {
        self::bootKernel();

        $em = static::getContainer()->get('doctrine')->getManager();

        $users  = $em->getRepository(User::class)->findAll();
        $albums = $em->getRepository(Album::class)->findAll();
        $medias = $em->getRepository(Media::class)->findAll();

        $this->assertNotEmpty($users);
        $this->assertNotEmpty($albums);
        $this->assertNotEmpty($medias);
    }
}
