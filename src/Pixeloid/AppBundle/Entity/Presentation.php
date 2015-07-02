<?php

namespace Pixeloid\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Presentation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pixeloid\AppBundle\Entity\PresentationRepository")
 */
class Presentation
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
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100)
     * @Assert\NotBlank
     * @Assert\Email
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="body1", type="text")
     * @Assert\NotBlank
     */
    private $body1;

    /**
     * @var string
     *
     * @ORM\Column(name="body2", type="text")
     * @Assert\NotBlank
     */
    private $body2;

    /**
     * @var string
     *
     * @ORM\Column(name="body3", type="text")
     * @Assert\NotBlank
     */
    private $body3;

    /**
     * @ORM\Column(name="authors", type="array")
     * @Assert\NotBlank
     */
    protected $authors;



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
     * Set body1
     *
     * @param string $body1
     * @return Presentation
     */
    public function setBody1($body1)
    {
        $this->body1 = $body1;

        return $this;
    }

    /**
     * Get body1
     *
     * @return string 
     */
    public function getBody1()
    {
        return $this->body1;
    }

    /**
     * Set body2
     *
     * @param string $body2
     * @return Presentation
     */
    public function setBody2($body2)
    {
        $this->body2 = $body2;

        return $this;
    }

    /**
     * Get body2
     *
     * @return string 
     */
    public function getBody2()
    {
        return $this->body2;
    }

    /**
     * Set body3
     *
     * @param string $body3
     * @return Presentation
     */
    public function setBody3($body3)
    {
        $this->body3 = $body3;

        return $this;
    }

    /**
     * Get body3
     *
     * @return string 
     */
    public function getBody3()
    {
        return $this->body3;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->authors = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add author
     *
     * @param \Pixeloid\AppBundle\Entity\Author $author
     *
     * @return Presentation
     */
    public function addAuthor(\Pixeloid\AppBundle\Entity\Author $author)
    {
        $this->authors[] = $author;

        return $this;
    }

    /**
     * Remove author
     *
     * @param \Pixeloid\AppBundle\Entity\Author $author
     */
    public function removeAuthor(\Pixeloid\AppBundle\Entity\Author $author)
    {
        $this->authors->removeElement($author);
    }

    /**
     * Get authors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Set authors
     *
     * @param array $authors
     *
     * @return Presentation
     */
    public function setAuthors($authors)
    {
        $this->authors = $authors;

        return $this;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Presentation
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
     * Set email
     *
     * @param string $email
     *
     * @return Presentation
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}
