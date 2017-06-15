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

    	$authUtils = $this->get("security.authentication_utils");
    	 // get the login error if there is one
		$error = $authUtils->getLastAuthenticationError();

		// last username entered by the user
		$lastUsername = $authUtils->getLastUsername();

		return $this->render('::default/login.html.twig', array(
		    'last_username' => $lastUsername,
		    'error'         => $error,
		));
    }

    public function loginAction()
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