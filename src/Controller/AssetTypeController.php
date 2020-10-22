<?php

namespace App\Controller;

use App\Entity\AssetType;
use App\Form\AssetTypeType;
use App\Repository\AssetTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/asset/type")
 */
class AssetTypeController extends AbstractController
{
    /**
     * @Route("/", name="asset_type_index", methods={"GET"})
     */
    public function index(AssetTypeRepository $assetTypeRepository): Response
    {
        return $this->render('asset_type/index.html.twig', [
            'asset_types' => $assetTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="asset_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $assetType = new AssetType();
        $form = $this->createForm(AssetTypeType::class, $assetType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($assetType);
            $entityManager->flush();

            return $this->redirectToRoute('asset_type_index');
        }

        return $this->render('asset_type/new.html.twig', [
            'asset_type' => $assetType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="asset_type_show", methods={"GET"})
     */
    public function show(AssetType $assetType): Response
    {
        return $this->render('asset_type/show.html.twig', [
            'asset_type' => $assetType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="asset_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AssetType $assetType): Response
    {
        $form = $this->createForm(AssetTypeType::class, $assetType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('asset_type_index');
        }

        return $this->render('asset_type/edit.html.twig', [
            'asset_type' => $assetType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="asset_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AssetType $assetType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$assetType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($assetType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('asset_type_index');
    }
}
