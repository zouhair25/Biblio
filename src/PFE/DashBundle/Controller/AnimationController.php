<?php

namespace PFE\DashBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PFE\DashBundle\Entity\Animation;
use PFE\DashBundle\Form\AnimationType;

/**
 * Animation controller.
 *
 */
class AnimationController extends Controller
{

    /**
     * Lists all Animation entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $req = $request->request;

        $y = $req->get('actionyear');
        $m = $req->get('actionmonth');

        $entities = $em->getRepository('PFEDashBundle:Animation')->findByDate($y,$m);

        return $this->render('PFEDashBundle:Animation:index.html.twig', array(
            'currt' => 'Animation',
            'entities' => $entities,
            'm' => $m, 'y' => $y,
        ));
    }
    /**
     * Creates a new Animation entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Animation();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('add', 'Nouvelle Animation ajoutée !');


            return $this->redirect($this->generateUrl('pfe_saisi_animation', array('id' => $entity->getId())));
        }

        return $this->render('PFEDashBundle:Animation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Animation entity.
     *
     * @param Animation $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Animation $entity)
    {
        $form = $this->createForm('PFE\DashBundle\Form\AnimationType', $entity, array(
            'action' => $this->generateUrl('pfe_saisi_animation_create'),
            'method' => 'POST',
        ));

       // $form->add('submit', 'submit', array('label' => '<i class="mdi-av-playlist-add left"></i> Enregistrer'));

        return $form;
    }

    /**
     * Displays a form to create a new Animation entity.
     *
     */
    public function newAction()
    {
        $entity = new Animation();
        $form   = $this->createCreateForm($entity);

        return $this->render('PFEDashBundle:Animation:new.html.twig', array(
            'currt' => 'Animation',
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Animation entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:Animation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Animation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PFEDashBundle:Animation:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Animation entity.
     *
     */
     public function editAction(Request $request,Animation $animation)
    {

        $form=$this->createForm('PFE\DashBundle\Form\AnimationType', $animation);
        $form->handleRequest($request);

        if($form->isValid()&& $form->isSubmitted()){
            $em = $this->getDoctrine()->getManager()->flush();

             $request->getSession()
                ->getFlashBag()
                ->add('edit', 'Informations actualisées !');

            return $this->redirect($this->generateUrl('pfe_saisi_animation_edit', array('id' =>$animation->getId())));
        }

        return $this->render('PFEDashBundle:Animation:edit.html.twig', array(
           // 'entity'      => $entity,
            'edit_form'   => $form->createView()
        ));
    }

    /**
    * Creates a form to edit a Animation entity.
    *
    * @param Animation $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Animation $entity)
    {
        $form = $this->createForm(new AnimationType(), $entity, array(
            'action' => $this->generateUrl('pfe_saisi_animation_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => '<i class="mdi-action-cached left"></i> Mettre à jour'));

        return $form;
    }
    /**
     * Edits an existing Animation entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:Animation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Animation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('update', 'Informations actualisées !');

            return $this->redirect($this->generateUrl('pfe_saisi_animation_edit', array('id' => $id)));
        }

        return $this->render('PFEDashBundle:Animation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Animation entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PFEDashBundle:Animation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Animation entity.');
            }

            $em->remove($entity);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('delete', 'Animation supprimée.');
        }

        return $this->redirect($this->generateUrl('pfe_saisi_animation'));
    }

    /**
     * Creates a form to delete a Animation entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pfe_saisi_animation_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => '<i class="mdi-action-delete left"></i> Supprimer',
                                                        'attr'=>array('class'=>'red')))
            ->getForm()
        ;
    }
}
