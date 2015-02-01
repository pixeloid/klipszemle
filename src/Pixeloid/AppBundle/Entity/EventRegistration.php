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
    private $postal = null;

    /**
	 * @ORM\Column(type="string", name="regnumber", length=50, unique=false, nullable=true)
	 */
    private $regnumber = null;

    /**
	 * @ORM\ManyToOne(targetEntity="Pixeloid\UserBundle\Entity\User")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	 */
    private $user;

    /**
	 * @ORM\ManyToOne(targetEntity="Pixeloid\AppBundle\Entity\RegistrantType")
	 * @ORM\JoinColumn(name="registrant_type_id", referencedColumnName="id")
	 */
    private $registrantType;

    /**
     * @ORM\OneToOne(targetEntity="Pixeloid\AppBundle\Entity\RoomReservation", mappedBy="eventRegistration")
     */
    private $roomReservation;


    /**
     * @ORM\OneToMany(targetEntity="Pixeloid\AppBundle\Entity\DiningDate", mappedBy="eventRegistration")
     */
    private $diningDates;

    /**
	 * @Recaptcha\True(groups={"flow_eventRegistration_step4"})
	 */
    private $recaptcha;

    /**
	 * @ORM\ManyToOne(targetEntity="Event")
	 * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
	 */
    private $eventId;



    public function getTotalCost()
    {
        $total = $this->getRoomReservation()->getRoom()->getPrice();
        $total *= $this->getRoomReservation()->getPersons();
        $numDays = $this->getRoomReservation()->getNumDays();
        $total *= $numDays;


        $diningtotal = 0;

        foreach ($this->getDiningDates() as $diningdate) {
            $diningtotal += $diningdate->getDining()->getPrice();
        }


        $total += $diningtotal;

        return $total;

    }


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
     * Constructor
     */
    public function __construct()
    {
        $this->diningDates = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set regnumber
     *
     * @param string $regnumber
     * @return EventRegistration
     */
    public function setRegnumber($regnumber)
    {
        $this->regnumber = $regnumber;

        return $this;
    }

    /**
     * Get regnumber
     *
     * @return string 
     */
    public function getRegnumber()
    {
        return $this->regnumber;
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
     * Set registrantType
     *
     * @param \Pixeloid\AppBundle\Entity\RegistrantType $registrantType
     * @return EventRegistration
     */
    public function setRegistrantType(\Pixeloid\AppBundle\Entity\RegistrantType $registrantType = null)
    {
        $this->registrantType = $registrantType;

        return $this;
    }

    /**
     * Get registrantType
     *
     * @return \Pixeloid\AppBundle\Entity\RegistrantType 
     */
    public function getRegistrantType()
    {
        return $this->registrantType;
    }

    /**
     * Set roomReservation
     *
     * @param \Pixeloid\AppBundle\Entity\RoomReservation $roomReservation
     * @return EventRegistration
     */
    public function setRoomReservation(\Pixeloid\AppBundle\Entity\RoomReservation $roomReservation = null)
    {
        $this->roomReservation = $roomReservation;

        return $this;
    }

    /**
     * Get roomReservation
     *
     * @return \Pixeloid\AppBundle\Entity\RoomReservation 
     */
    public function getRoomReservation()
    {
        return $this->roomReservation;
    }

    /**
     * Add diningReservations
     *
     * @param \Pixeloid\AppBundle\Entity\DiningReservation $diningReservations
     * @return EventRegistration
     */
    public function addDiningReservation(\Pixeloid\AppBundle\Entity\DiningReservation $diningReservations)
    {
        $this->diningReservations[] = $diningReservations;

        return $this;
    }

    /**
     * Remove diningReservations
     *
     * @param \Pixeloid\AppBundle\Entity\DiningReservation $diningReservations
     */
    public function removeDiningReservation(\Pixeloid\AppBundle\Entity\DiningReservation $diningReservations)
    {
        $this->diningReservations->removeElement($diningReservations);
    }

    /**
     * Get diningReservations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDiningReservations()
    {
        return $this->diningReservations;
    }

    /**
     * Get diningReservations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function setDiningReservations(\Doctrine\Common\Collections\Collection $diningReservations = null)
    {
        $this->diningReservations = $diningReservations;
    
        return $this;
    }

    /**
     * Set eventId
     *
     * @param \Pixeloid\AppBundle\Entity\Event $eventId
     * @return EventRegistration
     */
    public function setEventId(\Pixeloid\AppBundle\Entity\Event $eventId = null)
    {
        $this->eventId = $eventId;

        return $this;
    }

    /**
     * Get eventId
     *
     * @return \Pixeloid\AppBundle\Entity\Event 
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * Add diningDates
     *
     * @param \Pixeloid\AppBundle\Entity\DiningDate $diningDates
     * @return EventRegistration
     */
    public function addDiningDate(\Pixeloid\AppBundle\Entity\DiningDate $diningDates)
    {
        $this->diningDates[] = $diningDates;

        return $this;
    }

    /**
     * Remove diningDates
     *
     * @param \Pixeloid\AppBundle\Entity\DiningDate $diningDates
     */
    public function removeDiningDate(\Pixeloid\AppBundle\Entity\DiningDate $diningDates)
    {
        $this->diningDates->removeElement($diningDates);
    }

    /**
     * Get diningDates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDiningDates()
    {
        return $this->diningDates;
    }
}
