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

    $repo = $this->getDoctrine()->getRepository('AppBundle:User');
    $data = $repo->find($user_id);

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

      $update_data = $form->getData();

      $data->setTitle($update_data['personTitle']);
      $data->setFirstname($update_data['personFname']);
      $data->setLastname($update_data['personLname']);
      $data->setEmail($update_data['personEmail']);
      $data->setTelephone($update_data['personTel']);
      $data->setDateOfBirth(date_create_from_format('Y-m-d', $update_data['personDOB']));
      $data->setAddress($update_data['personAdr']);
      $data->setPostcode($update_data['personPostcode']);
      $data->setCountry($update_data['personCountry']);

      $em = $this->getDoctrine()->getManager();
      $em->flush();
    }

    // date for formatting
    $date = $data->getDateOfBirth();

    $user_data = [
      'id' => $user_id,
      'title' => $data->getTitle(),
      'fname' => $data->getFirstname(),
      'lname' => $data->getLastname(),
      'email' => $data->getEmail(),
      'tel' => $data->getTelephone(),
      'dob' => $date->format('Y-m-d'),
      'dob_formatted' => $date->format('d F Y'),
      'address' => $data->getAddress(),
      'postcode' => $data->getPostcode(),
      'country' => $data->getCountry()
    ];

    return $this->render('profile/profile_id.html.twig', [
        'title' => 'Profile with ID',
        'profile' => $user_data,
        'titles' => $this->user->getTitles()
    ]);
  }

}
