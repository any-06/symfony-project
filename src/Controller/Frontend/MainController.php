<?php

namespace App\Controller\Frontend;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Classe Main Controller pour Page d'Accueil
 */
class MainController extends AbstractController
{
    public function __construct(ArticleRepository $repoArticle)
    {
        $this->repoArticle = $repoArticle;
    }

    /**
     * Affiche la Page d'Accueil
     *
     * @Route("/", name="home")
     * @return Response
     */
    public function index(): Response
    {
        //Récupère tous les Articles
        $articles = $this->repoArticle->findAll();

        return $this->render('Frontend/Home/index.html.twig', [
            'articles' => $articles
        ]);
    }
}
