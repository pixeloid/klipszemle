<?php

namespace Pixeloid\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AccomodationReservation
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class DiningReservation
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
     * @ORM\Column(type="string", name="special", length=100, unique=false, nullable=true)
     */
    protected $special = null;
    


    /**
     * @ORM\ManyToOne(targetEntity="EventRegistration", inversedBy="diningReservations")
     * @ORM\JoinColumn(name="event_registration_id", referencedColumnName="id")
     */
    private $eventRegistration;
            
    /**
     * @ORM\ManyToMany(targetEntity="Pixeloid\AppBundle\Entity\DiningDate", mappedBy="diningReservations")
     */
    private $diningDates;

            


    public function getTotalCost()
    {
        $total = 0;
        foreach ($this->diningDates as $date) {
            $total += $date->getDining()->getPrice();
        }

        return $total;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->diningDates = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set special
     *
     * @param string $special
     * @return DiningReservation
     */
    public function setSpecial($special)
    {
        $this->special = $special;

        return $this;
    }

    /**
     * Get special
     *
     * @return string 
     */
    public function getSpecial()
    {
        return $this->special;
    }

    /**
     * Set eventRegistration
     *
     * @param \Pixeloid\AppBundle\Entity\EventRegistration $eventRegistration
     * @return DiningReservation
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
     * Add diningDates
     *
     * @param \Pixeloid\AppBundle\Entity\DiningDate $diningDates
     * @return DiningReservation
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
