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
    	$home = "Accueil";

    	$em = $this ->getDoctrine() ->getManager();

    	$user = $this -> getUser();

        $post =  $em ->getRepository('AppBundle:Post') ->findAll();

        if($user){
        	$vote =  $em ->getRepository('AppBundle:Vote') ->find($user -> getId());
        }
        else{
        	$vote = null;
        }

        return $this->render('::default/home.html.twig', array(
            'home' => $home,
            'post' => $post,
            'vote' => $vote,
        ));
    }   
}
