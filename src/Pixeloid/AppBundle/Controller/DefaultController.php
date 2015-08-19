<?php

namespace Pixeloid\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

use Pixeloid\AppBundle\Entity\Accomodation;
use Pixeloid\AppBundle\Entity\Room as Room;


class DefaultController extends Controller
{

    public function indexAction($event)
    {
        return $this->render('PixeloidAppBundle:Default:index.html.twig', array('name' => $event));




    }

    public function infoAction()
    {

        $em = $this->getDoctrine()->getManager();


        $event = $em->getRepository('PixeloidAppBundle:Event')->findOneById(2);

        $qb = $em->createQueryBuilder();
        $qb->select('a, r')
            ->from('PixeloidAppBundle:Accomodation', 'a')
            ->join('a.rooms', 'r')
            ->where('r.event = :event')
            ->setParameter('event', $event)
            ->distinct(true)
        ;

        $accomodations =$qb->getQuery()->getResult();

        return $this->render('PixeloidAppBundle:Default:info.html.twig', array(
            'accomodations' => $accomodations));
    }

    public function mapAction()
    {
        $em = $this->getDoctrine()->getManager();


        $event = $em->getRepository('PixeloidAppBundle:Event')->findOneById(4);

        $qb = $em->createQueryBuilder();
        $qb->select('a, r')
            ->from('PixeloidAppBundle:Accomodation', 'a')
            ->join('a.rooms', 'r')
            ->where('r.event = :event')
            ->setParameter('event', $event)
            ->distinct(true)
        ;

        $accomodations =$qb->getQuery()->getResult();

        return $this->render('PixeloidAppBundle:Default:map.html.twig', array(
            'accomodations' => $accomodations
        ));
    }

    public function registerAction()
    {
        return $this->render('PixeloidAppBundle:Default:register.html.twig');
    }

    public function abstractSubmissionAction($step)
    {
        return $this->render('PixeloidAppBundle:Default:abstract-submission.html.twig');
    }

    public function privacyAction()
    {
        return $this->render('PixeloidAppBundle:Default:privacy.html.twig');
    }
    public function importantAction()
    {
        return $this->render('PixeloidAppBundle:Default:important.html.twig');
    }

}
