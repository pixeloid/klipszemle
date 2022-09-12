<?php

namespace App\Controller;

use App\Entity\EmailLog;
use App\Entity\EventRegistration;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use PDOException;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Controller\CRUDController;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Exception\ModelManagerException;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class EventRegistrationAdminController extends CRUDController
{
    private $mailer;
    private $em;

    /**
     * @param MailerInterface $mailer
     * @param EntityManagerInterface $em
     */
    public function __construct(MailerInterface $mailer, EntityManagerInterface $em)
    {
        $this->mailer = $mailer;
        $this->em = $em;
    }

    /**
     * @throws ModelManagerException
     * @throws \Sonata\AdminBundle\Exception\ModelManagerThrowable
     */
    public function batchActionVoteMail(
        ProxyQueryInterface $query,
        AdminInterface      $admin,
        Request             $request
    ): RedirectResponse {
        $admin->checkAccess('edit');
        $admin->checkAccess('delete');
        
        $qb = $query->getQueryBuilder();
        $qb->select('DISTINCT '.current($qb->getRootAliases()));

        foreach ($qb->getQuery()->toIterable() as $object) {
            $this->sendMail(
                'email/vote-invite.html.twig',
                'Elindult a közönségszavazás!',
                $object
            );
        }

        $this->addFlash('sonata_flash_success', 'Sikeres küldés!');

        return $this->redirectToList();
    }

    private function sendMail(string $template, string $subject, EventRegistration $eventRegistration)
    {
        $email = (new TemplatedEmail())
            ->from(new Address('info@klipszemle.com', 'Hajógyár x 06. Magyar Klipszemle'))
            ->replyTo('info.klipszemle@gmail.com')
            ->to($eventRegistration->getUser()->getEmail())
            ->subject($subject)
            ->htmlTemplate($template)
            ->context([
                'er' => $eventRegistration,
            ])
        ;

        $body = $email->getHtmlTemplate();

        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            $body = $e->getMessage();
        }

        $log = new EmailLog;
        $log->setEmail($eventRegistration->getUser()->getEmail());
        $log->setSubject($subject);
        $log->setBody($body);
        $this->em->persist($log);
        $this->em->flush();
    }
}
