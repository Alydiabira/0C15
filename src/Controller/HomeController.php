<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\User;
use App\Repository\AlbumRepository;
use App\Repository\MediaRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return $this->render('front/home.html.twig');
    }

    #[Route('/guests', name: 'guests')]
    public function guests(UserRepository $userRepository): Response
    {
        return $this->render('front/guests.html.twig', [
            // Tous les invités = type = 'invite'
            'guests' => $userRepository->findBy(['type' => 'invite']),
        ]);
    }

    #[Route('/guest/{id}', name: 'guest')]
    public function guest(User $guest): Response
    {
        return $this->render('front/guest.html.twig', [
            'guest' => $guest,
        ]);
    }

    #[Route('/portfolio/{id}', name: 'portfolio', requirements: ['id' => '\d+'], defaults: ['id' => null])]
    public function portfolio(
        ?Album $album,
        AlbumRepository $albumRepository,
        MediaRepository $mediaRepository,
        UserRepository $userRepository
    ): Response {
        // Tous les albums
        $albums = $albumRepository->findAll();

        // Ina = type = 'ina'
        $ina = $userRepository->findOneBy(['type' => 'ina']);

        // Si un album est sélectionné → afficher ses médias
        // Sinon → afficher les médias d’Ina
        $medias = $album
            ? $mediaRepository->findBy(['album' => $album])
            : $mediaRepository->findBy(['user' => $ina]);

        return $this->render('front/portfolio.html.twig', [
            'albums' => $albums,
            'album' => $album,
            'medias' => $medias,
        ]);
    }

    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('front/about.html.twig');
    }
}
