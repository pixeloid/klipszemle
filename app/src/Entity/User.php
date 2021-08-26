<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository", repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private ?string $email;

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private string $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EventRegistration", mappedBy="user")
     **/
    protected Collection $eventRegistrations;

    /** @ORM\Column(name="facebook_id", type="string", length=255, nullable=true) */
    protected string $facebook_id;

    /** @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true) */
    protected string $facebook_access_token;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vote", mappedBy="user")
     */
    protected Collection $votes;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\VoteSheet", mappedBy="user", cascade={"persist", "remove"})
     */
    private ?VoteSheet $voteSheet;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\JuryVote", mappedBy="user", orphanRemoval=true)
     */
    private Collection $juryVotes;




    public function __construct()
    {
        $this->eventRegistrations = new ArrayCollection();
        $this->votes = new ArrayCollection();
        $this->juryVotes = new ArrayCollection();
        // your own logic
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }


    /**
     * Add eventRegistrations
     *
     * @param EventRegistration $eventRegistrations
     * @return User
     */
    public function addEventRegistration(EventRegistration $eventRegistrations): User
    {
        $this->eventRegistrations[] = $eventRegistrations;

        return $this;
    }

    /**
     * Remove eventRegistrations
     *
     * @param EventRegistration $eventRegistrations
     */
    public function removeEventRegistration(EventRegistration $eventRegistrations)
    {
        $this->eventRegistrations->removeElement($eventRegistrations);
    }

    /**
     * Get eventRegistrations
     *
     * @return Collection
     */
    public function getEventRegistrations()
    {
        return $this->eventRegistrations;
    }

    /**
     * @param string $facebookId
     * @return User
     */
    public function setFacebookId(string $facebookId): User
    {
        $this->facebook_id = $facebookId;

        return $this;
    }

    /**
     * @return string
     */
    public function getFacebookId(): string
    {
        return $this->facebook_id;
    }

    /**
     * @param string $facebookAccessToken
     * @return User
     */
    public function setFacebookAccessToken(string $facebookAccessToken): User
    {
        $this->facebook_access_token = $facebookAccessToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getFacebookAccessToken(): string
    {
        return $this->facebook_access_token;
    }


    /**
     * Add vote
     *
     * @param Vote $vote
     *
     * @return User
     */
    public function addVote(Vote $vote): User
    {
        $this->votes[] = $vote;

        return $this;
    }

    /**
     * Remove vote
     *
     * @param Vote $vote
     */
    public function removeVote(Vote $vote)
    {
        $this->votes->removeElement($vote);
    }

    /**
     * Get votes
     *
     * @return Collection
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
