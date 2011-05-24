<?php

/*
 * This file is part of the MLPZ\ShortURLBundle
 *
 * (c) Miguel Perez <miguel@mlpz.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace MLPZ\ShortURLBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Default ORM
 *  @ORM\Entity
 * @author Miguel Perez  <miguel@mlpz.com>
 */

class ShortURL
{

    /**
     * @Assert\NotBlank()
     * @ORM\Id
     * @ORM\Column(type="string")
     * @var string
     */
    private $longURL;
    /**
     *
     * @assert\Url()
     * @ORM\Column(type="string")
     * @var string
     */
    private $hash;
    /**
     * @ORM\Column(type="integer",nullable="true")
     * @var integer
     */
    private $clicks;
    /**
     *@ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $createdAt;
    /**
     * @ORM\Column(type="datetime", nullable="true")
     * @var \DateTime
     */
    private $lastClick;
 /**
     * Sets the longurl
     * @param string $longURL
     */
    public function setLongURL($longURL)
    {
        $this->longURL = $longURL;
    }

    /**
     * Sets the hash
     * @param string $hash
     */
    public function setHash()
    {
        $hash = md5(uniqid(rand(), true) . '!@#$%^&*()_+=-{}][;";/?<>.,' . microtime());
        $hash = pack('H*', $hash);
        $hash = base64_encode($hash);
        $hash = str_replace(
                array('+', '/', '='), array('', '', ''), $hash);
        $hash = substr($hash, 0, 3);

        $this->hash = $hash;
    }

    /**
     * Sets the clicks
     * @param integer $clicks
     */
    public function setClicks($clicks)
    {
        $this->clicks = $clicks;
    }

    /**
     * Sets the created date
     */
    public function setCreatedAt()
    {
        $createdAt = new \DateTime();
        $createdAt->format('M d, Y');

        $this->createdAt = $createdAt;
    }

    /**
     * Gets the last time click
     */
    public function setLastClick()
    {
        $lastClick = new \DateTime();
        $lastClick->format('M d, Y');

        $this->lastClick = $lastClick;
    }

    /**
     * Gets Long URL
     * @return string
     */
    public function getLongURL()
    {
        return $this->longURL;
    }

    /**
     * Get  Hash
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Gets Clicks
     * @return integer
     */
    public function getClicks()
    {
        return $this->clicks;
    }

    /**
     * Gets Created at
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Gets Last click
     * @return \DateTime
     */
    public function getLastClick()
    {
        return $this->lastClick;
    }


}