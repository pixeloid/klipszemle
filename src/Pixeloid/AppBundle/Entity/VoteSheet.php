<?php

namespace Pixeloid\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class VoteSheet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\OneToMany(targetEntity="Pixeloid\AppBundle\Entity\JuryVote", mappedBy="votesheet", orphanRemoval=true)
     */
    private $votes;

    /**
     * @ORM\OneToOne(targetEntity="Pixeloid\AppBundle\Entity\User", inversedBy="voteSheet", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;



    public function __construct()
    {
        $this->votes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return Collection|JuryVote[]
     */
    public function getVotes(): Collection
    {
        return $this->votes;
    }

    public function addVote(JuryVote $vote): self
    {
        if (!$this->votes->contains($vote)) {
            $this->votes[] = $vote;
            $vote->setVotesheet($this);
        }

        return $this;
    }

    public function removeVote(JuryVote $vote): self
    {
        if ($this->votes->contains($vote)) {
            $this->votes->removeElement($vote);
            // set the owning side to null (unless already changed)
            if ($vote->getVotesheet() === $this) {
                $vote->setVotesheet(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function __toString(): string
    {
        return $this->id;
    }

}
