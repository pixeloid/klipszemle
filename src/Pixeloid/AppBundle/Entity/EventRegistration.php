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
	 * @ORM\Column(name="name", type="string", length=255)
	 * @Assert\NotBlank(groups={"flow_eventRegistration_step1"})
	 */
    private $name;

    /**
	 * @var string
	 *
	 * @ORM\Column(name="company", type="string", length=50, nullable=true)
	 */
    private $company;

    /**
	 * @var string
	 *
	 * @ORM\Column(name="title", type="string", length=255)
	 * @Assert\NotBlank(groups={"flow_eventRegistration_step1"})
	 */
    private $title;

    /**
	 * @var string
	 *
	 * @ORM\Column(name="website", type="string", length=100, nullable= true)
	 */
    private $website;

    /**
	 * @var string
	 *
	 * @ORM\Column(name="address", type="string", length=255, nullable= true)
	 */
    private $address;


    /**
	 * @var string
	 *
	 * @ORM\Column(name="phone", type="string", length=20)
	 * @Assert\NotBlank(groups={"flow_eventRegistration_step1"})
	 */
    private $phone;




    /**
     * @ORM\Column(type="string", name="author", nullable=false, length=150)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step2"})
     */
    protected $author;
    



    /**
     * @ORM\Column(type="string", name="song_title", nullable=false, length=150)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step2"})
     */
    protected $song_title;
    



    /**
     * @ORM\Column(type="string", name="length", nullable=false, length=50)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step2"})
     */
    protected $length;




    /**
     * @ORM\Column(type="string", name="publisher", nullable=false, length=150, nullable=true)
     */
    protected $publisher;
    

    /**
     * @ORM\Column(type="text", name="song_publish_date", nullable=false, length=150)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step2"})
     */
    protected $song_publish_date;
    
    /**
     * @ORM\Column(type="text", name="video_publish_date", nullable=false, length=150)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step2"})
     */
    protected $video_publish_date;
    
    /**
     * @ORM\Column(type="string", name="producer", nullable=true, length=150, nullable=true)
     */
    protected $producer;

    /**
     * @ORM\Column(type="string", name="director", nullable=true, length=150)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step2"})
     */
    protected $director;

    /**
     * @ORM\Column(type="string", name="photographer", nullable=false, length=150)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step2"})
     */
    protected $photographer;

    /**
     * @ORM\Column(type="string", name="designer", nullable=false, length=150)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step2"})
     */
    protected $designer;
    /**
     * @ORM\Column(type="string", name="editor", nullable=false, length=150)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step2"})
     */
    protected $editor;

    /**
     * @ORM\Column(type="string", name="technology", nullable=false, length=150)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step2"})
     */
    protected $technology;
    /**
     * @ORM\Column(type="string", name="budget", nullable=false, length=150)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step2"})
     */
    protected $budget;
    /**
     * @ORM\Column(type="text", name="description", nullable=false)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step2"})
     */
    protected $description;

    /**
     * @ORM\Column(type="text", name="video_url", nullable=false)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step2"})
     */
    protected $video_url;

    /**
     * @ORM\Column(type="array", name="categories", nullable=false)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step2"})
     */
    protected $categories;

    



    /**
	 * @var string
	 *
	 * @ORM\Column(name="email", type="string", length=100)
	 * @Assert\NotBlank(groups={"flow_eventRegistration_step1"})
	 * @Assert\Email(groups={"flow_eventRegistration_step1"})
	 */
    private $email;


    /**
	 * @ORM\ManyToOne(targetEntity="Pixeloid\UserBundle\Entity\User", inversedBy="eventRegistrations")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	 */
    private $user;




    /**
     * @ORM\Column(type="date", name="created", nullable=false)
     */
    protected $created = null;
    




    /**
     * @Recaptcha\IsTrue(groups={"flow_eventRegistration_step3"})
     */
    public $recaptcha;




    /**
     * Constructor
     */
    public function __construct()
    {
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

    /**
     * Set name
     *
     * @param string $name
     *
     * @return EventRegistration
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
     * Set company
     *
     * @param string $company
     *
     * @return EventRegistration
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set website
     *
     * @param string $website
     *
     * @return EventRegistration
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return EventRegistration
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set songTitle
     *
     * @param string $songTitle
     *
     * @return EventRegistration
     */
    public function setSongTitle($songTitle)
    {
        $this->song_title = $songTitle;

        return $this;
    }

    /**
     * Get songTitle
     *
     * @return string
     */
    public function getSongTitle()
    {
        return $this->song_title;
    }

    /**
     * Set length
     *
     * @param string $length
     *
     * @return EventRegistration
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get length
     *
     * @return string
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set publisher
     *
     * @param string $publisher
     *
     * @return EventRegistration
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * Get publisher
     *
     * @return string
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * Set songPublishDate
     *
     * @param \DateTime $songPublishDate
     *
     * @return EventRegistration
     */
    public function setSongPublishDate($songPublishDate)
    {
        $this->song_publish_date = $songPublishDate;

        return $this;
    }

    /**
     * Get songPublishDate
     *
     * @return \DateTime
     */
    public function getSongPublishDate()
    {
        return $this->song_publish_date;
    }

    /**
     * Set videoPublishDate
     *
     * @param \DateTime $videoPublishDate
     *
     * @return EventRegistration
     */
    public function setVideoPublishDate($videoPublishDate)
    {
        $this->video_publish_date = $videoPublishDate;

        return $this;
    }

    /**
     * Get videoPublishDate
     *
     * @return \DateTime
     */
    public function getVideoPublishDate()
    {
        return $this->video_publish_date;
    }

    /**
     * Set producer
     *
     * @param string $producer
     *
     * @return EventRegistration
     */
    public function setProducer($producer)
    {
        $this->producer = $producer;

        return $this;
    }

    /**
     * Get producer
     *
     * @return string
     */
    public function getProducer()
    {
        return $this->producer;
    }

    /**
     * Set director
     *
     * @param string $director
     *
     * @return EventRegistration
     */
    public function setDirector($director)
    {
        $this->director = $director;

        return $this;
    }

    /**
     * Get director
     *
     * @return string
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * Set photographer
     *
     * @param string $photographer
     *
     * @return EventRegistration
     */
    public function setPhotographer($photographer)
    {
        $this->photographer = $photographer;

        return $this;
    }

    /**
     * Get photographer
     *
     * @return string
     */
    public function getPhotographer()
    {
        return $this->photographer;
    }

    /**
     * Set designer
     *
     * @param string $designer
     *
     * @return EventRegistration
     */
    public function setDesigner($designer)
    {
        $this->designer = $designer;

        return $this;
    }

    /**
     * Get designer
     *
     * @return string
     */
    public function getDesigner()
    {
        return $this->designer;
    }

    /**
     * Set editor
     *
     * @param string $editor
     *
     * @return EventRegistration
     */
    public function setEditor($editor)
    {
        $this->editor = $editor;

        return $this;
    }

    /**
     * Get editor
     *
     * @return string
     */
    public function getEditor()
    {
        return $this->editor;
    }

    /**
     * Set technology
     *
     * @param string $technology
     *
     * @return EventRegistration
     */
    public function setTechnology($technology)
    {
        $this->technology = $technology;

        return $this;
    }

    /**
     * Get technology
     *
     * @return string
     */
    public function getTechnology()
    {
        return $this->technology;
    }

    /**
     * Set budget
     *
     * @param string $budget
     *
     * @return EventRegistration
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * Get budget
     *
     * @return string
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return EventRegistration
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set videoUrl
     *
     * @param string $videoUrl
     *
     * @return EventRegistration
     */
    public function setVideoUrl($videoUrl)
    {
        $this->video_url = $videoUrl;

        return $this;
    }

    /**
     * Get videoUrl
     *
     * @return string
     */
    public function getVideoUrl()
    {
        return $this->video_url;
    }

    /**
     * Set categories
     *
     * @param array $categories
     *
     * @return EventRegistration
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Get categories
     *
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
