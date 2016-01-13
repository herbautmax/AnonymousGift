<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* UserEvent
*
* @ORM\Table(name="user_event")
* @ORM\Entity(repositoryClass="AppBundle\Repository\UserEventRepository")
*/
class UserEvent
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
  * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
  * @ORM\JoinColumn(name="user", referencedColumnName="id")
  */
  protected $user;

  /**
  * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Event")
  * @ORM\JoinColumn(name="event", referencedColumnName="id")
  */
  protected $event;

  /**
  * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
  * @ORM\JoinColumn(name="received_user", referencedColumnName="id")
  */
  protected $received_user;


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
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return UserEvent
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set event
     *
     * @param \AppBundle\Entity\Event $event
     *
     * @return UserEvent
     */
    public function setEvent(\AppBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \AppBundle\Entity\Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set receivedUser
     *
     * @param \AppBundle\Entity\User $receivedUser
     *
     * @return UserEvent
     */
    public function setReceivedUser(\AppBundle\Entity\User $receivedUser = null)
    {
        $this->received_user = $receivedUser;

        return $this;
    }

    /**
     * Get receivedUser
     *
     * @return \AppBundle\Entity\User
     */
    public function getReceivedUser()
    {
        return $this->received_user;
    }
}
