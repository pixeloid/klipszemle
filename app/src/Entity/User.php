<?php

namespace App\Entity;

use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use App\Repository\UserRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Rollerworks\Component\PasswordStrength\Validator\Constraints as RollerworksPassword;

#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use TimestampableEntity;
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private int $id;
    #[Groups(['user:read', 'user:write'])]
    #[ORM\Column(name: 'username', type: 'string', length: 180, nullable: false)]
    private ?string $username = null;
    #[ORM\Column(name: 'username_canonical', type: 'string', length: 180, nullable: false)]
    private ?string $usernameCanonical = null;
    #[Groups(['user:read', 'user:write'])]
    #[Assert\Email]
    #[ORM\Column(name: 'email', type: 'string', length: 180, nullable: false)]
    private ?string $email = null;
    #[ORM\Column(name: 'email_canonical', type: 'string', length: 180, nullable: false)]
    #[Assert\Email]
    private ?string $emailCanonical = null;


    #[Groups(['user:write'])]
    #[ORM\Column(name: 'password', type: 'string', length: 255, nullable: false)]
    private ?string $password = null;

    #[ORM\Column(name: 'last_login', type: 'datetime', nullable: true)]
    private $lastLogin;

    #[ORM\Column(name: 'confirmation_token', type: 'string', length: 180, nullable: true)]
    private ?string $confirmationToken = null;

    #[ORM\Column(name: 'password_requested_at', type: 'datetime', nullable: true)]
    private $passwordRequestedAt;

    #[ORM\Column(name: 'roles', type: 'json', length: 0, nullable: false)]
    private array $roles = [];

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: 'App\Entity\EventRegistration')]
    #[OrderBy(['created' => 'DESC'])]
    protected $eventRegistrations;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: 'App\Entity\Vote')]
    protected $votes;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: 'App\Entity\JuryVote')]
    protected $juryVotes;

    #[ORM\Column(type: 'boolean')]
    private bool $isVerified = false;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank]
    private ?string $phone = null;

    #[ORM\Column(nullable: true)]
    private ?bool $newsletter = null;


    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 3,
        max: 40,
        minMessage: 'Your first name must be at least {{ limit }} characters long',
        maxMessage: 'Your first name cannot be longer than {{ limit }} characters',
    )]
    private ?string $first_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 3,
        max: 40,
        minMessage: 'Your first name must be at least {{ limit }} characters long',
        maxMessage: 'Your first name cannot be longer than {{ limit }} characters',
    )]
    private ?string $last_name = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $terms_accepted_at = null;


    public function __construct()
    {
        $this->eventRegistrations = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
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
     * @return Collection|EventRegistration[]
     */
    public function getEventRegistrations(): Collection
    {
        return $this->eventRegistrations;
    }
    public function addEventRegistration(EventRegistration $eventRegistration): self
    {
        if (!$this->eventRegistrations->contains($eventRegistration)) {
            $this->eventRegistrations[] = $eventRegistration;
            $eventRegistration->setUser($this);
        }

        return $this;
    }
    public function removeEventRegistration(EventRegistration $eventRegistration): self
    {
        if ($this->eventRegistrations->removeElement($eventRegistration)) {
            // set the owning side to null (unless already changed)
            if ($eventRegistration->getUser() === $this) {
                $eventRegistration->setUser(null);
            }
        }

        return $this;
    }
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
    public function getUsernameCanonical(): ?string
    {
        return $this->usernameCanonical;
    }
    public function setUsernameCanonical(string $usernameCanonical): self
    {
        $this->usernameCanonical = $usernameCanonical;

        return $this;
    }
    public function getEmailCanonical(): ?string
    {
        return $this->emailCanonical;
    }
    public function setEmailCanonical(string $emailCanonical): self
    {
        $this->emailCanonical = $emailCanonical;

        return $this;
    }
    public function setSalt(?string $salt): self
    {
        $this->salt = $salt;

        return $this;
    }
    public function getLastLogin(): ?DateTimeInterface
    {
        return $this->lastLogin;
    }
    public function setLastLogin(?DateTimeInterface $lastLogin): self
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }
    public function getConfirmationToken(): ?string
    {
        return $this->confirmationToken;
    }
    public function setConfirmationToken(?string $confirmationToken): self
    {
        $this->confirmationToken = $confirmationToken;

        return $this;
    }
    public function getPasswordRequestedAt(): ?DateTimeInterface
    {
        return $this->passwordRequestedAt;
    }
    public function setPasswordRequestedAt(?DateTimeInterface $passwordRequestedAt): self
    {
        $this->passwordRequestedAt = $passwordRequestedAt;

        return $this;
    }
    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }
    public function isVerified(): bool
    {
        return $this->isVerified;
    }
    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
    public function getUserIdentifier(): string
    {
        return $this->email;
    }
    /**
     * @return mixed
     */
    public function getVotes()
    {
        return $this->votes;
    }
    /**
     * @param mixed $votes
     */
    public function setVotes($votes): void
    {
        $this->votes = $votes;
    }
    /**
     * @return mixed
     */
    public function getJuryVotes()
    {
        return $this->juryVotes;
    }
    /**
     * @param mixed $juryVotes
     */
    public function setJuryVotes($juryVotes): void
    {
        $this->juryVotes = $juryVotes;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function isNewsletter(): ?bool
    {
        return $this->newsletter;
    }

    public function setNewsletter(?bool $newsletter): self
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(?string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(?string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getTermsAcceptedAt(): ?\DateTimeImmutable
    {
        return $this->terms_accepted_at;
    }

    public function setTermsAcceptedAt(?\DateTimeImmutable $terms_accepted_at): self
    {
        $this->terms_accepted_at = $terms_accepted_at;

        return $this;
    }
}
