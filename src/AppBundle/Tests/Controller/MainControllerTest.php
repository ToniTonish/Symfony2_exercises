<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainControllerTest extends WebTestCase
{
    public function testRender()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/prova-twig');
    }

}
