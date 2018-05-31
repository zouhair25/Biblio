<?php

namespace PFE\DashBundle\Controller;

use PFE\DashBundle\Entity\Equipement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PFE\DashBundle\Form\EquipementType;
/**
 * Equipement controller.
 *
 */
class EquipementController extends Controller
{
    /**
     * Lists all equipement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $equipements = $em->getRepository('PFEDashBundle:Equipement')->findByDate($y,$m);

        return $this->render('PFEDashBundle:Equipement:index.html.twig', array(
            'currt' => 'Equipement',
            'entities' => $entities,
            'm' => $m, 'y' => $y,
        ));
    }

    /**
     * Creates a new equipement entity.
     *
     */
    public function newAction(Request $request)
    {
        $equipement = new Equipement();
        $form = $this->createForm('PFE\DashBundle\Form\EquipementType', $equipement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($equipement);
            $em->flush();

            return $this->redirectToRoute('equipement_show', array('id' => $equipement->getId()));
        }

        return $this->render('equipement/new.html.twig', array(
            'equipement' => $equipement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a equipement entity.
     *
     */
    public function showAction(Equipement $equipement)
    {
        $deleteForm = $this->createDeleteForm($equipement);

        return $this->render('equipement/show.html.twig', array(
            'equipement' => $equipement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing equipement entity.
     *
     */
    public function editAction(Request $request, Equipement $equipement)
    {
        $deleteForm = $this->createDeleteForm($equipement);
        $editForm = $this->createForm('PFE\DashBundle\Form\EquipementType', $equipement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('equipement_edit', array('id' => $equipement->getId()));
        }

        return $this->render('equipement/edit.html.twig', array(
            'equipement' => $equipement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a equipement entity.
     *
     */
    public function deleteAction(Request $request, Equipement $equipement)
    {
        $form = $this->createDeleteForm($equipement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($equipement);
            $em->flush();
        }

        return $this->redirectToRoute('equipement_index');
    }

    /**
     * Creates a form to delete a equipement entity.
     *
     * @param Equipement $equipement The equipement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Equipement $equipement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('equipement_delete', array('id' => $equipement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
