<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MachineControllerTest extends WebTestCase
{
    public function testShowIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShowOrder()
    {
        $client = static::createClient();

        $client->request('POST', '/order', ['beverageId' => 1, 'payDepositing' => 500]);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}