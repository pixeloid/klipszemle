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
     * @ORM\Column(type="string", name="paymentmethod", unique=false, nullable=false)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step4"})
     */
    protected $paymentMethod = null;
    
    /**
     * @ORM\Column(type="string", name="invoiceType_sponsored", unique=false, nullable=true)
     */
    protected $invoiceTypeSponsored = null;
    
    /**
     * @ORM\Column(type="string", name="billingName_sponsored", length=255, unique=false, nullable=true)
     * @Assert\NotBlank(groups={"paymentMethodSponsored"})
     */
    protected $billingNameSponsored = null;
    
    /**
     * @ORM\Column(type="string", name="billingAddress_sponsored", length=255, unique=false, nullable=true)
     * @Assert\NotBlank(groups={"paymentMethodSponsored"})
     */
    protected $billingAddressSponsored = null;
    /**
     * @ORM\Column(type="string", name="billingContactPerson_sponsored", length=255, unique=false, nullable=true)
     */
    protected $billingContactPersonSponsored = null;
    

    /**
     * @ORM\Column(type="string", name="billingName_transfer", length=255, unique=false, nullable=true)
     * @Assert\NotBlank(groups={"paymentMethodTransfer"})
     */
    protected $billingNameTransfer = null;
    
    /**
     * @ORM\Column(type="string", name="billingAddress_transfer", length=255, unique=false, nullable=true)
     * @Assert\NotBlank(groups={"paymentMethodTransfer"})
     */
    protected $billingAddressTransfer = null;

    /**
	 * @ORM\ManyToOne(targetEntity="Pixeloid\AppBundle\Entity\RegistrantType")
	 * @ORM\JoinColumn(name="registrant_type_id", referencedColumnName="id")
     * @Assert\NotBlank(groups={"flow_eventRegistration_step1"})
	 */
    private $registrantType;

    /**
     * @ORM\Column(type="date", name="created", nullable=false)
     */
    protected $created = null;
    

    /**
     * @ORM\OneToOne(targetEntity="Pixeloid\AppBundle\Entity\RoomReservation", mappedBy="eventRegistration", cascade={"all"})
     */
    private $roomReservation;

    /**
     * @ORM\OneToOne(targetEntity="Pixeloid\AppBundle\Entity\DiningReservation", mappedBy="eventRegistration", cascade={"persist"})
     */
    private $diningReservation;

    /**
     * @ORM\ManyToMany(targetEntity="Pixeloid\AppBundle\Entity\ExtraProgram")
     */
    private $extraPrograms;


    /**
     * @Recaptcha\True(groups={"flow_eventRegistration_step5"})
     */
    private $recaptcha;

    /**
     * @ORM\Column(type="boolean", name="extra1", nullable=true)
     */
    private $extra1;
    /**
     * @ORM\Column(type="boolean", name="extra2", nullable=true)
     */
    private $extra2;
    /**
     * @ORM\Column(type="boolean", name="extra3", nullable=true)
     */
    private $extra3;
    /**
     * @ORM\Column(type="boolean", name="extra4", nullable=true)
     */
    private $extra4;
    /**
	 * @ORM\ManyToOne(targetEntity="Event")
	 * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
	 */
    private $event;



    public function getTotalCost()
    {
        $total = 0;
        $total += $this->getRegistrantType() ? $this->getRegistrantType()->getPriceBefore() : 0;
        $total += $this->getRoomReservation() ? $this->getRoomReservation()->getTotalCost() : 0;
        $total += $this->getDiningReservation() ? $this->getDiningReservation()->getTotalCost() : 0;

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

    /**
     * Set diningReservation
     *
     * @param \Pixeloid\AppBundle\Entity\DiningReservation $diningReservation
     * @return EventRegistration
     */
    public function setDiningReservation(\Pixeloid\AppBundle\Entity\DiningReservation $diningReservation = null)
    {
        $this->diningReservation = $diningReservation;

        return $this;
    }

    /**
     * Get diningReservation
     *
     * @return \Pixeloid\AppBundle\Entity\DiningReservation 
     */
    public function getDiningReservation()
    {
        return $this->diningReservation;
    }


    /**
     * Set paymentMethod
     *
     * @param integer $paymentMethod
     * @return EventRegistration
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * Get paymentMethod
     *
     * @return integer 
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * Set invoiceType
     *
     * @param integer $invoiceType
     * @return EventRegistration
     */
    public function setInvoiceType($invoiceType)
    {
        $this->invoiceType = $invoiceType;

        return $this;
    }

    /**
     * Get invoiceType
     *
     * @return integer 
     */
    public function getInvoiceType()
    {
        return $this->invoiceType;
    }

    /**
     * Set billingName
     *
     * @param string $billingName
     * @return EventRegistration
     */
    public function setBillingName($billingName)
    {
        $this->billingName = $billingName;

        return $this;
    }

    /**
     * Get billingName
     *
     * @return string 
     */
    public function getBillingName()
    {
        return $this->billingName;
    }

    /**
     * Set billingAddress
     *
     * @param string $billingAddress
     * @return EventRegistration
     */
    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;

        return $this;
    }

    /**
     * Get billingAddress
     *
     * @return string 
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * Set billingContactPerson
     *
     * @param string $billingContactPerson
     * @return EventRegistration
     */
    public function setBillingContactPerson($billingContactPerson)
    {
        $this->billingContactPerson = $billingContactPerson;

        return $this;
    }

    /**
     * Get billingContactPerson
     *
     * @return string 
     */
    public function getBillingContactPerson()
    {
        return $this->billingContactPerson;
    }

    /**
     * Set invoiceTypeSponsored
     *
     * @param integer $invoiceTypeSponsored
     * @return EventRegistration
     */
    public function setInvoiceTypeSponsored($invoiceTypeSponsored)
    {
        $this->invoiceTypeSponsored = $invoiceTypeSponsored;

        return $this;
    }

    /**
     * Get invoiceTypeSponsored
     *
     * @return integer 
     */
    public function getInvoiceTypeSponsored()
    {
        return $this->invoiceTypeSponsored;
    }

    /**
     * Set billingNameSponsored
     *
     * @param string $billingNameSponsored
     * @return EventRegistration
     */
    public function setBillingNameSponsored($billingNameSponsored)
    {
        $this->billingNameSponsored = $billingNameSponsored;

        return $this;
    }

    /**
     * Get billingNameSponsored
     *
     * @return string 
     */
    public function getBillingNameSponsored()
    {
        return $this->billingNameSponsored;
    }

    /**
     * Set billingAddressSponsored
     *
     * @param string $billingAddressSponsored
     * @return EventRegistration
     */
    public function setBillingAddressSponsored($billingAddressSponsored)
    {
        $this->billingAddressSponsored = $billingAddressSponsored;

        return $this;
    }

    /**
     * Get billingAddressSponsored
     *
     * @return string 
     */
    public function getBillingAddressSponsored()
    {
        return $this->billingAddressSponsored;
    }

    /**
     * Set billingContactPersonSponsored
     *
     * @param string $billingContactPersonSponsored
     * @return EventRegistration
     */
    public function setBillingContactPersonSponsored($billingContactPersonSponsored)
    {
        $this->billingContactPersonSponsored = $billingContactPersonSponsored;

        return $this;
    }

    /**
     * Get billingContactPersonSponsored
     *
     * @return string 
     */
    public function getBillingContactPersonSponsored()
    {
        return $this->billingContactPersonSponsored;
    }

    /**
     * Set billingNameTransfer
     *
     * @param string $billingNameTransfer
     * @return EventRegistration
     */
    public function setBillingNameTransfer($billingNameTransfer)
    {
        $this->billingNameTransfer = $billingNameTransfer;

        return $this;
    }

    /**
     * Get billingNameTransfer
     *
     * @return string 
     */
    public function getBillingNameTransfer()
    {
        return $this->billingNameTransfer;
    }

    /**
     * Set billingAddressTransfer
     *
     * @param string $billingAddressTransfer
     * @return EventRegistration
     */
    public function setBillingAddressTransfer($billingAddressTransfer)
    {
        $this->billingAddressTransfer = $billingAddressTransfer;

        return $this;
    }

    /**
     * Get billingAddressTransfer
     *
     * @return string 
     */
    public function getBillingAddressTransfer()
    {
        return $this->billingAddressTransfer;
    }

    /**
     * Add extraPrograms
     *
     * @param \Pixeloid\AppBundle\Entity\ExtraProgram $extraPrograms
     * @return EventRegistration
     */
    public function addExtraProgram(\Pixeloid\AppBundle\Entity\ExtraProgram $extraPrograms)
    {
        $this->extraPrograms[] = $extraPrograms;

        return $this;
    }

    /**
     * Remove extraPrograms
     *
     * @param \Pixeloid\AppBundle\Entity\ExtraProgram $extraPrograms
     */
    public function removeExtraProgram(\Pixeloid\AppBundle\Entity\ExtraProgram $extraPrograms)
    {
        $this->extraPrograms->removeElement($extraPrograms);
    }

    /**
     * Get extraPrograms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getExtraPrograms()
    {
        return $this->extraPrograms;
    }

    /**
     * Set extra1
     *
     * @param boolean $extra1
     * @return EventRegistration
     */
    public function setExtra1($extra1)
    {
        $this->extra1 = $extra1;

        return $this;
    }

    /**
     * Get extra1
     *
     * @return boolean 
     */
    public function getExtra1()
    {
        return $this->extra1;
    }

    /**
     * Set extra2
     *
     * @param boolean $extra2
     * @return EventRegistration
     */
    public function setExtra2($extra2)
    {
        $this->extra2 = $extra2;

        return $this;
    }

    /**
     * Get extra2
     *
     * @return boolean 
     */
    public function getExtra2()
    {
        return $this->extra2;
    }

    /**
     * Set extra3
     *
     * @param boolean $extra3
     * @return EventRegistration
     */
    public function setExtra3($extra3)
    {
        $this->extra3 = $extra3;

        return $this;
    }

    /**
     * Get extra3
     *
     * @return boolean 
     */
    public function getExtra3()
    {
        return $this->extra3;
    }

    /**
     * Set extra4
     *
     * @param boolean $extra4
     * @return EventRegistration
     */
    public function setExtra4($extra4)
    {
        $this->extra4 = $extra4;

        return $this;
    }

    /**
     * Get extra4
     *
     * @return boolean 
     */
    public function getExtra4()
    {
        return $this->extra4;
    }

    /**
     * Set event
     *
     * @param \Pixeloid\AppBundle\Entity\Event $event
     * @return EventRegistration
     */
    public function setEvent(\Pixeloid\AppBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \Pixeloid\AppBundle\Entity\Event 
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return EventRegistration
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
}
