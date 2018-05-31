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
         
		return $this->render('Tutelle/index.html.twig'
		      ,array(
		/*	'current'=>'tutuelle',
			'y'=>$y, 'm'=>$m*/
		    'entities'=>$entities,
		    ));
	
	}

	public function addAction(){

	}
	public function deleteAction(){
     
	}
	public function createAction(){

	}
	public function showAction(Tutulle $tutulle){
     
	}
	public function createDeleteForm(Tutulle $tutulle){
     
     return $this->createFormBuilder()
            ->setAction($this->generateUrl('pfe_tutelle_delete',array($tutulle->getId())))
            ->setMethod('DELETE')
            ->getForm();
	}
}