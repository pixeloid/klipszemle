<?php

namespace App\Controller;

use App\Entity\Hero;
use App\Entity\Jury;
use App\Entity\Post;
use DateTime;
use Http\Client\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Yaml;
use MediaMonks\SonataMediaBundle\Generator\ImageUrlGenerator;
use MediaMonks\SonataMediaBundle\ParameterBag\ImageParameterBag;
use MediaMonks\SonataMediaBundle\Utility\ImageUtility;

use Spatie\Dropbox\Client;

class DefaultController extends AbstractController
{

    /**
     * @Route("/", name="default_home")
     */
    public function indexAction(Request $request): Response
    {

        $em = $this->getDoctrine()->getManager();
        $hero = $em->getRepository(Hero::class)->findAll();
        $jury = $em->getRepository(Jury::class)->findAll();

        return $this->render('Default/index.html.twig', array(
            'heroes' => $hero,
            'juries' => $jury,
            )
        );




    }

    public function sponsorsAction()
    {

        $em = $this->getDoctrine()->getManager();

        $sponsors = $em->getRepository('App:Sponsor')->findAll();

        return $this->render('Default/sponsors.html.twig', array(
            'sponsors' => $sponsors));
    }

    public function mapAction()
    {
        $em = $this->getDoctrine()->getManager();


        $event = $em->getRepository('App:Event')->findOneById(4);

        $qb = $em->createQueryBuilder();
        $qb->select('a, r')
            ->from('App:Accomodation', 'a')
            ->join('a.rooms', 'r')
            ->where('r.event = :event')
            ->setParameter('event', $event)
            ->distinct(true)
        ;

        $accomodations =$qb->getQuery()->getResult();

        return $this->render('Default/map.html.twig', array(
            'accomodations' => $accomodations
        ));
    }

    public function registerAction()
    {
        return $this->render('Default/register.html.twig');
    }


    /**
     * @Route("/hirek", name="news")
     */
    public function newsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findBy(array(), array('created' => 'DESC'));
        /*
                $imageprovider = $this->get('sonata.media.provider.image');
                foreach ($posts as $key => $post) {
                    $body = $post->getBody();
                    preg_match_all('/\[image-(.*?)\]/', $body, $matches);

                    foreach ($matches[0]  as $i => $match) {
                        $index = $matches[1][$i] - 1;
                        $media = $post->getGallery()->getGalleryHasMedias()->get($index);
                        if ($media) {
                            $format = $imageprovider->getFormatName($media->getMedia(), 'big');
                            $imageUrl = $imageprovider->generatePublicUrl($media->getMedia(), $format);
                             $imgtag = '<br><img src="'.$imageUrl.'" width="100%"><br>';
                            $body = str_replace($matches[0][$i], $imgtag, $body);
                            $post->getGallery()->getGalleryHasMedias()->remove($index);
                        }
                    }
                    $posts[$key]->setBody($body);
                }
        */
        return $this->render('Default/news.html.twig', ['posts' => $posts]);
    }

    /**
     * @Route("/program", name="program")
     */
    public function programAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('App:Program')->findBy(array(), array('id' => 'ASC'));

        return $this->render('Default/program.html.twig', ['posts' => $posts]);
    }

    /**
     * @Route("/privacy", name="privacy")
     */
    public function privacyAction()
    {
        return $this->render('Default/privacy.html.twig');
    }

    /**
     * @Route("/faq", name="faq")
     */
    public function faqAction()
    {
        $faq = Yaml::parse(file_get_contents($this->getParameter('kernel.project_dir') . '/src/Resources/config/faq.yml'));
        return $this->render('Default/faq.html.twig', ['faq' => $faq]);
    }

    public function splashAction()
    {
        return $this->render('Default/splash.html.twig');
    }

    private function slugify($text)
    {
      // replace non letter or digits by -
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);

      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      // trim
      $text = trim($text, '-');

      // remove duplicate -
      $text = preg_replace('~-+~', '-', $text);

      // lowercase
      $text = strtolower($text);

      if (empty($text)) {
        return 'n-a';
      }

      return $text;
    }

    /**
     * @Route("/gr", name="generate-request")
     */
    public function generateRequests()
    {
        $client = new Client('-norBkZx5NsAAAAAAAAAAUYs90Z78Gt05NHGVPTpL6lbdgObVTb46DDMldMbuRl5');

        $em = $this->getDoctrine()->getManager();
       $from = new DateTime('2021-07-01');
//
       // //
//
       // $body = $client->rpcEndpointRequest('file_requests/list');
//
       // foreach ($body['file_requests'] as $req) {
       //     $id = substr($req['destination'], 1, 4);
       //     $m = $em->getRepository('App:EventRegistration')->findOneById($id);
       //     if ($m) {
       //        $m->setDropboxRequest($req['id']);
       //        $em->persist($m);
//
       //     }
       // }
       // $em->flush();
//
       // exit;




        $events = $em->getRepository('App:EventRegistration')->getOnshow($from);

        foreach ($events as $event) {
            $parameters = [
                'title' => 'Kedves ' . $event->getName() . '! Kérjük hogy a ' . $event->getAuthor() . ' – ' . $event->getSongtitle() . '  nagy méretű file-ját töltsd fel az alábbi linken! ',
                'destination'  => '/' . $this->slugify( $event->getId() . ' - ' . $event->getAuthor() . ' – ' . substr($event->getSongtitle(), 0, 10)),
                'deadline' => [
                    'deadline' => '2021-09-28T00:00:00Z'
                ],
                'open' => true
            ];

            if (!$event->getDropboxRequest()) {
                try {
                    $body = $client->rpcEndpointRequest('file_requests/create', $parameters);
                } catch (\Exception $e) {
                    dump($e);
                    exit;
                }

                $event->setDropboxRequest($body['id']);
                $em->persist($event);
                $em->flush();

            }


        }


        exit;

    }

    /**
     * @Route("/mt", name="send_requests")
     * @param \Swift_Mailer $mailer
     */
    public function sendRequests(\Swift_Mailer $mailer)
    {

        $from = new DateTime('2021-07-01');
    

            $em = $this->getDoctrine()->getManager();


                $events = $em->getRepository('App:EventRegistration')->getOnshow($from);

                foreach ($events as $event) {

                    if (!$event->getDropboxRequest()) {
                        continue;
                    }
                    echo $event->getEmail();
                    echo $this->renderView('EventRegistration/request-mail.html.twig', array(
                         'entity'      => $event,
                     ));

                    $message = (new \Swift_Message('Töltsd fel a klip nagyméretű fileját!'))
                        ->setFrom('info@klipszemle.com')
                       ->setTo($event->getEmail())
                       //->setTo('olah.gergely@pixeloid.hu')
                        ->setBody(
                            $this->renderView('EventRegistration/request-mail.html.twig', array(
                                'entity'      => $event,
                            )), 'text/html'
                        );

                    try {
                        $mailer->send($message);
                    } catch (TransportExceptionInterface $e) {
                    }
                    return $this->render('Default/privacy.html.twig');


                }

        exit;

    }

    /**
     * @Route("/mailtest", name="mailtest")
     */
    public function sendEmail(\Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Hello Email teszt 02 APP pass'))
            ->setFrom('info@klipszemle.com')
            ->setTo('olahdzseri@gmail.com')
            ->setBody('You should see me from the profiler!')
        ;

        $mailer->send($message);

        return $this->render('Default/privacy.html.twig');
    }


}
