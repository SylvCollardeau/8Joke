<?php 	
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\User;

class UserController extends Controller
{

    public function loginAction(Request $request)
    {
    	$title = "Sign-in";

    	if($request->isMethod('POST')){
    		var_dump($this->getUser());
    		die;
    	}
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
}
?>