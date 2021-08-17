<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RoomRepositoryFunctionalTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $event;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        self::bootKernel();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager()
        ;

        $this->event = $this->em->getRepository('App:Event')->findOneById(2);
    }

    public function testEventRooms()
    {
        $rooms = $this->em
            ->getRepository('App:Room')
            ->findByEvent($this->event);
        ;

        $this->assertCount(10, $rooms);
    }

    public function testAccomodationsFromEventRooms()
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('a')
            ->from('App:Accomodation', 'a')
            ->join('a.rooms', 'r')
            ->where('r.event = :event')
            ->setParameter('event', $this->event)
            ->distinct(true)
        ;


        $accomodations =$qb->getQuery()->getResult();
        $this->assertCount(2, $accomodations);
        $this->assertCount(2, $accomodations[0]->getRooms());
        $this->assertCount(10, $accomodations[1]->getRooms());
        $this->assertCount(10, $accomodations[1]->getRooms());
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
        $this->em->close();
    }
}
