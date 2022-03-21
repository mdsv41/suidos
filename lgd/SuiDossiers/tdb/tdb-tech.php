<?php
/**
 * Created by PhpStorm.
 * User: manuel
 * Date: 28/03/2017
 * Time: 09:22
 */


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
  $livraison = "";
  $deb_etude = "";
  $fin_etude = "";
  $dr_envoie = "";
  $dr_retour = "";
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

  if($datas->d3_charge !="" || $datas->d3_charge != null){
    $prestation = $datas->d3_prestation;
    $rendu = $datas->d3_rendu;
    $charge = $datas->d3_charge;
  }elseif($datas->d2_charge != "" || $datas->d2_charge != null){
    $prestation = $datas->d2_prestation;
    $rendu = $datas->d2_rendu;
    $charge = $datas->d2_charge;
  }else{
    $prestation = $datas->d1_prestation;
    $rendu = $datas->d1_rendu;
    $charge = $datas->d1_charge;
  }

  switch($rendu){
    case "Avis technique":
      $livraison = $datas->ad_pi_envoi;
      $deb_etude = $datas->amo_pi_deb;
      $fin_etude = $datas->amo_pi_fin;
      $dr_envoie = $datas->amo_pi_dr_envoi;
      $dr_retour = "-";
      $facture = "";
      break;
    case "Propositions / Budget":
      $livraison = $datas->ad_pi_envoi;
      $deb_etude = $datas->amo_pi_deb;
      $fin_etude = $datas->amo_pi_fin;
      $dr_envoie = $datas->amo_pi_dr_envoi;
      $dr_retour = "-";
      $facture = "";
      break;
    case "Montage dossier":
      $livraison = $datas->ad_pi_envoi;
      $deb_etude = $datas->amo_pi_deb;
      $fin_etude = $datas->amo_pi_fin;
      $dr_envoie = $datas->amo_pi_dr_envoi;
      $dr_retour = "-";
      $facture = "";
      break;
    case "Cartographie / Budget":
      $livraison = $datas->ad_pi_envoi;
      $deb_etude = $datas->amo_pi_deb;
      $fin_etude = $datas->amo_pi_fin;
      $dr_envoie = $datas->amo_pi_dr_envoi;
      $dr_retour = "-";
      $facture = "";
      break;
    case "Programme besoin":
      $livraison = $datas->ad_progbesoin_envoi;
      $deb_etude = $datas->amo_besoin_deb;
      $fin_etude = $datas->amo_besoin_fin;
      $dr_envoie = $datas->amo_besoin_dr_envoi;
      $dr_retour = $datas->amo_besoin_dr_retour;
      $facture = $datas->amo_besoin_facture;
      break;
    case "Programme travaux":
      $livraison = $datas->ad_progtravaux_envoi;
      $deb_etude = $datas->amo_progtrvx_deb;
      $fin_etude = $datas->amo_progtrvx_fin;
      $dr_envoie = "-";
      $dr_retour = "-";
      $facture = "";
      break;
    case "Etude préalable":
      $livraison = max($datas->ad_preop_topo_marche,$datas->ad_preop_compt_marche,$datas->ad_preop_autre_marche);
      $deb_etude = max($datas->preop_topo_deb,$datas->preop_compt_deb,$datas->preop_autre_deb);
      $fin_etude = max($datas->preop_topo_val_dossier,$datas->preop_compt_val_dossier,$datas->preop_autre_val_dossier);
      $dr_envoie = "-";
      $dr_retour = "-";
      $facture = max($datas->ad_preop_topo_facture,$datas->ad_preop_compt_facture,$datas->ad_preop_autre_facture);
      break;
    case "Consultation MOE":
      $livraison = $datas->ad_consultmoe_marche;
      $deb_etude = $datas->amo_consultMO_deb;
      $fin_etude = $datas->amo_consultMO_fin;
      $dr_envoie = "-";
      $dr_retour = "-";
      $facture = $datas->ad_consultmoe_facture;
      break;
    case "AVP/PRO":
      $livraison = $datas->ad_moe_avp_pro_envoi;
      $deb_etude = $datas->moe_avp_pro_deb;
      $fin_etude = $datas->moe_avp_pro_fin;
      $dr_envoie = $datas->moe_avp_pro_dr_envoi;
      $dr_retour = $datas->moe_avp_pro_dr_retour;
      $facture = $datas->ad_moe_avp_pro_facture;
      break;
    case "Marché travaux":
      $livraison = $datas->ad_mtrvx_envoi;
      $deb_etude = $datas->moe_mtrvx_deb;
      $fin_etude = $datas->moe_mtrvx_fin;
      $dr_envoie = $datas->moe_mtrvx_dr_envoi;
      $dr_retour = $datas->moe_mtrvx_dr_retour;
      $facture = $datas->moe_mtrvx_facture;
      break;
    case "DCE":
      $livraison = $datas->ad_moe_dce_envoi;
      $deb_etude = $datas->moe_dce_deb;
      $fin_etude = $datas->moe_dce_fin;
      $dr_envoie = "-";
      $dr_retour = "-";
      $facture = $datas->ad_moe_dce_facture;
      break;
    case "Assistance / Conseil":
      $livraison = $datas->ad_vac_rapport;
      $deb_etude = "";
      $fin_etude = "";
      $dr_envoie = "-";
      $dr_retour = "-";
      $facture = $datas->ad_vac_facture;
      break;
    case "Programme pluriannuelle":
      $livraison = $datas->ad_progbesoin_envoi;
      $deb_etude = $datas->amo_besoin_deb;
      $fin_etude = $datas->amo_besoin_fin;
      $dr_envoie = "-";
      $dr_retour = "-";
      $facture = $datas->amo_besoin_facture;
      break;
  }



  $feuille->setCellValue('A'.$ligne,$datas->numero);
  $feuille->setCellValue('B'.$ligne,$datas->commune);
  $feuille->setCellValue('C'.$ligne,$datas->objet);
  $feuille->setCellValue('D'.$ligne,$prestation."\n".$rendu);
  $feuille->setCellValue('F'.$ligne,date_oui_non($datas->conv_commune1));
  $feuille->setCellValue('G'.$ligne,date_oui_non($datas->conv_retour));
  $feuille->setCellValue('H'.$ligne,date_oui_non($av_commune));
  $feuille->setCellValue('I'.$ligne,date_oui_non($av_retour));
  $feuille->setCellValue('J'.$ligne,affiche_date($deb_etude));
  $feuille->setCellValue('K'.$ligne,affiche_date($fin_etude));
  $feuille->setCellValue('L'.$ligne,$charge);
  $feuille->setCellValue('M'.$ligne,affiche_date($dr_envoie));
  $feuille->setCellValue('N'.$ligne,affiche_date($dr_retour));
  $feuille->setCellValue('O'.$ligne,affiche_date($livraison));
  $feuille->setCellValue('P'.$ligne,affiche_date($facture));
  $feuille->setCellValue('Q'.$ligne,$datas->commentaire);
  $ligne++;
};


