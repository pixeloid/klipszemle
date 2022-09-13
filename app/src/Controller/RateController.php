<?php

namespace App\Controller;

use App\Entity\EventRegistration;
use App\Entity\MovieCategory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\JuryVote;
use App\Form\JuryVoteType;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/rate", name="rate_")
 * @Security("is_granted('ROLE_JURY')")
 */
class RateController extends AbstractController
{
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    /**
     * @Route("/", name="index")
     */
    public function index()
    {

        $user = $this->getUser();



        $from = new \DateTime('2021-06-01');
        return $this->render('rate/index.html.twig', [
            'cats' => $this->em->getRepository(MovieCategory::class)->getMoviesForUser($user, $from),
        ]);
    }

    /**
     * @Security("is_granted('ROLE_ADMIN')")
     * @Route("/list", name="rate_list")
     */
    public function list()
    {
        $from = new \DateTime('2021-05-01');
      
        $categories = $this->em->getRepository(MovieCategory::class)->getCategoriesForRating($from);
        
        $result = [];


        foreach ($categories as $cat) {
            $result[$cat->getName()] = $this->em->getRepository(EventRegistration::class)->getRatings($from, $cat);
        }

        return $this->render('rate/list.html.twig', [
            'result' => $result,
        ]);
    }

    /**
     * @Route("/video/{id}", name="video")
     */
    public function videoAction($id, Request $request)
    {
        $user = $this->getUser();
        $video = $this->em->getRepository(EventRegistration::class)->findOneById($id);



        $success = false;

        $query = $this->em->createQuery(
            ' SELECT v
            FROM App:JuryVote v 
            WHERE v.user = :user AND v.eventRegistration = :er'
        )

        ->setParameters([
            'user' => $user,
            'er' => $video,
        ]);

        $vote = $query->getOneOrNullResult();

        if (!$vote) {
            $vote = new JuryVote;
            $vote->setUser($user);
            $vote->setEventRegistration($video);
        }

        $form = $this->createForm(JuryVoteType::class, $vote, [
          'action' => $this->generateUrl('rate_video', ['id' => $video->getId()]),
        ]);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($vote);
            $this->em->flush();
            if ($request->isXmlHttpRequest()) {
                return $this->render('rate/_rate-row.html.twig', [
                  'video' => $vote->getEventRegistration(),
                ]);
            }
        }

        if ($request->isXmlHttpRequest() && $form->isSubmitted()) {
            $html = $this->render('rate/_form.html.twig', [
                'form' => $form->createView(),
            ]);

            return new Response($html, 400);
        }


        return $this->render('rate/video.html.twig', [
          'video' => $video,
          'user' => $user,
          'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/finalize", name="rate_finalize")
     */
    public function finalizeAction()
    {
      # code...
    }
}
