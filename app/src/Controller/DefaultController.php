<?php

namespace App\Controller;

use App\Entity\Faq;
use App\Entity\Hero;
use App\Entity\Jury;
use App\Entity\Post;
use App\Entity\Program;
use App\Entity\Sponsor;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Yaml\Yaml;

use Spatie\Dropbox\Client;

class DefaultController extends AbstractController
{
    private MailerInterface $mailer;
    private EntityManagerInterface $em;

    /**
     * DefaultController constructor.
     * @param MailerInterface $mailer
     * @param EntityManagerInterface $em
     */
    public function __construct(MailerInterface $mailer, EntityManagerInterface $em)
    {
        $this->mailer = $mailer;
        $this->em = $em;
    }


    /**
     * @Route("/", name="default_home")
     */
    public function indexAction(): Response
    {

        $hero = $this->em->getRepository(Hero::class)->findAll();
        $jury = $this->em->getRepository(Jury::class)->findAll();

        return $this->render('Default/index.html.twig', [
            'heroes' => $hero,
            'juries' => $jury,
            ]);
    }

    public function sponsorsAction(): Response
    {


        $sponsors = $this->em->getRepository(Sponsor::class)->findAll();

        return $this->render('Default/sponsors.html.twig', [
            'sponsors' => $sponsors, ]);
    }



    public function registerAction(): Response
    {
        return $this->render('Default/register.html.twig');
    }


    /**
     * @Route("/hirek", name="news")
     */
    public function newsAction(): Response
    {
        $posts = $this->em->getRepository(Post::class)->findBy([]);
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
    public function programAction(): Response
    {
        $posts = $this->em->getRepository(Program::class)->findBy([], ['id' => 'ASC']);

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
        $faq = $this->em->getRepository(Faq::class)->findAll();
        
        $result = [];

        /** @var Faq $item */
        foreach ($faq as $item) {
            $result[$item->getCollection()->getName()][] = $item;
        }
        
        return $this->render('Default/faq.html.twig', ['faq' => $result]);
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
     * @Route("/reinit", name="reinit-request")
     */
    public function reinit()
    {
        $from = new DateTime('2021-07-01');
        $client = new Client('aURZZKlp2_IAAAAAAAAAAe2MGIIYK7bPtRrgeS0s6S5ohjrhW6Sp7XGLDV85O7ty');
        $events = $this->em->getRepository('App:EventRegistration')->getOnshow($from);

        foreach ($events as $event) {
            $id = $event->getDropboxRequest();


            $request = $client->rpcEndpointRequest('file_requests/get', [
                'id' => $id,
            ]);

            if ($request['is_open'] === true) {
                $event->setCreated(new \DateTime('2010-01-01'));
                $this->em->persist($event);
                $this->em->flush();

                continue;
            };

            try {
                $result = $client->rpcEndpointRequest('file_requests/update', [
                    'id' => $id,
                    'open' => true,
                ]);
            } catch (\Exception $e) {
                dump($e->getMessage());
            }
            $event->setHaveRights(true);
            $this->em->persist($event);
            $this->em->flush();
        }
    }
    /**
     * @Route("/gr", name="generate-request")
     */
    public function generateRequests()
    {
        $client = new Client('-norBkZx5NsAAAAAAAAAAUYs90Z78Gt05NHGVPTpL6lbdgObVTb46DDMldMbuRl5');

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




        $events = $this->em->getRepository('App:EventRegistration')->getPremiere($from);

        foreach ($events as $event) {
            $parameters = [
                'title' => sprintf(
                    "Kedves %s! Kérjük hogy a %s – %s  nagy méretű file-ját töltsd fel az alábbi linken! ",
                    $event->getName(),
                    $event->getAuthor(),
                    $event->getSongtitle()
                ),
                'destination'  => "/{$this->slugify(
                    sprintf(
                            "%s - %s – %s",
                            $event->getId(),
                            $event->getAuthor(),
                            substr($event->getSongtitle(), 0, 10)
                        )
                )}",
                'deadline' => [
                    'deadline' => '2021-10-01T00:00:00Z',
                ],
                'open' => true,
            ];

            if (!$event->getDropboxRequest()) {
                try {
                    $body = $client->rpcEndpointRequest('file_requests/create', $parameters);
                } catch (\Exception $e) {
                    dump($e);
                    exit;
                }

                $event->setDropboxRequest($body['id']);
                $this->em->persist($event);
                $this->em->flush();
            }
        }


        exit;
    }

    public function sendRequests(Swift_Mailer $mailer)
    {


        $this->readCsv();

        return $this->render('Default/privacy.html.twig');
/*

        $from = new DateTime('2021-07-01');




                $events = $this->em->getRepository('App:EventRegistration')->getOnshow($from);

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


                }

        return $this->render('Default/privacy.html.twig');
*/
    }

    public function sendEmail(Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Hello Email teszt 02 APP pass'))
            ->setFrom('info@klipszemle.com')
            ->setTo('olahdzseri@gmail.com')
            ->setBody('You should see me from the profiler!')
        ;

        $mailer->send($message);

        return $this->render('Default/privacy.html.twig');
    }

    private function readCsv()
    {
        if (($fp = fopen("../public/uploads/shortlist.csv", "r")) !== false) {
            while (($row = fgetcsv($fp, 1000, ",")) !== false) {
//                dump($row);
                $this->sendShortlistMail($row);
            }
            fclose($fp);
        }
    }

    private function sendShortlistMail($row)
    {
        $message = (new \Swift_Message('EMLÉKEZTETŐ: Holnap 06. Magyar Klipszemle díjtadó gála!'))
            ->setFrom('info.klipszemle@gmail.com')
        ->setTo($row[1])
            ->setBody(
                $this->renderView('EventRegistration/shortlist-mail.html.twig', [
                    'row'      => $row,
                ]),
                'text/html'
            );

        try {
            $this->mailer->send($message);
//
        //    dump($message);
        //    dump($row);
        } catch (TransportExceptionInterface $e) {
            dump($e);
        }
    }
}
