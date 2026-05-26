<?php

namespace App\Controller\Admin;

use App\Entity\Media;
use App\Form\MediaType;
use App\Repository\MediaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Route('/admin/media')]
class MediaController extends AbstractController
{
    #[Route('', name: 'admin_media_index', methods: ['GET'])]
    public function index(Request $request, MediaRepository $mediaRepository): Response
    {
        $page = $request->query->getInt('page', 1);

        // Si ce n'est pas INA → on ne voit que ses propres médias
        $criteria = [];
        if (!$this->isGranted('ROLE_INA')) {
            $criteria['user'] = $this->getUser();
        }

        $medias = $mediaRepository->findBy(
            $criteria,
            ['id' => 'ASC'],
            25,
            25 * ($page - 1)
        );

        $total = $mediaRepository->count($criteria);

        return $this->render('admin/media/index.html.twig', [
            'medias' => $medias,
            'total' => $total,
            'page' => $page,
        ]);
    }

    #[Route('/add', name: 'admin_media_add', methods: ['GET', 'POST'])]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $media = new Media();

        $form = $this->createForm(MediaType::class, $media, [
            'is_admin' => $this->isGranted('ROLE_INA'),
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Attribution automatique du user si ce n'est pas INA
            if (!$this->isGranted('ROLE_INA')) {
                $media->setUser($this->getUser());
            }

            /** @var UploadedFile|null $file */
            $file = $form->get('file')->getData();

            if ($file instanceof UploadedFile) {
                $filename = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move('uploads/', $filename);
                $media->setPath('uploads/' . $filename);
            }

            $em->persist($media);
            $em->flush();

            return $this->redirectToRoute('admin_media_index');
        }

        return $this->render('admin/media/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete/{id}', name: 'admin_media_delete', methods: ['POST'])]
    public function delete(Request $request, Media $media, EntityManagerInterface $em): Response
    {
        // Vérification des permissions
        if ($media->getUser() !== $this->getUser() && !$this->isGranted('ROLE_INA')) {
            throw $this->createAccessDeniedException();
        }

        $token = (string) $request->request->get('_token');

        if ($this->isCsrfTokenValid('delete_media_' . $media->getId(), $token)) {

            // Suppression du fichier physique
            if ($media->getPath() && is_file($media->getPath())) {
                unlink($media->getPath());
            }

            $em->remove($media);
            $em->flush();
        }

        return $this->redirectToRoute('admin_media_index');
    }

    #[Route('/edit/{id}', name: 'admin_media_update', methods: ['GET', 'POST'])]
    public function update(Request $request, Media $media, EntityManagerInterface $em): Response
    {
        // Vérification des permissions
        if ($media->getUser() !== $this->getUser() && !$this->isGranted('ROLE_INA')) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(MediaType::class, $media, [
            'is_admin' => $this->isGranted('ROLE_INA'),
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile|null $file */
            $file = $form->get('file')->getData();

            if ($file instanceof UploadedFile) {

                // Supprimer l'ancien fichier si présent
                if ($media->getPath() && is_file($media->getPath())) {
                    unlink($media->getPath());
                }

                $filename = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move('uploads/', $filename);
                $media->setPath('uploads/' . $filename);
            }

            $em->flush();

            return $this->redirectToRoute('admin_media_index');
        }

        return $this->render('admin/media/update.html.twig', [
            'form' => $form->createView(),
            'media' => $media,
        ]);
    }
}
