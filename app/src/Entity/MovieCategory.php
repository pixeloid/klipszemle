<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MovieCategory
 */
#[ORM\Table]
#[ORM\Entity(repositoryClass: 'App\Repository\MovieCategoryRepository')]
class MovieCategory implements \Stringable
{
    #[ORM\Column(name: 'id', type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;
    #[ORM\Column(name: 'name', type: 'string', length: 255)]
    private string $name;
    #[ORM\OneToMany(targetEntity: 'EventRegistrationCategory', mappedBy: 'category', cascade: ['persist', 'remove'], orphanRemoval: true)]
    protected $eventRegistrationCategories;
    public function getShortlisted(): array
    {   
        $result = [];
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
        $this->eventRegistrationCategories = new ArrayCollection();
    }
    /**
     * Add eventRegistrationCategory
     *
     *
     */
    public function addEventRegistrationCategory(EventRegistrationCategory $eventRegistrationCategory): MovieCategory
    {
        $this->eventRegistrationCategories[] = $eventRegistrationCategory;

        return $this;
    }
    /**
     * Remove eventRegistrationCategory
     */
    public function removeEventRegistrationCategory(EventRegistrationCategory $eventRegistrationCategory)
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
    public function __toString(): string
    {
        return $this->name ?: "";
    }
}
