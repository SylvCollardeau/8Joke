<?php 	
// src/AppBundle/Controller/TestController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Vote;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Post;
use AppBundle\Form\PostType;


class PostController extends Controller{

    public function showUserPostAction(){
        $em = $this ->getDoctrine() ->getManager();

    	$user = $this -> getUser();

        $post =  $em ->getRepository('AppBundle:Post') ->findBy(array('idUser' => $user->getId()));

        return $this->render('::default/showUserPost.html.twig', array(
            'post' => $post,
        ));

    }

    public function deletePostAction($post_id){

        $em = $this ->getDoctrine() ->getManager();

        $post =  $em ->getRepository('AppBundle:Post') -> find($post_id);

        $em->remove($post);

        $em->flush();

        return $this->redirectToRoute('showUserPost');
    }

    public function createPostAction(Request $request){
    	$em = $this -> getDoctrine() -> getManager();

    	$user = $this -> getUser();

    	$post = new Post();

    	$form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        	$post -> setAuteur($user->getUsername());

        	$post = $form->getData();
        	dump($post);

        	$file = $post -> getFile();

        	$fileName = md5(uniqid()).'.'. $file->guessExtension();

        	$file->move(
                $this->getParameter('post_img_directory'),
                $fileName
            );

            $post->setImg($fileName);

            $em->persist($post);

            $em->flush();	

            return $this->redirectToRoute("showUserPost");
        }
        else{
	        return $this->render('::default/createPost.html.twig', array(
            	'form' => $form-> createView(),
        	));
    	}
    }

	public function likeAction($post_id)
    {	
    	$em = $this -> getDoctrine() -> getManager();

    	$user = $this -> getUser();

    	if($user){

            $hasVote = $this->userHasVote($post_id, $user->getId(), "like");
            if(!$hasVote) {

                $vote_other_type = $em ->getRepository('AppBundle:Vote')->findBy(array('idPost' => $post_id, 'idUser' => $user->getId(), 'typeVote' => 'unlike'));

                if($vote_other_type){
                    foreach($vote_other_type as $item){
                        $em->remove($item);
                    }
                }

                $vote = new Vote();
                $vote->setIdPost($post_id);
                $vote->setIdUser($user->getId());
                $vote->setTypeVote("like");

                $em->persist($vote);

                $post = $em->getRepository('AppBundle:Post')->find("$post_id");

                if (!$post) {
                    throw new Symfony\Component\HttpKernel\Exception\HttpException(404, "Post not found");
                }

                $like_post = $post->getNbLike() + 1;

                $post->setNbLike($like_post);

                $em->persist($post);

                $em->flush();

                return $this->redirectToRoute('home');
            }
            else{
                return $this->redirectToRoute('home');
            }
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

            $hasVote = $this->userHasVote($post_id, $user->getId(), "unlike");
            if(!$hasVote) {
                $vote = new Vote();
                $vote->setIdPost($post_id);
                $vote->setIdUser($user->getId());
                $vote->setTypeVote("unlike");

                $vote_other_type = $em ->getRepository('AppBundle:Vote')->findBy(array('idPost' => $post_id, 'idUser' => $user->getId(), 'typeVote' => 'like'));

                if($vote_other_type){
                    foreach($vote_other_type as $item){
                        $em->remove($item);
                    }
                }

                $post = $em->getRepository('AppBundle:Post')->find("$post_id");

                if (!$post) {
                    throw new Symfony\Component\HttpKernel\Exception\HttpException(404, "Post not found");
                }

                $like_post = $post->getNbLike() - 1;

                $post->setNbLike($like_post);

                $em->persist($vote);

                $em->persist($post);

                $em->flush();

                return $this->redirectToRoute('home');
            }
            else{
                return $this->redirectToRoute('home');
            }

	    }
	    else
	    {
	    	return $this->redirectToRoute('home');
	    }
    }

    public function userHasVote($post_id, $user_id, $vote_type){
        $em = $this -> getDoctrine() -> getManager();

        $votes = $em ->getRepository('AppBundle:Vote')->findBy(array('idPost' => $post_id, 'idUser' => $user_id, 'typeVote' => $vote_type));

        if($votes){
            return true;
        }
        else
        {
            return false;
        }
    }
}