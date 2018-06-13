<?php

namespace PFE\DashBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PFE\DashBundle\Entity\Typepret;

 class TypepretController extends Controller{

	public function indexAction(){

		$em=$this->getDoctrine()->getManager();
		$typepret=$em->getRepository('PFEDashBundle:Typepret')->findAll();

		return $this->render('typepret/index.html.twig',array('typepret'=>$typepret));
	}

	public function editAction(Request $request, Typepret $typepret){

    $editForm=$this->createForm('PFE\DashBundle\Form\TypepretType',$typepret);
    $editForm->handleRequest($request);

    if($editForm->isSubmitted() && $editForm->isValid()){
    	$em=$this->getDoctrine()->getManager()->flush();

    		$request->getSession()
    	        ->getFlashbag()
    	        ->add('add','Type espace modifié');
    
    	return $this->redirectToRoute('typepret_edit',array('id'=>$typepret->getId()));        
    }

       return $this->render('typepret/edit.html.twig', array(
          'editForm'=>$editForm->createView(),
          'typepret'=>$typepret
       ));
	}

    public function newAction(Request $request){
    
    $typepret=new Typepret();
    $form=$this->createForm('PFE\DashBundle\Form\TypepretType',$typepret);
    $form->handleRequest($request);

    if($form->isSubmitted()&& $form->isValid()){
    	$em=$this->getDoctrine()->getManager();
    	$em->persist($typepret);
    	$em->flush();

    	$request->getSession()
    	        ->getFlashbag()
    	        ->add('add','Type prêt ajouté');

    	return $this->redirectToRoute('typepret_index',array('typepret'=>$typepret->getId()));        
    }

       return $this->render('typepret/new.html.twig', array(
          'form'=>$form->createView(),
          'typepret'=>$typepret
       ));
	}
	public function removeAction(Request $request,$id){
		
		$em=$this->getDoctrine()->getManager();
		$typepret=$em->getRepository('PFEDashBundle:Typepret')->find($id);
		$em->remove($typepret);
    $em->flush();
		$request->getSession()
		->getFlashbag()
		->add('delete','type prêt supprimé');

		return $this->redirectToRoute('typepret_index');
	}

	public function showAction(Request $request){
		
	}
}