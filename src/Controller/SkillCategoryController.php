<?php

namespace App\Controller;

use App\Entity\SkillCategory;
use App\Form\SkillCategoryType;
use App\Repository\SkillCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/skill/category")
 */
class SkillCategoryController extends AbstractController
{
    const DEFAULT_COUNT = 6;

    /**
     * @Route("/", name="skill_category_index", methods={"GET"})
     */
    public function index(SkillCategoryRepository $skillCategoryRepository): Response
    {
        return $this->render('skill_category/index.html.twig', [
            'skill_categories' => $skillCategoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="skill_category_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $skillCategory = new SkillCategory();
        $form = $this->createForm(SkillCategoryType::class, $skillCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($skillCategory);
            $entityManager->flush();

            return $this->redirectToRoute('skill_category_index');
        }

        return $this->render('skill_category/new.html.twig', [
            'skill_category' => $skillCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="skill_category_show", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function show(SkillCategory $skillCategory): Response
    {
        return $this->render('skill_category/show.html.twig', [
            'skill_category' => $skillCategory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="skill_category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SkillCategory $skillCategory): Response
    {
        $form = $this->createForm(SkillCategoryType::class, $skillCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('skill_category_index');
        }

        return $this->render('skill_category/edit.html.twig', [
            'skill_category' => $skillCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="skill_category_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SkillCategory $skillCategory): Response
    {
        if ($this->isCsrfTokenValid('delete' . $skillCategory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($skillCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('skill_category_index');
    }

    /**
     * @Route("/featured/{count}", name="skill_category_featured", requirements={"count"="\d+"})
     *
     * @param integer $count
     * @return Response
     */
    public function featured(
        SkillCategoryRepository $skillCategoryRepository,
        int $count = self::DEFAULT_COUNT
    ): Response {
        $categories = $skillCategoryRepository->findBy(
            [],
            ['name' => 'ASC'],
            $count
        );

        return $this->render('skill_category/featured.html.twig', [
            'categories' => $categories,
        ]);
    }
}
