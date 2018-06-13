<?php

namespace PFE\DashBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PFE\DashBundle\Entity\Pret;
use PFE\DashBundle\Form\PretType;

/**
 * Pret controller.
 *
 */
class PretController extends Controller
{

    /**
     * Lists all Pret entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //$req = $request->request;

       //// $y = $req->get('actionyear');
       // $m = $req->get('actionmonth');

        $entities = $em->getRepository('PFEDashBundle:Pret')->findAll();

        return $this->render('PFEDashBundle:Pret:index.html.twig', array(
           // 'currt' => 'Pret',
            'entities' => $entities,
           // 'm' => $m, 'y' => $y,
        ));
    }
    /**
     * Creates a new Pret entity.
     *
     */
    public function newAction(Request $request)
    {
        $entity = new Pret();
        $form = $this->CreateForm('PFE\DashBundle\Form\PretType',$entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('add', 'Nouveau Prêt ajouté !');

            return $this->redirect($this->generateUrl('pfe_saisi_pret', array('id' => $entity->getId())));
        }

        return $this->render('PFEDashBundle:Pret:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Pret entity.
     *
     * @param Pret $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Pret $entity)
    {
        $form = $this->createForm(new PretType(), $entity, array(
            'action' => $this->generateUrl('pfe_saisi_pret_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => '<i class="mdi-av-playlist-add left"></i> Enregistrer'));

        return $form;
    }

    /**
     * Displays a form to create a new Pret entity.
     *
     */
    public function new1Action()
    {
        $entity = new Pret();
        $form   = $this->createCreateForm($entity);

        return $this->render('PFEDashBundle:Pret:new.html.twig', array(
            'currt' => 'Pret',
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Pret entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:Pret')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pret entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PFEDashBundle:Pret:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Pret entity.
     *
     */
    public function editAction(Request $request,Pret $pret )
    {
        
        $form=$this->createForm('PFE\DashBundle\Form\PretType',$pret);
        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()){
             $em = $this->getDoctrine()->getManager()->flush();


             $request->getSession()
                ->getFlashbag()
                ->add('add','Type prêts modifié');
    
        return $this->redirectToRoute('pfe_saisi_pret_edit',array('id'=>$pret->getId()));     
        }

        return $this->render('PFEDashBundle:Pret:edit.html.twig', array(
            'edit_form'   => $form->createView()));
         
    }

    /**
    * Creates a form to edit a Pret entity.
    *
    * @param Pret $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pret $entity)
    {
        $form = $this->createForm(new PretType(), $entity, array(
            'action' => $this->generateUrl('pfe_saisi_pret_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => '<i class="mdi-action-cached left"></i> Mettre à jour'));

        return $form;
    }
    /**
     * Edits an existing Pret entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:Pret')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pret entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('update', 'Informations actualisées !');

            return $this->redirect($this->generateUrl('pfe_saisi_pret_edit', array('id' => $id)));
        }

        return $this->render('PFEDashBundle:Pret:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Pret entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PFEDashBundle:Pret')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pret entity.');
            }

            $em->remove($entity);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('delete', 'Prêt supprimé.');
        }

        return $this->redirect($this->generateUrl('pfe_saisi_pret'));
    }

    /**
     * Creates a form to delete a Pret entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pfe_saisi_pret_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => '<i class="mdi-action-delete left"></i> Supprimer',
                                                        'attr'=>array('class'=>'red')))
            ->getForm()
        ;
    }

      public function removeAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PFEDashBundle:Pret')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pret entity.');
            }

            $em->remove($entity);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('delete', 'Prêt supprimé.');
        }

        return $this->redirect($this->generateUrl('pfe_saisi_pret'));
    }
}