//Entete tableau donnée
$feuille->setCellValue('A1','N°');
$feuille->setCellValue('B1','Commune');
$feuille->setCellValue('C1','Objet');
$feuille->setCellValue('D1',"Domaine \nPrestation");
$feuille->setCellValue('F1','Convetion');
$feuille->setCellValue('F2','env');
$feuille->setCellValue('G2','ret');
$feuille->setCellValue('H1','Avenant');
$feuille->setCellValue('H2','env');
$feuille->setCellValue('I2','ret');
$feuille->setCellValue('J1','étude');
$feuille->setCellValue('J2','début');
$feuille->setCellValue('K2','fin');
$feuille->setCellValue('L1','Chargé');
$feuille->setCellValue('M1','Avis DR');
$feuille->setCellValue('M2','demande');
$feuille->setCellValue('N2','retour');
$feuille->setCellValue('O1','Livraison');
$feuille->setCellValue('P1','Facture');
$feuille->setCellValue('Q1','Observations');

//
//Entete tableau mise en forme
//

//Largeur des colonnes
$feuille->getColumnDimension('A')->setWidth(7.5);
$feuille->getColumnDimension('B')->setWidth(17);
$feuille->getColumnDimension('C')->setWidth(24);
$feuille->getColumnDimension('D')->setWidth(20);
$feuille->getColumnDimension('E')->setWidth(0);
$feuille->getColumnDimension('F')->setWidth(4);
$feuille->getColumnDimension('G')->setWidth(4);
$feuille->getColumnDimension('H')->setWidth(4);
$feuille->getColumnDimension('I')->setWidth(4);
$feuille->getColumnDimension('J')->setWidth(9);
$feuille->getColumnDimension('K')->setWidth(9);
$feuille->getColumnDimension('L')->setWidth(9);
$feuille->getColumnDimension('M')->setWidth(9);
$feuille->getColumnDimension('N')->setWidth(9);
$feuille->getColumnDimension('O')->setWidth(9);
$feuille->getColumnDimension('P')->setWidth(9);
$feuille->getColumnDimension('Q')->setWidth(47);



