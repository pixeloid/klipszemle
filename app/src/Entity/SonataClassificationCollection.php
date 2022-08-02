<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Sonata\ClassificationBundle\Entity\BaseCollection;
use Sonata\ClassificationBundle\Model\ContextInterface;

#[ORM\Entity]
#[ORM\Table(name: 'classification__collection')]
#[ORM\HasLifecycleCallbacks]
class SonataClassificationCollection extends BaseCollection
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
     * @var ContextInterface|null
     */
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
