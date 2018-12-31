<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Booking
 *
 * @ORM\Table(name="booking")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BookingRepository")
 */
class Booking
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_in", type="date")
     */
    private $dateIn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_out", type="date")
     */
    private $dateOut;

    /**
    * @ORM\ManyToOne(targetEntity="User", inversedBy="bookings")
    * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
    */
    private $user;

    /**
    * @ORM\ManyToOne(targetEntity="Room", inversedBy="bookings")
    * @ORM\JoinColumn(name="room_id", referencedColumnName="id")
    */
    private $room;


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
     * Set dateIn
     *
     * @param \DateTime $dateIn
     *
     * @return Booking
     */
    public function setDateIn($dateIn)
    {
        $this->dateIn = $dateIn;

        return $this;
    }

    /**
     * Get dateIn
     *
     * @return \DateTime
     */
    public function getDateIn()
    {
        return $this->dateIn;
    }

    /**
     * Set dateOut
     *
     * @param \DateTime $dateOut
     *
     * @return Booking
     */
    public function setDateOut($dateOut)
    {
        $this->dateOut = $dateOut;

        return $this;
    }

    /**
     * Get dateOut
     *
     * @return \DateTime
     */
    public function getDateOut()
    {
        return $this->dateOut;
    }
}
