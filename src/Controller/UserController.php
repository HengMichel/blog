<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class UserController extends AbstractController
{
    // #[Route('/user', name: 'app_user')]
    // public function index(): Response
    // {
    //     return $this->render('user/user.html.twig', [
    //         'controller_name' => 'UserController',
    //     ]);
    // }

    #[Route('/user', name: 'app_user')]

    // public function index(Request $request, EntityManagerInterface $entityManager): Response
    public function index(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {

        $user = new User();
        $form = $this->createForm(UserFormType::class,$user);

        // handleRequest est une methode qui gere la verification de isSubmitted() et isValid()
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $plaintextPassword = $user->getPassword();
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            // Hasher le mot de passe avant de l'enregistrer
            $user->setPassword($hashedPassword);
            $entityManager->persist($user);
            $entityManager->flush();

            // $this->addFlash('success', 'Inscription réussie ! Vous pouvez maintenant vous connecter.');
            

            return $this->redirectToRoute('app_login');
            // return new RedirectResponse($this->generateUrl('app_home'));
        
        }

        return $this->render('user/user.html.twig', [
            'controller_name' => 'Inscrivez-vous',
            'user' => $form->createView()

        ]);
    }
}
