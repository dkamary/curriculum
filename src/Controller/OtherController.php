<?php

namespace App\Controller;

use App\Entity\Other;
use App\Form\OtherType;
use App\Repository\OtherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/other")
 */
class OtherController extends AbstractController
{
    /**
     * @Route("/", name="other_index", methods={"GET"})
     */
    public function index(OtherRepository $otherRepository): Response
    {
        return $this->render('other/index.html.twig', [
            'others' => $otherRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="other_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $other = new Other();
        $form = $this->createForm(OtherType::class, $other);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($other);
            $entityManager->flush();

            return $this->redirectToRoute('other_index');
        }

        return $this->render('other/new.html.twig', [
            'other' => $other,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="other_show", methods={"GET"})
     */
    public function show(Other $other): Response
    {
        return $this->render('other/show.html.twig', [
            'other' => $other,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="other_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Other $other): Response
    {
        $form = $this->createForm(OtherType::class, $other);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('other_index');
        }

        return $this->render('other/edit.html.twig', [
            'other' => $other,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="other_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Other $other): Response
    {
        if ($this->isCsrfTokenValid('delete'.$other->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($other);
            $entityManager->flush();
        }

        return $this->redirectToRoute('other_index');
    }
}
