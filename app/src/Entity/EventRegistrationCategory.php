<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventRegistrationCategory
 */
#[ORM\Table]
#[ORM\Entity]
class EventRegistrationCategory implements \Stringable
{
    #[ORM\Column(name: 'id', type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;
    #[ORM\Column(name: 'shortlist', type: 'boolean', nullable: true)]
    private bool $shortlist;
    #[ORM\ManyToOne(targetEntity: 'EventRegistration', inversedBy: 'moviecategories')]
    protected $eventregistration;
    #[ORM\ManyToOne(targetEntity: 'MovieCategory')]
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
     *
     * @return EventRegistrationCategory
     */
    public function setEventregistration(\App\Entity\EventRegistration $eventregistration = null)
    {
        $this->eventregistration = $eventregistration;

        return $this;
    }
    /**
     * Get eventregistration
     *
     * @return \App\Entity\EventRegistration
     */
    public function getEventregistration()
    {
        return $this->eventregistration;
    }
    /**
     * Set category
     *
     *
     * @return EventRegistrationCategory
     */
    public function setCategory(\App\Entity\MovieCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }
    /**
     * Get category
     *
     * @return \App\Entity\MovieCategory
     */
    public function getCategory()
    {
        return $this->category;
    }
    public function __toString(): string
{
    return (string) ($this->category ? $this->category->getName() : '');
}
}
