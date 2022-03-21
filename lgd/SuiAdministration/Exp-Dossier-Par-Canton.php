<?php
/**
 * Created by PhpStorm.
 * User: mdesousa
 * Date: 12/12/date('Y','2017-01-01')
 * Time: 09:31
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Include PHPExcel */
require_once '../../app/database.php';
require_once '../../inc/connection.php';
require_once '../../inc/functions.php';
require_once '../../app/PHPExcel.php';
$db = new database($db_name, $db_user, $db_pass, $db_host);
$lignes = 2;

// Création d'un nouvelle objet PHPexcel
$classeur = new PHPExcel;



//definition de la feuille

$feuille = $classeur->getActiveSheet();

$feuille->setTitle('Extraction Dossier par Canton');

//
//Entete tableau et mise en forme
//

//Entete tableau donnée
$feuille->setCellValue('A1','Numero');
$feuille->setCellValue('B1','Commune');
$feuille->setCellValue('C1','Canton');
$feuille->setCellValue('D1','Mission');
$feuille->setCellValue('E1','Prestation');
$feuille->setCellValue('F1','Type Facturation');


//Largeur des colonnes
$feuille->getColumnDimension('A')->setWidth(10);
$feuille->getColumnDimension('B')->setWidth(38);
$feuille->getColumnDimension('C')->setWidth(25);
$feuille->getColumnDimension('D')->setWidth(8);
$feuille->getColumnDimension('E')->setWidth(25);
$feuille->getColumnDimension('F')->setWidth(25);

//Allignement cellule

$feuille->getStyle('A1:F1')->getAlignment()->setHorizontal('center');

$feuille->getStyle('A1:F1')->getAlignment()->setVertical('center');


//style cellule bordure

$feuille->getStyle('A1:F1')->applyFromArray(
    array(
        'font' => array(
            'bold' => false,
            'name' => 'Calibri',
            'size' => 12,
        ),
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
            )
        ),
    )
);


//
//Remplissage données tableau et mise en forme
//


