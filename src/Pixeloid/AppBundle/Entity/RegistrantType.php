<?php

namespace Pixeloid\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RegistrantType
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pixeloid\AppBundle\Entity\RegistrantTypeRepository")
 */
class RegistrantType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="price_before", type="decimal")
     */
    private $priceBefore;

    /**
     * @var string
     *
     * @ORM\Column(name="price_after", type="decimal")
     */
    private $priceAfter;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return RegistrantType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set priceBefore
     *
     * @param string $priceBefore
     * @return RegistrantType
     */
    public function setPriceBefore($priceBefore)
    {
        $this->priceBefore = $priceBefore;

        return $this;
    }

    /**
     * Get priceBefore
     *
     * @return string 
     */
    public function getPriceBefore()
    {
        return $this->priceBefore;
    }

    /**
     * Set priceAfter
     *
     * @param string $priceAfter
     * @return RegistrantType
     */
    public function setPriceAfter($priceAfter)
    {
        $this->priceAfter = $priceAfter;

        return $this;
    }

    /**
     * Get priceAfter
     *
     * @return string 
     */
    public function getPriceAfter()
    {
        return $this->priceAfter;
    }
}
