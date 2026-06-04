<?php

namespace App\Tests\Functional;

use App\Entity\Media;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class MediaPermissionsTest extends WebTestCase
{
    private \Symfony\Bundle\FrameworkBundle\KernelBrowser $client;
    private EntityManagerInterface $em;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->em = static::getContainer()->get('doctrine')->getManager();
    }

    private function getUserByEmail(string $email): User
    {
        $user = $this->em->getRepository(User::class)->findOneBy(['email' => $email]);
        self::assertNotNull($user, "User $email must exist in fixtures");

        return $user;
    }

    private function getAnyMedia(): Media
    {
        $media = $this->em->getRepository(Media::class)->findOneBy([]);
        self::assertNotNull($media, 'At least one Media must exist in fixtures');

        return $media;
    }

    public function testGuestCannotAccessOthersMedia(): void
    {
        $guest = $this->getUserByEmail('invite@test.com');
        $this->client->loginUser($guest, 'main'); // ← FIX

        $media = $this->getAnyMedia();

        $this->client->request('POST', "/admin/media/delete/{$media->getId()}", [
            '_token' => 'invalid',
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }

    public function testInaCanAccessAllMedia(): void
    {
        $ina = $this->getUserByEmail('ina@test.com');
        $this->client->loginUser($ina, 'main'); // ← FIX

        $media = $this->getAnyMedia();

        $this->client->request('POST', "/admin/media/delete/{$media->getId()}", [
            '_token' => 'delete_media_'.$media->getId(),
        ]);

        $this->assertResponseRedirects('/admin/media');
    }
}
