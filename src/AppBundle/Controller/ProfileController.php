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
      return $this->render('profile/profile.html.twig', array(
          'title' => 'Profile page',
          'name' => 'Giedrius profile',
          'profiles' => [
            1, 2, 3, 4, 5
          ]
      ));
  }

  /**
   * @Route("/profile/add", name="add_profile")
   */
  public function profileAdd(Request $request)
  {
      return $this->render('profile/profile_add.html.twig', array(
          'title' => 'Add new profile',
          'call' => $request->getMethod()
      ));
  }

  /**
   * @Route("/profile/{user_id}", name="profileID")
   */
  public function profileID(Request $request, int $user_id)
  {
      return $this->render('profile/profile_id.html.twig', array(
          'title' => 'Profile with ID',
          'profile_id' => $user_id
      ));
  }

}
