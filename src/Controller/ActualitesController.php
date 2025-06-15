<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ArticleRepository;
use App\Entity\Media;
use App\Repository\MediaRepository;




final class ActualitesController extends AbstractController
{
    #[Route('/actualites', name: 'app_actualites')]
    public function index(ArticleRepository $articleRepository, MediaRepository $repo): Response
    {
        $media = $repo->findBy([], ['uploadedAt' => 'DESC']);
        return $this->render('actualites/index.html.twig', [
            'controller_name' => 'ActualitesController',
            'articles' => $articleRepository->findBy([], ['publishedAt' => 'DESC']),
            'media' => $media
        ]);
    }

    #[Route('/', name: 'article_index')]
    public function indexar(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findBy([], ['publishedAt' => 'DESC']),
        ]);
    }

    #[Route('/media', name: 'media_home')]
    public function indexme(MediaRepository $repo): Response
    {
        $media = $repo->findBy([], ['uploadedAt' => 'DESC']);
        return $this->render('media/index.html.twig', [
            'media' => $media
        ]);
    }

    #[Route('/actu', name: 'actu')]
    public function indexart(MediaRepository $repo, ArticleRepository $articleRepository): Response
    {
        $media = $repo->findBy([], ['uploadedAt' => 'DESC']);
        return $this->render('article/lesarticles.html.twig', [
            'articles' => $articleRepository->findBy([], ['publishedAt' => 'DESC']),
        ]);
    }
}
