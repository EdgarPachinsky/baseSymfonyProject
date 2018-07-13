<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginCheck extends Controller
{

    /**
     * @Route("/app/login_check", name="app_login_check")
     */
    public function loginAction(Request $request){
        $user=$this->getUser();
        $em = $this->getDoctrine()->getManager();
        if($user){
            $user->setRoleChange(0);
            $em->persist($user);
            $em->flush();
        }

        /**
         * Change To Your Rout
         */
        return $this->redirectToRoute('homepage');
    }
}