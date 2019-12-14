<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $short_description;

    /**
     * @ORM\Column(type="text")
     */
    private $full_description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $seo_url;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_update;

    /**
     * Many posts have one user. This is the owning side.
     * @ORM\ManyToOne(targetEntity="User", inversedBy="posts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    public function __construct() {
        $this->date_update = new \DateTime();
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle(string $title) {
        $this->title = $title;

        return $this;
    }

    public function getShortDescription() {
        return $this->short_description;
    }

    public function setShortDescription(string $short_description) {
        $this->short_description = $short_description;

        return $this;
    }

    public function getFullDescription() {
        return $this->full_description;
    }

    public function setFullDescription(string $full_description) {
        $this->full_description = $full_description;

        return $this;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus(bool $status) {
        $this->status = $status;

        return $this;
    }

    public function getSeoUrl() {
        return $this->seo_url;
    }

    public function setSeoUrl(string $seo_url) {
        $this->seo_url = $seo_url;

        return $this;
    }

    public function getDateUpdate() {
        return $this->date_update;
    }

    public function getUser() {
        return $this->user;
    }
    
    public function getUserId() {
        return $this->user_id;
    }

    public function setUser(User $User) {
        return $this->user = $User;
    }
    
    public function setFrontData($key, $vallue) {
        if($key === 'title') {
            $this->setTitle($vallue);
        }
        
        if($key === 'short_description') {
            $this->setShortDescription($vallue);
        }
        
        if($key === 'full_description') {
            $this->setFullDescription($vallue);
        }
        
        if($key === 'seo_url') {
            $this->setSeoUrl($vallue);
        }
        
        if($key === 'status') {
            $this->setStatus($vallue);
        }
    }

    public function getFrontData() {
        return [
            'id' => $this->getId(),
            'user_id' => $this->getUserId(),
            'title' => $this->getTitle(),
            'short_description' => $this->getShortDescription(),
            'full_description' => $this->getFullDescription(),
            'status' => $this->getStatus(),
            'date_update' => $this->getDateUpdate(),
        ];
    }
}
