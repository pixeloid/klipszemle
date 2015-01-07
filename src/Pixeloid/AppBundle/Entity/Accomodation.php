<?php

namespace Pixeloid\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Accomodation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pixeloid\AppBundle\Entity\AccomodationRepository")
 */
class Accomodation
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var float
     *
     * @ORM\Column(name="price_single", type="float")
     */
    private $priceSingle;

    /**
     * @var float
     *
     * @ORM\Column(name="price_double", type="float")
     */
    private $priceDouble;


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
     * @return Accomodation
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
     * Set address
     *
     * @param string $address
     * @return Accomodation
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set priceSingle
     *
     * @param float $priceSingle
     * @return Accomodation
     */
    public function setPriceSingle($priceSingle)
    {
        $this->priceSingle = $priceSingle;

        return $this;
    }

    /**
     * Get priceSingle
     *
     * @return float 
     */
    public function getPriceSingle()
    {
        return $this->priceSingle;
    }

    /**
     * Set priceDouble
     *
     * @param float $priceDouble
     * @return Accomodation
     */
    public function setPriceDouble($priceDouble)
    {
        $this->priceDouble = $priceDouble;

        return $this;
    }

    /**
     * Get priceDouble
     *
     * @return float 
     */
    public function getPriceDouble()
    {
        return $this->priceDouble;
    }
}
