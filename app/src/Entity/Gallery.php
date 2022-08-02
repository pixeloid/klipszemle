<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\MediaBundle\Entity\BaseGallery;

#[ORM\Entity]
#[ORM\Table(name: 'media__gallery')]
class Gallery extends BaseGallery
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
