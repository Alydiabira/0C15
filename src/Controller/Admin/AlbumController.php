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
    public function delete(Request $request, Album $album, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_INA');

        $token = (string) $request->request->get('_token');

        if ($this->isCsrfTokenValid('delete_album_'.$album->getId(), $token)) {
            $em->remove($album);
            $em->flush();
        }

        return $this->redirectToRoute('admin_album_index');
    }
}
