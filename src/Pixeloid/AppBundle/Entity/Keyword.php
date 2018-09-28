<?php

namespace Pixeloid\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Keyword
 *
 * @ORM\Table(name="keyword")
 * @ORM\Entity(repositoryClass="Pixeloid\AppBundle\Repository\KeywordRepository")
 */
class Keyword
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="EventRegistration", inversedBy="keywords", cascade={"persist","remove"})
     */
    protected $eventregistrations;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Keyword
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
     * Constructor
     */
    public function __construct()
    {
        $this->eventregistrations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add eventregistration
     *
     * @param \Pixeloid\AppBundle\Entity\EventRegistration $eventregistration
     *
     * @return Keyword
     */
    public function addEventregistration(\Pixeloid\AppBundle\Entity\EventRegistration $eventregistration)
    {

        $eventregistration->addKeyword($this);
        $this->eventregistrations[] = $eventregistration;

        return $this;
    }

    /**
     * Remove eventregistration
     *
     * @param \Pixeloid\AppBundle\Entity\EventRegistration $eventregistration
     */
    public function removeEventregistration(\Pixeloid\AppBundle\Entity\EventRegistration $eventregistration)
    {
        $this->eventregistrations->removeElement($eventregistration);
    }

    /**
     * Get eventregistrations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEventregistrations()
    {
        return $this->eventregistrations;
    }

    public function __toString()
    {
        return $this->name;
    }
}
