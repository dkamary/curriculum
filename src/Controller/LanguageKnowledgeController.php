<?php

namespace App\Controller;

use App\Entity\LanguageKnowledge;
use App\Form\LanguageKnowledgeType;
use App\Repository\LanguageKnowledgeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/language/knowledge")
 */
class LanguageKnowledgeController extends AbstractController
{
    /**
     * @Route("/", name="language_knowledge_index", methods={"GET"})
     */
    public function index(LanguageKnowledgeRepository $languageKnowledgeRepository): Response
    {
        return $this->render('language_knowledge/index.html.twig', [
            'language_knowledges' => $languageKnowledgeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="language_knowledge_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $languageKnowledge = new LanguageKnowledge();
        $form = $this->createForm(LanguageKnowledgeType::class, $languageKnowledge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($languageKnowledge);
            $entityManager->flush();

            return $this->redirectToRoute('language_knowledge_index');
        }

        return $this->render('language_knowledge/new.html.twig', [
            'language_knowledge' => $languageKnowledge,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="language_knowledge_show", methods={"GET"})
     */
    public function show(LanguageKnowledge $languageKnowledge): Response
    {
        return $this->render('language_knowledge/show.html.twig', [
            'language_knowledge' => $languageKnowledge,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="language_knowledge_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, LanguageKnowledge $languageKnowledge): Response
    {
        $form = $this->createForm(LanguageKnowledgeType::class, $languageKnowledge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('language_knowledge_index');
        }

        return $this->render('language_knowledge/edit.html.twig', [
            'language_knowledge' => $languageKnowledge,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="language_knowledge_delete", methods={"DELETE"})
     */
    public function delete(Request $request, LanguageKnowledge $languageKnowledge): Response
    {
        if ($this->isCsrfTokenValid('delete'.$languageKnowledge->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($languageKnowledge);
            $entityManager->flush();
        }

        return $this->redirectToRoute('language_knowledge_index');
    }
}
