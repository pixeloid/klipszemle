<?php

namespace Pixeloid\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jury
 *
 * @ORM\Table(name="jury")
 * @ORM\Entity(repositoryClass="Pixeloid\AppBundle\Repository\JuryRepository")
 */
class Jury
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="details", type="string", length=255)
     */
    private $details;


    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    private $image;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Jury
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set image.
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media|null $image
     *
     * @return Jury
     */
    public function setImage(\Application\Sonata\MediaBundle\Entity\Media $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image.
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media|null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set details.
     *
     * @param string $details
     *
     * @return Jury
     */
    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Get details.
     *
     * @return string
     */
    public function getDetails()
    {
        return $this->details;
    }
}
