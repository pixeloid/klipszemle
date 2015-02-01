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
     * @ORM\OneToMany(targetEntity="Pixeloid\AppBundle\Entity\DiningReservationDining", mappedBy="diningReservation")
     */
    private $dinings;

            


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

    /**
     * Get diningDates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDiningDates()
    {
        return $this->diningDates;
    }

    /**
     * Add dinings
     *
     * @param \Pixeloid\AppBundle\Entity\DiningReservationDining $dinings
     * @return DiningReservation
     */
    public function addDining(\Pixeloid\AppBundle\Entity\DiningReservationDining $dinings)
    {
        $this->dinings[] = $dinings;

        return $this;
    }

    /**
     * Remove dinings
     *
     * @param \Pixeloid\AppBundle\Entity\DiningReservationDining $dinings
     */
    public function removeDining(\Pixeloid\AppBundle\Entity\DiningReservationDining $dinings)
    {
        $this->dinings->removeElement($dinings);
    }

    /**
     * Get dinings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDinings()
    {
        return $this->dinings;
    }
}
