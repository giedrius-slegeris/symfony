<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends Controller
{

  /**
   * @Route("/profile", name="profile")
   */
  public function profile(Request $request)
  {
      // replace this example code with whatever you need
      return $this->render('profile/profile.html.twig', array(
          'title' => 'Profile page',
          'name' => 'Giedrius profile'
      ));
  }

}
