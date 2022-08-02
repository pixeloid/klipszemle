<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\MediaBundle\Entity\BaseMedia;

#[ORM\Entity]
#[ORM\Table(name: 'media__media')]
class Media extends BaseMedia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;
    public function getId(): int|string|null
    {
        return $this->id;
    }
}
