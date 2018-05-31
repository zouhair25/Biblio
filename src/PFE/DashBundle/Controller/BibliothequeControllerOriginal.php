<?php

namespace PFE\DashBundle\Controller;
// php bin/console cache:clear
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PFE\DashBundle\Entity\Bibliotheque;
use PFE\DashBundle\Form\BibliothequeType;

/**
 * Bibliotheque controller.
 *
 */
class BibliothequeController extends Controller
{

    /**
     * Lists all Bibliotheque entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PFEDashBundle:Bibliotheque')->findAll();

        return $this->render('PFEDashBundle:Bibliotheque:index.html.twig', array(
            'currt' => 'Bibliotheque',
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Bibliotheque entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Bibliotheque();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('add', 'Nouvelle Bibliothéque ajoutée !');


            return $this->redirect($this->generateUrl('pfe_admin_bibliotheque', array('id' => $entity->getId())));
        }

        return $this->render('PFEDashBundle:Bibliotheque:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Bibliotheque entity.
     *
     * @param Bibliotheque $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Bibliotheque $entity)
    {
        $form = $this->createForm(new BibliothequeType(), $entity, array(
            'action' => $this->generateUrl('pfe_admin_bibliotheque_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => '<i class="mdi-av-playlist-add left"></i> Enregistrer'));

        return $form;
    }

    /**
     * Displays a form to create a new Bibliotheque entity.
     *
     */
    public function newAction()
    {
        $entity = new Bibliotheque();
        $form   = $this->createCreateForm($entity);

        return $this->render('PFEDashBundle:Bibliotheque:new.html.twig', array(
            'currt' => 'Bibliotheque',
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Bibliotheque entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:Bibliotheque')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bibliotheque entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PFEDashBundle:Bibliotheque:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Bibliotheque entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:Bibliotheque')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bibliotheque entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PFEDashBundle:Bibliotheque:edit.html.twig', array(
            'currt' => 'Bibliotheque',
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Bibliotheque entity.
    *
    * @param Bibliotheque $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Bibliotheque $entity)
    {
        $form = $this->createForm(new BibliothequeType(), $entity, array(
            'action' => $this->generateUrl('pfe_admin_bibliotheque_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => '<i class="mdi-action-cached left"></i> Mettre à jour'));

        return $form;
    }
    /**
     * Edits an existing Bibliotheque entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:Bibliotheque')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bibliotheque entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('update', 'Informations actualisées !');

            return $this->redirect($this->generateUrl('pfe_admin_bibliotheque_edit', array('id' => $id)));
        }

        return $this->render('PFEDashBundle:Bibliotheque:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Bibliotheque entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PFEDashBundle:Bibliotheque')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Bibliotheque entity.');
            }

            $em->remove($entity);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('delete', 'Bibliothéque supprimée.');
        }

        return $this->redirect($this->generateUrl('pfe_admin_bibliotheque'));
    }

    /**
     * Creates a form to delete a Bibliotheque entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pfe_admin_bibliotheque_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => '<i class="mdi-action-delete left"></i> Supprimer',
                                                        'attr'=>array('class'=>'red')))
            ->getForm()
        ;
    }
}
