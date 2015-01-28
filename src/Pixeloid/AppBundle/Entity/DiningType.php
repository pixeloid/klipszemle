<?php

namespace Pixeloid\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DiningType
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class DiningType
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
     * @ORM\OneToMany(targetEntity="Dining", mappedBy="diningType")
     */
    protected $dinings;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dinings = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return DiningType
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
     * Add dinings
     *
     * @param \Pixeloid\AppBundle\Entity\Dining $dinings
     * @return DiningType
     */
    public function addDining(\Pixeloid\AppBundle\Entity\Dining $dinings)
    {
        $this->dinings[] = $dinings;

        return $this;
    }

    /**
     * Remove dinings
     *
     * @param \Pixeloid\AppBundle\Entity\Dining $dinings
     */
    public function removeDining(\Pixeloid\AppBundle\Entity\Dining $dinings)
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
