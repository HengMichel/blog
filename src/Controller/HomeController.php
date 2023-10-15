<?php
namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(ArticleRepository $articleRepository): Response
    {

        $articles = $articleRepository->findAll();

        // dd($articles);
        return $this->render('home/home.html.twig', [
            'controller_name' => 'Bienvenue sur mon site !',
            'articles' => $articles,

        ]);
    }
    
    #[Route('/show/{id}', name: 'show')]
    public function show(ArticleRepository $articleRepository,$id): Response
    {

        $article = $articleRepository->find($id);

        // dd($articles);
        return $this->render('home/show.html.twig', [
            'article' => $article,

        ]);
    }

        
}