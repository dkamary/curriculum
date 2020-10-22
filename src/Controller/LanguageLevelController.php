<?php

namespace App\Controller;

use App\Entity\LanguageLevel;
use App\Form\LanguageLevelType;
use App\Repository\LanguageLevelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/language/level")
 */
class LanguageLevelController extends AbstractController
{
    /**
     * @Route("/", name="language_level_index", methods={"GET"})
     */
    public function index(LanguageLevelRepository $languageLevelRepository): Response
    {
        return $this->render('language_level/index.html.twig', [
            'language_levels' => $languageLevelRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="language_level_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $languageLevel = new LanguageLevel();
        $form = $this->createForm(LanguageLevelType::class, $languageLevel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($languageLevel);
            $entityManager->flush();

            return $this->redirectToRoute('language_level_index');
        }

        return $this->render('language_level/new.html.twig', [
            'language_level' => $languageLevel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="language_level_show", methods={"GET"})
     */
    public function show(LanguageLevel $languageLevel): Response
    {
        return $this->render('language_level/show.html.twig', [
            'language_level' => $languageLevel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="language_level_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, LanguageLevel $languageLevel): Response
    {
        $form = $this->createForm(LanguageLevelType::class, $languageLevel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('language_level_index');
        }

        return $this->render('language_level/edit.html.twig', [
            'language_level' => $languageLevel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="language_level_delete", methods={"DELETE"})
     */
    public function delete(Request $request, LanguageLevel $languageLevel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$languageLevel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($languageLevel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('language_level_index');
    }
}
