<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateUpdate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $percent;

    /**
     * @ORM\Column(type="integer")
     */
    private $minutes;

    /**
     * @ORM\Column(type="integer")
     */
    private $hours;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(?string $description)
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus(string $status)
    {
        $this->status = $status;

        return $this;
    }

    public function getDateCreate()
    {
        return $this->dateCreate;
    }

    public function setDateCreate(\DateTimeInterface $dateCreate)
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    public function getDateUpdate()
    {
        return $this->dateUpdate;
    }

    public function setDateUpdate(\DateTimeInterface $dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;

        return $this;
    }

    public function getRate()
    {
        return $this->rate;
    }

    public function setRate(string $rate)
    {
        $this->rate = $rate;

        return $this;
    }

    public function getPercent()
    {
        return $this->percent;
    }

    public function setPercent(string $percent)
    {
        $this->percent = $percent;

        return $this;
    }

    public function getMinutes()
    {
        return $this->minutes;
    }

    public function setMinutes(int $minutes)
    {
        $this->minutes = $minutes;

        return $this;
    }

    public function getHours()
    {
        return $this->hours;
    }

    public function setHours(int $hours)
    {
        $this->hours = $hours;

        return $this;
    }
}
