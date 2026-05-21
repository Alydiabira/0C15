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

#[Route('/admin/media')]
class MediaController extends AbstractController
{
    #[Route('', name: 'admin_media_index', methods: ['GET'])]
    public function index(Request $request, MediaRepository $mediaRepository): Response
    {
        $page = $request->query->getInt('page', 1);

        // 🔐 Si ce n’est pas Ina → ne voir que ses propres médias
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

        $total = $mediaRepository->count([]);

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

            // 🔐 Un invité ne peut ajouter un média que pour lui-même
            if (!$this->isGranted('ROLE_INA')) {
                $media->setUser($this->getUser());
            }

            // Upload du fichier
            if ($media->getFile()) {
                $filename = md5(uniqid()) . '.' . $media->getFile()->guessExtension();
                $media->setPath('uploads/' . $filename);
                $media->getFile()->move('uploads/', $filename);
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
        // 🔐 Un invité ne peut supprimer que ses propres médias
        if ($media->getUser() !== $this->getUser() && !$this->isGranted('ROLE_INA')) {
            throw $this->createAccessDeniedException();
        }

        if ($this->isCsrfTokenValid('delete_media_' . $media->getId(), $request->request->get('_token'))) {

            if (file_exists($media->getPath())) {
                unlink($media->getPath());
            }

            $em->remove($media);
            $em->flush();
        }

        return $this->redirectToRoute('admin_media_index');
    }
}
