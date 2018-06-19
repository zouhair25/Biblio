<?php

namespace PFE\DashBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PFE\DashBundle\Entity\Remarque;
use PFE\DashBundle\Form\RemarqueType;

/**
 * Remarque controller.
 *
 */
class RemarqueController extends Controller
{

    /**
     * Lists all Remarque entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $req = $request->request;

        $y = $req->get('actionyear');
        $m = $req->get('actionmonth');

        $entities = $em->getRepository('PFEDashBundle:Remarque')->findByDate($y,$m);

        return $this->render('PFEDashBundle:Remarque:index.html.twig', array(
            'currt' => 'Remarque',
            'entities' => $entities,
            'm' => $m, 'y' => $y,
        ));
    }
    /**
     * Creates a new Remarque entity.
     *
     */
    public function newAction(Request $request)
    {
        $entity = new Remarque();
        $form = $this->createForm('PFE\DashBundle\Form\RemarqueType',$entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('add', 'Nouvelle Remarque ajoutée !');

            return $this->redirect($this->generateUrl('pfe_saisi_remarque', array('id' => $entity->getId())));
        }

        return $this->render('PFEDashBundle:Remarque:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Remarque entity.
     *
     * @param Remarque $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Remarque $entity)
    {
        $form = $this->createForm(new RemarqueType(), $entity, array(
            'action' => $this->generateUrl('pfe_saisi_remarque_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => '<i class="mdi-av-playlist-add left"></i> Enregistrer'));

        return $form;
    }

    /**
     * Displays a form to create a new Remarque entity.
     *
     */
    public function new1Action()
    {
        $entity = new Remarque();
        $form   = $this->createCreateForm($entity);

        return $this->render('PFEDashBundle:Remarque:new.html.twig', array(
            'currt' => 'Remarque',
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Remarque entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:Remarque')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Remarque entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PFEDashBundle:Remarque:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Remarque entity.
     *
     */
    public function editAction(Request $request, Remarque $remarque)
    {

        $form=$this->createForm('PFE\DashBundle\Form\RemarqueType',$remarque);
        $form->handleRequest($request);
        if($form->isValid()&& $form->isSubmitted()){
            $em = $this->getDoctrine()->getManager()->flush();

               $request->getSession()
                ->getFlashBag()
                ->add('edit', 'Informations actualisées !');
        $this->redirectToRoute('pfe_saisi_remarque',array('id'=>$remarque->getId()));
        }

        return $this->render('PFEDashBundle:Remarque:edit.html.twig', array(
          
            'edit_form'   => $form->createView(),

        ));
    }

    /**
    * Creates a form to edit a Remarque entity.
    *
    * @param Remarque $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Remarque $entity)
    {
        $form = $this->createForm(new RemarqueType(), $entity, array(
            'action' => $this->generateUrl('pfe_saisi_remarque_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => '<i class="mdi-action-cached left"></i> Mettre à jour'));

        return $form;
    }
    /**
     * Edits an existing Remarque entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:Remarque')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Remarque entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('update', 'Informations actualisées !');

            return $this->redirect($this->generateUrl('pfe_saisi_remarque_edit', array('id' => $id)));
        }

        return $this->render('PFEDashBundle:Remarque:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Remarque entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PFEDashBundle:Remarque')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Remarque entity.');
            }

            $em->remove($entity);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('delete', 'Remarque supprimée.');
        }

        return $this->redirect($this->generateUrl('pfe_saisi_remarque'));
    }


   public function removeAction(Request $request, $id)
    {
            $r=new Remarque();
            $em = $this->getDoctrine()->getManager();
            $r = $em->getRepository('PFEDashBundle:Remarque')->find($id);
            $em->remove($r);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('delete', 'Remarque supprimée.');
        

        return $this->redirect($this->generateUrl('pfe_saisi_remarque'));
    }

    /**
     * Creates a form to delete a Remarque entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pfe_saisi_remarque_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => '<i class="mdi-action-delete left"></i> Supprimer',
                                                        'attr'=>array('class'=>'red')))
            ->getForm()
        ;
    }
}
