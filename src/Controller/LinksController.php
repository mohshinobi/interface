<?php

namespace App\Controller;

use App\Entity\Links;
use App\Form\LinksType;
use App\Repository\LinksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/links")
 * @IsGranted("ROLE_ADMIN")
 */
class LinksController extends AbstractController
{
    /**
     * @Route("/", name="links_index", methods={"GET"})
     */
    public function index(LinksRepository $linksRepository): Response
    {
        return $this->render('links/index.html.twig', [
            'links' => $linksRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="links_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $link = new Links();
        $form = $this->createForm(LinksType::class, $link);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($link);
            $entityManager->flush();

            return $this->redirectToRoute('links_index');
        }

        return $this->render('links/new.html.twig', [
            'link' => $link,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="links_show", methods={"GET"})
     */
    public function show(Links $link): Response
    {
        return $this->render('links/show.html.twig', [
            'link' => $link,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="links_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Links $link): Response
    {
        $form = $this->createForm(LinksType::class, $link);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('links_index');
        }

        return $this->render('links/edit.html.twig', [
            'link' => $link,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="links_delete", methods={"POST"})
     */
    public function delete(Request $request, Links $link): Response
    {
        if ($this->isCsrfTokenValid('delete'.$link->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($link);
            $entityManager->flush();
        }

        return $this->redirectToRoute('links_index');
    }
}
