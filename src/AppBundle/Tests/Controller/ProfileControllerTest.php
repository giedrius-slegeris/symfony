<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use AppBundle\Controller\ProfileController;
use AppBundle\User;

class ProfileControllerTest extends WebTestCase
{

    public function testProfileIndex()
    {
      $client = static::createClient();
      $crawler = $client->request('GET', '/profile');

      $this->assertEquals(200, $client->getResponse()->getStatusCode());
      $this->assertContains('/profile/add', $crawler->filter('a[href="/profile/add"]')->attr('href'));
    }

    public function testUserInstance(){
      $user = new User();
      $this->assertInstanceOf('AppBundle\User', $user);
    }
}
