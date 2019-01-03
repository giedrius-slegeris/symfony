<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Room;
use AppBundle\Entity\User;
use AppBundle\Entity\Booking;

class BookingController extends Controller
{

  /**
  * @Route("/bookings", name="bookings")
  */
  public function bookings(){

    $bookings = $this->getDoctrine()
      ->getRepository('AppBundle:Booking')
      ->findAll();

    return $this->render('booking/index.html.twig', array(
        'title' => 'All bookings',
        'bookings' => $bookings
    ));
  }

  /**
   * @Route("/book", name="book_room")
   */
  public function bookRoom(Request $request)
  {
    $form = $this->createFormBuilder()
      ->add('personID')
      ->add('room')
      ->add('dateIn')
      ->add('dateOut')
      ->getForm();

    $form->handleRequest($request);

    if($form->isSubmitted()){
      $form_data = $form->getData();

      $room_repo = $this->getDoctrine()
        ->getRepository('AppBundle:Room')
        ->find($form_data['room']);

      $user_repo = $this->getDoctrine()
        ->getRepository('AppBundle:User')
        ->find($form_data['personID']);

      $dateIn = new \DateTime($form_data['dateIn']);
      $dateOut = new \DateTime($form_data['dateOut']);

      $booking = new Booking();

      $booking->setUser($user_repo);
      $booking->setRoom($room_repo);
      $booking->setDateIn($dateIn);
      $booking->setDateOut($dateOut);

      $em = $this->getDoctrine()->getManager();
      $em->persist($booking);
      $em->flush();
    }

    return $this->redirectToRoute('profile');
  }

}
