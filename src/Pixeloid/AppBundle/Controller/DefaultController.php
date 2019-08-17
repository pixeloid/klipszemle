<?php

namespace Pixeloid\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Pixeloid\AppBundle\Entity\Accomodation;
use Pixeloid\AppBundle\Entity\Room as Room;
use Pixeloid\AppBundle\Form\DocumentType;
use Pixeloid\AppBundle\Entity\Documents;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\HttpKernel\Kernel;


class DefaultController extends AbstractController
{

    /**
     * @Route("/", name="default_home")
     */

    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $hero = $em->getRepository('PixeloidAppBundle:Hero')->findAll();
        $jury = $em->getRepository('PixeloidAppBundle:Jury')->findAll();

        return $this->render('PixeloidAppBundle:Default:index.html.twig', array(
            'heroes' => $hero,
            'juries' => $jury,
            )
        );




    }

    public function sponsorsAction()
    {

        $em = $this->getDoctrine()->getManager();

        $sponsors = $em->getRepository('PixeloidAppBundle:Sponsor')->findAll();

        return $this->render('PixeloidAppBundle:Default:sponsors.html.twig', array(
            'sponsors' => $sponsors));
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


    /**
     * @Route("/hirek", name="news")
     */

    public function newsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('PixeloidAppBundle:Post')->findAll();

        return $this->render('PixeloidAppBundle:Default:news.html.twig', ['posts' => $posts]);
    }

    public function privacyAction()
    {
        return $this->render('PixeloidAppBundle:Default:privacy.html.twig');
    }

    /**
     * @Route("/faq", name="faq")
     */
    public function faqAction()
    {
        $faq = Yaml::parse(file_get_contents($this->get('kernel')->getRootDir() . '/../src/Pixeloid/AppBundle/Resources/config/faq.yml'));
        return $this->render('PixeloidAppBundle:Default:faq.html.twig', ['faq' => $faq]);
    }

    public function splashAction()
    {
        return $this->render('PixeloidAppBundle:Default:splash.html.twig');
    }

}
