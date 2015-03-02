<?php

namespace Pixeloid\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dining
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pixeloid\AppBundle\Entity\DiningRepository")
 */
class Dining
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
     * @ORM\Column(name="price", type="decimal")
     */
    private $price;



    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="dinings")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    protected $event;

    /**
     * @ORM\ManyToOne(targetEntity="DiningType", inversedBy="dinings")
     * @ORM\JoinColumn(name="dining_type_id", referencedColumnName="id")
     */
    protected $diningType;
            

    /**
     * @ORM\OneToMany(targetEntity="DiningDate", mappedBy="dining")
     */
    protected $diningDates;


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
     * @param string $price
     * @return Dining
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
     * Set dates
     *
     * @param array $dates
     * @return Dining
     */
    public function setDates($dates)
    {
        $this->dates = $dates;

        return $this;
    }

    /**
     * Get dates
     *
     * @return array 
     */
    public function getDates()
    {
        return $this->dates;
    }

    /**
     * Set event
     *
     * @param \Pixeloid\AppBundle\Entity\Event $event
     * @return Dining
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
     * Set diningType
     *
     * @param \Pixeloid\AppBundle\Entity\DiningType $diningType
     * @return Dining
     */
    public function setDiningType(\Pixeloid\AppBundle\Entity\DiningType $diningType = null)
    {
        $this->diningType = $diningType;

        return $this;
    }

    /**
     * Get diningType
     *
     * @return \Pixeloid\AppBundle\Entity\DiningType 
     */
    public function getDiningType()
    {
        return $this->diningType;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Dining
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->diningDates = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add diningDates
     *
     * @param \Pixeloid\AppBundle\Entity\DiningDate $diningDates
     * @return Dining
     */
    public function addDiningDate(\Pixeloid\AppBundle\Entity\DiningDate $diningDates)
    {
        $this->diningDates[] = $diningDates;

        return $this;
    }

    /**
     * Remove diningDates
     *
     * @param \Pixeloid\AppBundle\Entity\DiningDate $diningDates
     */
    public function removeDiningDate(\Pixeloid\AppBundle\Entity\DiningDate $diningDates)
    {
        $this->diningDates->removeElement($diningDates);
    }

    /**
     * Get diningDates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDiningDates()
    {
        return $this->diningDates;
    }
}
