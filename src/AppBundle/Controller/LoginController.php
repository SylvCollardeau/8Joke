<?php 	
// src/AppBundle/Controller/TestController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\User;

class LoginController extends Controller
{

    public function connexionAction()
    {
    	$title = "Sign-in";

    	return $this->render('::default/login.html.twig', array(
    		'title' => $title,
    	));
    }

    public function connectUserAction()
    {

    	$user = new User();

	    // ... do something to the $author object

	    $validator = $this->get('validator');
	    $errors = $validator->validate($user);

	    $success = "Connexion réussie !";

	    if (count($errors) > 0) {
	      return $this->render('::default/validation.html.twig', array(
		        'errors' => $errors,
		  ));
	    }

	    return $this->render('::default/validation.html.twig', array(
		        'success' => $success,
		));
    }


}
?>