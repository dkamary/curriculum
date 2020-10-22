<?php

namespace App\Controller;

use App\Entity\SkillLevel;
use App\Form\SkillLevelType;
use App\Repository\SkillLevelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/skill/level")
 */
class SkillLevelController extends AbstractController
{
    /**
     * @Route("/", name="skill_level_index", methods={"GET"})
     */
    public function index(SkillLevelRepository $skillLevelRepository): Response
    {
        return $this->render('skill_level/index.html.twig', [
            'skill_levels' => $skillLevelRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="skill_level_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $skillLevel = new SkillLevel();
        $form = $this->createForm(SkillLevelType::class, $skillLevel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($skillLevel);
            $entityManager->flush();

            return $this->redirectToRoute('skill_level_index');
        }

        return $this->render('skill_level/new.html.twig', [
            'skill_level' => $skillLevel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="skill_level_show", methods={"GET"})
     */
    public function show(SkillLevel $skillLevel): Response
    {
        return $this->render('skill_level/show.html.twig', [
            'skill_level' => $skillLevel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="skill_level_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SkillLevel $skillLevel): Response
    {
        $form = $this->createForm(SkillLevelType::class, $skillLevel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('skill_level_index');
        }

        return $this->render('skill_level/edit.html.twig', [
            'skill_level' => $skillLevel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="skill_level_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SkillLevel $skillLevel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$skillLevel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($skillLevel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('skill_level_index');
    }
}
