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



// Création d'un nouvelle objet PHPexcel
$classeur = new PHPExcel;

//definition de la feuille
try {
  $feuille = $classeur->getActiveSheet();
} catch (PHPExcel_Exception $e) {
}
$feuille->setTitle('Tableau de Bord Technique');

//insertion des donnée
$res = $db->query("SELECT * FROM dossier WHERE archive != 'OUI' ORDER BY numero ASC ");
$ligne=3;
foreach ($res as $datas){
  // Avenant
  if ($datas->av1_commune1 > $datas->av2_commune1){
    $av_commune = $datas->av1_commune1;
    $av_retour = $datas->av1_retour;
  }elseif ($datas->av2_commune1 > $datas->av3_commune1) {
    $av_commune = $datas->av2_commune1;
    $av_retour = $datas->av2_retour;
  }else{
    $av_commune = $datas->av3_commune1;
    $av_retour = $datas->av3_retour;
  }

  // Dossier
  if($datas->d3_prestation !="" || $datas->d3_prestation != null){
    $prestation = $datas->d3_prestation;
    $mission = $datas->d3_mission;
    $rendu = $datas->d3_rendu;
    $charge = $datas->d3_charge;
  }elseif($datas->d2_charge != "" || $datas->d2_charge != null){
    $prestation = $datas->d2_prestation;
    $mission = $datas->d2_mission;
    $rendu = $datas->d2_rendu;
    $charge = $datas->d2_charge;
  }else{
    $prestation = $datas->d1_prestation;
    $mission = $datas->d1_mission;
    $rendu = $datas->d1_rendu;
    $charge = $datas->d1_charge;
  }
  $domaine = $prestation . "\n" . $rendu;

  // Livraison
  $livraison = "";
  switch($rendu){
    case "Avis technique":
      $livraison = $datas->ad_pi_envoi;
      break;
    case "Propositions / Budget":
      $livraison = $datas->ad_pi_envoi;
      break;
    case "Montage dossier":
      $livraison = $datas->ad_pi_envoi;
      break;
    case "Programme besoin":
      $livraison = $datas->ad_progbesoin_envoi;
      break;
    case "Programme travaux":
      $livraison = $datas->ad_progtravaux_envoi;
      break;
    case "Etude préalable":
      $livraison = max($datas->ad_preop_topo_marche,$datas->ad_preop_compt_marche,$datas->ad_preop_autre_marche);
      break;
    case "Consultation MOE":
      $livraison = $datas->ad_consultmoe_marche;
      break;
    case "AVP/PRO":
      $livraison = $datas->ad_moe_avp_pro_envoi;
      break;
    case "Marché travaux":
      $livraison = $datas->ad_mtrvx_envoi;
      break;
    case "DCE":
      $livraison = $datas->ad_moe_dce_envoi;
      break;
    case "Assistance / Conseil":
      $livraison = $datas->ad_vac_rapport;
      break;
    case "Programme pluriannuelle":
      $livraison = $datas->ad_progtravaux;
      break;
  }

  $feuille->setCellValue('A'.$ligne,$datas->numero);
  $feuille->setCellValue('B'.$ligne,$datas->commune);
  $feuille->setCellValue('C'.$ligne,$datas->saisie_date);
  $feuille->setCellValue('D'.$ligne,$mission);
  $feuille->setCellValue('E'.$ligne,$domaine);
  $feuille->setCellValue('F'.$ligne,affiche_date($datas->ad_gen_rdv));
  $feuille->setCellValue('G'.$ligne,affiche_date($datas->conv_commune1));
  $feuille->setCellValue('H'.$ligne,affiche_date($datas->conv_retour));
  $feuille->setCellValue('I'.$ligne,affiche_date($av_commune));
  $feuille->setCellValue('J'.$ligne,affiche_date($av_retour));
  $feuille->setCellValue('K'.$ligne,$datas->objet);
  $feuille->setCellValue('L'.$ligne,affiche_date($livraison));
  $feuille->setCellValue('M'.$ligne,$charge);
  $feuille->setCellValue('N'.$ligne,$datas->commentaire);
  $ligne++;
};

//Entete tableau donnée
$feuille->setCellValue('A1','N°');
$feuille->setCellValue('B1','Commune');
$feuille->setCellValue('C1','contact');
$feuille->setCellValue('D1','mission');
$feuille->setCellValue('E1',"Domaine \n Prestations");
$feuille->setCellValue('F1','RDV');
$feuille->setCellValue('G1','Convention');
$feuille->setCellValue('G2','envoi');
$feuille->setCellValue('H2','retour');
$feuille->setCellValue('I1','Avenant');
$feuille->setCellValue('I2','envoi');
$feuille->setCellValue('J2','retour');
$feuille->setCellValue('K1','objet');
$feuille->setCellValue('L1','livraison');
$feuille->setCellValue('M1','Chargé');
$feuille->setCellValue('N1','Observations');

//
//Entete tableau mise en forme
//

