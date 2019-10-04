<?php


namespace Pixeloid\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Pixeloid\AppBundle\Entity\EventRegistration;
use Pixeloid\AppBundle\Entity\Vote;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="SiteUser")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\OneToMany(targetEntity="Pixeloid\AppBundle\Entity\EventRegistration", mappedBy="user")
     **/
    protected $eventRegistrations;

    /** @ORM\Column(name="facebook_id", type="string", length=255, nullable=true) */
    protected $facebook_id;
    
    /** @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true) */
    protected $facebook_access_token;

    
    /**
     * @ORM\OneToMany(targetEntity="Pixeloid\AppBundle\Entity\Vote", mappedBy="user")
     */
    protected $votes;

    /**
     * @ORM\OneToOne(targetEntity="Pixeloid\AppBundle\Entity\VoteSheet", mappedBy="user", cascade={"persist", "remove"})
     */
    private $voteSheet;

    /**
     * @ORM\OneToMany(targetEntity="Pixeloid\AppBundle\Entity\JuryVote", mappedBy="user", orphanRemoval=true)
     */
    private $juryVotes;




    public function __construct()
    {
        parent::__construct();
        $this->eventRegistrations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->votes = new ArrayCollection();
        $this->juryVotes = new ArrayCollection();
        // your own logic
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
     * Add eventRegistrations
     *
     * @param \Pixeloid\AppBundle\Entity\EventRegistration $eventRegistrations
     * @return User
     */
    public function addEventRegistration(\Pixeloid\AppBundle\Entity\EventRegistration $eventRegistrations)
    {
        $this->eventRegistrations[] = $eventRegistrations;

        return $this;
    }

    /**
     * Remove eventRegistrations
     *
     * @param \Pixeloid\AppBundle\Entity\EventRegistration $eventRegistrations
     */
    public function removeEventRegistration(\Pixeloid\AppBundle\Entity\EventRegistration $eventRegistrations)
    {
        $this->eventRegistrations->removeElement($eventRegistrations);
    }

    /**
     * Get eventRegistrations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEventRegistrations()
    {
        return $this->eventRegistrations;
    }

    /**
     * @param string $facebookId
     * @return User
     */
    public function setFacebookId($facebookId)
    {
        $this->facebook_id = $facebookId;

        return $this;
    }

    /**
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebook_id;
    }

    /**
     * @param string $facebookAccessToken
     * @return User
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebook_access_token = $facebookAccessToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getFacebookAccessToken()
    {
        return $this->facebook_access_token;
    }


    /**
     * Add vote
     *
     * @param \Pixeloid\UserBundle\Entity\Vote $vote
     *
     * @return User
     */
    public function addVote(\Pixeloid\AppBundle\Entity\Vote $vote)
    {
        $this->votes[] = $vote;

        return $this;
    }

    /**
     * Remove vote
     *
     * @param \Pixeloid\UserBundle\Entity\Vote $vote
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

    public function getVoteSheet(): ?VoteSheet
    {
        return $this->voteSheet;
    }

    public function setVoteSheet(VoteSheet $voteSheet): self
    {
        $this->voteSheet = $voteSheet;

        // set the owning side of the relation if necessary
        if ($this !== $voteSheet->getUser()) {
            $voteSheet->setUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|JuryVote[]
     */
    public function getJuryVotes(): Collection
    {
        return $this->juryVotes;
    }

    public function addJuryVote(JuryVote $juryVote): self
    {
        if (!$this->juryVotes->contains($juryVote)) {
            $this->juryVotes[] = $juryVote;
            $juryVote->setUser($this);
        }

        return $this;
    }

    public function removeJuryVote(JuryVote $juryVote): self
    {
        if ($this->juryVotes->contains($juryVote)) {
            $this->juryVotes->removeElement($juryVote);
            // set the owning side to null (unless already changed)
            if ($juryVote->getUser() === $this) {
                $juryVote->setUser(null);
            }
        }

        return $this;
    }

}
