<?php

namespace Pixeloid\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="body1", type="text")
     */
    private $body1;

    /**
     * @var string
     *
     * @ORM\Column(name="body2", type="text")
     */
    private $body2;

    /**
     * @var string
     *
     * @ORM\Column(name="body3", type="text")
     */
    private $body3;



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
}
