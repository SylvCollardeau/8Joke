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
    	$em = $this ->getDoctrine() ->getManager();
        $post =  $em ->getRepository('AppBundle:Post') ->findAll();
        $home = "Accueil";

        return $this->render('::default/home.html.twig', array(
            'home' => $home,
            'post' => $post,
        ));
    }

    public function likeAction($post_id)
    {	
    	$em = $this ->getDoctrine() ->getManager();

    	$post = $em ->getRepository('AppBundle:Post') -> find("$post_id");

    	if (!$post) {
    		throw new Symfony\Component\HttpKernel\Exception\HttpException(404, "Post not found");
    	}

    	$like_post = $post -> getNbLike() + 1;

    	$post -> setNbLike($like_post);

    	$em -> persist($post);

    	$em -> flush();


    	return $this->redirectToRoute('home');
    }

    public function unlikeAction($post_id)
    {	
    	$em = $this ->getDoctrine() ->getManager();

    	$post = $em ->getRepository('AppBundle:Post') -> find("$post_id");

    	if (!$post) {
    		throw new Symfony\Component\HttpKernel\Exception\HttpException(404, "Post not found");
    	}

    	$like_post = $post -> getNbLike() - 1;

    	$post -> setNbLike($like_post);

    	$em -> persist($post);

    	$em -> flush();


    	return $this->redirectToRoute('home');
    }
}
