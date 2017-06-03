<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Melifaro\BookingBundle\Entity\Booking as BaseClass;

/**
 * Booking
 *
 * @ORM\Entity()
 * @ORM\Table(name="booking")
 */
class Booking extends BaseClass
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @var Sodyba
     *
     * @ORM\ManyToOne(targetEntity="Sodyba", inversedBy="bookings")
     * @ORM\JoinColumn(name="property_id", referencedColumnName="id")
     */
    protected $item;

    /**
     * @return Sodyba
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param Sodyba $item
     */
    public function setItem($item)
    {
        $this->item = $item;
    }

}