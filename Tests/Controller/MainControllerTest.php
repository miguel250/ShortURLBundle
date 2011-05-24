<?php

/*
 * This file is part of the MLPZ\ShortURLBundle
 *
 * (c) Miguel Perez <miguel@mlpz.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace MLPZ\ShortURLBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test main controller
 *
 * @author Miguel Perez <miguel@mlpz.com>
 */
class MainControllerTest extends WebTestCase
{

    function testIndex()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/shorten');

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertTrue($crawler->filter('html:contains("form")')->count() > 0);
    }

    function testAdd()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/shorten?q=http%3A%2F%2Fgoogle.com');

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertEquals('W3c',$client->getResponse()->getContent());
    }

    public function testredirect()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/W3c');

        $this->assertTrue($client->getResponse()->getStatusCode() == '301');
    }

}