<?php

namespace Pixeloid\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AccomodationReservation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pixeloid\AppBundle\Entity\AccomodationReservationRepository")
 */
class AccomodationReservation
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
     * @ORM\Column(name="room_type", type="string", length=10)
     */
    private $roomType;

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
     * @ORM\OneToOne(targetEntity="EventRegistration", inversedBy="reservation", cascade={"persist"})
     * @ORM\JoinColumn(name="event_registration_id", referencedColumnName="id")
     */
    private $eventRegistration;
            
    /**
     * @ORM\ManyToOne(targetEntity="Accomodation")
     * @ORM\JoinColumn(name="accomodation_id", referencedColumnName="id")
     */
    private $accomodation;
            


    public function getTotalCost()
    {
        $total = ($this->getRoomType() == 'single') ? $this->getAccomodation()->getPriceSingle() : $this->getAccomodation()->getPriceDouble();
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
     * Set roomType
     *
     * @param integer $roomType
     * @return AccomodationReservation
     */
    public function setRoomType($roomType)
    {
        $this->roomType = $roomType;

        return $this;
    }

    /**
     * Get roomType
     *
     * @return integer 
     */
    public function getRoomType()
    {
        return $this->roomType;
    }

    /**
     * Set roomQty
     *
     * @param integer $roomQty
     * @return AccomodationReservation
     */
    public function setRoomQty($roomQty)
    {
        $this->roomQty = $roomQty;

        return $this;
    }

    /**
     * Get roomQty
     *
     * @return integer 
     */
    public function getRoomQty()
    {
        return $this->roomQty;
    }

    /**
     * Set eventRegistration
     *
     * @param \Pixeloid\AppBundle\Entity\EventRegistration $eventRegistration
     * @return AccomodationReservation
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
     * Set accomodation
     *
     * @param \Pixeloid\AppBundle\Entity\Accomodation $accomodation
     * @return AccomodationReservation
     */
    public function setAccomodation(\Pixeloid\AppBundle\Entity\Accomodation $accomodation = null)
    {
        $this->accomodation = $accomodation;

        return $this;
    }

    /**
     * Get accomodation
     *
     * @return \Pixeloid\AppBundle\Entity\Accomodation 
     */
    public function getAccomodation()
    {
        return $this->accomodation;
    }

    /**
     * Set persons
     *
     * @param integer $persons
     * @return AccomodationReservation
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
     * @return AccomodationReservation
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
     * @return AccomodationReservation
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
}
