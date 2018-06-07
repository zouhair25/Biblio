<?php

namespace PFE\DashBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PFE\DashBundle\Entity\Typeespace;

 class TypeespaceController extends Controller{

	public function indexAction(){

		$em=$this->getDoctrine()->getManager();
		$typeespace=$em->getRepository('PFEDashBundle:Typeespace')->findAll();

		return $this->render('typeespace/index.html.twig',array('typeespace'=>$typeespace));
	}

	public function editAction(Request $request, Typeespace $typeespace){

    $editForm=$this->createForm('PFE\DashBundle\Form\TypeespaceType',$typeespace);
    $editForm->handleRequest($request);

    if($editForm->isSubmitted() && $editForm->isValid()){
    	$em=$this->getDoctrine()->getManager()->flush();

    		$request->getSession()
    	        ->getFlashbag()
    	        ->add('add','Type espace modifié');
    
    	return $this->redirectToRoute('typeespace_edit',array('typeespace'=>$this->getId()));        
    }

       return $this->render('typeespace/edit.html.twig', array(
          'editForm'=>$editForm->createView(),
          'typeespace'=>$typeespace
       ));
	}

    public function newAction(Request $request){
    
    $typeespace=new Typeespace();
    $form=$this->createForm('PFE\DashBundle\Form\TypeespaceType',$typeespace);
    $form->handleRequest($request);

    if($form->isSubmitted()&& $form->isValid()){
    	$em=$this->getDoctrine()->getManager();
    	$em->persist($typeespace);
    	$em->flush();

    	$request->getSession()
    	        ->getFlashbag()
    	        ->add('add','Type espace ajouté');

    	return $this->redirectToRoute('typeespace_index',array('typeespace'=>$typeespace->getId()));        
    }

       return $this->render('typeespace/new.html.twig', array(
          'form'=>$form->createView(),
          'typeespace'=>$typeespace
       ));
	}
	public function removeAction(Request $request,$id){
		
		$em=$this->getDoctrine()->getManager();
		$typeespace=$em->getRepository('PFEDashBundle:Typeespace')->find($id);
		$em->remove($typeespace);
        $em->flush();
		$request->getSession()
		->getFlashbag()
		->add('delete','type espace supprimé');

		return $this->redirectToRoute('typeespace_index');
	}

	public function showAction(Request $request){
		
	}
}