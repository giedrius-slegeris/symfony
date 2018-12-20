<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\User;

class ProfileController extends Controller
{

  private $user;

  public function __construct(){
    $this->user = new User();
  }

  /**
   * @Route("/profile", name="profile")
   */
  public function profile(Request $request)
  {
    return $this->render('profile/profile.html.twig', array(
        'title' => 'Profile page',
        'name' => 'Giedrius profile',
        'profiles' => count($this->user->getUsers())
    ));
  }

  /**
   * @Route("/profile/add", name="add_profile")
   */
  public function profileAdd(Request $request)
  {
      return $this->render('profile/profile_add.html.twig', array(
          'title' => 'Add new profile',
          'call' => $request->getMethod(),
          'titles' => $this->user->getTitles()
      ));
  }

  /**
   * @Route("/profile/{user_id}", name="profileID")
   */
  public function profileID(Request $request, int $user_id)
  {
    $users = $this->user->getUsers();
    $user_data = [];

    try {
      $user_data = $users[$user_id -1];
    } catch(\Symfony\Component\Debug\Exception\ContextErrorException $e) {
      // no action
    }

    return $this->render('profile/profile_id.html.twig', array(
        'title' => 'Profile with ID',
        'profile' => $user_data,
        'titles' => $this->user->getTitles()
    ));
  }

}
