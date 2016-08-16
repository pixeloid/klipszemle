<?php

namespace Pixeloid\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventRegistrationCategory
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class EventRegistrationCategory
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
     * @var boolean
     *
     * @ORM\Column(name="shortlist", type="boolean", nullable=true)
     */
    private $shortlist;


    /**
     * @ORM\ManyToOne(targetEntity="EventRegistration")
     */
    protected $eventregistration;
    /**
     * @ORM\ManyToOne(targetEntity="MovieCategory")
     */
    protected $category;
    


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
     * Set shortlist
     *
     * @param boolean $shortlist
     *
     * @return EventRegistrationCategory
     */
    public function setShortlist($shortlist)
    {
        $this->shortlist = $shortlist;

        return $this;
    }

    /**
     * Get shortlist
     *
     * @return boolean
     */
    public function getShortlist()
    {
        return $this->shortlist;
    }

    /**
     * Set eventregistration
     *
     * @param \Pixeloid\AppBundle\Entity\EventRegistration $eventregistration
     *
     * @return EventRegistrationCategory
     */
    public function setEventregistration(\Pixeloid\AppBundle\Entity\EventRegistration $eventregistration = null)
    {
        $this->eventregistration = $eventregistration;

        return $this;
    }

    /**
     * Get eventregistration
     *
     * @return \Pixeloid\AppBundle\Entity\EventRegistration
     */
    public function getEventregistration()
    {
        return $this->eventregistration;
    }

    /**
     * Set category
     *
     * @param \Pixeloid\AppBundle\Entity\MovieCategory $category
     *
     * @return EventRegistrationCategory
     */
    public function setCategory(\Pixeloid\AppBundle\Entity\MovieCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Pixeloid\AppBundle\Entity\MovieCategory
     */
    public function getCategory()
    {
        return $this->category;
    }
}
