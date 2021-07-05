<?php

namespace App\Controller;

use App\Repository\LinksRepository;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    /**
     * @Route("/", name="home")
     */ 
    public function index( LinksRepository $linksRepository): Response
    {
        if ($this->security->isGranted('ROLE_SUPER_ADMIN') || $this->security->isGranted('ROLE_ADMIN') || $this->security->isGranted('ROLE_USER') ) {
         
        return $this->render('index.html.twig', [
            'title' => 'Navigation',
            'links' => $linksRepository->findAll(),
        ]);
        }else{
         return $this->redirectToRoute("app_login");
        }
    }
    
}
