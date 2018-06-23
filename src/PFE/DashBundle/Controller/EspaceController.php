<?php

namespace PFE\DashBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PFE\DashBundle\Entity\Espace;
use PFE\DashBundle\Form\EspaceType;

/**
 * Espace controller.
 *
 */
class EspaceController extends Controller
{

    /**
     * Lists all Espace entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $req = $request->request;

        $y = $req->get('actionyear');
        $m = $req->get('actionmonth');

        $entities = $em->getRepository('PFEDashBundle:Espace')->findByDate($y,$m);

        return $this->render('PFEDashBundle:espace:index.html.twig', array(
            'currt' => 'Espace',
            'entities' => $entities,
            'm' => $m, 'y' => $y,
        ));
    }
    /**
     * Creates a new Espace entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Espace();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('add', 'Nouvel Espace ajouté !');

            return $this->redirect($this->generateUrl('pfe_saisi_espace', array('id' => $entity->getId())));
        }

        return $this->render('PFEDashBundle:Espace:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Espace entity.
     *
     * @param Espace $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Espace $entity)
    {
        $form = $this->createForm('PFE\DashBundle\Form\EspaceType', $entity, array(
            'action' => $this->generateUrl('pfe_saisi_espace_create'),
            'method' => 'POST',
        ));

        //$form->add('submit', 'submit', array('label' => '<i class="mdi-av-playlist-add left"></i> Enregistrer'));

        return $form;
    }

    /**
     * Displays a form to create a new Espace entity.
     *
     */
    public function newAction()
    {
        $entity = new Espace();
        $form   = $this->createCreateForm($entity);

        return $this->render('PFEDashBundle:Espace:new.html.twig', array(
            'currt' => 'Espace',
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Espace entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:Espace')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Espace entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PFEDashBundle:Espace:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Espace entity.
     *
     */
    public function editAction(Request $request, Espace $espace){

    $edit_form=$this->createForm('PFE\DashBundle\Form\EspaceType',$espace);
    $edit_form->handleRequest($request);

    if($edit_form->isSubmitted() && $edit_form->isValid()){
        $em=$this->getDoctrine()->getManager()->flush();

            $request->getSession()
                ->getFlashbag()
                ->add('edit','Espace modifié');
    
        return $this->redirectToRoute('pfe_saisi_espace_edit',array('id'=>$espace->getId()));        
    }

       return $this->render('PFEDashBundle:espace:edit.html.twig', array(
          'edit_form'=>$edit_form->createView(),
          'espace'=>$espace
       ));
    }

    /**
    * Creates a form to edit a Espace entity.
    *
    * @param Espace $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Espace $entity)
    {
        $form = $this->createForm(new EspaceType(), $entity, array(
            'action' => $this->generateUrl('pfe_saisi_espace_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => '<i class="mdi-action-cached left"></i> Mettre à jour'));

        return $form;
    }
 
    /**
     * Deletes a Espace entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PFEDashBundle:Espace')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Espace entity.');
            }

            $em->remove($entity);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('delete', 'Espace supprimé.');
        }

        return $this->redirect($this->generateUrl('pfe_saisi_espace'));
    }

    /**
     * Creates a form to delete a Espace entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pfe_saisi_espace_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => '<i class="mdi-action-delete left"></i> Supprimer',
                                                        'attr'=>array('class'=>'red')))
            ->getForm()
        ;
    }

        public function removeAction(Request $request, $id)
    {
        
        $em = $this->getDoctrine()->getManager();
        $espace=$em->getRepository('PFEDashBundle:Espace')->find($id);

            if (!$espace) {
                throw $this->createNotFoundException('Unable to find Espace entity.');
            }

            $em->remove($espace);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('delete', 'Espace supprimé.');
        

        return $this->redirect($this->generateUrl('pfe_saisi_espace'));
    }
}
