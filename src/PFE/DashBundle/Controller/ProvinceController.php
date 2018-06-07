<?php

namespace PFE\DashBundle\Controller;

use PFE\DashBundle\Entity\Province;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Province controller.
 *
 */
class ProvinceController extends Controller
{
    /**
     * Lists all province entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $provinces = $em->getRepository('PFEDashBundle:Province')->findAll();

        return $this->render('province/index.html.twig', array(
            'provinces' => $provinces,
        ));
    }

    /**
     * Creates a new province entity.
     *
     */
    public function newAction(Request $request)
    {
        $province = new Province();
        $form = $this->createForm('PFE\DashBundle\Form\ProvinceType', $province);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($province);
            $em->flush();
           $request->getSession()
                  ->getFlashbag()
                  ->add('add','Province ajouté');
            return $this->redirectToRoute('province_index', array('id' => $province->getId()));
        }

        return $this->render('province/new.html.twig', array(
            'province' => $province,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a province entity.
     *
     */
    public function showAction(Province $province)
    {
        $deleteForm = $this->createDeleteForm($province);

        return $this->render('province/show.html.twig', array(
            'province' => $province,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing province entity.
     *
     */
    public function editAction(Request $request, Province $province)
    {
        $deleteForm = $this->createDeleteForm($province);
        $editForm = $this->createForm('PFE\DashBundle\Form\ProvinceType', $province);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

          $request->getSession()
                  ->getFlashbag()
                  ->add('edit','Province modifié');
            return $this->redirectToRoute('province_index', array('id' => $province->getId()));
        }

        return $this->render('province/edit.html.twig', array(
            'province' => $province,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a province entity.
     *
     */
    public function deleteAction(Request $request, Province $province)
    {
        $form = $this->createDeleteForm($province);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($province);
            $em->flush();
        }

        return $this->redirectToRoute('province_index');
    }

    /**
     * Creates a form to delete a province entity.
     *
     * @param Province $province The province entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Province $province)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('province_delete', array('id' => $province->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


    public function removeAction(Request $request, $id){

       // $province=new Province();
        $em=$this->getDoctrine()->getManager();
        $province=$em->getRepository('PFEDashBundle:Province')->find($id);
        $em->remove($province);
        $em->flush();

        $request->getSession()
                ->getFlashbag()
                ->add('delete','Province supprimé.');


        return $this->redirectToRoute('province_index');
    }
}
