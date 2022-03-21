<?php
/**
 * Created by PhpStorm.
 * User: manueldesousa
 * Date: 24/11/2017
 * Time: 14:51
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

$req = $db->query('SELECT * FROM commune order by nom asc ');




// Création d'un nouvelle objet PHPexcel
$classeur = new PHPExcel;



//definition de la feuille
$feuille = $classeur->getActiveSheet();
$feuille->setTitle('Extraction Communes');


//
//Entete tableau et mise en forme
//

//Entete tableau donnée
$feuille->setCellValue('A1','INSEE');
$feuille->setCellValue('B1','type');
$feuille->setCellValue('C1','collectivitée');
$feuille->setCellValue('D1','nom');
$feuille->setCellValue('E1','adresse');
$feuille->setCellValue('F1','CP');
$feuille->setCellValue('G1','ville');
$feuille->setCellValue('H1','téléphone');
$feuille->setCellValue('I1','fax');
$feuille->setCellValue('J1','courriel');
$feuille->setCellValue('K1','web');
$feuille->setCellValue('L1','Représentant');
$feuille->setCellValue('L2','fonction');
$feuille->setCellValue('M2','civilité');
$feuille->setCellValue('N2','nom');
$feuille->setCellValue('O1','Maire');
$feuille->setCellValue('O2','civilité');
$feuille->setCellValue('P2','nom');
$feuille->setCellValue('Q1','adhérent');
$feuille->setCellValue('R1','date adhésion');
$feuille->setCellValue('S1','Nb habitant');
$feuille->setCellValue('T1','Code');
$feuille->setCellValue('U1','Blois < 1000');
$feuille->setCellValue('V1','Vendôme < 1000');
$feuille->setCellValue('W1','Romorantin < 1000');
$feuille->setCellValue('X1','1000 < 2000');
$feuille->setCellValue('Y1','ECPI');

//Largeur des colonnes
$feuille->getColumnDimension('A')->setWidth(8);
$feuille->getColumnDimension('B')->setWidth(11);
$feuille->getColumnDimension('C')->setWidth(58);
$feuille->getColumnDimension('D')->setWidth(38);
$feuille->getColumnDimension('E')->setWidth(42);
$feuille->getColumnDimension('F')->setWidth(6);
$feuille->getColumnDimension('G')->setWidth(34);
$feuille->getColumnDimension('H')->setWidth(12);
$feuille->getColumnDimension('I')->setWidth(12);
$feuille->getColumnDimension('J')->setWidth(44);
$feuille->getColumnDimension('K')->setWidth(67);
$feuille->getColumnDimension('L')->setWidth(21);
$feuille->getColumnDimension('M')->setWidth(11);
$feuille->getColumnDimension('N')->setWidth(35);
$feuille->getColumnDimension('O')->setWidth(11);
$feuille->getColumnDimension('P')->setWidth(35);
$feuille->getColumnDimension('Q')->setWidth(9);
$feuille->getColumnDimension('R')->setWidth(14);
$feuille->getColumnDimension('S')->setWidth(12);
$feuille->getColumnDimension('T')->setWidth(13);
$feuille->getColumnDimension('U')->setWidth(11);
$feuille->getColumnDimension('V')->setWidth(11);
$feuille->getColumnDimension('W')->setWidth(11);
$feuille->getColumnDimension('X')->setWidth(11);
$feuille->getColumnDimension('Y')->setWidth(11);

//Fusion des cellules
$feuille->mergeCells('A1:A2');
$feuille->mergeCells('B1:B2');
$feuille->mergeCells('C1:C2');
$feuille->mergeCells('D1:D2');
$feuille->mergeCells('E1:E2');
$feuille->mergeCells('F1:F2');
$feuille->mergeCells('G1:G2');
$feuille->mergeCells('H1:H2');
$feuille->mergeCells('I1:I2');
$feuille->mergeCells('J1:J2');
$feuille->mergeCells('K1:K2');
$feuille->mergeCells('L1:N1');
$feuille->mergeCells('O1:P1');
$feuille->mergeCells('Q1:Q2');
$feuille->mergeCells('R1:R2');
$feuille->mergeCells('S1:S2');
$feuille->mergeCells('T1:T2');
$feuille->mergeCells('U1:U2');
$feuille->mergeCells('V1:V2');
$feuille->mergeCells('W1:W2');
$feuille->mergeCells('X1:X2');
$feuille->mergeCells('Y1:Y2');



//Allignement cellule
$feuille->getStyle('A1:Y2')->getAlignment()->setHorizontal('center');
$feuille->getStyle('A1:Y2')->getAlignment()->setVertical('center');

//style cellule bordure
$feuille->getStyle('A1:Y2')->applyFromArray(
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




//
//Remplissage données tableau et mise en forme
//

$lignes = 3;
$bloistotal = 0.0;
$vendometotal = 0.0;
$romototal = 0.0;
$ecpitotal = 0.0;
$plusmilletotal = 0.0;
$nbadherant = 0.0;
$population_Total = 0.0;
$population_Adherant = 0.0;

//insertion des donnée
foreach ($req as $datas) {
    if(strtoupper($datas->adhesion)=="OUI"){
        if(strtoupper($datas->arrondissement)=="EPCI"){
            $code = 2;
            $blois = "";
            $vendome = "";
            $romo = "";
            $plusmille = "";
            $epci =1;
            $ecpitotal++;
            $nbadherant++;
            $population_Adherant = $population_Adherant + $datas->Nb_Habitant;
        }elseif (strtoupper($datas->arrondissement)=="BLOIS" && $datas->Nb_Habitant < 1001){
            $code = 2;
            $blois = 1;
            $vendome = "";
            $romo = "";
            $plusmille = "";
            $epci = "";
            $bloistotal++;
            $nbadherant++;
            $population_Adherant = $population_Adherant + $datas->Nb_Habitant;
        }elseif (strtoupper($datas->arrondissement)=="VENDOME" && $datas->Nb_Habitant < 1001){
            $code = 2;
            $blois = "";
            $vendome = 1;
            $romo = "";
            $plusmille = "";
            $epci = "";
            $vendometotal++;
            $nbadherant++;
            $population_Adherant = $population_Adherant + $datas->Nb_Habitant;
        }elseif (strtoupper($datas->arrondissement)=="ROMORANTIN" && $datas->Nb_Habitant < 1001){
            $code = 2;
            $blois = "";
            $vendome = "";
            $romo = 1;
            $plusmille = "";
            $epci = "";
            $romototal++;
            $nbadherant++;
            $population_Adherant = $population_Adherant + $datas->Nb_Habitant;
        }else{
            $code = 2;
            $blois = "";
            $vendome = "";
            $romo = "";
            $plusmille = 1;
            $epci = "";
            $plusmilletotal++;
            $nbadherant++;
            $population_Adherant = $population_Adherant + $datas->Nb_Habitant;
        }
    }else{
        if($datas->Nb_Habitant < 2001){
            $code = 1;
            $blois = "";
            $vendome = "";
            $romo = "";
            $plusmille = "";
            $epci = "";
            $population_Total = $population_Total + $datas->Nb_Habitant;
        }else{
            $code = 0;
            $blois = "";
            $vendome = "";
            $romo = "";
            $plusmille = "";
            $epci = "";
        }
    }

    $adhesion = affiche_date($datas->date_adhesion);

    $feuille->setCellValue('A'.$lignes,$datas->siren_siret);
    $feuille->setCellValue('B'.$lignes,$datas->type);
    $feuille->setCellValue('C'.$lignes,$datas->collectivite);
    $feuille->setCellValue('D'.$lignes,$datas->nom);
    $feuille->setCellValue('E'.$lignes,$datas->adresse);
    $feuille->setCellValue('F'.$lignes,$datas->code_postal);
    $feuille->setCellValue('G'.$lignes,$datas->ville);
    $feuille->setCellValue('H'.$lignes,$datas->telephone);
    $feuille->setCellValue('I'.$lignes,$datas->fax);
    $feuille->setCellValue('J'.$lignes,$datas->courriel);
    $feuille->setCellValue('K'.$lignes,$datas->web);
    $feuille->setCellValue('L'.$lignes,$datas->fonction);
    $feuille->setCellValue('M'.$lignes,$datas->civilite);
    $feuille->setCellValue('N'.$lignes,$datas->representant);
    $feuille->setCellValue('O'.$lignes,$datas->civilite_maire);
    $feuille->setCellValue('P'.$lignes,$datas->maire);
    $feuille->setCellValue('Q'.$lignes,$datas->adhesion);
    $feuille->setCellValue('R'.$lignes,$adhesion);
    $feuille->setCellValue('S'.$lignes,$datas->Nb_Habitant);
    $feuille->setCellValue('T'.$lignes,$code);
    $feuille->setCellValue('U'.$lignes,$blois);
    $feuille->setCellValue('V'.$lignes,$vendome);
    $feuille->setCellValue('W'.$lignes,$romo);
    $feuille->setCellValue('X'.$lignes,$plusmille);
    $feuille->setCellValue('Y'.$lignes,$epci);

    $lignes++;
}

$population_Dep = $population_Total + $population_Adherant;

$lignes++;
$feuille->setCellValue('S'.$lignes,'Pop Dép.');
$feuille->setCellValue('T'.$lignes,'Pop Adhérant');
$feuille->setCellValue('U'.$lignes,'Blois < 1000');
$feuille->setCellValue('V'.$lignes,'Vendôme < 1000');
$feuille->setCellValue('W'.$lignes,'Romorantin < 1000');
$feuille->setCellValue('X'.$lignes,'1000 < 2000');
$feuille->setCellValue('Y'.$lignes,'ECPI');
$feuille->setCellValue('Z'.$lignes,'Nb Adhérant Total');
$lignes++;
$feuille->setCellValue('S'.$lignes,$population_Dep);
$feuille->setCellValue('T'.$lignes,$population_Adherant);
$feuille->setCellValue('U'.$lignes,$bloistotal);
$feuille->setCellValue('V'.$lignes,$vendometotal);
$feuille->setCellValue('W'.$lignes,$romototal);
$feuille->setCellValue('X'.$lignes,$plusmilletotal);
$feuille->setCellValue('Y'.$lignes,$ecpitotal);
$feuille->setCellValue('Z'.$lignes,$nbadherant);


//
//Entete tableau mise en forme
//


//$feuille->getRowDimension('2')->setRowHeight(252);
$feuille->getStyle('A1:Y2')->getAlignment()->setWrapText(true);


$fichier = 'Export - commune.xls';

$ecrire = new PHPExcel_Writer_Excel5($classeur);
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition:inline;filename="'.$fichier.'"');
$ecrire->save('php://output');



