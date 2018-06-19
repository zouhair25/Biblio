<?php

namespace PFE\DashBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PFE\DashBundle\Entity\Equipement;
use PFE\DashBundle\Form\EquipementType;

/**
 * Equipement controller.
 *
 */
class EquipementController extends Controller
{

    /**
     * Lists all Equipement entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $req = $request->request;

        $y = $req->get('actionyear');
        $m = $req->get('actionmonth');

        $entities = $em->getRepository('PFEDashBundle:Equipement')->findByDate($y,$m);

        return $this->render('PFEDashBundle:Equipement:index.html.twig', array(
            'currt' => 'Equipement',
            'entities' => $entities,
            'm' => $m, 'y' => $y,
        ));
    }
    /**
     * Creates a new Equipement entity.
     *
     */
    public function newAction(Request $request)
    {
        $entity = new Equipement();
        $form = $this->createForm('PFE\DashBundle\Form\EquipementType', $entity);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('add', 'Nouvel Equipement ajouté !');


            return $this->redirect($this->generateUrl('pfe_saisi_equipement', array('id' => $entity->getId())));
        }

        return $this->render('PFEDashBundle:Equipement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Equipement entity.
     *
     * @param Equipement $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Equipement $entity)
    {
        $form = $this->createForm('PFE\DashBundle\Form\EquipementType', $entity, array(
            'action' => $this->generateUrl('pfe_saisi_equipement_new'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => '<i class="mdi-av-playlist-add left"></i> Enregistrer'));

        return $form;
    }

    /**
     * Displays a form to create a new Equipement entity.
     *
     */
    public function new1Action()
    {
        $entity = new Equipement();
        $form   = $this->createCreateForm($entity);

        return $this->render('PFEDashBundle:Equipement:new.html.twig', array(
            'currt' => 'Equipement',
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Equipement entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:Equipement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Equipement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PFEDashBundle:Equipement:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Equipement entity.
     *
     */
    public function editAction(Request $request,Equipement $equipement){

        
        $form=$this->createForm('PFE\DashBundle\Form\EquipementType',$equipement);
        $form->handleRequest($request);
        if($form->isValid()&& $form->isSubmitted()){
           $em = $this->getDoctrine()->getManager()->flush(); 

           $request->getSession()
                   ->getFlashBag()
                   ->add('edit','Equipement modifié');
        return $this->redirectToRoute('pfe_saisi_equipement_edit',array('id'=>$equipement->getId()));
        }

        return $this->render('PFEDashBundle:Equipement:edit.html.twig', array(
           
            'edit_form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to edit a Equipement entity.
    *
    * @param Equipement $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Equipement $entity)
    {
        $form = $this->createForm(new EquipementType(), $entity, array(
            'action' => $this->generateUrl('pfe_saisi_equipement_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => '<i class="mdi-action-cached left"></i> Mettre à jour'));

        return $form;
    }
    /**
     * Edits an existing Equipement entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:Equipement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Equipement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('update', 'Informations actualisées !');

            return $this->redirect($this->generateUrl('pfe_saisi_equipement_edit', array('id' => $id)));
        }

        return $this->render('PFEDashBundle:Equipement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Equipement entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PFEDashBundle:Equipement')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Equipement entity.');
            }

            $em->remove($entity);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('delete', 'Equipement supprimé.');
        }

        return $this->redirect($this->generateUrl('pfe_saisi_equipement'));
    }

       public function removeAction(Request $request,$id)
    {
            $e=new Equipement();
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PFEDashBundle:Equipement')->find($id);
            $em->remove($e);
            $em->flush();
            $request->getSession()
                ->getFlashBag()
                ->add('delete', 'Equipement supprimé.');
        

        return $this->redirect($this->generateUrl('pfe_saisi_equipement'));
    }

    /**
     * Creates a form to delete a Equipement entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pfe_saisi_equipement_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => '<i class="mdi-action-delete left"></i> Supprimer',
                                                        'attr'=>array('class'=>'red')))
            ->getForm()
        ;
    }
}
