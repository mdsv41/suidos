<?php
/**
 * Created by PhpStorm.
 * User: manuel
 * Date: 28/03/2017
 * Time: 09:22
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Include PHPExcel */
if(session_status() === PHP_SESSION_NONE){session_start(); };
require_once '../../../app/database.php';
require_once '../../../inc/connection.php';
require_once '../../../inc/functions.php';
require_once '../../../inc/dev.php';
require_once '../../../app/PHPExcel.php';
$db = new database($db_name, $db_user, $db_pass, $db_host);

$datas = $db->queryOne("SELECT * FROM dossier WHERE numero = '".$_GET['numero']."'");
$presta = $db->queryOne("SELECT * FROM commune WHERE nom = '".$datas->commune."'");



// Création d'un nouvelle objet PHPexcel
$classeur = new PHPExcel();

//definition de la feuille
try {
    $feuille = $classeur->getActiveSheet();
} catch (PHPExcel_Exception $e) {
}
$feuille->setTitle('DONNEES');


$date_adhesion = date_format(date_create($presta->date_adhesion),'d-m-Y');


//insertion des donnée
$feuille->setCellValue('A2',$datas->numero);
$feuille->setCellValue('B2',$datas->commune);
$feuille->setCellValue('C2',$datas->objet);
$feuille->setCellValue('D2',$datas->BT_Besoin);
$feuille->setCellValue('E2',$datas->BT_Objectif);
$feuille->setCellValue('F2',$datas->BT_DetailTrvx);
$feuille->setCellValue('G2',$datas->BT_ContenueMission);
$feuille->setCellValue('H2',$datas->collectivite);
$feuille->setCellValue('I2',$datas->civilite.' '.$datas->representant);
$feuille->setCellValue('J2',$datas->adresse.PHP_EOL.$datas->code_postal.' '.$datas->ville);
$feuille->setCellValue('K2','Tel. '.$datas->telephone.PHP_EOL.'Fax. '.$datas->fax.PHP_EOL.'Courriel '.$datas->courriel);
$feuille->setCellValue('L2',$date_adhesion);
$feuille->setCellValue('M2',$datas->montant_besoin);
$feuille->setCellValue('N2',$datas->montant_trvx);
$feuille->setCellValue('O2',$datas->montant_estim);
$feuille->setCellValue('P2',$datas->delaisexcution);
$feuille->setCellValue('Q2',$date_adhesion);

//Entete tableau donnée
$feuille->setCellValue('A1','dossier');
$feuille->setCellValue('B1','commune');
$feuille->setCellValue('C1','opération');
$feuille->setCellValue('D1','besoin');
$feuille->setCellValue('E1','objectifs');
$feuille->setCellValue('F1','détail des travaux');
$feuille->setCellValue('G1','contenu de la mission');
$feuille->setCellValue('H1','maîtrise d\'ouvrage');
$feuille->setCellValue('I1','maître d\'ouvrage');
$feuille->setCellValue('J1','adresse maîtrise d\'ouvrage');
$feuille->setCellValue('K1','tel fax mel');
$feuille->setCellValue('L1','date adhésion');
$feuille->setCellValue('M1','montant besoin');
$feuille->setCellValue('N1','montant travaux');
$feuille->setCellValue('O1','montant estime');
$feuille->setCellValue('P1','délai global');
$feuille->setCellValue('Q1','date adhesion');

//
//Entete tableau mise en forme
//

//Largeur des colonnes
$feuille->getColumnDimension('A')->setWidth(10);
$feuille->getColumnDimension('B')->setWidth(20);
$feuille->getColumnDimension('C')->setWidth(20);
$feuille->getColumnDimension('D')->setWidth(20);
$feuille->getColumnDimension('E')->setWidth(25);
$feuille->getColumnDimension('F')->setWidth(25);
$feuille->getColumnDimension('G')->setWidth(30);
$feuille->getColumnDimension('H')->setWidth(20);
$feuille->getColumnDimension('I')->setWidth(20);
$feuille->getColumnDimension('J')->setWidth(25);
$feuille->getColumnDimension('K')->setWidth(35);
$feuille->getColumnDimension('L')->setWidth(25);
$feuille->getColumnDimension('M')->setWidth(25);
$feuille->getColumnDimension('N')->setWidth(25);
$feuille->getColumnDimension('O')->setWidth(25);
$feuille->getColumnDimension('P')->setWidth(25);
$feuille->getColumnDimension('Q')->setWidth(25);



//Allignement cellule
try {
    $feuille->getStyle('A1:Q2')->getAlignment()->setHorizontal('center');
    $feuille->getStyle('A1:Q2')->getAlignment()->setVertical('center');

//style cellule bordure
    $feuille->getStyle('A1:Q2')->applyFromArray(
        array(
            'font' => array(
                'bold'=>false,
                'name'=>'Calibri',
                'size'=>12,
            ),
            'borders'=> array(
                'allborders'=>array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                )
            ),
        )
    );
    $feuille->getRowDimension('2')->setRowHeight(252);
    $feuille->getStyle('A1:Q2')->getAlignment()->setWrapText(true);
} catch (PHPExcel_Exception $e) {
}


$feuille->getStyle('A3')->getAlignment()->setWrapText(true);


$fichier = $datas->numero.' - BASE technique.xls';

$ecrire = new PHPExcel_Writer_Excel5($classeur);
header('Content-type: application/vnd.ms-tdb');
header('Content-Disposition:inline;filename="'.$fichier.'"');
try {
    $ecrire->save('php://output');
} catch (PHPExcel_Writer_Exception $e) {
}