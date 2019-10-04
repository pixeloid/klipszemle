<?php

namespace Pixeloid\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MovieCategory
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pixeloid\AppBundle\Repository\MovieCategoryRepository")
 */
class MovieCategory
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="EventRegistrationCategory", mappedBy="category", cascade={"persist","remove"}, orphanRemoval=true)
     */
    protected $eventRegistrationCategories;
        


    public function getShortlisted()
    {   
        $result = array();
        $deadline = new \DateTime('2016-05-01');
        foreach ($this->getEventRegistrationCategories() as $cat) {
            // var_dump($cat->getEventRegistration()->getCreated());

            if (($cat->getEventRegistration()->getCreated()->format('Y') == 2016)) {
                $result[] = $cat;            
            }

        }
        return $result;
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
     *
     * @return MovieCategory
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
        $this->eventRegistrationCategories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add eventRegistrationCategory
     *
     * @param \Pixeloid\AppBundle\Entity\EventRegistrationCategory $eventRegistrationCategory
     *
     * @return MovieCategory
     */
    public function addEventRegistrationCategory(\Pixeloid\AppBundle\Entity\EventRegistrationCategory $eventRegistrationCategory)
    {
        $this->eventRegistrationCategories[] = $eventRegistrationCategory;

        return $this;
    }

    /**
     * Remove eventRegistrationCategory
     *
     * @param \Pixeloid\AppBundle\Entity\EventRegistrationCategory $eventRegistrationCategory
     */
    public function removeEventRegistrationCategory(\Pixeloid\AppBundle\Entity\EventRegistrationCategory $eventRegistrationCategory)
    {
        $this->eventRegistrationCategories->removeElement($eventRegistrationCategory);
    }

    /**
     * Get eventRegistrationCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEventRegistrationCategories()
    {

        return $this->eventRegistrationCategories;
    }

    
    public function __toString()
    {
        return $this->name ? $this->name : "";
    }

}
