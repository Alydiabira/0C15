<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\InviteType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/invites')]
class InviteController extends AbstractController
{
    #[Route('', name: 'admin_invite_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_INA');

        $invites = $userRepository->findBy(['type' => 'invite']);

        return $this->render('admin/invites/index.html.twig', [
            'invites' => $invites,
        ]);
    }

    #[Route('/new', name: 'admin_invite_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher,
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_INA');

        $invite = new User();
        $invite->setType('invite');

        $form = $this->createForm(InviteType::class, $invite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = (string) $form->get('plainPassword')->getData();
            $hashedPassword = $passwordHasher->hashPassword($invite, $plainPassword);

            $invite->setPassword($hashedPassword);

            $em->persist($invite);
            $em->flush();

            return $this->redirectToRoute('admin_invite_index');
        }

        return $this->render('admin/invites/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/block', name: 'admin_invite_block', methods: ['POST'])]
    public function block(User $user, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_INA');

        $user->setIsBlocked(true);
        $em->flush();

        return $this->redirectToRoute('admin_invite_index');
    }

    #[Route('/{id}/delete', name: 'admin_invite_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_INA');

        $token = (string) $request->request->get('_token');

        if ($this->isCsrfTokenValid('delete_invite_'.$user->getId(), $token)) {
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('admin_invite_index');
    }

    #[Route('/revoke/{id}', name: 'admin_invite_revoke', methods: ['POST'])]
    public function revoke(User $user, EntityManagerInterface $em): Response
    {
        if (!$this->isGranted('ROLE_INA')) {
            throw $this->createAccessDeniedException();
        }

        $user->setIsBlocked(true);
        $em->flush();

        $this->addFlash('success', 'L’accès de cet invité a été révoqué.');

        return $this->redirectToRoute('admin_invite_index');
    }
}
