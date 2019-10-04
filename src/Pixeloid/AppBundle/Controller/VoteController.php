<?php
namespace Pixeloid\AppBundle\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Pixeloid\AppBundle\Twig\AppExtension;
use Pixeloid\AppBundle\Entity\EventRegistration;
use Pixeloid\AppBundle\Entity\Vote;
use Pixeloid\AppBundle\Entity\User as User;


class VoteController extends Controller
{
    /**
     * @Route("/", name="-vote")
     * @Template("PixeloidAppBundle:Vote:index.html.twig")
     */
    // public function indexAction()
    // {
    //     $em = $this->getDoctrine()->getManager();
    //     $query = $em->createQuery(
    //             'SELECT e.id, e.author, e.songtitle, e.video_url AS videourl, COUNT(v.id) AS numvotes FROM PixeloidAppBundle:EventRegistration e
    //             LEFT JOIN e.votes v
    //             WHERE 
    //                     e.premiere != 1
    //                 AND e.created > :start
    //             GROUP BY e.id'
    //         )
    //         ->setParameter('start', new \DateTime($this->container->getParameter('start_date')));

    
    //     $videos = $query->getArrayResult();
    //     shuffle($videos);

    //     return array(
    //         'videos' => $videos,
    //     );    
    
    // }

    /**
     * @Route("/show/{id}", name="-vote_show")
     * @Template("PixeloidAppBundle:Vote:show.html.twig")
     */
    // public function showAction($id)
    // {

    //     $user = $this->get('security.token_storage')->getToken()->getUser();

    //     $em = $this->getDoctrine()->getManager();

    //     $repo = $em->getRepository('PixeloidAppBundle:EventRegistration');

    //     $video = $repo->findOneById($id);


    //     $alreadyVoted = true;

    //     if ($user instanceof User) {
    //         $alreadyVoted = $user && $repo->hasAlreadyVoted($user, $video); 
    //     }


        


    //     return array(
    //         'user' => ($user instanceof User),
    //         'video' => $video,
    //         'alreadyVoted' => $alreadyVoted
    //     );    
    // }

    /**
     * @Route("/vote/{id}", name="-vote_vote")
     * @Security("is_granted(['ROLE_USER'])")
     * @Template("PixeloidAppBundle:Vote:thanks.html.twig")
     */
    // public function voteAction($id)
    // {
    //     $user = $this->get('security.token_storage')->getToken()->getUser();

    //     $em = $this->getDoctrine()->getManager();
        
    //     $video = $em->getRepository('PixeloidAppBundle:EventRegistration')->findOneById($id);

    //     $success = false;

    //     $query = $em->createQuery(
    //     'SELECT v FROM PixeloidAppBundle:Vote v WHERE v.user = :user AND v.eventRegistration = :er')

    //     ->setParameters(array(
    //         'user' => $user,
    //         'er' => $video
    //     ));

    //     $votes = $query->getResult();

    //     if (count($votes) === 0) {
    //         $vote = new Vote;

    //         $vote->setUser($user);
    //         $vote->setEventRegistration($video);
    //         $vote->setCreated(new \DateTime);

    //         $em->persist($vote);
    //         $em->flush();
    //         $success = true;
    //     }




    //     return    array(
    //              'video' => $video,
    //         );
    // }



    /**
     * @Route("toplist", name="vote_vote_toplist")
     * @Security("is_granted(['ROLE_ADMIN'])")
     * @Template("PixeloidAppBundle:Vote:toplist.html.twig")
     */
    public function voteToplistAction()
    {

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        
        $query = $em->createQuery(
        'SELECT e, COUNT(vote.id) numvote FROM PixeloidAppBundle:EventRegistration e LEFT JOIN e.votes vote

        WHERE 
             e.created > :start
        GROUP BY e.id
        ORDER BY numvote DESC')
        ->setParameter('start', new \DateTime($this->container->getParameter('start_date')));


        $votes = $query->getArrayResult();



        // $votes = $query->getResult();

        // if (count($votes) === 0) {
        //     $vote = new Vote;

        //     $vote->setUser($user);
        //     $vote->setEventRegistration($video);
        //     $vote->setCreated(new \DateTime);

        //     $em->persist($vote);
        //     $em->flush();
        //     $success = true;
        // }



        // if (!$video->getPostImage()) {
        //     $this->generatePostImage($video->getId());
        // }

        return    array(
                 'votes' => $votes,
            );
    }

        /**
     * @Route("/test/{id}", name="vote_test")
     * @Template("PixeloidAppBundle:Vote:thanks.html.twig")
     */
    public function testAction($id)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        
        $video = $em->getRepository('PixeloidAppBundle:EventRegistration')->findOneById($id);

     
        $this->generatePostImage($video->getId());
    
        exit;    
    }

    /**
     * @Route("/fb_post_image/{id}", name="vote_fb_post_image")
     * @Template("PixeloidAppBundle:Vote:facebook_post_image_show.html.twig")
     */
    public function facebookPostImageAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $video = $em->getRepository('PixeloidAppBundle:EventRegistration')->findOneById($id);
        if (!$video->getPostImage() || !is_file($video->getPostImage())) {
            $this->generatePostImage($video->getId());
        }


        if (strpos($_SERVER["HTTP_USER_AGENT"], "facebookexternalhit/") !== false ||          
            strpos($_SERVER["HTTP_USER_AGENT"], "Facebot") !== false
        ) {



            return                 array(
                         'video' => $video,
                    );
        }
        else {
            $url = $this->generateUrl('default_home');
            return $this->redirect($url);
        }


    }

    /**
     * @Route("/fb_post_image_generator/{id}", name="vote_fb_post_image_generator")
     * @Template("PixeloidAppBundle:Vote:facebook_post_image.html.twig")
     */
    public function facebookPostImageGeneratorAction($id)
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


        $filename = 'fb_post_images/klipszemle2019_fb_post_' . $id .'-'.time().'.jpg';

        // $this->get('knp_snappy.image')->getInternalGenerator()->setTimeout(300);
        $this->get('knp_snappy.image')->generate(
            'http://klipszemle.com/vote/fb_post_image_generator/' . $video->getId()
            ,$filename
        );

        $file = imagecreatefromjpeg($filename);
        $cropped = imagecreatetruecolor( 1180, 620 );
        
        imagecopyresampled($cropped,
                           $file ,-10,-5,0,0,1200, 630, 1200, 630
                          );
        imagejpeg($cropped, $filename, 100);

        $video->setPostImage($filename);
        $em->persist($video);
        $em->flush();

    }



}
