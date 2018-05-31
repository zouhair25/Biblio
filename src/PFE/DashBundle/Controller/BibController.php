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
        $chart1->title->text('isDispo');
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
            'name' => 'isDispoooo',
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
        return $this->render('PFEDashBundle:Bib:catalogues.html.twig', array(
            "b" => $b,

        ));    }

    public function pretsAction(Bibliotheque $b, Request $request)
    {
        $req = $request->request;

        $y = $req->get('actionyear');
        $m = $req->get('actionmonth');

        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PFEDashBundle:Pret');

        $prets = $repository->getPretByBibliotheque($b, $y, $m);
        $countdocs = $repository->countdocs($b,'','', $y, $m);
        $countdocs_interne = $repository->countdocs($b,'interne','', $y, $m);
        $countdocs_externe = $repository->countdocs($b,'externe','', $y, $m);

        $countprets = $repository->countdocs($b,'','pret', $y, $m);
        $countprets_interne  = $repository->countdocs($b,'interne','pret', $y, $m);
        $countprets_externe  = $repository->countdocs($b,'externe','pret', $y, $m);

        $chart1 = new Highchart();
        $chart1->chart->renderTo('piechart1');
        $chart1->chart->type('pie'); // Column / Line (default)
        $chart1->title->text('Count Docs');
        $chart1->colors('#5c6bc0', '#42A5F5');
        $chart1->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $data = array(
            array('docs pretés interne', (int)$countdocs_interne),
            array('docs pretés externe', (int)$countdocs_externe));

        $chart1->series(array(array(
            'name' => 'type de pret',
            'data' => $data)));

        $chart2 = new Highchart();
        $chart2->chart->renderTo('piechart2');
        $chart2->chart->type('pie'); // Column / Line (default)
        $chart2->title->text('Count Prets');
        $chart2->colors('#5c6bc0', '#42A5F5');
        $chart2->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $data = array(
            array('prets interne', (int)$countprets_interne),
            array('prets externe', (int)$countprets_externe),
        );
        $chart2->series(array(array(
            'name' => 'nombre de prets',
            'data' => $data,
        )));

        return $this->render('PFEDashBundle:Bib:prets.html.twig', array(
            "b" => $b,
            "prets" => $prets,
            "countdocs" => $countdocs,
            "countprets" => $countprets,
            "chart1" => $chart1,
            "chart2" => $chart2,
            "countdocs_interne" => $countdocs_interne,
            "countdocs_externe" => $countdocs_externe,
            "countprets_interne" => $countprets_interne,
            "countprets_externe" => $countprets_externe,
            'm' => $m, 'y' => $y,
        ));    }

    public function adherentsAction(Bibliotheque $b, Request $request)
    {
        $req = $request->request;

        $y = $req->get('actionyear');
        $m = $req->get('actionmonth');

        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PFEDashBundle:Adherent');

        $adherents = $repository->findByBibDate($b,$y,$m);
        $count = count($adherents);

        $count_sexe_m = $repository->counbysexe(1,$b,$y,$m);
        $count_sexe_f = $repository->counbysexe(0,$b,$y,$m);
        $count_petits=0;
        $count_moyens=0;
        $count_grands=0;


        foreach ($adherents as $adherent) {
            if($adherent->getAge()<=12) { $count_petits+=1;}
            if($adherent->getAge()>12 and $adherent->getAge()<=18) { $count_moyens+=1;}
            if($adherent->getAge()>18) { $count_grands+=1;}
        }

        $chart1 = new Highchart();
        $chart1->chart->renderTo('piechart1');
        $chart1->chart->type('pie'); // Column / Line (default)
        $chart1->title->text('Sexe');
        $chart1->colors('#66bb6a', '#ec407a');
        $chart1->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'showInLegend'  => true
        ));
        $data = array(
            array('Masculin : '.$count_sexe_m, (int)$count_sexe_m),
            array('Feminin : '.$count_sexe_f, (int)$count_sexe_f));

        $chart1->series(array(array(
            'name' => 'Sexe',
            'data' => $data)));

        $chart2 = new Highchart();
        $chart2->chart->renderTo('piechart2');
        $chart2->chart->type('pie'); // Column / Line (default)
        $chart2->title->text('Age');
        $chart2->colors('#ff7043', '#26a69a','#5c6bc0');
        $chart2->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            //'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $data = array(
            array('petits : '.$count_petits, $count_petits),
            array('moyens : '.$count_moyens, $count_moyens),
            array('grands : '.$count_grands, $count_grands),
        );
        $chart2->series(array(array(
            'name' => 'Age',
            'data' => $data,
        )));

        return $this->render('PFEDashBundle:Bib:adherents.html.twig', array(
            "b" => $b,
            "count" => $count,
            "adherents" => $adherents,
            "chart1" => $chart1,
            "chart2" => $chart2,
            'm' => $m, 'y' => $y,
        ));    }

    public function animationsAction(Bibliotheque $b, Request $request)
    {
        $req = $request->request;

        $y = $req->get('actionyear');
        $m = $req->get('actionmonth');

        $repository_type = $this->getDoctrine()
            ->getManager()
            ->getRepository('PFEDashBundle:Typeanimation');
        $types = $repository_type->findAll();

        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PFEDashBundle:Animation');

        $animations = array();
        $countAs = 0;
        $countPVs = array();
        $countPTs = array();
        foreach ($types as $type) {
            $as = $repository->findByBibDate($b, $type, $y, $m);
            $countAs = $countAs + (int)count($as);
            $animations[] = $as;
            $countPVs[] = $repository->sumPublic($type,$b,'publicvise', $y, $m);
            $countPTs[] = $repository->sumPublic($type,$b,'publicTotal', $y, $m);
        }

        $sumPVs = array_sum($countPVs);
        $sumPTs = array_sum($countPTs);

        return $this->render('PFEDashBundle:Bib:animations.html.twig', array(
            "b" => $b,
            "types" => $types,
            "animations" => $animations,
            "countPTs" => $countPTs,
            "countPVs" => $countPVs,
            "sumPVs" => $sumPVs,
            "sumPTs" => $sumPTs,
            "countAs" => $countAs,
            'm' => $m, 'y' => $y,
        ));    }

    public function remarquesAction(Bibliotheque $b, Request $request)
    {
        $req = $request->request;

        $y = $req->get('actionyear');
        $m = $req->get('actionmonth');

        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PFEDashBundle:Remarque');

        $remarques = $repository->findByBibDate($b,'remarque',$y,$m);
        $besoins = $repository->findByBibDate($b,'besoin',$y,$m);
        return $this->render('PFEDashBundle:Bib:remarques.html.twig', array(
            "b" => $b,
            "remarques" => $remarques,
            "besoins" => $besoins,
            'm' => $m, 'y' => $y,
        ));    }

    public function menuAction()
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PFEDashBundle:Province');

        $provinces = $repository->findAll();

        return $this->render('PFEDashBundle:Bib:menu.html.twig', array(
            "provinces" => $provinces
        ));
    }

    public function provinceAction(Province $p)
    {
        return $this->render('PFEDashBundle:Bib:province.html.twig', array("p" => $p));
    }

    public function majAction(Request $request)
    {
        $repo  = $this->getDoctrine()
            ->getManager()
            ->getRepository('PFEDashBundle:Bibliotheque');

        if($this->get('security.authorization_checker')->isGranted('ROLE_RESPONSABLE')){
            $u = $this->getDoctrine()
                ->getManager()
                ->getRepository('PFEUserBundle:User')
                ->findOneBy(array('username'=>$this->get('security.token_storage')->getToken()->getUser()->getUsername()));
            $bibs = $repo->findWithMajRespo($u);
        }

        if(
            $this->get('security.authorization_checker')->isGranted('ROLE_ADMINISTRATEUR') ||
            $this->get('security.authorization_checker')->isGranted('ROLE_DIRECTEUR')
        ){
            $bibs = $repo->findWithMaj();
        }



        if($request->isMethod('POST') /*&& $request->request->get('generatetable') */)
        {
            $y = $request->request->get('actionyear');
            $bibid = $request->request->get('bibid');
            if(is_null($bibid))
            {
                foreach ($bibs as $bib) {
                    $this->majBibByYear($bib,$y);
                }
            }
            else
            {
                $bib = $repo->find($bibid);
                //$this->majBibByYear($bib,$y);
            }
        }

        return $this->render('PFEDashBundle:Bib:maj.html.twig', array(
            "bibs" => $bibs
    ));
    }

    public function majBibByYear(Bibliotheque $bib, $y)
    {
        for($i=1;$i<=12;$i++)
        {
            $miseajour = new Miseajour();
            $miseajour->setY($y);
            $miseajour->setM($i);
            $miseajour->setEtat(1);
            $miseajour->setBibliotheque($bib);
            //$em = $this->getDoctrine()->getEntityManager('distant');
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($miseajour);
            $em->flush();
        }
    }

}
