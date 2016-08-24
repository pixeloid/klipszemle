<?php

namespace Pixeloid\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Pixeloid\AppBundle\Twig\AppExtension;
use Pixeloid\AppBundle\Entity\EventRegistration;


class VoteController extends Controller
{
    /**
     * @Route("/", name="vote")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                'SELECT e FROM PixeloidAppBundle:EventRegistration e WHERE e.voteable = TRUE AND e.created > :start'
            )
            ->setParameter('start', new \DateTime($this->container->getParameter('start_date')));

    


        return array(
            'videos' => $query->getResult(),
        );    
    
    }

    /**
     * @Route("/show/{id}", name="vote_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $video = $em->getRepository('PixeloidAppBundle:EventRegistration')->findOneById($id);

        


        return array(
            'video' => $video,
        );    
    }

    /**
     * @Route("/vote/{id}", name="vote_vote")
     * @Security("is_granted(['ROLE_USER'])")
     * @Template()
     */
    public function voteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $video = $em->getRepository('PixeloidAppBundle:EventRegistration')->findOneById($id);


        if (!$video->getPostImage()) {
            $this->generatePostImage($video->getId());
        }

        return $this->redirectToRoute('vote_show', array('id' => $id), 301);

    }

    /**
     * @Route("/fb_post_image/{id}", name="vote_fb_post_image")
     * @Template("PixeloidAppBundle:Vote:facebook_post_image.html.twig")
     */
    public function facebookPostImageAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $video = $em->getRepository('PixeloidAppBundle:EventRegistration')->findOneById($id);


        return                 array(
                     'video' => $video,
                );

    }

    public function generatePostImage($id)
    {

        set_time_limit(100000);
        
        $em = $this->getDoctrine()->getManager();
        $video = $em->getRepository('PixeloidAppBundle:EventRegistration')->findOneById($id);


        $filename = 'klipszemle2016_fb_post_' . $id .'-'.time().'.jpg';

        $this->get('knp_snappy.image')->getInternalGenerator()->setTimeout(300);
        $this->get('knp_snappy.image')->generateFromHtml(
            $this->renderView(
                'PixeloidAppBundle:Vote:facebook_post_image.html.twig',
                array(
                     'video' => $video,
                )
            ),
            $filename
        );

        $file = imagecreatefromjpeg($filename);
        $cropped = imagecreatetruecolor( 1200, 630 );
        
        imagecopyresampled($cropped,
                           $file ,-10,-5,0,0,1200, 630, 1200, 630
                          );
        imagejpeg($cropped, $filename, 100);

        $video->setPostImage($filename);
        $em->persist($video);
        $em->flush();

    }



}
