<?php

namespace Pixeloid\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DiningReservationDining
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class DiningReservationDining
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
     * @ORM\ManyToOne(targetEntity="DiningReservation", inversedBy="dinings")
     * @ORM\JoinColumn(name="dining_reservation_id", referencedColumnName="id")
     */
    private $diningReservation;


    /**
     * @ORM\ManyToOne(targetEntity="DiningDate")
     * @ORM\JoinColumn(name="dining_date_id", referencedColumnName="id")
     */
    private $diningDate;



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
     * Set diningReservation
     *
     * @param \Pixeloid\AppBundle\Entity\DiningReservation $diningReservation
     * @return DiningReservationDining
     */
    public function setDiningReservation(\Pixeloid\AppBundle\Entity\DiningReservation $diningReservation = null)
    {
        $this->diningReservation = $diningReservation;

        return $this;
    }

    /**
     * Get diningReservation
     *
     * @return \Pixeloid\AppBundle\Entity\DiningReservation 
     */
    public function getDiningReservation()
    {
        return $this->diningReservation;
    }

    /**
     * Set diningDate
     *
     * @param \Pixeloid\AppBundle\Entity\DiningDate $diningDate
     * @return DiningReservationDining
     */
    public function setDiningDate(\Pixeloid\AppBundle\Entity\DiningDate $diningDate = null)
    {
        $this->diningDate = $diningDate;

        return $this;
    }

    /**
     * Get diningDate
     *
     * @return \Pixeloid\AppBundle\Entity\DiningDate 
     */
    public function getDiningDate()
    {
        return $this->diningDate;
    }
}
