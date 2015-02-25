<?php

namespace Pixeloid\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Room
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Room
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
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="rooms")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    protected $event;

    /**
     * @ORM\ManyToOne(targetEntity="RoomType")
     * @ORM\JoinColumn(name="roomtype_id", referencedColumnName="id")
     */
    protected $roomType;
            

    /**
     * @ORM\ManyToOne(targetEntity="Accomodation", inversedBy="rooms")
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
     * @return Room
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
     * Set event
     *
     * @param \Pixeloid\AppBundle\Entity\Event $event
     * @return Room
     */
    public function setEvent(\Pixeloid\AppBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \Pixeloid\AppBundle\Entity\Event 
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set roomType
     *
     * @param \Pixeloid\AppBundle\Entity\RoomType $roomType
     * @return Room
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
     * @return Room
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
