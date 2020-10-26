<?php

namespace App\Controller;

use App\Entity\Job;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/candidate")
 */
class CandidateController extends AbstractController
{
    /**
     * @Route("/", name="candidate_index")
     */
    public function index()
    {
        return $this->render('candidate/index.html.twig', [
            'controller_name' => 'CandidateController',
        ]);
    }

    /**
     * @Route("/carousel", name="candidate_carousel")
     *
     * @return Response
     */
    public function featuredCarousel(): Response
    {
        $candidates = [];

        return $this->render('candidate/carousel.html.twig', [
            'candidates' => $candidates,
        ]);
    }

    /**
     * @Route("/list/{page}/{perPage}/{job}", name="candidate_list", requirements={"page": "\d+", "perPage": "\d+", "job": "\d+"})
     */
    public function list(
        UserRepository $userRepository,
        int $page = 1,
        int $perPage = 10,
        ?Job $job = null
    ): Response {
        $candidates = $userRepository->getCandidates($page, $perPage, null, $job);

        return $this->render('candidate/list.html.twig', [
            'candidates' => $candidates,
        ]);
    }
}
