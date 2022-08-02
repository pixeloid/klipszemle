<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\Timestampable;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Vote
 */
#[ORM\Table]
#[ORM\Entity]
class Vote
{
    use Timestampable;
    #[ORM\Column(name: 'id', type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;
    #[ORM\Column(name: 'created', type: 'datetime')]
    private \DateTime $created;
    #[ORM\ManyToOne(targetEntity: 'EventRegistration', inversedBy: 'votes')]
    protected $eventRegistration;
    #[ORM\ManyToOne(targetEntity: 'User', inversedBy: 'votes')]
    protected $user;
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Vote
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }
    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }
    /**
     * Set eventRegistration
     *
     *
     * @return Vote
     */
    public function setEventRegistration(\App\Entity\EventRegistration $eventRegistration = null)
    {
        $this->eventRegistration = $eventRegistration;

        return $this;
    }
    /**
     * Get eventRegistration
     *
     * @return \App\Entity\EventRegistration
     */
    public function getEventRegistration()
    {
        return $this->eventRegistration;
    }
    /**
     * Set user
     *
     *
     * @return Vote
     */
    public function setUser(UserInterface $user = null)
    {
        $this->user = $user;

        return $this;
    }
    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}
