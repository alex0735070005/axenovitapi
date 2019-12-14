<?php
namespace App\Entity;

use App\Entity\Post;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean",)
     */
    private $verify;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $api_key;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_update;

    /**
     * @ORM\Column(type="array")
     */
    private $roles;

    /**
     * One user has many posts. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Post", mappedBy="user")
     */
    private $posts;

    public function __construct() {
        $this->posts = new ArrayCollection();
        $this->roles = array('ROLE_USER');
        $this->date_update = new \DateTime();
    }

    public function getId() {
        return $this->id;
    }

    public function getUserName() {
        return $this->username;
    }

    public function setUserName(string $username) {
        $this->username = $username;

        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail(string $email) {
        $this->email = $email;

        return $this;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword(string $password) {
        $this->password = $password;

        return $this;
    }

    public function getApiKey() {
        return $this->api_key;
    }

    public function setApiKey(string $api_key) {
        $this->api_key = $api_key;

        return $this;
    }

    public function getVerify() {
        return $this->verify;
    }

    public function setVerify(string $verfy) {
        return $this->verify = $verfy;
    }

    public function getDateUpdate() {
        return $this->date_update;
    }

    public function getRoles() {
        return $this->roles;
    }

    public function getSalt() {
        // The bcrypt and argon2i algorithms don't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }

    public function addPost(Post $Post) {
      return $this->posts[] = $Post;
    }

    public function getPosts() {
      return $this->posts;
    }

    public function eraseCredentials() {
        
    }

}
