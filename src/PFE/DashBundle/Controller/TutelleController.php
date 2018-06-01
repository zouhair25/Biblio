<?php

namespace PFE\DashBundle\Controller;

use PFE\DashBundle\Entity\Tutelle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Tutelle controller.
 *
 */
class TutelleController extends Controller
{
    /**
     * Lists all tutelle entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tutelles = $em->getRepository('PFEDashBundle:Tutelle')->findAll();

        return $this->render('tutelle/index.html.twig', array(
            'tutelles' => $tutelles,
        ));
    }

    /**
     * Finds and displays a tutelle entity.
     *
     */
    public function showAction(Tutelle $tutelle)
    {

        return $this->render('tutelle/show.html.twig', array(
            'tutelle' => $tutelle,
        ));
    }
}
