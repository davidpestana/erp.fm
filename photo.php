<?php


$dir = $argv[1];

$destiny = $argv[2];

$relative = str_replace("/home/projects/erp.furgomania/","",$destiny);

$relative = str_replace("web/","/",$relative);


mkdir($destiny,0755,true);

$d = scandir($dir);

$json = array();

foreach ($d as $entry) {


	if ( (preg_match("/jpg/",$entry)) or (preg_match("/JPG/",$entry)) or (preg_match("/png/",$entry)) or (preg_match("/PNG/",$entry))){

		
		$s1 = "convert {$dir}/{$entry} -resize \"786x524^\" -gravity center -crop 786x524+0+0 {$destiny}/{$entry}";
		$s2 = "convert {$dir}/{$entry} -resize \"930x524^\" -gravity center -crop 930x524+0+0 {$destiny}/T_{$entry}";

		$s3 = "convert {$dir}/{$entry} -resize \"180x120^\" -gravity center -crop 180x120+0+0 {$destiny}/th_{$entry}";


		echo $s1."\n";
		system($s1);	

		echo $s2."\n";
		system($s2);

		echo $s3."\n";
		system($s3);	

		$json[]  = array("th" => $relative."/th_".$entry , "origin" =>$relative."/T_".$entry, "img" => $relative."/T_".$entry );

	} 
	



}
$d->close();

file_put_contents($destiny."/images.json",json_encode($json));
