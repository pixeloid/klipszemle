<?php

namespace Pixeloid\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$name = '...';
        return $this->render('PixeloidUserBundle:Default:index.html.twig', array('name' => $name));
    }

    public function createUserAction()
    {
    	$email = 'john.doe@example.com';
    	$password = $this->randomPassword();
    	$username = 'john';

    	$userManager = $this->get('fos_user.user_manager');

   	    $existsUser = $userManager->findUserByEmail($email); 

   	    if($existsUser)
   	    {
   	    	return 'Van user!';
   	    }


    	$user = $userManager->createUser();
    	$user->setUsername($username);
    	$user->setEmail($email);
    	$user->setPassword($password);

    	$userManager->updateUser($user);


    }

    private function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}
