<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]

     public function index(AuthenticationUtils $authenticationUtils): Response
    {
       // get the login error if there is one
       $error = $authenticationUtils->getLastAuthenticationError();

      // last username entered by the user
       $lastUsername = $authenticationUtils->getLastUsername();


       $this->addFlash('success', 'Inscription réussie ! Vous pouvez maintenant vous connecter.');


    // dd($error);
    return $this->render('login/login.html.twig', [

        'controller_name' => 'Connexion',
        'last_username' => $lastUsername,
        'error'  => $error,
        ]);
    }
}
