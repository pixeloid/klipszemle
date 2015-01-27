<?php

namespace Pixeloid\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Accomodation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pixeloid\AppBundle\Entity\AccomodationRepository")
 */
class Accomodation
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;


    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;


    /**
     * @ORM\OneToMany(targetEntity="AccomodationRoom", mappedBy="accomodation")
     */
    protected $accomodationRooms;



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
     * Set name
     *
     * @param string $name
     * @return Accomodation
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Accomodation
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set priceSingle
     *
     * @param float $priceSingle
     * @return Accomodation
     */
    public function setPriceSingle($priceSingle)
    {
        $this->priceSingle = $priceSingle;

        return $this;
    }

    /**
     * Get priceSingle
     *
     * @return float 
     */
    public function getPriceSingle()
    {
        return $this->priceSingle;
    }

    /**
     * Set priceDouble
     *
     * @param float $priceDouble
     * @return Accomodation
     */
    public function setPriceDouble($priceDouble)
    {
        $this->priceDouble = $priceDouble;

        return $this;
    }

    /**
     * Get priceDouble
     *
     * @return float 
     */
    public function getPriceDouble()
    {
        return $this->priceDouble;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add events
     *
     * @param \Pixeloid\AppBundle\Entity\Event $events
     * @return Accomodation
     */
    public function addEvent(\Pixeloid\AppBundle\Entity\Event $events)
    {
        $this->events[] = $events;

        return $this;
    }

    /**
     * Remove events
     *
     * @param \Pixeloid\AppBundle\Entity\Event $events
     */
    public function removeEvent(\Pixeloid\AppBundle\Entity\Event $events)
    {
        $this->events->removeElement($events);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Add roomTypes
     *
     * @param \Pixeloid\AppBundle\Entity\RoomTypes $roomTypes
     * @return Accomodation
     */
    public function addRoomType(\Pixeloid\AppBundle\Entity\RoomTypes $roomTypes)
    {
        $this->roomTypes[] = $roomTypes;

        return $this;
    }

    /**
     * Remove roomTypes
     *
     * @param \Pixeloid\AppBundle\Entity\RoomTypes $roomTypes
     */
    public function removeRoomType(\Pixeloid\AppBundle\Entity\RoomTypes $roomTypes)
    {
        $this->roomTypes->removeElement($roomTypes);
    }

    /**
     * Get roomTypes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoomTypes()
    {
        return $this->roomTypes;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Accomodation
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Add accomodationRooms
     *
     * @param \Pixeloid\AppBundle\Entity\AccomodationRoom $accomodationRooms
     * @return Accomodation
     */
    public function addAccomodationRoom(\Pixeloid\AppBundle\Entity\AccomodationRoom $accomodationRooms)
    {
        $this->accomodationRooms[] = $accomodationRooms;

        return $this;
    }

    /**
     * Remove accomodationRooms
     *
     * @param \Pixeloid\AppBundle\Entity\AccomodationRoom $accomodationRooms
     */
    public function removeAccomodationRoom(\Pixeloid\AppBundle\Entity\AccomodationRoom $accomodationRooms)
    {
        $this->accomodationRooms->removeElement($accomodationRooms);
    }

    /**
     * Get accomodationRooms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAccomodationRooms()
    {
        return $this->accomodationRooms;
    }
}
