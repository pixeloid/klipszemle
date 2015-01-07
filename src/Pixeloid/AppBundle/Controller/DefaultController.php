<?php

namespace Pixeloid\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Pixeloid\AppBundle\Entity\Accomodation;


class DefaultController extends Controller
{

    public function indexAction($event)
    {
        return $this->render('PixeloidAppBundle:Default:index.html.twig', array('name' => $event));
    }

    public function infoAction()
    {

        $em = $this->getDoctrine()->getManager();

        $accomodations = $em->getRepository('PixeloidAppBundle:Accomodation')->findAll();

        return $this->render('PixeloidAppBundle:Default:info.html.twig', array(
            'accomodations' => $accomodations));
    }

    public function mapAction()
    {

        $map = $this->get('ivory_google_map.map');

        return $this->render('PixeloidAppBundle:Default:map.html.twig', array('map' => $map));
    }

    public function registerAction()
    {
        return $this->render('PixeloidAppBundle:Default:register.html.twig');
    }

    public function abstractSubmissionAction($step)
    {
        return $this->render('PixeloidAppBundle:Default:abstract-submission.html.twig');
    }

    public function programmeAction()
    {
        return $this->render('PixeloidAppBundle:Default:programme.html.twig');
    }

}