$req = $db->query('SELECT * FROM dossier');
foreach ($req as $datas){
    $datas2 = $db->queryOne("SELECT * FROM commune WHERE nom = '".$datas->commune."'");
    /*
    echo "<pre>".print_r($datas2,true)."</pre>";

    echo '<br>'.$datas->numero." - ".$canton.' - '.$datas->commune;
    */
    $canton = $datas2->canton;
    $progbesoin = date('Y',strtotime($datas->ad_progbesoin_envoi));
    $consultmoe = date('Y',strtotime($datas->ad_consultmoe_marche));
    $dce = date('Y',strtotime($datas->ad_moe_dce_envoi));
    $mtrvx = date('Y',strtotime($datas->ad_mtrvx_envoi));
    $pi = date('Y',strtotime($datas->ad_pi_envoi));


    if($datas->d1_facture != "" && $datas->d1_mission != ""){
        if($datas->d1_facture == "Cotisation" && $pi == 2017 ){
            $feuille->setCellValue('A'.$lignes,$datas->numero);
            $feuille->setCellValue('B'.$lignes,$datas->commune);
            $feuille->setCellValue('C'.$lignes,$canton);
            $feuille->setCellValue('D'.$lignes,$datas->d1_mission);
            $feuille->setCellValue('E'.$lignes,$datas->d1_rendu);
            $feuille->setCellValue('F'.$lignes,$datas->d1_facture);
            $lignes++;
        }
        if($datas->d1_rendu == "Programme besoin" && $progbesoin == 2017 ){
            $feuille->setCellValue('A'.$lignes,$datas->numero);
            $feuille->setCellValue('B'.$lignes,$datas->commune);
            $feuille->setCellValue('C'.$lignes,$canton);
            $feuille->setCellValue('D'.$lignes,$datas->d1_mission);
            $feuille->setCellValue('E'.$lignes,$datas->d1_rendu);
            $feuille->setCellValue('F'.$lignes,$datas->d1_facture);
            $lignes++;
        }
        if($datas->d1_rendu == "Consultation MOE" && $consultmoe == 2017 ){
            $feuille->setCellValue('A'.$lignes,$datas->numero);
            $feuille->setCellValue('B'.$lignes,$datas->commune);
            $feuille->setCellValue('C'.$lignes,$canton);
            $feuille->setCellValue('D'.$lignes,$datas->d1_mission);
            $feuille->setCellValue('E'.$lignes,$datas->d1_rendu);
            $feuille->setCellValue('F'.$lignes,$datas->d1_facture);
            $lignes++;
        }
        if($datas->d1_rendu == "DCE" && $dce == 2017 ){
            $feuille->setCellValue('A'.$lignes,$datas->numero);
            $feuille->setCellValue('B'.$lignes,$datas->commune);
            $feuille->setCellValue('C'.$lignes,$canton);
            $feuille->setCellValue('D'.$lignes,$datas->d1_mission);
            $feuille->setCellValue('E'.$lignes,$datas->d1_rendu);
            $feuille->setCellValue('F'.$lignes,$datas->d1_facture);
            $lignes++;
        }
        if($datas->d1_rendu == "Marché travaux" && $mtrvx == 2017 ){
            $feuille->setCellValue('A'.$lignes,$datas->numero);
            $feuille->setCellValue('B'.$lignes,$datas->commune);
            $feuille->setCellValue('C'.$lignes,$canton);
            $feuille->setCellValue('D'.$lignes,$datas->d1_mission);
            $feuille->setCellValue('E'.$lignes,$datas->d1_rendu);
            $feuille->setCellValue('F'.$lignes,$datas->d1_facture);
            $lignes++;
        }
    }

    if($datas->d2_facture != "" && $datas->d2_mission != ""){
        if($datas->d2_facture == "Cotisation" && $pi == 2017 ){
            $feuille->setCellValue('A'.$lignes,$datas->numero);
            $feuille->setCellValue('B'.$lignes,$datas->commune);
            $feuille->setCellValue('C'.$lignes,$canton);
            $feuille->setCellValue('D'.$lignes,$datas->d2_mission);
            $feuille->setCellValue('E'.$lignes,$datas->d2_rendu);
            $feuille->setCellValue('F'.$lignes,$datas->d2_facture);
            $lignes++;
        }
        if($datas->d2_rendu == "Programme besoin" && $progbesoin == 2017 ){
            $feuille->setCellValue('A'.$lignes,$datas->numero);
            $feuille->setCellValue('B'.$lignes,$datas->commune);
            $feuille->setCellValue('C'.$lignes,$canton);
            $feuille->setCellValue('D'.$lignes,$datas->d2_mission);
            $feuille->setCellValue('E'.$lignes,$datas->d2_rendu);
            $feuille->setCellValue('F'.$lignes,$datas->d2_facture);
            $lignes++;
        }
        if($datas->d2_rendu == "Consultation MOE" && $consultmoe == 2017 ){
            $feuille->setCellValue('A'.$lignes,$datas->numero);
            $feuille->setCellValue('B'.$lignes,$datas->commune);
            $feuille->setCellValue('C'.$lignes,$canton);
            $feuille->setCellValue('D'.$lignes,$datas->d2_mission);
            $feuille->setCellValue('E'.$lignes,$datas->d2_rendu);
            $feuille->setCellValue('F'.$lignes,$datas->d2_facture);
            $lignes++;
        }
        if($datas->d2_rendu == "DCE" && $dce == 2017 ){
            $feuille->setCellValue('A'.$lignes,$datas->numero);
            $feuille->setCellValue('B'.$lignes,$datas->commune);
            $feuille->setCellValue('C'.$lignes,$canton);
            $feuille->setCellValue('D'.$lignes,$datas->d2_mission);
            $feuille->setCellValue('E'.$lignes,$datas->d2_rendu);
            $feuille->setCellValue('F'.$lignes,$datas->d2_facture);
            $lignes++;
        }
        if($datas->d2_rendu == "Marché travaux" && $mtrvx == 2017 ){
            $feuille->setCellValue('A'.$lignes,$datas->numero);
            $feuille->setCellValue('B'.$lignes,$datas->commune);
            $feuille->setCellValue('C'.$lignes,$canton);
            $feuille->setCellValue('D'.$lignes,$datas->d2_mission);
            $feuille->setCellValue('E'.$lignes,$datas->d2_rendu);
            $feuille->setCellValue('F'.$lignes,$datas->d2_facture);
            $lignes++;
        }
    }

    if($datas->d3_facture != "" && $datas->d3_mission != ""){
        if($datas->d3_facture == "Cotisation" && $pi == 2017 ){
            $feuille->setCellValue('A'.$lignes,$datas->numero);
            $feuille->setCellValue('B'.$lignes,$datas->commune);
            $feuille->setCellValue('C'.$lignes,$canton);
            $feuille->setCellValue('D'.$lignes,$datas->d3_mission);
            $feuille->setCellValue('E'.$lignes,$datas->d3_rendu);
            $feuille->setCellValue('F'.$lignes,$datas->d3_facture);
            $lignes++;
        }
        if($datas->d3_rendu == "Programme besoin" && $progbesoin == 2017 ){
            $feuille->setCellValue('A'.$lignes,$datas->numero);
            $feuille->setCellValue('B'.$lignes,$datas->commune);
            $feuille->setCellValue('C'.$lignes,$canton);
            $feuille->setCellValue('D'.$lignes,$datas->d3_mission);
            $feuille->setCellValue('E'.$lignes,$datas->d3_rendu);
            $feuille->setCellValue('F'.$lignes,$datas->d3_facture);
            $lignes++;
        }
        if($datas->d3_rendu == "Consultation MOE" && $consultmoe == 2017 ){
            $feuille->setCellValue('A'.$lignes,$datas->numero);
            $feuille->setCellValue('B'.$lignes,$datas->commune);
            $feuille->setCellValue('C'.$lignes,$canton);
            $feuille->setCellValue('D'.$lignes,$datas->d3_mission);
            $feuille->setCellValue('E'.$lignes,$datas->d3_rendu);
            $feuille->setCellValue('F'.$lignes,$datas->d3_facture);
            $lignes++;
        }
        if($datas->d3_rendu == "DCE" && $dce == 2017 ){
            $feuille->setCellValue('A'.$lignes,$datas->numero);
            $feuille->setCellValue('B'.$lignes,$datas->commune);
            $feuille->setCellValue('C'.$lignes,$canton);
            $feuille->setCellValue('D'.$lignes,$datas->d3_mission);
            $feuille->setCellValue('E'.$lignes,$datas->d3_rendu);
            $feuille->setCellValue('F'.$lignes,$datas->d3_facture);
            $lignes++;
        }
        if($datas->d3_rendu == "Marché travaux" && $mtrvx == 2017 ){
            $feuille->setCellValue('A'.$lignes,$datas->numero);
            $feuille->setCellValue('B'.$lignes,$datas->commune);
            $feuille->setCellValue('C'.$lignes,$canton);
            $feuille->setCellValue('D'.$lignes,$datas->d3_mission);
            $feuille->setCellValue('E'.$lignes,$datas->d3_rendu);
            $feuille->setCellValue('F'.$lignes,$datas->d3_facture);
            $lignes++;
        }
    }

}

$fichier = 'Export - Dossier par Canton.xls';

$ecrire = new PHPExcel_Writer_Excel5($classeur);
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition:inline;filename="'.$fichier.'"');

$ecrire->save('php://output');



