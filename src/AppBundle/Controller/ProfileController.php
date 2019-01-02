<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\User as UserEntity;

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
    $users = $this->getDoctrine()
      ->getRepository('AppBundle:User')
      ->findAll();

    return $this->render('profile/profile.html.twig', array(
        'title' => 'Profile page',
        'name' => 'Giedrius profile',
        // 'profiles' => count($this->user->getUsers()),
        'profiles' => $users
    ));
  }

  /**
   * @Route("/profile/add", name="add_profile")
   */
  public function profileAdd(Request $request)
  {
    $data = [
      'form' => ''
    ];

    $form = $this->createFormBuilder()
      ->add('personTitle')
      ->add('personFname')
      ->add('personLname')
      ->add('personEmail')
      ->add('personTel')
      ->add('personDOB')
      ->add('personAdr')
      ->add('personPostcode')
      ->add('personCountry')
      ->getForm();

    $form->handleRequest($request);

    if($form->isSubmitted()){
      $data['form'] = $form->getData();

      // doctrine manager instance
      $em = $this->getDoctrine()->getManager();

      $userEnt = new UserEntity();

      $userEnt->setTitle($data['form']['personTitle']);
      $userEnt->setFirstname($data['form']['personFname']);
      $userEnt->setLastname($data['form']['personLname']);
      $userEnt->setEmail($data['form']['personEmail']);

      $date = date_create_from_format('Y-m-d', $data['form']['personDOB']);
      $date->getTimestamp();
      $userEnt->setDateOfBirth($date);

      $userEnt->setTelephone($data['form']['personTel']);
      $userEnt->setAddress($data['form']['personAdr']);
      $userEnt->setPostcode($data['form']['personPostcode']);
      $userEnt->setCountry($data['form']['personCountry']);

      $em->persist($userEnt);
      $em->flush();
    }

    return $this->render('profile/profile_add.html.twig', [
      'title' => 'Add new profile',
      'call' => $request->getMethod(),
      'titles' => $this->user->getTitles(),
      'data' => $data
    ]);
  }

  /**
   * @Route("/profile/{user_id}", name="profileID")
   */
  public function profileID(Request $request, int $user_id)
  {

    // process update request
    $form = $this->createFormBuilder()
      ->add('personID')
      ->add('personTitle')
      ->add('personFname')
      ->add('personLname')
      ->add('personEmail')
      ->add('personTel')
      ->add('personDOB')
      ->add('personAdr')
      ->add('personPostcode')
      ->add('personCountry')
      ->getForm();

    $form->handleRequest($request);

    if($form->isSubmitted()){
      echo '<pre>';
      print_r($form->getData());
      echo '</pre>';
      die();

      // TODO: update stuff!
    }

    // $users = $this->user->getUsers();
    $repo = $this->getDoctrine()->getRepository('AppBundle:User');

    $user_data = [];

    try {
      // $user_data = $users[$user_id -1];
      $data = $repo->find($user_id);

      $user_data['id'] = $user_id;

      $user_data['title'] = $data->getTitle();
      $user_data['fname'] = $data->getFirstname();
      $user_data['lname'] = $data->getLastname();
      $user_data['email'] = $data->getEmail();
      $user_data['tel'] = $data->getTelephone();

      $date = $data->getDateOfBirth();
      $user_data['dob'] = $date->format('Y-m-d');
      $user_data['dob_formatted'] = $date->format('d F Y');

      $user_data['address'] = $data->getAddress();
      $user_data['postcode'] = $data->getPostcode();
      $user_data['country'] = $data->getCountry();

    } catch(\Symfony\Component\Debug\Exception\ContextErrorException $e) {
      // no action
    }

    return $this->render('profile/profile_id.html.twig', [
        'title' => 'Profile with ID',
        'profile' => $user_data,
        'titles' => $this->user->getTitles()
    ]);
  }

}
