<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Media;
use App\Form\MediaType;
use App\Repository\MediaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

final class HelloController extends AbstractController
{
    #[Route('/', name: 'app_hello')]
    public function index(): Response
    {
        return $this->render('hello/index.html.twig', [
            'controller_name' => 'HelloController',
        ]);
    }

    #[Route('/club', name: 'club')]
    public function indexe(): Response
    {
        return $this->render('hello/leclub.html.twig', [
            'controller_name' => 'HelloController',
        ]);
    }

    #[Route('/apropos', name: 'apropos')]
    public function indexeS(): Response
    {
        return $this->render('hello/apropos.html.twig', [
            'controller_name' => 'HelloController',
        ]);
    }
}
