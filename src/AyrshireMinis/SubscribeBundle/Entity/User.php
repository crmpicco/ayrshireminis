<?php

/**
 * Entity class for a User, created during newsletter subscription
 *
 * @author Craig R Morton <crmpicco@aol.co.uk>
 * @date   11-Dec-2014
 */

namespace AyrshireMinis\SubscribeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * User
 */
class User
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var \DateTime
     */
    private $joinedOn;

    /**
     * @var boolean
     */
    private $unsubscribed;


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
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set joinedOn
     *
     * @param \DateTime $joinedOn
     *
     * @return User
     */
    public function setJoinedOn($joinedOn)
    {
        $this->joinedOn = $joinedOn;

        return $this;
    }

    /**
     * Get joinedOn
     *
     * @return \DateTime
     */
    public function getJoinedOn()
    {
        return $this->joinedOn;
    }

    /**
     * Set unsubscribed
     *
     * @param boolean $unsubscribed
     *
     * @return User
     */
    public function setUnsubscribed($unsubscribed)
    {
        $this->unsubscribed = $unsubscribed;

        return $this;
    }

    /**
     * Get unsubscribed
     *
     * @return boolean
     */
    public function getUnsubscribed()
    {
        return $this->unsubscribed;
    }
}
