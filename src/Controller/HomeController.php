<?php
namespace App\Controller;

use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(ArticleRepository $articleRepository, CategoryRepository $categoryRepository): Response
    {
        $articles = $articleRepository->findAll();
        $categories = $categoryRepository->findAll();
        
        // dd($articles);
        
        return $this->render('home/home.html.twig', [
            'controller_name' => 'Bienvenue sur mon site !',
            'articles' => $articles,
            'categories' => $categories,

        ]);
    }  
    
    // #[Security("is_granted('ROLE_USER')")]
    #[Route('/show/{id}', name: 'show')]
    public function show(ArticleRepository $articleRepository,$id): Response
    {
        $article = $articleRepository->find($id);

        // dd($articles);

        return $this->render('home/show.html.twig', [
            'article' => $article,

        ]);
    }
    
    #[Route('/show/ArticleCategory/{id}', name: 'show_filter')]
    public function showCategory(Category $category ,CategoryRepository $categoryRepository): Response
    {

        $categories = $categoryRepository->findAll();

        if($category) {
            $articles = $category->getArticles()->getValues();

        }else {

            return $this->redirectToRoute('app_home');
        }
        return $this->render('home/home.html.twig', [
            'articles' => $articles,
            'categories' => $categories
        ]);
    }
}