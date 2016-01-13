<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventRepository")
 * @ORM\HasLifecycleCallbacks()
 */

class Event
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
     * @ORM\Column(name="startdate", type="datetime")
     */
    private $startdate;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255)
     */
    private $token;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_distributed", type="boolean")
     */
    private $isDistributed = false;

    /**
     * @var string
     *
     * @ORM\Column(name="shared_token", type="string", length=255, nullable=true)
     */
    private $sharedToken;

    /**
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
    * @ORM\JoinColumn(name="owner", referencedColumnName="id")
    */
    private $owner;

    /**
     * @ORM\PrePersist
     */
    public function prePersist() {
        $this->setToken(bin2hex(openssl_random_pseudo_bytes(16)));
        $this->setSharedToken(bin2hex(openssl_random_pseudo_bytes(16)));
    }

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
     * Set startdate
     *
     * @param \DateTime $startdate
     *
     * @return Event
     */
    public function setStartdate($startdate)
    {
        $this->startdate = $startdate;

        return $this;
    }

    /**
     * Get startdate
     *
     * @return \DateTime
     */
    public function getStartdate()
    {
        return $this->startdate;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Event
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
     * Set token
     *
     * @param string $token
     *
     * @return Event
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set isDistributed
     *
     * @param boolean $isDistributed
     *
     * @return Event
     */
    public function setIsDistributed($isDistributed)
    {
        $this->isDistributed = $isDistributed;

        return $this;
    }

    /**
     * Get isDistributed
     *
     * @return bool
     */
    public function getIsDistributed()
    {
        return $this->isDistributed;
    }

    /**
     * Set sharedToken
     *
     * @param string $sharedToken
     *
     * @return Event
     */
    public function setSharedToken($sharedToken)
    {
        $this->sharedToken = $sharedToken;

        return $this;
    }

    /**
     * Get sharedToken
     *
     * @return string
     */
    public function getSharedToken()
    {
        return $this->sharedToken;
    }

    /**
     * Set owner
     *
     * @param \AppBundle\Entity\User $owner
     *
     * @return Event
     */
    public function setOwner(\AppBundle\Entity\User $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \AppBundle\Entity\User
     */
    public function getOwner()
    {
        return $this->owner;
    }
}
