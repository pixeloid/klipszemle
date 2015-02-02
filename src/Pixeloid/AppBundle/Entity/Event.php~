<?php
namespace Pixeloid\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Event
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pixeloid\AppBundle\Entity\EventRepository")
 */

class Event {
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
	 */
	private $name;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="start", type="date")
	 */
	private $start;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="end", type="date")
	 */
	private $end;


    /**
     * @ORM\Column(type="string", name="tagline", length=255, unique=false, nullable=true)
     */
    protected $tagline = null;
    
    /**
     * @ORM\Column(type="string", name="location", length=255, unique=false, nullable=true)
     */
    protected $location = null;
    
    /**
     * @ORM\Column(type="string", name="slug", length=20, unique=true, nullable=false)
     */
    protected $slug = null;
    

    /**
     * @ORM\ManyToMany(targetEntity="RegistrantType", mappedBy="events")
     **/
    protected $registrantTypes;


    /**
     * @ORM\OneToMany(targetEntity="Room", mappedBy="event")
     **/
    protected $rooms;

		
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->registrantTypes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Event
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
     * Set start
     *
     * @param \DateTime $start
     * @return Event
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     * @return Event
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime 
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Add registrantTypes
     *
     * @param \Pixeloid\AppBundle\Entity\RegistrantType $registrantTypes
     * @return Event
     */
    public function addRegistrantType(\Pixeloid\AppBundle\Entity\RegistrantType $registrantTypes)
    {
        $this->registrantTypes[] = $registrantTypes;

        return $this;
    }

    /**
     * Remove registrantTypes
     *
     * @param \Pixeloid\AppBundle\Entity\RegistrantType $registrantTypes
     */
    public function removeRegistrantType(\Pixeloid\AppBundle\Entity\RegistrantType $registrantTypes)
    {
        $this->registrantTypes->removeElement($registrantTypes);
    }

    /**
     * Get registrantTypes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRegistrantTypes()
    {
        return $this->registrantTypes;
    }

    /**
     * Add rooms
     *
     * @param \Pixeloid\AppBundle\Entity\Room $rooms
     * @return Event
     */
    public function addRoom(\Pixeloid\AppBundle\Entity\Room $rooms)
    {
        $this->rooms[] = $rooms;

        return $this;
    }

    /**
     * Remove rooms
     *
     * @param \Pixeloid\AppBundle\Entity\Room $rooms
     */
    public function removeRoom(\Pixeloid\AppBundle\Entity\Room $rooms)
    {
        $this->rooms->removeElement($rooms);
    }

    /**
     * Get rooms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * Set tagline
     *
     * @param string $tagline
     * @return Event
     */
    public function setTagline($tagline)
    {
        $this->tagline = $tagline;

        return $this;
    }

    /**
     * Get tagline
     *
     * @return string 
     */
    public function getTagline()
    {
        return $this->tagline;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Event
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Event
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
