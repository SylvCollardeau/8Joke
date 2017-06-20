<?php 	
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;

class UserController extends Controller
{

    public function loginAction()
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

    public function registerAction(Request $request){
    	$title = "Register";
		
		$em = $this -> getDoctrine() -> getManager();

    	$user = new User();

    	$form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
	    	$em -> persist($user);

	    	$em -> flush();

            return $this->redirectToRoute("createUserOk");
        }

        return $this->render('::default/register.html.twig', array(
			"title" => $title,
			"form" => $form-> createView(),
		));

    }

    public function validationAction()
    {	
    	$title = "Inscription réussie !";

		return $this->render('::default/validation.html.twig', array(
			"title" => $title,
		));
    }
}
?>