<?php 	
// src/AppBundle/Controller/TestController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Vote;

class PostController extends Controller{
	public function likeAction($post_id)
    {	
    	$em = $this -> getDoctrine() -> getManager();

    	$user = $this -> getUser();

    	if($user){

	    	$vote = new Vote();
	    	$vote -> setIdPost($post_id);
			$vote -> setIdUser($user->getId());
			$vote -> setTypeVote("like");

			$em -> persist($vote);

	    	$post = $em ->getRepository('AppBundle:Post') -> find("$post_id");

	    	if (!$post) {
	    		throw new Symfony\Component\HttpKernel\Exception\HttpException(404, "Post not found");
	    	}

	    	$like_post = $post -> getNbLike() + 1;

	    	$post -> setNbLike($like_post);

	    	$em -> persist($post);

	    	$em -> flush();

	    	return $this -> redirectToRoute('home');
	    }
	    else
	    {
	    	return $this -> redirectToRoute('home');
	    }
    }

    public function unlikeAction($post_id)
    {	
    	$em = $this -> getDoctrine() -> getManager();

    	$user = $this-> getUser();

		if($user){

	    	$vote = new Vote();
	    	$vote -> setIdPost($post_id);
			$vote -> setIdUser($user -> getId());
			$vote -> setTypeVote("unlike");

			

	    	$post = $em -> getRepository('AppBundle:Post') -> find("$post_id");

	    	if (!$post) 
	    	{
	    		throw new Symfony\Component\HttpKernel\Exception\HttpException(404, "Post not found");
	    	}

	    	$like_post = $post -> getNbLike() - 1;

	    	$post -> setNbLike($like_post);

	    	$em -> persist($vote);

	    	$em -> persist($post);

	    	$em -> flush();


	    	return $this->redirectToRoute('home');
	    }
	    else
	    {
	    	return $this->redirectToRoute('home');
	    }
    }
}