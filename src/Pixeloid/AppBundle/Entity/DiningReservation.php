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
     * @ORM\ManyToOne(targetEntity="EventRegistration", inversedBy="diningReservations")
     * @ORM\JoinColumn(name="event_registration_id", referencedColumnName="id")
     */
    private $eventRegistration;
            
    /**
     * @ORM\ManyToOne(targetEntity="DiningDate")
     * @ORM\JoinColumn(name="dining_date_id", referencedColumnName="id")
     */
    private $diningDate;
            


    public function getTotalCost()
    {
        // $total = ($this->getRoomType() == 'single') ? $this->getAccomodation()->getPriceSingle() : $this->getAccomodation()->getPriceDouble();
        // $total *= $this->getPersons();

        // $numDays = $this->getNumDays();

        // $total *= $numDays;

        // return $total;

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
     * Constructor
     */
    public function __construct()
    {
        $this->diningDate = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add diningDate
     *
     * @param \Pixeloid\AppBundle\Entity\DiningDate $diningDate
     * @return DiningReservation
     */
    public function addDiningDate(\Pixeloid\AppBundle\Entity\DiningDate $diningDate)
    {
        $this->diningDate[] = $diningDate;

        return $this;
    }

    /**
     * Remove diningDate
     *
     * @param \Pixeloid\AppBundle\Entity\DiningDate $diningDate
     */
    public function removeDiningDate(\Pixeloid\AppBundle\Entity\DiningDate $diningDate)
    {
        $this->diningDate->removeElement($diningDate);
    }

    /**
     * Get diningDate
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDiningDate()
    {
        return $this->diningDate;
    }

    /**
     * Set diningDate
     *
     * @param \Pixeloid\AppBundle\Entity\DiningDate $diningDate
     * @return DiningReservation
     */
    public function setDiningDate(\Pixeloid\AppBundle\Entity\DiningDate $diningDate = null)
    {
        $this->diningDate = $diningDate;

        return $this;
    }
}
