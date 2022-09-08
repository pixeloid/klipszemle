<?php
namespace App\Controller;

use App\Entity\EventRegistration;
use App\Entity\User;
use App\Entity\Vote;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Snappy\Image;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class VoteController
 * @package App\Controller
 * @Route("/vote", name="vote_")
 */
class VoteController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    /**
     * @Route("/", name="index")
     * @IsGranted("EVENTREGISTRATION_VOTE")
     * @Template("Vote/index.html.twig")
     */
    public function indexAction()
    {
         
        $query = $this->em->createQuery(
            'SELECT e.id, e.author, e.songtitle, e.video_url AS videourl, e.yt_id AS ytId, COUNT(v.id) AS numvotes FROM App:EventRegistration e
                 LEFT JOIN e.votes v
                 WHERE 
                         e.is_votable = 1
                 GROUP BY e.id'
        );

    
        $videos = $query->getArrayResult();
        shuffle($videos);

        return array(
            'videos' => $videos,
        );
    }

    /**
     * @Route("/show/{id}", name="show")
     * @Template("Vote/show.html.twig")
     */
    public function showAction($id): array
    {
        $user = $this->getUser();


        $repo = $this->em->getRepository(EventRegistration::class);

        $video = $repo->findOneById($id);


        $alreadyVoted = true;

        if ($user instanceof User) {
            $alreadyVoted = $repo->hasAlreadyVoted($user, $video);
        }


        


        return array(
            'user' => ($user instanceof User),
            'video' => $video,
            'alreadyVoted' => $alreadyVoted
        );
    }

    /**
     * @Route("/vote/{id}", name="vote")
     * @IsGranted("EVENTREGISTRATION_VOTE")
     * @Template("Vote/thanks.html.twig")
     */
    public function voteAction($id): array
    {
        $user = $this->getUser();


        $video = $this->em->getRepository(EventRegistration::class)->findOneById($id);

        $success = false;

        $query = $this->em->createQuery(
            'SELECT v FROM App:Vote v WHERE v.user = :user AND v.eventRegistration = :er'
        )

        ->setParameters(array(
            'user' => $user,
            'er' => $video
        ));

        $votes = $query->getResult();

        if (count($votes) === 0) {
            $vote = new Vote;

            $vote->setUser($user);
            $vote->setEventRegistration($video);
            $vote->setCreated(new DateTime);

            $this->em->persist($vote);
            $this->em->flush();
            $success = true;
        }




        return    array(
                 'video' => $video,
            );
    }



    /**
     * @Route("toplist", name="vote_toplist")
     * @IsGranted("ROLE_ADMIN")
     * @Template("Vote/toplist.html.twig")
     */
    public function voteToplistAction()
    {

        $user = $this->getUser();


        $query = $this->em->createQuery(
            'SELECT e, COUNT(vote.id) numvote FROM App:EventRegistration e LEFT JOIN e.votes vote
        GROUP BY e.id
        ORDER BY numvote DESC'
        );


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
     * @Template("Vote/thanks.html.twig")
     */
    public function testAction($id)
    {


        $video = $this->em->getRepository(EventRegistration::class)->findOneById($id);

     
        $this->generatePostImage($video->getId());
    
        exit;
    }

    /**
     * @Route("/fb_post_image/{id}", name="vote_fb_post_image")
     * @Template("Vote/facebook_post_image_show.html.twig")
     * @param $id
     * @param Image $knpSnappyImage
     * @return array|RedirectResponse
     */
    public function facebookPostImageAction($id, Image $knpSnappyImage): array|RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $video = $em->getRepository('App:EventRegistration')->findOneById($id);
        if (!$video->getPostImage() || !is_file($video->getPostImage())) {
            $this->generatePostImage($video->getId(), $knpSnappyImage);
        }


        if (str_contains($_SERVER["HTTP_USER_AGENT"], "facebookexternalhit/") ||
            str_contains($_SERVER["HTTP_USER_AGENT"], "Facebot")
        ) {
            return                 array(
                         'video' => $video,
                    );
        } else {
            $url = $this->generateUrl('default_home');
            return $this->redirect($url);
        }
    }

    /**
     * @Route("/fb_post_image_generator/{id}", name="vote_fb_post_image_generator")
     * @Template("Vote/facebook_post_image.html.twig")
     */
    public function facebookPostImageGeneratorAction($id)
    {


        $video = $this->em->getRepository('App:EventRegistration')->findOneById($id);


        return                 array(
                     'video' => $video,
                );
    }

    public function generatePostImage($id, $knpSnappyImage)
    {

        set_time_limit(100000);
        
        $video = $this->em->getRepository('App:EventRegistration')->findOneById($id);


        $filename = 'fb_post_images/klipszemle2019_fb_post_' . $id .'-'.time().'.jpg';

        // $this->get('knp_snappy.image')->getInternalGenerator()->setTimeout(300);
        $knpSnappyImage->generate(
            'http://klipszemle.com/vote/fb_post_image_generator/' . $video->getId(),
            $filename
        );

        $file = imagecreatefromjpeg($filename);
        $cropped = imagecreatetruecolor(1180, 620);
        
        imagecopyresampled(
            $cropped,
            $file,
            -10,
            -5,
            0,
            0,
            1200,
            630,
            1200,
            630
        );
        imagejpeg($cropped, $filename, 100);

        $video->setPostImage($filename);
        $this->em->persist($video);
        $this->em->flush();
    }
}
