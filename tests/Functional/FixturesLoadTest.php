<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;
use App\Entity\Album;
use App\Entity\Media;

class FixturesLoadTest extends WebTestCase
{
    use AuthenticatedTestTrait;   // <-- CORRECTION ICI

    public function testFixturesLoad(): void
    {
        $client = static::createClient();

        // Charge les fixtures test
        $this->loadTestFixtures();

        $em = static::getContainer()->get('doctrine')->getManager();

        $users  = $em->getRepository(User::class)->findAll();
        $albums = $em->getRepository(Album::class)->findAll();
        $medias = $em->getRepository(Media::class)->findAll();

        $this->assertNotEmpty($users);

        // ⚠️ Ces deux lignes ne passeront que si tu ajoutes album + media dans TestUserFixtures
        $this->assertNotEmpty($albums);
        $this->assertNotEmpty($medias);
    }
}
