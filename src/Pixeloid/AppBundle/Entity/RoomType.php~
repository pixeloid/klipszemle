<?php

namespace Pixeloid\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RoomType
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class RoomType
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
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

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
     * @return RoomType
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
     * Set price
     *
     * @param string $price
     * @return RoomType
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
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
        $this->accomodations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add accomodations
     *
     * @param \Pixeloid\AppBundle\Entity\Accomodation $accomodations
     * @return RoomType
     */
    public function addAccomodation(\Pixeloid\AppBundle\Entity\Accomodation $accomodations)
    {
        $this->accomodations[] = $accomodations;

        return $this;
    }

    /**
     * Remove accomodations
     *
     * @param \Pixeloid\AppBundle\Entity\Accomodation $accomodations
     */
    public function removeAccomodation(\Pixeloid\AppBundle\Entity\Accomodation $accomodations)
    {
        $this->accomodations->removeElement($accomodations);
    }

    /**
     * Get accomodations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAccomodations()
    {
        return $this->accomodations;
    }

    /**
     * Add accomodationRooms
     *
     * @param \Pixeloid\AppBundle\Entity\AccomodationRoom $accomodationRooms
     * @return RoomType
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
