<?php

namespace PFE\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PFE\UserBundle\Entity\User;
class UserController extends Controller{
                     

    public function indexAction(){

    	$em=$this->getDoctrine()->getManager();
    	$user=$em->getRepository('PFEUserBundle:User')->findAll();

      //dump($user);
      //die();
    	return $this->render('user/index.html.twig',array('user'=>$user));
    }


    public function editAction(Request $request, User $user)
    {
     
        $editForm=$this->createForm('PFE\UserBundle\Form\RegistrationType',$user);
        $editForm->handleRequest($request);
       if($editForm->isSubmitted() && $editForm->isValid()){
         
         $this->getDoctrine()->getManager()->flush();
         
             $request->getSession()
                ->getFlashBag()
                ->add('edit', 'Utilisateur modifié.');
         return $this->redirectToRoute('pfe_saisi_user_edit',array('id'=>$user->getId()));
        }
          
        return $this->render('user/edit.html.twig', array(
            'user' => $user,
            'edit_form'   => $editForm->createView(),
           
        ));
    }

   
     public function removeAction(Request $request,$id)
    {
        $user=new User();
        $em = $this->getDoctrine()->getManager();
        $user=$em->getRepository('PFEUserBundle:User')->find($id);
        $em->remove($user);
        $em->flush();

       // $y = $req->get('actionyear');
      //  $m = $req->get('actionmonth');

           $request->getSession()
                ->getFlashBag()
                ->add('delete', 'Utilisateur supprimé.');
        return $this->redirectToRoute('pfe_saisi_user');
    }
}