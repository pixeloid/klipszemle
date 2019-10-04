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
use MediaMonks\SonataMediaBundle\Generator\ImageUrlGenerator;
use MediaMonks\SonataMediaBundle\ParameterBag\ImageParameterBag;
use MediaMonks\SonataMediaBundle\Utility\ImageUtility;

use Spatie\Dropbox\Client;

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
        $posts = $em->getRepository('PixeloidAppBundle:Post')->findBy(array(), array('created' => 'DESC'));
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

        return $this->render('PixeloidAppBundle:Default:news.html.twig', ['posts' => $posts]);
    }

    /**
     * @Route("/program", name="program")
     */

    public function programAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('PixeloidAppBundle:Program')->findBy(array(), array('id' => 'ASC'));

        return $this->render('PixeloidAppBundle:Default:program.html.twig', ['posts' => $posts]);
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

        $em = $this->getDoctrine()->getManager();
        $from = new \DateTime($this->container->getParameter('start_date'));

        $client = new Client('dXvmksGbtSAAAAAAAAAAF_RqBRpK0EAWcFb2D5YlCGBZgEwYCOy-hXY2eC5MZthU');


        // $body = $client->rpcEndpointRequest('file_requests/list');

        // foreach ($body['file_requests'] as $req) {
        //     $id = substr($req['destination'], 1, 4);
        //     $m = $em->getRepository('PixeloidAppBundle:EventRegistration')->findOneById($id);
        //     if ($m) {
        //        $m->setDropboxRequest($req['id']);
        //        $em->persist($m);
        //        $em->flush();

        //     }
        // }
        // exit;




        $events = $em->getRepository('PixeloidAppBundle:EventRegistration')->getOnshow($from);

        foreach ($events as $event) {
            $parameters = [
                'title' => 'Kedves ' . $event->getName() . '! Kérjük hogy a ' . $event->getAuthor() . ' – ' . $event->getSongtitle() . '  nagy méretű file-ját töltsd fel az alábbi linken! ',
                'destination'  => '/' . $this->slugify( $event->getId() . ' - ' . $event->getAuthor() . ' – ' . substr($event->getSongtitle(), 0, 10)),
                'deadline' => [
                    'deadline' => '2019-10-02T00:00:00Z'
                ],
                'open' => true
            ];

            if (!$event->getDropboxRequest()) {
                var_dump($event->getId());
                try {
                    $body = $client->rpcEndpointRequest('file_requests/create', $parameters);
                } catch (Exception $e) {
                    var_dump($e);
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
     */
    public function sendRequests()
    {

            $from = new \DateTime($this->container->getParameter('start_date'));
    

            $em = $this->getDoctrine()->getManager();


                $events = $em->getRepository('PixeloidAppBundle:EventRegistration')->getOnshow($from);
                var_dump($count($events));
                exit;

                foreach ($events as $event) {

                    if (!$event->getDropboxRequest()) {
                        continue;
                    }
                    echo $event->getEmail();
                    echo $this->renderView('PixeloidAppBundle:EventRegistration:request-mail.html.twig', array(
                         'entity'      => $event,
                     ));

                    $message = (new \Swift_Message('Töltsd fel a klip nagyméretű fileját!'))
                        ->setFrom(['info@klipszemle.com' => "Magyar Klipszemle"])
                        //->setTo($event->getEmail())
                        ->setTo('olah.gergely@pixeloid.hu')
                        ->setBody(
                            $this->renderView('PixeloidAppBundle:EventRegistration:request-mail.html.twig', array(
                                'entity'      => $event,
                            )), 'text/html'
                        );
                    try {
                        echo $this->get('mailer')->send($message);
                    } catch (Exception $e) {
                        var_dump($e);
                    }

                }

        exit;

    }

}
