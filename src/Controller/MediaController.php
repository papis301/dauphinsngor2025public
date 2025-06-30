<?php
namespace App\Controller;

use App\Entity\Media;
use App\Form\MediaType;
use App\Repository\MediaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class MediaController extends AbstractController
{
    #[Route('/media', name: 'media_home')]
    public function index(MediaRepository $repo): Response
    {
        $media = $repo->findBy([], ['uploadedAt' => 'DESC']);
        return $this->render('media/index.html.twig', [
            'media' => $media
        ]);
    }

    #[Route('/galerie', name: 'galerie')]
    public function indexe(MediaRepository $repo): Response
    {
        $media = $repo->findBy([], ['uploadedAt' => 'DESC']);
        return $this->render('media/galerie.html.twig', [
            'media' => $media
        ]);
    }

    #[Route('/upload', name: 'media_upload')]
    public function upload(Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        $media = new Media();
        $form = $this->createForm(MediaType::class, $media);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('file')->getData();
            if ($file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

                $file->move(
                    $this->getParameter('media_directory'),
                    $newFilename
                );

                $media->setFilename($newFilename);
                $media->setUploadedAt(new \DateTimeImmutable());

                $em->persist($media);
                $em->flush();

                return $this->redirectToRoute('media_home');
            }
        }

        return $this->render('media/upload.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
