<?php

namespace Pixeloid\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Pixeloid\AppBundle\Entity\Accomodation;
use Pixeloid\AppBundle\Entity\Room as Room;
use Pixeloid\AppBundle\Form\DocumentType;
use Pixeloid\AppBundle\Entity\Documents;


class DefaultController extends Controller
{

    public function indexAction($event, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $day1 = $em->getRepository('PixeloidAppBundle:Documents')->findOneByName('day1');
        $day2 = $em->getRepository('PixeloidAppBundle:Documents')->findOneByName('day2');
        $lead = $em->getRepository('PixeloidAppBundle:Documents')->findOneByName('lead');
        $winners = $em->getRepository('PixeloidAppBundle:EventRegistration')->getWinners();

        if(!$day1){
          $day1 = new Documents;
          $day1->setName('day1');  
        } 

        if(!$day2){
          $day2 = new Documents;
          $day2->setName('day2');  
        } 
        if(!$lead){
          $lead = new Documents;
          $lead->setName('lead');  
        } 



        $form = $this->createForm(new DocumentType(), null, array(
        ));

        $form['day1']->setData($day1->getContent());
        $form['day2']->setData($day2->getContent());
        $form['lead']->setData($lead->getContent());

        $form->handleRequest($request);
        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $day1 = $em->getRepository('PixeloidAppBundle:Documents')->findOneByName('day1');
            $day2 = $em->getRepository('PixeloidAppBundle:Documents')->findOneByName('day2');
            $lead = $em->getRepository('PixeloidAppBundle:Documents')->findOneByName('lead');

            if(!$day1){
              $day1 = new Documents;
              $day1->setName('day1');  
            } 

            if(!$day2){
              $day2 = new Documents;
              $day2->setName('day2');  
            } 
            if(!$lead){
              $lead = new Documents;
              $lead->setName('lead');  
            } 




            $day1->setContent($form['day1']->getData());
            $day2->setContent($form['day2']->getData());
            $lead->setContent($form['lead']->getData());

            $em->persist($day1);
            $em->persist($day2);
            $em->persist($lead);
            $em->flush();

        }


        return $this->render('PixeloidAppBundle:Default:index.html.twig', array(
            'day1' => $day1->getContent(),
            'day2' => $day2->getContent(),
            'lead' => $lead->getContent(),
            'form' => $form->createView(),
            'winners' => $winners
            )
        );




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
