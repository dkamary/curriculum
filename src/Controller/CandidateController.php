<?php

namespace App\Controller;

use App\Entity\Job;
use App\Entity\SkillCategory;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;

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
        Request $request,
        UserRepository $userRepository,
        int $page = 1,
        int $perPage = 10,
        ?Job $job = null
    ): Response {
        $candidates = $userRepository->getCandidates($page, $perPage, null, $job);
        if ($request->isXmlHttpRequest()) {
            $view = new Response();
            foreach ($candidates as $c) {
                /**
                 * @var User $c
                 */
                $tmp = $this->renderView('candidate/single-post.html.twig', [
                    'features' => $c->getFeaturedKnowledge(),
                    'myjob' => $c->getTheJob(),
                    'xp' => $c->getExperienceTime(),
                    'candidate' => $c,
                ]);
                $view->setContent($view->getContent() . $tmp);
            }

            return $view;
        } else {

            return $this->render('candidate/list.html.twig', [
                'candidates' => $candidates,
                'actionFilter' => $this->generateUrl('candidate_list'),
                'page' => $page,
                'perPage' => $perPage,
                'job' => $job,
            ]);
        }
    }

    /**
     * @Route("/profiles/{skillCategory}/{page}/{perPage}/{job}", name="profiles_by_cat", requirements={"skillCategory" : "\d+", "page": "\d+", "perPage": "\d+", "job": "\d+"})
     */
    public function profiles(
        Request $request,
        UserRepository $userRepository,
        SkillCategory $skillCategory,
        int $page = 1,
        int $perPage = 10,
        ?Job $job = null
    ): Response {
        $candidates = $userRepository->getCandidatesByCategory(
            $skillCategory,
            $page,
            $perPage,
            $job
        );

        if ($request->isXmlHttpRequest()) {
            $view = new Response();
            foreach ($candidates as $c) {
                /**
                 * @var User $c
                 */
                $tmp = $this->renderView('candidate/single-post.html.twig', [
                    'features' => $c->getFeaturedKnowledge(),
                    'myjob' => $c->getTheJob(),
                    'xp' => $c->getExperienceTime(),
                    'candidate' => $c,
                ]);
                $view->setContent($view->getContent() . $tmp);
            }

            return $view;
        } else {

            return $this->render('candidate/category.html.twig', [
                'candidates' => $candidates,
                'actionFilter' => $this->generateUrl('profiles_by_cat', ['skillCategory' => $skillCategory->getId()]),
                'page' => $page,
                'perPage' => $perPage,
                'job' => $job,
                'category' => $skillCategory,
            ]);
        }
    }
}
