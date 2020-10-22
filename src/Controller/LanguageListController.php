<?php

namespace App\Controller;

use App\Entity\LanguageList;
use App\Form\LanguageListType;
use App\Repository\LanguageListRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/language/list")
 */
class LanguageListController extends AbstractController
{
    /**
     * @Route("/", name="language_list_index", methods={"GET"})
     */
    public function index(LanguageListRepository $languageListRepository): Response
    {
        return $this->render('language_list/index.html.twig', [
            'language_lists' => $languageListRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="language_list_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $languageList = new LanguageList();
        $form = $this->createForm(LanguageListType::class, $languageList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($languageList);
            $entityManager->flush();

            return $this->redirectToRoute('language_list_index');
        }

        return $this->render('language_list/new.html.twig', [
            'language_list' => $languageList,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="language_list_show", methods={"GET"})
     */
    public function show(LanguageList $languageList): Response
    {
        return $this->render('language_list/show.html.twig', [
            'language_list' => $languageList,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="language_list_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, LanguageList $languageList): Response
    {
        $form = $this->createForm(LanguageListType::class, $languageList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('language_list_index');
        }

        return $this->render('language_list/edit.html.twig', [
            'language_list' => $languageList,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="language_list_delete", methods={"DELETE"})
     */
    public function delete(Request $request, LanguageList $languageList): Response
    {
        if ($this->isCsrfTokenValid('delete'.$languageList->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($languageList);
            $entityManager->flush();
        }

        return $this->redirectToRoute('language_list_index');
    }
}
