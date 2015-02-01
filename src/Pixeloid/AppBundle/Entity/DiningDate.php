<?php

namespace Pixeloid\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DiningDates
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class DiningDate
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Dining")
     * @ORM\JoinColumn(name="dining_id", referencedColumnName="id")
     */
    protected $dining;


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
     * Set date
     *
     * @param \DateTime $date
     * @return DiningDates
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
        return $this->date->format('Y-m-d');
    }

    /**
     * Set diningId
     *
     * @param \Pixeloid\AppBundle\Entity\Dining $diningId
     * @return DiningDate
     */
    public function setDiningId(\Pixeloid\AppBundle\Entity\Dining $diningId = null)
    {
        $this->diningId = $diningId;

        return $this;
    }

    /**
     * Get diningId
     *
     * @return \Pixeloid\AppBundle\Entity\Dining 
     */
    public function getDiningId()
    {
        return $this->diningId;
    }

    /**
     * Set dining
     *
     * @param \Pixeloid\AppBundle\Entity\Dining $dining
     * @return DiningDate
     */
    public function setDining(\Pixeloid\AppBundle\Entity\Dining $dining = null)
    {
        $this->dining = $dining;

        return $this;
    }

    /**
     * Get dining
     *
     * @return \Pixeloid\AppBundle\Entity\Dining 
     */
    public function getDining()
    {
        return $this->dining;
    }
}
