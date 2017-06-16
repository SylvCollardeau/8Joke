<?php 	
// src/AppBundle/Controller/TestController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;

class HomeController extends Controller
{


    public function homeAction()
    {
        $post = $this  ->getDoctrine() ->getManager() ->getRepository('AppBundle:Post') ->findAll();
        $home = "Accueil";

        return $this->render('::default/home.html.twig', array(
            'home' => $home,
            'post' => $post,
        ));
    }
}
?>