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

    // Charger la page qui contient le formulaire
    $crawler = $client->request('GET', '/admin/album');

    // Sélectionner le formulaire correspondant à cet album
    $form = $crawler
        ->filter('form[action="/admin/album/delete/'.$album->getId().'"]')
        ->form();

    // Soumettre le formulaire (le token CSRF est déjà dedans)
    $client->submit($form);

    $this->assertResponseRedirects('/admin/album');

    $em->clear();
    $deleted = $em->getRepository(Album::class)->find($album->getId());
    $this->assertNull($deleted);
}



}
