<?php


namespace Pixeloid\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Pixeloid\AppBundle\Entity\EventRegistration;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="SiteUser")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\OneToMany(targetEntity="Pixeloid\AppBundle\Entity\EventRegistration", mappedBy="user")
     **/
    protected $eventRegistrations;


    public function __construct()
    {
        parent::__construct();
        $this->eventRegistrations = new \Doctrine\Common\Collections\ArrayCollection();
        // your own logic
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
     * Add eventRegistrations
     *
     * @param \Pixeloid\AppBundle\Entity\EventRegistration $eventRegistrations
     * @return User
     */
    public function addEventRegistration(\Pixeloid\AppBundle\Entity\EventRegistration $eventRegistrations)
    {
        $this->eventRegistrations[] = $eventRegistrations;

        return $this;
    }

    /**
     * Remove eventRegistrations
     *
     * @param \Pixeloid\AppBundle\Entity\EventRegistration $eventRegistrations
     */
    public function removeEventRegistration(\Pixeloid\AppBundle\Entity\EventRegistration $eventRegistrations)
    {
        $this->eventRegistrations->removeElement($eventRegistrations);
    }

    /**
     * Get eventRegistrations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEventRegistrations()
    {
        return $this->eventRegistrations;
    }
}
