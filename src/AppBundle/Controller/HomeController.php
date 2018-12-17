<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController extends Controller
{
    /**
     * @Route("/home", name="homepage_v2")
     */
    public function index(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('home/index.html.twig', array(
            'title' => 'Alternative homepage'
        ));
    }

    /**
    * @Route("/home/v2")
    */
    public function homeV2(Request $request){
      return $this->render('home/index.html.twig', array(
          'title' => 'Different title!!!'
      ));
    }

    /**
    * @Route("/home/api")
    */
    public function homeAPI(Request $request){

      // API response
      return new JsonResponse([
        'name' => 'Giedrius'
      ]);
    }

    /**
    * @Route("/home/{name}")
    */
    public function homeName(Request $request, string $name){

      return $this->render('home/index.html.twig', [
          'title' => 'Different title!!!',
          'name' => $name
      ]);
    }
}
