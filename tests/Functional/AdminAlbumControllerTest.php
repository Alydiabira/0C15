<?php

namespace App\Tests\Functional;

use App\Entity\Album;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\ORM\EntityManagerInterface;

class AdminAlbumControllerTest extends WebTestCase
{
    use AuthenticatedTestTrait;

    public function test_index_access(): void
    {
        $client = static::createClient();
        $this->loginAsAdmin($client);

        $client->request('GET', '/admin/album');
        $this->assertResponseIsSuccessful();
    }

    public function test_index_denied_for_guest(): void
    {
        $client = static::createClient();
        $this->loginAsGuest($client);

        $client->request('GET', '/admin/album');
        $this->assertResponseStatusCodeSame(403);
    }

    public function test_add_album_valid(): void
    {
        $client = static::createClient();
        $this->loginAsAdmin($client);

        $crawler = $client->request('GET', '/admin/album/add');

        $form = $crawler->selectButton('Ajouter')->form([
            'album[name]' => 'Nouvel Album Test',
        ]);

        $client->submit($form);

        $this->assertResponseRedirects('/admin/album');
    }

    public function test_add_album_invalid(): void
    {
        $client = static::createClient();
        $this->loginAsAdmin($client);

        $crawler = $client->request('GET', '/admin/album/add');

        $form = $crawler->selectButton('Ajouter')->form([
            'album[name]' => '',
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(200);
        $this->assertSelectorExists('.invalid-feedback');
    }

    public function test_update_album(): void
    {
        $client = static::createClient();
        $this->loginAsAdmin($client);

        $em = static::getContainer()->get(EntityManagerInterface::class);

        $album = new Album();
        $album->setName('Album Original');
        $em->persist($album);
        $em->flush();

        $crawler = $client->request('GET', '/admin/album/update/' . $album->getId());

        $form = $crawler->selectButton('Modifier')->form([
            'album[name]' => 'Album Modifié',
        ]);

        $client->submit($form);
        $this->assertResponseRedirects('/admin/album');

        $em->clear();
        $album = $em->getRepository(Album::class)->find($album->getId());

        $this->assertSame('Album Modifié', $album->getName());
    }

    public function test_update_denied_for_guest(): void
    {
        $client = static::createClient();
        $this->loginAsGuest($client);

        $client->request('GET', '/admin/album/update/1');
        $this->assertResponseStatusCodeSame(403);
    }

    public function test_delete_album(): void
    {
        $client = static::createClient();
        $this->loginAsAdmin($client);

        $em = static::getContainer()->get(EntityManagerInterface::class);

        $album = new Album();
        $album->setName('Album à supprimer');
        $em->persist($album);
        $em->flush();

        // 1) Déclenche le firewall
        $client->request('GET', '/admin');

        // 2) Récupère la session DEPUIS LE REQUESTSTACK (méthode officielle Symfony 6.4)
        $requestStack = static::getContainer()->get('request_stack');
        $session = $requestStack->getSession();

        // 3) Génère le token CSRF
        $csrfToken = static::getContainer()
            ->get('security.csrf.token_manager')
            ->getToken('delete_album_' . $album->getId())
            ->getValue();

        // 4) Requête POST
        $client->request('POST', '/admin/album/delete/' . $album->getId(), [
            '_token' => $csrfToken,
        ]);

        $this->assertResponseRedirects('/admin/album');

        $em->clear();
        $deleted = $em->getRepository(Album::class)->find($album->getId());
        $this->assertNull($deleted);
    }
}
