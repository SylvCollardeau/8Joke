<?php 	
// src/AppBundle/Controller/TestController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{


    public function homeAction()
    {

        $home = "Accueil";

        return $this->render('::default/home.html.twig', array(
            'home' => $home,
        ));
    }
}
?>