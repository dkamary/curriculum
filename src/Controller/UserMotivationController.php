<?php

namespace App\Controller;

use App\Entity\UserMotivation;
use App\Form\UserMotivationType;
use App\Repository\UserMotivationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/motivation")
 */
class UserMotivationController extends AbstractController
{
    /**
     * @Route("/", name="user_motivation_index", methods={"GET"})
     */
    public function index(UserMotivationRepository $userMotivationRepository): Response
    {
        return $this->render('user_motivation/index.html.twig', [
            'user_motivations' => $userMotivationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_motivation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $userMotivation = new UserMotivation();
        $form = $this->createForm(UserMotivationType::class, $userMotivation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userMotivation);
            $entityManager->flush();

            return $this->redirectToRoute('user_motivation_index');
        }

        return $this->render('user_motivation/new.html.twig', [
            'user_motivation' => $userMotivation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_motivation_show", methods={"GET"})
     */
    public function show(UserMotivation $userMotivation): Response
    {
        return $this->render('user_motivation/show.html.twig', [
            'user_motivation' => $userMotivation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_motivation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserMotivation $userMotivation): Response
    {
        $form = $this->createForm(UserMotivationType::class, $userMotivation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_motivation_index');
        }

        return $this->render('user_motivation/edit.html.twig', [
            'user_motivation' => $userMotivation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_motivation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UserMotivation $userMotivation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userMotivation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userMotivation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_motivation_index');
    }
}
