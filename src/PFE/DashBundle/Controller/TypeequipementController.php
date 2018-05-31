<?php

namespace PFE\DashBundle\Controller;

use PFE\DashBundle\Entity\Typeequipement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Typeequipement controller.
 *
 */
class TypeequipementController extends Controller
{
    /**
     * Lists all typeequipement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $typeequipements = $em->getRepository('PFEDashBundle:Typeequipement')->findAll();

        return $this->render('typeequipement/index.html.twig', array(
            'typeequipements' => $typeequipements,
        ));
    }

    /**
     * Creates a new typeequipement entity.
     *
     */
    public function newAction(Request $request)
    {
        $typeequipement = new Typeequipement();
        $form = $this->createForm('PFE\DashBundle\Form\TypeequipementType', $typeequipement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeequipement);
            $em->flush();

            return $this->redirectToRoute('typeequipement_show', array('id' => $typeequipement->getId()));
        }

        return $this->render('typeequipement/new.html.twig', array(
            'typeequipement' => $typeequipement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a typeequipement entity.
     *
     */
    public function showAction(Typeequipement $typeequipement)
    {
        $deleteForm = $this->createDeleteForm($typeequipement);

        return $this->render('typeequipement/show.html.twig', array(
            'typeequipement' => $typeequipement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing typeequipement entity.
     *
     */
    public function editAction(Request $request, Typeequipement $typeequipement)
    {
        $deleteForm = $this->createDeleteForm($typeequipement);
        $editForm = $this->createForm('PFE\DashBundle\Form\TypeequipementType', $typeequipement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('typeequipement_edit', array('id' => $typeequipement->getId()));
        }

        return $this->render('typeequipement/edit.html.twig', array(
            'typeequipement' => $typeequipement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a typeequipement entity.
     *
     */
    public function deleteAction(Request $request, Typeequipement $typeequipement)
    {
        $form = $this->createDeleteForm($typeequipement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typeequipement);
            $em->flush();
        }

        return $this->redirectToRoute('typeequipement_index');
    }

    /**
     * Creates a form to delete a typeequipement entity.
     *
     * @param Typeequipement $typeequipement The typeequipement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Typeequipement $typeequipement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('typeequipement_delete', array('id' => $typeequipement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
