<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Room
 *
 * @ORM\Table(name="room")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RoomRepository")
 */
class Room
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
     * @var int
     *
     * @ORM\Column(name="room_no", type="integer", unique=true)
     */
    private $roomNo;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
    * @ORM\OneToMany(targetEntity="Booking", mappedBy="room")
    */
    private $bookings;


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
     * Set roomNo
     *
     * @param integer $roomNo
     *
     * @return Room
     */
    public function setRoomNo($roomNo)
    {
        $this->roomNo = $roomNo;

        return $this;
    }

    /**
     * Get roomNo
     *
     * @return int
     */
    public function getRoomNo()
    {
        return $this->roomNo;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Room
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
