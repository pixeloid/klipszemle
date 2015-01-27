<?php

namespace Pixeloid\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AccomodationRoom
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class AccomodationRoom
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
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;


    /**
     * @ORM\ManyToOne(targetEntity="Event")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    protected $event;

    /**
     * @ORM\ManyToOne(targetEntity="RoomType")
     * @ORM\JoinColumn(name="roomtype_id", referencedColumnName="id")
     */
    protected $roomType;
            

    /**
     * @ORM\ManyToOne(targetEntity="Accomodation")
     * @ORM\JoinColumn(name="accomodation_id", referencedColumnName="id")
     */
    protected $accomodation;

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
     * Set price
     *
     * @param float $price
     * @return AccomodationRoom
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->event = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add event
     *
     * @param \Pixeloid\AppBundle\Entity\Event $event
     * @return AccomodationRoom
     */
    public function addEvent(\Pixeloid\AppBundle\Entity\Event $event)
    {
        $this->event[] = $event;

        return $this;
    }

    /**
     * Remove event
     *
     * @param \Pixeloid\AppBundle\Entity\Event $event
     */
    public function removeEvent(\Pixeloid\AppBundle\Entity\Event $event)
    {
        $this->event->removeElement($event);
    }

    /**
     * Get event
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set event
     *
     * @param \Pixeloid\AppBundle\Entity\Event $event
     * @return AccomodationRoom
     */
    public function setEvent(\Pixeloid\AppBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Set roomType
     *
     * @param \Pixeloid\AppBundle\Entity\RoomType $roomType
     * @return AccomodationRoom
     */
    public function setRoomType(\Pixeloid\AppBundle\Entity\RoomType $roomType = null)
    {
        $this->roomType = $roomType;

        return $this;
    }

    /**
     * Get roomType
     *
     * @return \Pixeloid\AppBundle\Entity\RoomType 
     */
    public function getRoomType()
    {
        return $this->roomType;
    }

    /**
     * Set accomodation
     *
     * @param \Pixeloid\AppBundle\Entity\Accomodation $accomodation
     * @return AccomodationRoom
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
}