//Fusion cellule
try {
  $feuille->mergeCells('A1:A2');
  $feuille->mergeCells('B1:B2');
  $feuille->mergeCells('C1:C2');
  $feuille->mergeCells('D1:D2');
  $feuille->mergeCells('E1:E2');
  $feuille->mergeCells('F1:G1');
  $feuille->mergeCells('H1:I1');
  $feuille->mergeCells('J1:K1');
  $feuille->mergeCells('L1:L2');
  $feuille->mergeCells('M1:N1');
  $feuille->mergeCells('O1:O2');
  $feuille->mergeCells('P1:P2');
  $feuille->mergeCells('Q1:Q2');
} catch (PHPExcel_Exception $e) {
}


//Allignement cellule

try {
  $feuille->getStyle('A1:Q2')->getAlignment()->setHorizontal('center');
  $feuille->getStyle('A1:Q2')->getAlignment()->setVertical('center');
  $feuille->getStyle('A1:Q2')->getAlignment()->setWrapText(true);
} catch (PHPExcel_Exception $e) {
}




//style cellule bordure
try {
  $feuille->getStyle('A1:Q2')->applyFromArray(
    array(
      'font' => array(
        'bold' => true,
        'name' => 'Calibri',
        'size' => 9,
        'color' => array(
          'rgb' => 'FFFFFF')
      ),
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array(
            'rgb' => 'A0A0A0'
          )
        )
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array(
          'rgb' => '0080FF'
        )
      )
    )
  );
} catch (PHPExcel_Exception $e) {
}


//
// Mise en forme des données
//


try {
  $feuille->getStyle('A3:Q' . ($ligne - 1))->applyFromArray(
    array(
      'font' => array(
        'bold' => false,
        'name' => 'Calibri',
        'size' => 9
      ),
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array(
            'rgb' => 'A0A0A0'
          )
        )
      )
    )
  );
} catch (PHPExcel_Exception $e) {
}


try {
  $feuille->getStyle('A3:P' . ($ligne - 1))->getAlignment()->setHorizontal('center');
  $feuille->getStyle('A3:P' . ($ligne-1))->getAlignment()->setVertical('top');
  $feuille->getStyle('Q3:Q' . ($ligne-1))->getAlignment()->setHorizontal('left');
  $feuille->getStyle('Q3:Q' . ($ligne-1))->getAlignment()->setVertical('top');
  $feuille->getStyle('A3:Q' . ($ligne-1))->getAlignment()->setWrapText(true);
} catch (PHPExcel_Exception $e) {
}




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


try {
  $classeur->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 2);
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
} catch (PHPExcel_Exception $e) {
}




// entete de page
try {
  $classeur->getActiveSheet()->getHeaderFooter()->setOddHeader('&14 Suivi Technique &R ATD41');
  $classeur->getActiveSheet()->getHeaderFooter()->setOddFooter('&R&D');
} catch (PHPExcel_Exception $e) {
}



$ecrire = new PHPExcel_Writer_Excel5($classeur);
header('Content-type: application/vnd.ms-tdb');
header('Content-Disposition:inline;filename=tdb-technique.xls');
try {
  $ecrire->save('php://output');
} catch (PHPExcel_Writer_Exception $e) {
}