//Largeur des colonnes
$feuille->getColumnDimension('A')->setWidth(7.5);
$feuille->getColumnDimension('B')->setWidth(17);
$feuille->getColumnDimension('C')->setWidth(9);
$feuille->getColumnDimension('D')->setWidth(9);
$feuille->getColumnDimension('E')->setWidth(22);
$feuille->getColumnDimension('F')->setWidth(9);
$feuille->getColumnDimension('G')->setWidth(9);
$feuille->getColumnDimension('H')->setWidth(9);
$feuille->getColumnDimension('I')->setWidth(9);
$feuille->getColumnDimension('J')->setWidth(9);
$feuille->getColumnDimension('K')->setWidth(35);
$feuille->getColumnDimension('L')->setWidth(9);
$feuille->getColumnDimension('M')->setWidth(9);
$feuille->getColumnDimension('N')->setWidth(40);



//Fusion cellule
//Fusion cellule
$feuille->mergeCells('A1:A2');
$feuille->mergeCells('B1:B2');
$feuille->mergeCells('C1:C2');
$feuille->mergeCells('D1:D2');
$feuille->mergeCells('E1:E2');
$feuille->mergeCells('F1:F2');
$feuille->mergeCells('G1:H1');
$feuille->mergeCells('I1:J1');
$feuille->mergeCells('K1:K2');
$feuille->mergeCells('L1:L2');
$feuille->mergeCells('M1:M2');
$feuille->mergeCells('N1:N2');

//Allignement cellule
$feuille->getStyle('A1:N2')->getAlignment()->setHorizontal('center');
$feuille->getStyle('A1:N2')->getAlignment()->setVertical('center');
$feuille->getStyle('A1:N2')->getAlignment()->setWrapText(true);

//style cellule bordure

$feuille->getStyle('A1:N2')->applyFromArray(
  array(
    'font' => array(
      'bold'=>true,
      'name'=>'Calibri',
      'size'=>9,
      'color'=>array(
        'rgb'=>'FFFFFF')
    ),
    'borders'=> array(
      'allborders'=>array(
        'style' => PHPExcel_Style_Border::BORDER_THIN,
        'color'=>array(
          'rgb'=>'A0A0A0'
        )
      )
    ),
    'fill'=>array(
      'type'=>PHPExcel_Style_Fill::FILL_SOLID,
      'color'=>array(
        'rgb'=>'0080FF'
      )
    )
  )
);



//
// Mise en forme des données
//


$feuille->getStyle('A3:N'.($ligne-1))->applyFromArray(
  array(
    'font' => array(
      'bold'=>false,
      'name'=>'Calibri',
      'size'=>9
    ),
    'borders' => array(
      'allborders' => array(
        'style' => PHPExcel_Style_Border::BORDER_THIN,
        'color'=>array(
          'rgb'=>'A0A0A0'
        )
      )
    )
  )
);

//$feuille->getRowDimension('3:'.($ligne-1))->setRowHeight(37);
$feuille->getStyle('A3:M'.($ligne-1))->getAlignment()->setHorizontal('center');
$feuille->getStyle('A3:M'.($ligne-1))->getAlignment()->setVertical('top');
$feuille->getStyle('A3:M'.($ligne-1))->getAlignment()->setWrapText(true);
$feuille->getStyle('N3:N'.($ligne-1))->getAlignment()->setHorizontal('left');
$feuille->getStyle('N3:N'.($ligne-1))->getAlignment()->setVertical('top');
$feuille->getStyle('N3:N'.($ligne-1))->getAlignment()->setWrapText(true);

//filtre automatique
//$feuille->setAutoFilter('A3:P'.($ligne-1));

//
//Mise en page
//
$haut = 1.4/2.54;
$bas = 1/2.54;
$droite = 0.5/2.54;
$gauche = 0.5/2.54;
$header = 0/2.54;
$footer = 0.5/2.54;


$classeur->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1,2);
$classeur->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$classeur->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
$classeur->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
$classeur->getActiveSheet()->getPageSetup()->setFitToPage(true);
$classeur->getActiveSheet()->getPageSetup()->setFitToWidth(1);
$classeur->getActiveSheet()->getPageSetup()->setFitToHeight(0);
$classeur->getActiveSheet()->getPageMargins()->setHeader($header);
$classeur->getActiveSheet()->getPageMargins()->setFooter($footer);
$classeur->getActiveSheet()->getPageMargins()->setTop($haut);
$classeur->getActiveSheet()->getPageMargins()->setBottom($bas);
$classeur->getActiveSheet()->getPageMargins()->setLeft($gauche);
$classeur->getActiveSheet()->getPageMargins()->setRight($droite);



// entete de page
$classeur->getActiveSheet()->getHeaderFooter()->setOddHeader('&14 Tableau de bord activité &R ATD41');
$classeur->getActiveSheet()->getHeaderFooter()->setOddFooter('&R&D');


$ecrire = new PHPExcel_Writer_Excel5($classeur);
header('Content-type: application/vnd.ms-tdb');
header('Content-Disposition:inline;filename=tdb-activite.xls');
$ecrire->save('php://output');
