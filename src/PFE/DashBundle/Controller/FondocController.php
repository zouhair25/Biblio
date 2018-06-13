<?php

namespace PFE\DashBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PFE\DashBundle\Entity\Fondoc;
use PFE\DashBundle\Form\FondocType;

/**
 * Fondoc controller.
 *
 */
class FondocController extends Controller
{

    /**
     * Lists all Fondoc entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $req = $request->request;

        $y = $req->get('actionyear');
        $m = $req->get('actionmonth');

        $entities = $em->getRepository('PFEDashBundle:Fondoc')->findAll();

        return $this->render('Fondoc/index.html.twig', array(
            'currt' => 'Fond documentaire',
            'entities' => $entities,
            'm' => $m, 'y' => $y,
        ));
    }
    /**
     * Creates a new Fondoc entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Fondoc();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('add', 'Nouveaux Documents ajoutés !');

            return $this->redirect($this->generateUrl('pfe_saisi_fondoc', array('id' => $entity->getId())));
        }

        return $this->render('PFEDashBundle:Fondoc:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Fondoc entity.
     *
     * @param Fondoc $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Fondoc $entity)
    {
        $form = $this->createForm(new FondocType(), $entity, array(
            'action' => $this->generateUrl('pfe_saisi_fondoc_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => '<i class="mdi-av-playlist-add left"></i> Enregistrer'));

        return $form;
    }

    /**
     * Displays a form to create a new Fondoc entity.
     *
     */
    public function newAction(Request $request){
        $fondoc=new Fondoc();
        $form=$this->createForm('PFE\DashBundle\Form\FondocType',$fondoc);
        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted()){

            $em=$this->getDoctrine()->getManager();
            $em->persist($fondoc);
            $em->flush();

               $request->getSession()
                    ->getFlashbag()
                    ->add('add','Nouvelle fond documentaire ajouté');

            return $this->redirectToRoute('pfe_saisi_fondoc',array('id'=>$fondoc->getId()));       
        }
        return $this->render('Fondoc/new.html.twig', array(
           // 'currt' => 'Fond documentaire',
            'entity' => $fondoc,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing Fondoc entity.
     *
     */
    public function editAction(Request $request, Fondoc $fondoc){
        $form=$this->createForm('PFE\DashBundle\Form\FondocType',$fondoc);
        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted()){
        $em = $this->getDoctrine()->getManager()->flush();  
            $request->getSession()
                    ->getFlashbag()
                    ->add('edit','Fond documentaire modifié');
        return $this->redirectToRoute('pfe_saisi_fondoc_edit',array('id'=>$fondoc->getId()));            
        }      


        return $this->render('Fondoc/edit.html.twig', array(
            'currt' => 'Fond documentaire',
            'entity'      => $fondoc,
            'edit_form'   => $form->createView(),
        ));
    }

/**
     * Finds and displays a Fondoc entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:Fondoc')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fondoc entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PFEDashBundle:Fondoc:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
    * Creates a form to edit a Fondoc entity.
    *
    * @param Fondoc $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Fondoc $entity)
    {
        $form = $this->createForm(new FondocType(), $entity, array(
            'action' => $this->generateUrl('pfe_saisi_fondoc_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => '<i class="mdi-action-cached left"></i> Mettre à jour'));

        return $form;
    }
    /**
     * Edits an existing Fondoc entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:Fondoc')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fondoc entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('update', 'Informations actualisées !');

            return $this->redirect($this->generateUrl('pfe_saisi_fondoc_edit', array('id' => $id)));
        }

        return $this->render('PFEDashBundle:Fondoc:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Fondoc entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PFEDashBundle:Fondoc')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Fondoc entity.');
            }

            $em->remove($entity);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('delete', 'Documents supprimés.');
        }

        return $this->redirect($this->generateUrl('pfe_saisi_fondoc'));
    }


  public function removeAction(Request $request, $id)
    {
      
        
         $em = $this->getDoctrine()->getManager();
         $entity = $em->getRepository('PFEDashBundle:Fondoc')->find($id);
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Fondoc entity.');
            }

            $em->remove($entity);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('delete', 'Documents supprimés.');
        

        return $this->redirect($this->generateUrl('pfe_saisi_fondoc'));
    }
    /**
     * Creates a form to delete a Fondoc entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pfe_saisi_fondoc_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => '<i class="mdi-action-delete left"></i> Supprimer',
                                                        'attr'=>array('class'=>'red')))
            ->getForm()
        ;
    }
}
