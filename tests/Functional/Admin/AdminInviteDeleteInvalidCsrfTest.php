<?php

namespace App\Tests\Functional\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;
use App\Repository\InviteRepository;
use App\Entity\Invite;
use Doctrine\ORM\EntityManagerInterface;

class AdminInviteDeleteInvalidCsrfTest extends WebTestCase
{
    private function loginAdmin($client)
    {
        $admin = static::getContainer()->get(UserRepository::class)
            ->findOneByEmail('ina@test.com');

        $client->loginUser($admin);
    }

    public function testDeleteInviteInvalidCsrf(): void
    {
        $client = static::createClient();
        $this->loginAdmin($client);

        $em = static::getContainer()->get(EntityManagerInterface::class);
        $inviteRepo = static::getContainer()->get(InviteRepository::class);

        // Création d'une invitation valide (tous les champs NOT NULL)
        $invite = new Invite();
        $invite->setEmail('test-csrf@invite.com');
        $invite->setName('Test Invite');
        $invite->setIsBlocked(false);
        $invite->setCreatedAt(new \DateTimeImmutable());

        $em->persist($invite);
        $em->flush();

        // Génération automatique de la bonne route delete
        $url = static::getContainer()->get('router')->generate('admin_invite_delete', [
            'id' => $invite->getId()
        ]);

        // Envoi d'un token CSRF invalide
        $client->request('POST', $url, [
            '_token' => 'invalid_token'
        ]);

        // Le controller redirige toujours vers l'index
        $this->assertTrue(
            $client->getResponse()->isRedirection() ||
                $client->getResponse()->isSuccessful()
        );

        // Vérifier que l'invitation n'a PAS été supprimée
        $this->assertNotNull(
            $inviteRepo->find($invite->getId()),
            'L’invitation ne doit PAS être supprimée si le CSRF est invalide.'
        );
    }
}
