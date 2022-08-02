<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sponsor
 */
#[ORM\Table(name: 'sponsor')]
#[ORM\Entity]
class Sponsor
{
    #[ORM\Column(name: 'id', type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;
    #[ORM\Column(name: 'name', type: 'string', length: 255)]
    private string $name;
    #[ORM\Column(name: 'url', type: 'string', length: 255)]
    private string $url;
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Media')]
    private $image;
    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Sponsor
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Set url.
     *
     * @param string $url
     *
     * @return Sponsor
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }
    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
    /**
     * Set image.
     *
     * @param Media|null $image
     *
     * @return Sponsor
     */
    public function setImage(Media $image = null)
    {
        $this->image = $image;

        return $this;
    }
    /**
     * Get image.
     *
     * @return Media|null
     */
    public function getImage()
    {
        return $this->image;
    }
}
