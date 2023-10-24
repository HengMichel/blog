<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(ArticleRepository $articleRepository): Response
    {
        if($this->getUser()){
            $user = $this->getUser();
            $username = $user->getUsername();

            $articlesFindByUser = $articleRepository->findArticlesByUser($username);
        }

        return $this->render('account/account.html.twig', [
            'controller_name' => 'AccountController',

    ]);
    }
}
