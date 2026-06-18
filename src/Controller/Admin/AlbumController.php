<?php

namespace App\Controller\Admin;

use App\Entity\Album;
use App\Form\AlbumType;
use App\Repository\AlbumRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Csrf\CsrfToken;

#[Route('/admin/album')]
class AlbumController extends AbstractController
{
    #[Route('', name: 'admin_album_index', methods: ['GET'])]
    public function index(AlbumRepository $albumRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_INA');

        return $this->render('admin/album/index.html.twig', [
            'albums' => $albumRepository->findAll(),
        ]);
    }

    #[Route('/add', name: 'admin_album_add', methods: ['GET', 'POST'])]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_INA');

        $album = new Album();
        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // 🔥 Correction obligatoire
            $album->setUser($this->getUser());

            $em->persist($album);
            $em->flush();

            return $this->redirectToRoute('admin_album_index');
        }

        return $this->render('admin/album/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/update/{id}', name: 'admin_album_update', methods: ['GET', 'POST'])]
    public function update(Request $request, Album $album, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_INA');

        // 🔥 Correction : fallback si l’album n’a pas de user (cas des tests)
        if (!$album->getUser()) {
            $album->setUser($this->getUser());
        }

        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->flush();

            return $this->redirectToRoute('admin_album_index');
        }

        return $this->render('admin/album/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete/{id}', name: 'admin_album_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        Album $album,
        EntityManagerInterface $em,
        CsrfTokenManagerInterface $csrfTokenManager
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_INA');

        $token = $request->request->get('_token');

        if ($csrfTokenManager->isTokenValid(new CsrfToken('delete_album_' . $album->getId(), $token))) {
            $em->remove($album);
            $em->flush();
        }

        return $this->redirectToRoute('admin_album_index');
    }
}
