<?php

namespace Pixeloid\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints as Recaptcha;

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
     * @Assert\NotBlank(groups={"flow_presentation_step1"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank(groups={"flow_presentation_step2"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100)
     * @Assert\NotBlank(groups={"flow_presentation_step1"})
     * @Assert\Email(groups={"flow_presentation_step1"})
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="body1", type="text")
     * @Assert\NotBlank(groups={"flow_presentation_step2"})
     */
    private $body1;

    /**
     * @var string
     *
     * @ORM\Column(name="body2", type="text", nullable=true)
     * @Assert\NotBlank
     */
    private $body2;

    /**
     * @var string
     *
     * @ORM\Column(name="body3", type="text", nullable=true)
     * @Assert\NotBlank
     */
    private $body3;

    /**
     * @ORM\Column(name="authors", type="array")
     * @Assert\NotBlank(groups={"flow_presentation_step1"})
     */
    protected $authors;

    /**
     * @Recaptcha\IsTrue(groups={"flow_eventRegistration_step3"})
     */
    public $recaptcha;


    /**
     * Gets the value of recaptcha.
     *
     * @return mixed
     */
    public function getRecaptcha()
    {
        return $this->recaptcha;
    }

    /**
     * Sets the value of recaptcha.
     *
     * @param mixed $recaptcha the recaptcha
     *
     * @return self
     */
    protected function setRecaptcha($recaptcha)
    {
        $this->recaptcha = $recaptcha;

        return $this;
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

    /**
     * Set body1
     *
     * @param string $body1
     *
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
     *
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
     *
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
     * Get authors
     *
     * @return array
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Presentation
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}
