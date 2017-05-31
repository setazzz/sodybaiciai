<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Sodyba;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\SodybaPerks;

/**
 * Perks
 *
 * @ORM\Table(name="perks")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PerksRepository")
 */
class Perks
{
    /**
     * @var int
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
     * Bidirectional - Many comments are favorited by many users (INVERSE SIDE)
     *
     * @ORM\ManyToMany(targetEntity="Sodyba", mappedBy="perks")
     */
    private $sodybaPerks;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Perks
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
     * @return mixed
     */
    public function getSodybaPerks()
    {
        return $this->sodybaPerks;
    }

    /**
     * @param mixed $sodybaPerks
     */
    public function setSodybaPerks($sodybaPerks)
    {
        $this->sodybaPerks = $sodybaPerks;
    }
}

