<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Sonata\ClassificationBundle\Entity\BaseContext;

#[ORM\Entity]
#[ORM\Table(name: 'classification__context')]
#[ORM\HasLifecycleCallbacks]
class SonataClassificationContext extends BaseContext
{
    /**
     *
     * @var string|null
     */
    #[ORM\Id]
    #[ORM\Column(type: 'string')]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    protected ?string $id = null;
    public function getId(): ?string
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
