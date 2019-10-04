<?php

namespace Pixeloid\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Pixeloid\AppBundle\Entity\VoteSheet;
use Pixeloid\AppBundle\Entity\JuryVote;
use Pixeloid\AppBundle\Form\JuryVoteType;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class RateController extends Controller
{
    /**
     * @Route("/", name="rate_index")
     */
    public function index()
    {

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();



        $from = new \DateTime($this->container->getParameter('start_date'));
        return $this->render('rate/index.html.twig', [
            'cats' => $em->getRepository('PixeloidAppBundle:MovieCategory')->getMoviesForUser($user, $from),
        ]);
    }

    /**
     * @Route("/list", name="rate_list")
     */
    public function list()
    {
      $from = new \DateTime($this->container->getParameter('start_date'));

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('PixeloidAppBundle:MovieCategory')->getCategoriesForRating($from);
        
        $result = [];

        foreach ($categories as $cat) {
          $result[$cat->getName()] = $em->getRepository('PixeloidAppBundle:EventRegistration')->getRatings($from, $cat);
        }
        return $this->render('rate/list.html.twig', [
            'result' => $result,
        ]);
    }

    /**
     * @Route("/video/{id}", name="rate_video")
     */
    public function videoAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $video = $em->getRepository('PixeloidAppBundle:EventRegistration')->findOneById($id);



        $success = false;

        $query = $em->createQuery(
          ' SELECT v
            FROM PixeloidAppBundle:JuryVote v 
            WHERE v.user = :user AND v.eventRegistration = :er')

        ->setParameters(array(
            'user' => $user,
            'er' => $video
        ));

        $vote = $query->getOneOrNullResult();

        if(!$vote) {
          $vote = new JuryVote;
          $vote->setUser($user);
          $vote->setEventRegistration($video);
        }

        $form = $this->createForm(JuryVoteType::class, $vote, [
          'action' => $this->generateUrl('rate_video', ['id' => $video->getId()]),
        ]);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          $em->persist($vote);
          $em->flush();
          if ($request->isXmlHttpRequest()) {
              return $this->render('rate/_rate-row.html.twig', [
                  'video' => $vote->getEventRegistration()
              ]);
          }
        }

        if ($request->isXmlHttpRequest() && $form->isSubmitted()) {
            $html = $this->render('rate/_form.html.twig', [
                'form' => $form->createView()
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
