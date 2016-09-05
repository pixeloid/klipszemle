<?php
namespace Pixeloid\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints as Recaptcha;
use Pixeloid\AppBundle\Validator\Constraints as AppAssert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * EventRegistration
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pixeloid\AppBundle\Entity\EventRegistrationRepository")
 * @UniqueEntity("video_url",groups={"flow_eventRegistration_step2"}, message="Ez a video már nevezésre került!")
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
     * @ORM\Column(type="integer", name="number", unique=false, nullable=true)
     */
    protected $number = null;
    

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
	 * @ORM\Column(name="title", type="string", length=255, nullable=true)
	 */
    private $title;

    /**
	 * @var string
	 *
	 * @ORM\Column(name="company", type="string", length=50, nullable=true)
	 */
    private $company;


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
     */
    protected $technology;

    /**
     * @ORM\Column(type="array", name="categories", nullable=true)
     */
    protected $categories;



    /**
     * @ORM\Column(type="string", name="budget", nullable=true, length=150)
     */
    protected $budget;



    /**
     * @ORM\Column(type="text", name="description", nullable=false)
     */
    protected $description;

    /**
     * @ORM\Column(type="string", name="video_url", nullable=false, unique=true)
     * @Assert\NotBlank(groups={"flow_eventRegistration_step2"})
     * @AppAssert\Youtube(groups={"flow_eventRegistration_step2"})
     */
    protected $video_url;

    



    /**
	 * @var string
	 *
	 * @ORM\Column(name="email", type="string", length=100)
	 * @Assert\NotBlank(groups={"flow_eventRegistration_step1"})
	 * @Assert\Email(groups={"flow_eventRegistration_step1"})
	 */
    private $email;


    /**
	 * @ORM\ManyToOne(targetEntity="User", inversedBy="eventRegistrations")
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
     * @ORM\ManyToOne(targetEntity="UserTitle")
     * @Assert\NotBlank(groups={"flow_eventRegistration_step2"})
     */
    protected $user_title = null;
    /**
     * @ORM\ManyToOne(targetEntity="BudgetCategory")
     * @Assert\NotBlank(groups={"flow_eventRegistration_step2"})
     */
    protected $budget_category = null;
    
    /**
     * @ORM\OneToMany(targetEntity="EventRegistrationCategory", mappedBy="eventregistration", cascade={"persist","remove"}, orphanRemoval=true)
     * @Assert\Count(
     *      min = "1",
     *      max = "3",
     *      groups={"flow_eventRegistration_step2"}
     * )
     */
    protected $moviecategories;
    
    



    /**
     * @ORM\Column(name="have_rights", type="boolean")
     * @Assert\True(groups={"flow_eventRegistration_step3"},message = "Kötelező mező")
     */
    protected $have_rights = null;
    /**
     * @ORM\Column(name="winner", type="integer", nullable=true)
     */
    protected $winner = null;
    

    /**
     * @ORM\Column(name="accept_terms", type="boolean", nullable=true)
     * @Assert\True(groups={"flow_eventRegistration_step3"}, message = "Kötelező mező")
     */
    protected $accept_terms = null;
    

    /**
     * @ORM\Column(type="boolean", name="shortlist")
     */
    protected $shortlist = 0;
    

    /**
     * @ORM\Column(type="boolean", name="voteable", nullable=true)
     */
    protected $voteable = false;
    

    /**
     * @ORM\Column(type="string", name="post_image", nullable=true)
     */
    protected $post_image = true;
    
    /**
     * @ORM\OneToMany(targetEntity="Vote", mappedBy="eventRegistration")
     */
    protected $votes;


    /**
     * Constructor
     */
    public function __construct()
    {
    }

    public function isShortlisted()
    {
        $result = false;

        foreach ($this->getMovieCategories() as $cat) {
            if($cat->getShortlist()) return true;
        }
    }

    public function getShortlistCategories()
    {
        $result = array();

        foreach ($this->getMovieCategories() as $cat) {
            if($cat->getShortlist()) $result[] = $cat;
        }

        return $result;
    }

    public function getYtId(){
        $value = $this->getVideoUrl();
        if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $value, $id)) {
          $values = $id[1];
        } else if (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $value, $id)) {
          $values = $id[1];
        } else if (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $value, $id)) {
          $values = $id[1];
        } else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $value, $id)) {
          $values = $id[1];
        }
        else if (preg_match('/youtube\.com\/verify_age\?next_url=\/watch%3Fv%3D([^\&\?\/]+)/', $value, $id)) {
            $values = $id[1];
        } else {   
        // not an youtube video
        }
        return $values;
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

    /**
     * Set userTitle
     *
     * @param \Pixeloid\AppBundle\Entity\UserTitle $userTitle
     *
     * @return EventRegistration
     */
    public function setUserTitle(\Pixeloid\AppBundle\Entity\UserTitle $userTitle = null)
    {
        $this->user_title = $userTitle;

        return $this;
    }

    /**
     * Get userTitle
     *
     * @return \Pixeloid\AppBundle\Entity\UserTitle
     */
    public function getUserTitle()
    {
        return $this->user_title;
    }

    /**
     * Set budgetCategory
     *
     * @param \Pixeloid\AppBundle\Entity\BudgetCategory $budgetCategory
     *
     * @return EventRegistration
     */
    public function setBudgetCategory(\Pixeloid\AppBundle\Entity\BudgetCategory $budgetCategory = null)
    {
        $this->budget_category = $budgetCategory;

        return $this;
    }

    /**
     * Get budgetCategory
     *
     * @return \Pixeloid\AppBundle\Entity\BudgetCategory
     */
    public function getBudgetCategory()
    {
        return $this->budget_category;
    }


    /**
     * Gets the value of have_rights.
     *
     * @return mixed
     */
    public function getHaveRights()
    {
        return $this->have_rights;
    }

    /**
     * Sets the value of have_rights.
     *
     * @param mixed $have_rights the have rights
     *
     * @return self
     */
    public function setHaveRights($have_rights)
    {
        $this->have_rights = $have_rights;

        return $this;
    }

    /**
     * Gets the value of accept_terms.
     *
     * @return mixed
     */
    public function getAcceptTerms()
    {
        return $this->accept_terms;
    }

    /**
     * Sets the value of accept_terms.
     *
     * @param mixed $accept_terms the accept terms
     *
     * @return self
     */
    public function setAcceptTerms($accept_terms)
    {
        $this->accept_terms = $accept_terms;

        return $this;
    }

    /**
     * Set shortlist
     *
     * @param boolean $shortlist
     *
     * @return EventRegistration
     */
    public function setShortlist($shortlist)
    {
        $this->shortlist = $shortlist;

        return $this;
    }

    /**
     * Get shortlist
     *
     * @return boolean
     */
    public function getShortlist()
    {
        return $this->shortlist;
    }

    /**
     * Add movieCategory
     *
     * @param \Pixeloid\AppBundle\Entity\EventRegistrationCategory $movieCategory
     *
     * @return EventRegistration
     */
    public function addMovieCategory(\Pixeloid\AppBundle\Entity\EventRegistrationCategory $movieCategory)
    {
        $this->moviecategories[] = $movieCategory;

        return $this;
    }

    /**
     * Remove movieCategory
     *
     * @param \Pixeloid\AppBundle\Entity\EventRegistrationCategory $movieCategory
     */
    public function removeMovieCategory(\Pixeloid\AppBundle\Entity\EventRegistrationCategory $movieCategory)
    {
        $this->moviecategories->removeElement($movieCategory);
    }

    /**
     * Get movieCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMovieCategories()
    {
        return $this->moviecategories;
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return EventRegistration
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set winner
     *
     * @param boolean $winner
     *
     * @return EventRegistration
     */
    public function setWinner($winner)
    {
        $this->winner = $winner;

        return $this;
    }

    /**
     * Get winner
     *
     * @return boolean
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * Set voteable
     *
     * @param boolean $voteable
     *
     * @return EventRegistration
     */
    public function setVoteable($voteable)
    {
        $this->voteable = $voteable;

        return $this;
    }

    /**
     * Get voteable
     *
     * @return boolean
     */
    public function getVoteable()
    {
        return $this->voteable;
    }

    /**
     * Set postImage
     *
     * @param string $postImage
     *
     * @return EventRegistration
     */
    public function setPostImage($postImage)
    {
        $this->post_image = $postImage;

        return $this;
    }

    /**
     * Get postImage
     *
     * @return string
     */
    public function getPostImage()
    {
        return $this->post_image;
    }

    /**
     * Add vote
     *
     * @param \Pixeloid\AppBundle\Entity\Vote $vote
     *
     * @return EventRegistration
     */
    public function addVote(\Pixeloid\AppBundle\Entity\Vote $vote)
    {
        $this->votes[] = $vote;

        return $this;
    }

    /**
     * Remove vote
     *
     * @param \Pixeloid\AppBundle\Entity\Vote $vote
     */
    public function removeVote(\Pixeloid\AppBundle\Entity\Vote $vote)
    {
        $this->votes->removeElement($vote);
    }

    /**
     * Get votes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVotes()
    {
        return $this->votes;
    }
}
