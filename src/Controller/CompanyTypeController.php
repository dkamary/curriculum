<?php

namespace App\Controller;

use App\Entity\CompanyType;
use App\Form\CompanyTypeType;
use App\Repository\CompanyTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/company/type")
 */
class CompanyTypeController extends AbstractController
{
    /**
     * @Route("/", name="company_type_index", methods={"GET"})
     */
    public function index(CompanyTypeRepository $companyTypeRepository): Response
    {
        return $this->render('company_type/index.html.twig', [
            'company_types' => $companyTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="company_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $companyType = new CompanyType();
        $form = $this->createForm(CompanyTypeType::class, $companyType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($companyType);
            $entityManager->flush();

            return $this->redirectToRoute('company_type_index');
        }

        return $this->render('company_type/new.html.twig', [
            'company_type' => $companyType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="company_type_show", methods={"GET"})
     */
    public function show(CompanyType $companyType): Response
    {
        return $this->render('company_type/show.html.twig', [
            'company_type' => $companyType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="company_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CompanyType $companyType): Response
    {
        $form = $this->createForm(CompanyTypeType::class, $companyType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('company_type_index');
        }

        return $this->render('company_type/edit.html.twig', [
            'company_type' => $companyType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="company_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CompanyType $companyType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$companyType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($companyType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('company_type_index');
    }
}
