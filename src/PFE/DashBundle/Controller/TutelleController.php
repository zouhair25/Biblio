<?php

namespace PFE\DashBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PFE\DashBundle\Entity\Tutelle;
class TutelleController extends Controller{

	/*
	* liste des entities tutelle
	*/
	public function indexAction(Request $request){
       
         $tutelle =new Tutelle();
        //$deleteForm=$this->createDeleteForm($tutelle);
		$em =$this->getDoctrine()->getManager();
		/*$req=$request->request;
		$y=$req->get('actionyear');
		$m=$req->get('actionmonth');*/

		$entities=$em->getRepository('PFEDashBundle:Tutelle')->findAll();
         
		return $this->render('tutelle/index.html.twig'
		      ,array(
		/*	'current'=>'tutelle',
			'y'=>$y, 'm'=>$m*/
		    'entities'=>$entities,
		   // 'deleteform'=>$deleteform->createView()
		    ));
	
	}

	public function newAction(Request $request){
      
      $tutelle= new Tutelle();
      $form=$this->createForm('PFE\DashBundle\Form\TutelleType',$tutelle);

      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){
      	$em=$this->getDoctrine()->getManager();
      	$em->persist($tutelle);
      	$em->flush();
       
       return $this->redirectToRoute('pfe_tutelle_show',array('id'=>$tutelle->getId()));
      }

      return $this->render('tutelle/new.html.twig',array(
      	'tutelle'=>$tutelle,
      	'form'=>$form->createView()));
	}
	public function deleteAction(Request $request,Tutelle $tutelle){
     
     $form=$this->createDeleteForm($tutelle);
     $form->handleRequest($request);
     if ($form->isSubmitted() && $form->isValid()) {
     	$em=$this->getDoctrine()->getManager();
     	$em->remove($tutelle);
     	$em->flush();
     }
    return $this->redirectToRoute('pfe_tutelle_index');
	}
	public function editAction(Request $request,Tutelle $tutelle){

    $deleteForm=$this->createDeleteForm($tutelle);
    $editForm=$this->createForm('PFE\DashBundle\Form\TutelleType',$tutelle);
    $editForm->handleRequest($request);
    if($editForm->isValid() && $editForm->isSubmitted()){
    	$this->getDoctrine()->getManager()->flush();
       
       return $this->redirectToRoute('pfe_tutelle_edit',array('id'=>$tutelle->getId()));
    }
    return $this->render('tutelle/edit.html.twig',array(
    	'deleteForm'=>$deleteForm->createView(),
        'editForm'=>$editForm->createView(),
        'tutelle'=>$tutelle));
	}

	public function showAction(Tutelle $entity){
     
     return $this->render('tutelle/show.html.twig', array('entity'=>$entity->getId()));
	}

	private function createDeleteForm(Tutelle $tutelle){
     
     return $this->createFormBuilder()
            ->setAction($this->generateUrl('pfe_tutelle_delete',array('id'=>$tutelle->getId())))
            ->setMethod('DELETE')
            ->getForm();
	}

	public function  removeAction(Request $request, $id){

		$tutelle =new Tutelle();
		$em=$this->getDoctrine()->getManager();
		$tutelle=$em->getRepository('PFEDashBundle:Tutelle')->find($id);
		$em->remove($tutelle);
		$em->flush();
		return $this->redirectToRoute('pfe_tutelle_index');
	}
}