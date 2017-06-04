<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookingRequest
 * @ORM\Entity()
 * @ORM\Table(name="bookingrequests")
 */
class BookingRequest
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
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="date")
     */
    protected $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="date")
     */
    protected $end;

    /**
     * @var User
     *
     * @ORM\Column(name="user", type="string", length=255)
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    protected $user;

    /**
     * @var Thread
     *
     * @ORM\Column(name="thread_id", type="integer")
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Thread")
     */
    protected $thread;

    /**
     * @var bool
     *
     * @ORM\Column(name="confirmed", type="boolean")
     */
    protected $confirmed = false;

    /**
     * Set confirmed
     *
     * @param boolean $confirmed
     *
     * @return BookingRequest
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;

        return $this;
    }

    /**
     * Is confirmed
     *
     * @return bool
     */
    public function isConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * @return Thread
     */
    public function getThread()
    {
        return $this->thread;
    }

    /**
     * @param Thread $thread
     */
    public function setThread($thread)
    {
        $this->thread = $thread;
    }


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
     * Set start
     *
     * @param  \DateTime $start
     * @return BookingRequest
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param  \DateTime $end
     * @return BookingRequest
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @var Sodyba
     *
     * @ORM\ManyToOne(targetEntity="Sodyba", inversedBy="bookingrequest")
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
