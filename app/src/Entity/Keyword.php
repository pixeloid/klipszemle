<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Keyword
 */
#[ORM\Table(name: 'keyword')]
#[ORM\Entity]
class Keyword implements \Stringable
{
    #[ORM\Column(name: 'id', type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;
    #[ORM\Column(name: 'name', type: 'string', length: 255, unique: true)]
    private string $name;
    #[ORM\ManyToMany(targetEntity: 'EventRegistration', inversedBy: 'keywords', cascade: ['persist', 'remove'])]
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
     *
     * @return Keyword
     */
    public function addEventregistration(\App\Entity\EventRegistration $eventregistration)
    {

        $eventregistration->addKeyword($this);
        $this->eventregistrations[] = $eventregistration;

        return $this;
    }
    /**
     * Remove eventregistration
     */
    public function removeEventregistration(\App\Entity\EventRegistration $eventregistration)
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
    public function __toString(): string
    {
        return $this->name;
    }
}
