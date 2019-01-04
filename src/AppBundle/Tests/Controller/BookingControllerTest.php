<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use AppBundle\Controller\BookingController;

class BookingControllerTest extends WebTestCase
{

    public function testBookingIndex()
    {
      $client = static::createClient();
      $crawler = $client->request('GET', '/bookings');

      $this->assertEquals(200, $client->getResponse()->getStatusCode());
      $this->assertContains('List all bookings', $crawler->filter('#page .col-sm-12 > p:nth-child(1)')->text());
      $this->assertContains('User ID', $crawler->filter('#page .col-sm-12 > table > thead > tr:nth-child(1) > th:first-child')->text());
    }

    public function testBookingControllerClass(){
      $bookingController = new BookingController();
      $this->assertInstanceOf('AppBundle\Controller\BookingController', $bookingController);
    }
    
}
