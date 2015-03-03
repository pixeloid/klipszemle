<?php

namespace Pixeloid\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AccomodationReservation
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class RoomReservation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var integer
     *
     * @ORM\Column(name="persons", type="smallint")
     */
    private $persons;

    /**
     * @ORM\Column(type="date", name="check_in", nullable=true)
     */
    private $checkIn = null;
    
    /**
     * @ORM\Column(type="date", name="check_out", nullable=true)
     */
    private $checkOut = null;

    /**
     * @ORM\Column(type="string", name="roommate", length=255, unique=false, nullable=true)
     */
    protected $roommate = null;
    

    /**
     * @ORM\OneToOne(targetEntity="EventRegistration", inversedBy="roomReservation", cascade={"all"})
     */
    private $eventRegistration;
            
    /**
     * @ORM\ManyToOne(targetEntity="Room")
     * @ORM\JoinColumn(name="room_id", referencedColumnName="id")
     */
    private $room;
            


    public function getTotalCost()
    {   
        $total = $this->getRoom()->getPrice();
        $total *= $this->getPersons();

        $numDays = $this->getNumDays();

        $total *= $numDays;

        return $total;

    }

    public function getNumDays()
    {
        return $this->getCheckIn()->diff($this->getCheckOut())->format('%a');
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set persons
     *
     * @param integer $persons
     * @return RoomReservation
     */
    public function setPersons($persons)
    {
        $this->persons = $persons;

        return $this;
    }

    /**
     * Get persons
     *
     * @return integer 
     */
    public function getPersons()
    {
        return $this->persons;
    }

    /**
     * Set checkIn
     *
     * @param \DateTime $checkIn
     * @return RoomReservation
     */
    public function setCheckIn($checkIn)
    {
        $this->checkIn = $checkIn;

        return $this;
    }

    /**
     * Get checkIn
     *
     * @return \DateTime 
     */
    public function getCheckIn()
    {
        return $this->checkIn;
    }

    /**
     * Set checkOut
     *
     * @param \DateTime $checkOut
     * @return RoomReservation
     */
    public function setCheckOut($checkOut)
    {
        $this->checkOut = $checkOut;

        return $this;
    }

    /**
     * Get checkOut
     *
     * @return \DateTime 
     */
    public function getCheckOut()
    {
        return $this->checkOut;
    }

    /**
     * Set eventRegistration
     *
     * @param \Pixeloid\AppBundle\Entity\EventRegistration $eventRegistration
     * @return RoomReservation
     */
    public function setEventRegistration(\Pixeloid\AppBundle\Entity\EventRegistration $eventRegistration = null)
    {
        $this->eventRegistration = $eventRegistration;

        return $this;
    }

    /**
     * Get eventRegistration
     *
     * @return \Pixeloid\AppBundle\Entity\EventRegistration 
     */
    public function getEventRegistration()
    {
        return $this->eventRegistration;
    }

    /**
     * Set room
     *
     * @param \Pixeloid\AppBundle\Entity\Room $room
     * @return RoomReservation
     */
    public function setRoom(\Pixeloid\AppBundle\Entity\Room $room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return \Pixeloid\AppBundle\Entity\Room 
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Set roommate
     *
     * @param string $roommate
     * @return RoomReservation
     */
    public function setRoommate($roommate)
    {
        $this->roommate = $roommate;

        return $this;
    }

    /**
     * Get roommate
     *
     * @return string 
     */
    public function getRoommate()
    {
        return $this->roommate;
    }
}
