<?php

namespace Pixeloid\AppBundle\Entity;

use Pixeloid\UserBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints as Recaptcha;

/**
 * EventRegistration
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pixeloid\AppBundle\Entity\EventRegistrationRepository")
 */
class EventRegistration
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
     * @ORM\Column(name="firstname", type="string", length=255)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step1"})
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step1"})
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=10)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step1"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="institution", type="string", length=255)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step1"})
     */
    private $institution;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=2)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step1"})
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step1"})
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step1"})
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=20)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step1"})
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=20, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step1"})
     * @Assert\Email(groups={"flow_eventRegistration_step1"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", name="postal", length=10, unique=false, nullable=false)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step1"})
     */
    protected $postal = null;
    

    /**
     * @ORM\ManyToOne(targetEntity="Pixeloid\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    

    /**
     * @ORM\OneToOne(targetEntity="AccomodationReservation",mappedBy="eventRegistration", cascade={"persist"})
     */
    protected $reservation;

    /**
     * @Recaptcha\True
     */
    protected $recaptcha;

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
     * Set firstname
     *
     * @param string $firstname
     * @return EventRegistration
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return EventRegistration
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return EventRegistration
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

    /**
     * Set institution
     *
     * @param string $institution
     * @return EventRegistration
     */
    public function setInstitution($institution)
    {
        $this->institution = $institution;

        return $this;
    }

    /**
     * Get institution
     *
     * @return string 
     */
    public function getInstitution()
    {
        return $this->institution;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return EventRegistration
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return EventRegistration
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return EventRegistration
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return EventRegistration
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return EventRegistration
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
     * Set postal
     *
     * @param string $postal
     * @return EventRegistration
     */
    public function setPostal($postal)
    {
        $this->postal = $postal;

        return $this;
    }

    /**
     * Get postal
     *
     * @return string 
     */
    public function getPostal()
    {
        return $this->postal;
    }

    /**
     * Set user
     *
     * @param \Pixeloid\UserBundle\Entity\User $user
     * @return EventRegistration
     */
    public function setUser(\Pixeloid\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Pixeloid\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set reservation
     *
     * @param \Pixeloid\AppBundle\Entity\AccomodationReservation $reservation
     * @return EventRegistration
     */
    public function setReservation(\Pixeloid\AppBundle\Entity\AccomodationReservation $reservation = null)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation
     *
     * @return \Pixeloid\AppBundle\Entity\AccomodationReservation 
     */
    public function getReservation()
    {
        return $this->reservation;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return EventRegistration
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    public function getRecaptcha()
    {
        return $this->recaptcha;
    }

    public function setRecaptcha($recaptcha)
    {
        $this->recaptcha = $recaptcha;
    }

}
