<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\Timestampable;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JuryVoteRepository")
 */
class JuryVote
{

    use Timestampable;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     * @Assert\Range(
     *      min = 1,
     *      max = 10,
     * )
     */
    private $rate;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $best;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $specialprize;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $info;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EventRegistration", inversedBy="juryvotes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $eventRegistration;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="juryVotes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVotesheet(): ?VoteSheet
    {
        return $this->votesheet;
    }

    public function setVotesheet(?VoteSheet $votesheet): self
    {
        $this->votesheet = $votesheet;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getBest(): ?bool
    {
        return $this->best;
    }

    public function setBest(?bool $best): self
    {
        $this->best = $best;

        return $this;
    }

    public function getSpecialprize(): ?bool
    {
        return $this->specialprize;
    }

    public function setSpecialprize(?bool $specialprize): self
    {
        $this->specialprize = $specialprize;

        return $this;
    }

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(?string $info): self
    {
        $this->info = $info;

        return $this;
    }

    public function getEventRegistration(): ?EventRegistration
    {
        return $this->eventRegistration;
    }

    public function setEventRegistration(?EventRegistration $eventRegistration): self
    {
        $this->eventRegistration = $eventRegistration;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
