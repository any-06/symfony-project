<?php

namespace App\Controller\Backend;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/user')]
class UserController extends AbstractController
{
    /**
     * Constrtucteur of UserController
     * 
     * @param UserRepository $repoUser
     */
    public function __construct(
        private UserRepository $repoUser
    ) {
    }

    #[Route('', name: 'admin.user.index')]
    public function indexUser(): Response
    {
        //Récupérer tous les Users
        $users = $this->repoUser->findAll();

        return $this->render('Backend/User/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin.user.edit')]
    public function editUser(?User $user, Request $request): Response|RedirectResponse
    {
        if (!$user instanceof User) {
            $this->addFlash('error', 'l\'id de l\'utilisateur n\'existe pas');

            return $this->redirectToRoute('admin.index.user');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->repoUser->add($user, true);
            $this->addFlash('success', 'User modifié avec succès');

            return $this->redirectToRoute('admin.user.index');
        }

        return $this->renderForm('Backend/User/edit.html.twig', [
            'form' => $form,
            'user' => $user
        ]);
    }

    #[Route('/{id}/delete', name: 'admin.user.delete', methods: ['POST'])]
    public function deleteUser(?User $user, Request $request): RedirectResponse
    {
        if (!$user instanceof User) {
            $this->addFlash('error', 'User not found');

            return $this->redirectToRoute('admin.user.index');
        }

        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->get('_token'))) {
            $this->repoUser->remove($user, true);

            $this->addFlash('success', 'Utilisateur supprimé avec succès');

            return $this->redirectToRoute('admin.user.index');
        }
    }
}