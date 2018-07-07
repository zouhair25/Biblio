<?php

namespace PFE\DashBundle\Controller;

use Ob\HighchartsBundle\Highcharts\Highchart;
use PFE\DashBundle\Entity\Bibliotheque;
use PFE\DashBundle\Entity\Miseajour;
use PFE\DashBundle\Entity\Province;
use PFE\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BibController extends Controller
{
    public function presentationAction(Bibliotheque $b, Request $request)
    {
        $req = $request->request;

        $y = $req->get('actionyear');
        $m = $req->get('actionmonth');

        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PFEDashBundle:Espace');
        $cplaces = $repository->countplaces($b,$y,$m);

        $repository_adh = $this->getDoctrine()
            ->getManager()
            ->getRepository('PFEDashBundle:Adherent');
        $countadherent = count($repository_adh->findByBibDate($b,$y,$m));

        $repository_f = $this->getDoctrine()
            ->getManager()
            ->getRepository('PFEDashBundle:Fondoc');
        $c1 = $repository_f->count(0,$b,$y,$m);
        $c2 = $repository_f->count(1,$b,$y,$m);
        $countdocfonds = $c1+$c2;

        $repository_r = $this->getDoctrine()
            ->getManager()
            ->getRepository('PFEDashBundle:Remarque');
        $countremarques = count($repository_r->findByBibDate($b,'remarque',$y,$m));
        $countbesoins = count($repository_r->findByBibDate($b,'besoin',$y,$m));

        return $this->render('PFEDashBundle:Bib:presentation.html.twig', array(
            "b" => $b,
            "cplaces" => $cplaces,
            'm' => $m, 'y' => $y,
            'countadherent' => $countadherent,
            'countdocfonds' => $countdocfonds,
            'countremarques' => $countremarques,
            'countbesoins' => $countbesoins,
        ));
    }

    public function espacesAction(Bibliotheque $b, Request $request)
    {
        $req = $request->request;

        $y = $req->get('actionyear');
        $m = $req->get('actionmonth');

        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PFEDashBundle:Espace');

        $espaces = $repository->findByBibDate($b,$y,$m);
        $c1 = $repository->counto('isDisponible',1,$b,$y,$m);
        $c2 = $repository->counto('isDisponible',0,$b,$y,$m);
        $c3 = $repository->counto('etat',1,$b,$y,$m);
        $c4 = $repository->counto('etat',0,$b,$y,$m);
        $cplaces = $repository->countplaces($b,$y,$m);

        $chart1 = new Highchart();
        $chart1->chart->renderTo('piechart1');
        $chart1->chart->type('pie'); // Column / Line (default)
        $chart1->title->text('Disponibilité');
        $chart1->colors('#4CAF50', '#F44336');
        $chart1->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'showInLegend'  => true
        ));
        $data = array(
            array('Disponible', (int)$c1),
            array('Non Disponible', (int)$c2));

        $chart1->series(array(array(
            'name' => 'isDispo',
            'data' => $data)));

        $chart2 = new Highchart();
        $chart2->chart->renderTo('piechart2');
        $chart2->chart->type('pie'); // Column / Line (default)
        $chart2->title->text('etat');
        $chart2->colors('#2196F3', '#607d8b');
        $chart2->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            //'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $data = array(
            array('Bon', (int)$c3,'#607d8b'),
            array('Mediocre', (int)$c4,'#607d8b'),
        );
        $chart2->series(array(array(
            'name' => 'etaaaaa',
            'data' => $data,
        )));

        return $this->render('PFEDashBundle:Bib:espaces.html.twig', array(
            "espaces" => $espaces,
            'chart1' => $chart1,
            'chart2' => $chart2,
            'cplaces' => $cplaces,
            'b' => $b,
            'm' => $m, 'y' => $y,
        ));    }

    public function equipementsAction(Bibliotheque $b, Request $request)
    {
        $req = $request->request;

        $y = $req->get('actionyear');
        $m = $req->get('actionmonth');

        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PFEDashBundle:Equipement');

        $equipements = $repository->getEquipementsByBibliotheque(0,$b,$y,$m);
        $rayonnages = $repository->getEquipementsByBibliotheque(1,$b,$y,$m);
        $c_equ_ndispo = $repository->countetat(0,0,$b,$y,$m);
        $c_equ_dispo = $repository->countetat(0,1,$b,$y,$m);
        $c_ray_ndispo = $repository->countetat(1,0,$b,$y,$m);
        $c_ray_dispo = $repository->countetat(1,1,$b,$y,$m);

        $qb1 = $this->getDoctrine()->getManager();
        $qb1 = $qb1->createQueryBuilder();
        $qb1->select('teq.nom')
            ->from('PFEDashBundle:Typeequipement', 'teq')
            ->where('teq.isRayonnage=:ray')
            ->setParameter(':ray',0)
            ->orderBy('teq.nom','ASC');
        $teq_e = $qb1->getQuery()->getArrayResult();

        $cats_e = array();
        foreach ($teq_e as $item) {
            $cats_e[]=$item['nom'];
        }

        $countcats_e = array();
        foreach ($equipements as $e) {
            $countcats_e['nombre'][] = $e['nombre'];
            $countcats_e['nombre_endommage'][] = $e['nombre_endommage'];
            $countcats_e['nombre_nutilisable'][] = $e['nombre_nutilisable'];
        }

        $qb2 = $this->getDoctrine()->getManager();
        $qb2 = $qb2->createQueryBuilder();
        $qb2->select('teq.nom')
            ->from('PFEDashBundle:Typeequipement', 'teq')
            ->where('teq.isRayonnage=:ray')
            ->setParameter(':ray',1)
            ->orderBy('teq.nom','ASC');
        $teq_r = $qb2->getQuery()->getArrayResult();

        $cats_r = array();
        foreach ($teq_r as $item) {
            $cats_r[]=$item['nom'];
        }

        $countcats_r = array();
        foreach ($rayonnages as $r) {
            $countcats_r['nombre'][] = $r['nombre'];
            $countcats_r['nombre_endommage'][] = $r['nombre_endommage'];
            $countcats_r['nombre_nutilisable'][] = $r['nombre_nutilisable'];
        }

        $chart1 = new Highchart();
        $chart1->chart->renderTo('piechart1');
        $chart1->chart->type('pie'); // Column / Line (default)
        $chart1->title->text('Disponibilités des équipements');
        $chart1->colors('#4CAF50', '#F44336');
        $chart1->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $data = array(
            array('Disponible', (int)$c_equ_dispo),
            array('Non Disponible', (int)$c_equ_ndispo));

        $chart1->series(array(array(
            'name' => 'isDispoooo',
            'data' => $data)));

        $chart3 = new Highchart();
        $chart3->chart->renderTo('barchart1');  // The #id of the div where to render the chart
        $chart3->chart->type('column'); // bar / area / Column / Line (default)
        $chart3->title->text('Historic World Population by Region');


        $chart3->xAxis->categories($cats_e);

        $chart3->colors('#2196F3', '#ff9800', '#616161');

        $chart3->plotOptions->tooltip(array('valueSuffix'=>'millions'));
        $chart3->plotOptions->series(array(
//            'stacking'=> 'normal',
            'dataLabels'=>array('enabled'=>true),
        ));

        $chart3->yAxis->title(array('text'  => " ", 'align' => 'high'));
        $s = array(array(
            'name' => 'Nombre',
            'data' => $countcats_e['nombre'],
        ),array(
            'name' => 'endom',
            'data' => $countcats_e['nombre_endommage'],
        ),array(
            'name' => 'non util',
            'data' => $countcats_e['nombre_nutilisable'],
        ));
        $chart3->series($s);


        $chart2 = new Highchart();
        $chart2->chart->renderTo('piechart2');
        $chart2->chart->type('pie'); // Column / Line (default)
        $chart2->title->text('Disponibilités des équipements');
        $chart2->colors('#4CAF50', '#F44336');
        $chart2->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $data = array(
            array('Disponible', (int)$c_ray_dispo),
            array('Non Disponible', (int)$c_ray_ndispo));

        $chart2->series(array(array(
            'name' => 'isDispoooo',
            'data' => $data)));

        $chart4 = new Highchart();
        $chart4->chart->renderTo('barchart2');  // The #id of the div where to render the chart
        $chart4->chart->type('column'); // bar / area / Column / Line (default)
        $chart4->title->text('Historic World Population by Region');


        $chart4->xAxis->categories($cats_r);

        $chart4->colors('#2196F3', '#ff9800', '#616161');

        $chart4->plotOptions->tooltip(array('valueSuffix'=>'millions'));
        $chart4->plotOptions->series(array(
//            'stacking'=> 'normal',
            'dataLabels'=>array('enabled'=>true),
        ));
        $chart4->yAxis->title(array('text'  => " ", 'align' => 'high'));
        $s = array(array(
            'name' => 'Nombre',
            'data' => @$countcats_r['nombre'],
        ),array(
            'name' => 'endom',
            'data' => @$countcats_r['nombre_endommage'],
        ),array(
            'name' => 'non util',
            'data' => @$countcats_r['nombre_nutilisable'],
        ));
        $chart4->series($s);

        return $this->render('PFEDashBundle:Bib:equipements.html.twig', array(
            "b" => $b,
            "equipements" => $equipements,
            "rayonnages" => $rayonnages,
            "chart1" => $chart1,
            "chart2" => $chart2,
            "chart3" => $chart3,
            "chart4" => $chart4,
            'm' => $m, 'y' => $y,
        ));    }

    public function fondsAction(Bibliotheque $b, Request $request)
    {
        $req = $request->request;

        $y = $req->get('actionyear');
        $m = $req->get('actionmonth');

        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PFEDashBundle:Fondoc');

        $fondocs = $repository->findByBibDate($b,$y,$m);
        $c1 = $repository->count(0,$b,$y,$m);
        $c2 = $repository->count(1,$b,$y,$m);
        $count = $c1+$c2;

        /////////////////////////////////////////////////

        $chart1 = new Highchart();
        $chart1->chart->renderTo('piechart');
        $chart1->chart->type('pie'); // Column / Line (default)
        $chart1->title->text('Fonds documentaires');
        $chart1->colors('#26a69a', '#ec407a', '#5c6bc0', '#29b6f6', '#ef5350');
        $chart1->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $data = array();
        foreach ($fondocs as $fondoc) {
            $data[] = array($fondoc->getTypefondoc()->getNom(),$fondoc->getNombre());
        }

        $chart1->series(array(array(
            'name' => 'Nombre',
            'data' => $data)));

        //****************  Line chart  ****************//
//        $series = array(
//            array("name" => "Data Serie Name",    "data" => array(1,2,4,5,6,3,8,1,2,4,5,6,3,8,1,2,4,5,6,3,8)),
//            array("name" => "Data Serie Name",    "data" => array(2,4,6,8,10,13,18,2,4,6,8,10,13,18,2,4,6,8,10,13,18)),
//            array("name" => "Data Serie Name",    "data" => array(21,32,44,55,66,73,2,4,6,8,10,13,18,2,4,6,21,32,44,55,6)),
//            array("name" => "Data Serie Name",    "data" => array(21,32,44,55,66,73,88,21,32,44,55,66,73,88,21,32,4,5,6,3,8))
//        );
//
//        $chart3 = new Highchart();
//        $chart3->chart->renderTo('linechart');  // The #id of the div where to render the chart
//        $chart3->chart->type('line'); // Column / Line (default)
//        $chart3->title->text('Chart COLUMN/LINE Title');
//        $chart3->xAxis->title(array('text'  => "Horizontal axis title"));
//        $chart3->plotOptions->series(array( 'pointStart' => 3));
//        $chart3->yAxis->title(array('text'  => "Vertical axis title"));
//        $chart3->series($series);

        return $this->render('PFEDashBundle:Bib:fonds.html.twig', array(
            "b" => $b,
            "fondocs" => $fondocs,
            "count"  => $count,
            "chart1" => $chart1,
//            "chart3" => $chart3,
            "colors" => $chart1->colors,
            'm' => $m, 'y' => $y,
        ));    }

    public function cataloguesAction(Bibliotheque $b)
    {
          }

    public function pretsAction(Bibliotheque $b, Request $request)
    {
         }

    public function adherentsAction(Bibliotheque $b, Request $request)
    {
           }

    public function animationsAction(Bibliotheque $b, Request $request)
    {
           }

    public function remarquesAction(Bibliotheque $b, Request $request)
    {
      
        }

    public function menuAction()
    {
       
    }

    public function provinceAction(Province $p)
    {

       
    }

   public function majAction(Request $request)
    {
      
    }
    public function majBibByYear(Bibliotheque $bib, $y)
    {
       
    }

}
