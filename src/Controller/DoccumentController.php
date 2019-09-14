<?php

namespace App\Controller;

use App\Entity\Doccument;
use App\Form\DoccumentType;
use App\Repository\DoccumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/doccument")
 */
class DoccumentController extends AbstractController
{
    /**
     * @Route("/", name="doccument_index", methods={"GET"})
     */
    public function index(DoccumentRepository $doccumentRepository): Response
    {
        return $this->render('doccument/index.html.twig', [
            'doccuments' => $doccumentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{type}", name="doccument_new", methods={"GET","POST"})
     */
    public function new(Request $request, $type): Response
    {
        $doccument = new Doccument();
        $form = $this->createForm(DoccumentType::class, $doccument, [
            'type' => $type
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($doccument);
            $entityManager->flush();

            return $this->redirectToRoute('doccument_index');
        }

        return $this->render('doccument/new.html.twig', [
            'doccument' => $doccument,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="doccument_show", methods={"GET"})
     */
    public function show(Doccument $doccument): Response
    {
        return $this->render('doccument/show.html.twig', [
            'doccument' => $doccument,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="doccument_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Doccument $doccument): Response
    {
        $form = $this->createForm(DoccumentType::class, $doccument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('doccument_index');
        }

        return $this->render('doccument/edit.html.twig', [
            'doccument' => $doccument,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="doccument_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Doccument $doccument): Response
    {
        if ($this->isCsrfTokenValid('delete'.$doccument->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($doccument);
            $entityManager->flush();
        }

        return $this->redirectToRoute('doccument_index');
    }
}
