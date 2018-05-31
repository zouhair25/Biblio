<?php

namespace PFE\DashBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PFE\DashBundle\Entity\Internet;
use PFE\DashBundle\Form\InternetType;

/**
 * Internet controller.
 *
 */
class InternetController extends Controller
{

    /**
     * Lists all Internet entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $req = $request->request;

        $y = $req->get('actionyear');
        $m = $req->get('actionmonth');

        $entities = $em->getRepository('PFEDashBundle:Internet')->findByDate($y,$m);

        return $this->render('PFEDashBundle:Internet:index.html.twig', array(
            'currt' => 'Internet',
            'entities' => $entities,
            'm' => $m, 'y' => $y,
        ));
    }
    /**
     * Creates a new Internet entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Internet();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('add', 'Nouvelle Etat pfe_saisi_internet ajoutée !');

            return $this->redirect($this->generateUrl('pfe_saisi_internet', array('id' => $entity->getId())));
        }

        return $this->render('PFEDashBundle:Internet:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Internet entity.
     *
     * @param Internet $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Internet $entity)
    {
        $form = $this->createForm(new InternetType(), $entity, array(
            'action' => $this->generateUrl('pfe_saisi_internet_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => '<i class="mdi-av-playlist-add left"></i> Enregistrer'));

        return $form;
    }

    /**
     * Displays a form to create a new Internet entity.
     *
     */
    public function newAction()
    {
        $entity = new Internet();
        $form   = $this->createCreateForm($entity);

        return $this->render('PFEDashBundle:Internet:new.html.twig', array(
            'currt' => 'Internet',
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Internet entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:Internet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Internet entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PFEDashBundle:Internet:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Internet entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:Internet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Internet entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PFEDashBundle:Internet:edit.html.twig', array(
            'currt' => 'Internet',
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Internet entity.
    *
    * @param Internet $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Internet $entity)
    {
        $form = $this->createForm(new InternetType(), $entity, array(
            'action' => $this->generateUrl('pfe_saisi_internet_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => '<i class="mdi-action-cached left"></i> Mettre à jour'));

        return $form;
    }
    /**
     * Edits an existing Internet entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:Internet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Internet entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('update', 'Informations actualisées !');

            return $this->redirect($this->generateUrl('pfe_saisi_internet_edit', array('id' => $id)));
        }

        return $this->render('PFEDashBundle:Internet:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Internet entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PFEDashBundle:Internet')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Internet entity.');
            }

            $em->remove($entity);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('delete', 'Etat pfe_saisi_internet supprimée.');
        }

        return $this->redirect($this->generateUrl('pfe_saisi_internet'));
    }

    /**
     * Creates a form to delete a Internet entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pfe_saisi_internet_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => '<i class="mdi-action-delete left"></i> Supprimer',
                                                        'attr'=>array('class'=>'red')))
            ->getForm()
        ;
    }
}
