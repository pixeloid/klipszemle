<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Sonata\ClassificationBundle\Entity\BaseCategory;
use Sonata\ClassificationBundle\Model\CategoryInterface;
use Sonata\ClassificationBundle\Model\ContextInterface;
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: 'classification__category')]
#[ORM\HasLifecycleCallbacks]
class SonataClassificationCategory extends BaseCategory
{
    /**
     *
     * @var int
     */
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected $id;
    /**
     *
     * @var Collection
     */
    #[ORM\OneToMany(targetEntity: 'App\Entity\SonataClassificationCategory', mappedBy: 'parent', cascade: ['persist'], orphanRemoval: true)]
    #[ORM\OrderBy(['position' => 'ASC'])]
    protected Collection $children;
    /**
     *
     * @var CategoryInterface|null
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\SonataClassificationCategory', inversedBy: 'children', cascade: ['persist', 'refresh', 'merge', 'detach'])]
    #[ORM\JoinColumn(name: 'parent_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    protected ?CategoryInterface $parent = null;
    /**
     *
     * @var ContextInterface|null
     */
    #[Assert\NotNull]
    #[ORM\ManyToOne(targetEntity: 'App\Entity\SonataClassificationContext', cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'context', referencedColumnName: 'id', nullable: false)]
    protected ?ContextInterface $context = null;
    public function getId(): int|string|null
    {
        return $this->id;
    }
    #[ORM\PrePersist]
    public function prePersist() : void
    {
        parent::prePersist();
    }
    #[ORM\PreUpdate]
    public function preUpdate() : void
    {
        parent::preUpdate();
    }
}
