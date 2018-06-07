<?php

namespace PFE\DashBundle\Controller;

use PFE\DashBundle\Entity\Bibliotheque;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Bibliotheque controller.
 *
 */
class BibliothequeController extends Controller
{
    /**
     * Lists all bibliotheque entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bibliotheques = $em->getRepository('PFEDashBundle:Bibliotheque')->findAll();

        return $this->render('bibliotheque/index.html.twig', array(
            'bibliotheques' => $bibliotheques,
        ));
    }

    /**
     * Creates a new bibliotheque entity.
     *
     */
    public function newAction(Request $request)
    {
        $bibliotheque = new Bibliotheque();
        $form = $this->createForm('PFE\DashBundle\Form\BibliothequeType', $bibliotheque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bibliotheque);
            $em->flush();

            $request->getSession()
                    ->getFlashbag()
                    ->add('add','Nouvelle bibliothèque ajouté');

            return $this->redirectToRoute('pfe_admin_bibliotheque', array('id' => $bibliotheque->getId()));
        }

        return $this->render('bibliotheque/new.html.twig', array(
            'bibliotheque' => $bibliotheque,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a bibliotheque entity.
     *
     */
    public function showAction(Bibliotheque $bibliotheque)
    {
        $deleteForm = $this->createDeleteForm($bibliotheque);

        return $this->render('bibliotheque/show.html.twig', array(
            'bibliotheque' => $bibliotheque,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing bibliotheque entity.
     *
     */
    public function editAction(Request $request, Bibliotheque $bibliotheque)
    {
        $deleteForm = $this->createDeleteForm($bibliotheque);
        $editForm = $this->createForm('PFE\DashBundle\Form\BibliothequeType', $bibliotheque);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
           
           $request->getSession()
                   ->getFlashbag()
                   ->add('edit','Bibliothèque modifié');
            return $this->redirectToRoute('pfe_admin_bibliotheque_edit', array('id' => $bibliotheque->getId()));
        }

        return $this->render('bibliotheque/edit.html.twig', array(
            'bibliotheque' => $bibliotheque,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a bibliotheque entity.
     *
     */
    public function deleteAction(Request $request, Bibliotheque $bibliotheque)
    {
        $form = $this->createDeleteForm($bibliotheque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bibliotheque);
            $em->flush();
            $request->getSession()
                ->getFlashBag()
                ->add('edit', 'Adhérent modifié.');
        }

        return $this->redirectToRoute('pfe_admin_bibliotheque');
    }

    /**
     * Creates a form to delete a bibliotheque entity.
     *
     * @param Bibliotheque $bibliotheque The bibliotheque entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Bibliotheque $bibliotheque)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pfe_admin_bibliotheque_delete', array('id' => $bibliotheque->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


      public function testAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bibliotheques = $em->getRepository('PFEDashBundle:Bibliotheque')->findAll();

        return $this->render('bibliotheque/test.html.twig', array(
            'bibliotheques' => $bibliotheques,
        ));
    }

    public function removeAction(Request $request,$id){

        $b =new Bibliotheque();
        $em=$this->getDoctrine()->getManager();
        $b=$em->getRepository('PFEDashBundle:Bibliotheque')->find($id);
        $em->remove($b);
        $em->flush();
        $request->getSession()
                ->getFlashBag()
                ->add('delete', 'Bibliothèque supprimé.');

        return $this->redirectToRoute('pfe_admin_bibliotheque');

    }
}
