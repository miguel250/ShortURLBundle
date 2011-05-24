<?php

/*
 * This file is part of the MLPZ\ShortURLBundle
 *
 * (c) Miguel Perez <miguel@mlpz.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace MLPZ\ShortURLBundle\Tests\Model;

/**
 * Test short url model
 *
 * @author  Miguel Perez <miguel@mlpz.com>
 */
class ShortURLTest extends \PHPUnit_Framework_TestCase
{

    public function testLongURL()
    {
        $longurl = $this->getShortURL();
        $this->assertNull($longurl->getLongURL());

        $longurl->setLongURL('http://google.com');
        $this->assertEquals('http://google.com', $longurl->getLongURL());
    }

    public function testHash()
    {
        $hash = $this->getShortURL();
        $this->assertNull($hash->getHash());

        $hash->setHash('W3c');
        $this->assertEquals('W3c', $hash->getHash());
    }

    public function testClicks()
    {
        $clicks = $this->getShortURL();
        $this->assertNull($clicks->getClicks());

        $clicks->setClicks(1);
        $this->assertEquals(1, $clicks->getClicks());
    }

    public function testCreatedAt()
    {
        $createdAt = $this->getShortURL();
        $this->assertNull($createdAt->getCreatedAt());

        $date = new \DateTime();
        $date->format('M d, Y');

        $createdAt->setCreatedAt();
        $this->assertEquals($date, $createdAt->getCreatedAt());
    }

    public function testLastClick()
    {
         $lastClick= $this->getShortURL();
        $this->assertNull($lastClick->getLastClick());

        $date = new \DateTime();
        $date->format('M d, Y');

        $lastClick->setLastClick();
        $this->assertEquals($date, $lastClick->getLastClick());
    }

    protected function getShortURL()
    {
        return $this->getMockForAbstractClass('MLPZ\ShortURLBundle\Entity\ShortURL');
    }

}