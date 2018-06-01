<?php

namespace PFE\DashBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PFE\DashBundle\Entity\Tutelle;
class TutelleController extends Controller{

	/*
	* liste des entities tutulle
	*/
	public function indexAction(Request $request){

		$em =$this->getDoctrine()->getManager();
		/*$req=$request->request;
		$y=$req->get('actionyear');
		$m=$req->get('actionmonth');*/

		$entities=$em->getRepository('PFEDashBundle:Tutelle')->findAll();
         
		return $this->render('tutelle/index.html.twig'
		      ,array(
		/*	'current'=>'tutuelle',
			'y'=>$y, 'm'=>$m*/
		    'entities'=>$entities,
		    ));
	
	}

	public function newAction(Request $request){
      
      $tutelle= new Tutulle();
      $form=$this->createForm('PFE\DashBundle\Form\TutelleType',$tutulle);

      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){
      	$em=$this->getDoctrine()->getManager();
      	$em->persist($tutelle);
      	$em->flush();
       
       return $this->redirectToRoute('pfe_tutelle_show',array('id'=>$tutelle->getId()));
      }

      return $this->render('tutelle/new.html/twig',array('tutelle'=>$tutelle,'form'=>$this->createView()));
	}
	public function deleteAction(){
     
	}
	public function createAction(){

	}
	public function showAction(Tutulle $tutulle){
     
	}
	public function createDeleteForm(Tutelle $tutelle){
     
     return $this->createFormBuilder()
            ->setAction($this->generateUrl('pfe_tutelle_delete',array($tutelle->getId())))
            ->setMethod('DELETE')
            ->getForm();
	}
}