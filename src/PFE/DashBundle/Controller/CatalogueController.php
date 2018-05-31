<?php

namespace PFE\DashBundle\Controller;

use PFE\DashBundle\Entity\Catalogue;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Catalogue controller.
 *
 */
class CatalogueController extends Controller
{
    /**
     * Lists all catalogue entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $catalogues = $em->getRepository('PFEDashBundle:Catalogue')->findAll();

        return $this->render('catalogue/index.html.twig', array(
            'catalogues' => $catalogues,
        ));
    }

    /**
     * Creates a new catalogue entity.
     *
     */
    public function newAction(Request $request)
    {
        $catalogue = new Catalogue();
        $form = $this->createForm('PFE\DashBundle\Form\CatalogueType', $catalogue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($catalogue);
            $em->flush();

            return $this->redirectToRoute('catalogue_show', array('id' => $catalogue->getId()));
        }

        return $this->render('catalogue/new.html.twig', array(
            'catalogue' => $catalogue,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a catalogue entity.
     *
     */
    public function showAction(Catalogue $catalogue)
    {
        $deleteForm = $this->createDeleteForm($catalogue);

        return $this->render('catalogue/show.html.twig', array(
            'catalogue' => $catalogue,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing catalogue entity.
     *
     */
    public function editAction(Request $request, Catalogue $catalogue)
    {
        $deleteForm = $this->createDeleteForm($catalogue);
        $editForm = $this->createForm('PFE\DashBundle\Form\CatalogueType', $catalogue);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('catalogue_edit', array('id' => $catalogue->getId()));
        }

        return $this->render('catalogue/edit.html.twig', array(
            'catalogue' => $catalogue,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a catalogue entity.
     *
     */
    public function deleteAction(Request $request, Catalogue $catalogue)
    {
        $form = $this->createDeleteForm($catalogue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($catalogue);
            $em->flush();
        }

        return $this->redirectToRoute('catalogue_index');
    }

    /**
     * Creates a form to delete a catalogue entity.
     *
     * @param Catalogue $catalogue The catalogue entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Catalogue $catalogue)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('catalogue_delete', array('id' => $catalogue->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
