<?php

namespace PFE\DashBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ob\HighchartsBundle\Highcharts\Highchart;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
    	//****************  Line chart  ****************//
	    $series = array(
	        array("name" => "Data Serie Name",    "data" => array(1,2,4,5,6,3,8)),
	        array("name" => "Data Serie Name",    "data" => array(2,4,6,8,10,13,18)),
	        array("name" => "Data Serie Name",    "data" => array(21,32,44,55,66,73,88))
	    );

	    $chart1 = new Highchart();
	    $chart1->chart->renderTo('linechart');  // The #id of the div where to render the chart
		$chart1->chart->type('line'); // Column / Line (default)
	    $chart1->title->text('Chart COLUMN/LINE Title');
	    $chart1->xAxis->title(array('text'  => "Horizontal axis title"));
	    $chart1->plotOptions->series(array( 'pointStart' => 3));
		$chart1->yAxis->title(array('text'  => "Vertical axis title"));
		$chart1->series($series);



    	//****************  Pie chart  ****************//
		$chart2 = new Highchart();
		$chart2->chart->renderTo('piechart');
		$chart2->chart->type('pie'); // Column / Line (default)
		$chart2->title->text('Browser market shares January, 2015 to May, 2015');
		$chart2->plotOptions->pie(array(
		    'allowPointSelect'  => true,
		    'cursor'    => 'pointer',
		    //'dataLabels'    => array('enabled' => false),
		    'showInLegend'  => true
		));
		$data = array(
		    array('Firefox', 45.0),
		    array('IE', 26.8),
		    array('Chrome', 12.8),
		    array('Safari', 8.5),
		    array('Opera', 6.2),
		    array('Others', 0.7),
		);
		$chart2->series(array(array(
			//'type' => 'pie',
			'name' => 'Browser share', 
			'data' => $data,
			)));


    	//****************  Bar/Column chart + Stacking Bar/column Chart Option and label  ****************//
		$chart3 = new Highchart();
		$chart3->chart->renderTo('barchart');  // The #id of the div where to render the chart
		$chart3->chart->type('bar'); // bar / area / Column / Line (default)
		$chart3->title->text('Historic World Population by Region');
		//$chart3->subtitle->text('ource: <a href="https://en.wikipedia.org/wiki/World_population">Wikipedia.org</a>');

		$chart3->xAxis->title(array('text'  => "Horizontal axis title"));
    	$chart3->xAxis->categories(array('Africa', 'America', 'Asia', 'Europe', 'Oceania'));

		$chart3->plotOptions->tooltip(array('valueSuffix'=>'millions'));
		$chart3->plotOptions->series(array('stacking'=> 'normal', 'dataLabels'=>array('enabled'=>true)));

		$chart3->yAxis->title(array('text'  => "Population (millions)", 'align' => 'high'));
		$s = array(array(
			'name' => 'Year 1800', 
			'data' => array(107, 31, 635, 203, 2),
			),array(
			'name' => 'Year 1900', 
			'data' => array(133, 156, 947, 408, 6),
			),array(
			'name' => 'Year 2012', 
			'data' => array(1052, 954, 4250, 740, 38),
			));
		$chart3->series($s); 


        return $this->render('PFEDashBundle:Default:index.html.twig', compact('name','chart1','chart2','chart3'));
    }
}
