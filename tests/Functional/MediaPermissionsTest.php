<?php

namespace App\Tests\Functional;

use App\Entity\User;
use App\Entity\Media;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class MediaPermissionsTest extends WebTestCase
{
    private EntityManagerInterface $em;

    private function initEm(): void
    {
        $this->em = static::getContainer()->get('doctrine')->getManager();
    }

    private function getIna(): User
    {
        return $this->em->getRepository(User::class)->findOneBy(['type' => 'ina']);
    }

    private function getGuest(): User
    {
        return $this->em->getRepository(User::class)->findOneBy(['type' => 'invite']);
    }

    private function getAnyMedia(): Media
    {
        return $this->em->getRepository(Media::class)->findOneBy([]);
    }

    private function getMediaOwnedByAnotherUser(User $guest): Media
    {
        return $this->em->getRepository(Media::class)->createQueryBuilder('m')
            ->andWhere('m.user != :guest')
            ->setParameter('guest', $guest)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function testGuestCannotAccessOthersMedia(): void
    {
        $client = static::createClient();
        $this->initEm(); // container OK après createClient()

        $guest = $this->getGuest();
        $client->loginUser($guest);

        $media = $this->getMediaOwnedByAnotherUser($guest);

        $client->request('POST', "/admin/media/delete/{$media->getId()}", [
            '_token' => 'invalid'
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }

    public function testInaCanAccessAllMedia(): void
    {
        $client = static::createClient();
        $this->initEm();

        $client->loginUser($this->getIna());

        $media = $this->getAnyMedia();

        $client->request('POST', "/admin/media/delete/{$media->getId()}", [
            '_token' => 'delete_media_' . $media->getId()
        ]);

        $this->assertResponseRedirects('/admin/media');
    }
}
