<?php
/**
 * Created by PhpStorm.
 * User: MdSV
 * Date: 2019/02
 */

/*
 *
 *  Gestion du temps par AMO
 *
 */


/*
 *  Entete tableau et mise en forme
 */

//Entete tableau donnée
$feuille_MOE->setCellValue('A1',$annee);
$feuille_MOE->setCellValue('A2','Dossier');
$feuille_MOE->setCellValue('B2','Prestation');
$feuille_MOE->setCellValue('C2','temps 1/2J');

//Largeur des colonnes
$feuille_MOE->getColumnDimension('A')->setWidth(40);
$feuille_MOE->getColumnDimension('B')->setWidth(30);
$feuille_MOE->getColumnDimension('C')->setWidth(10);
$feuille_MOE->getColumnDimension('D')->setWidth(10);
$feuille_MOE->getColumnDimension('E')->setWidth(12);
$feuille_MOE->getColumnDimension('E')->setWidth(10);

//Fusion des cellules
try {
  $feuille_MOE->mergeCells('A1:C1');
} catch (PHPExcel_Exception $e) {
}

//Allignement cellule
try {
  $feuille_MOE->getStyle('A1:C2')->getAlignment()->setHorizontal('center');
  $feuille_MOE->getStyle('A1:C2')->getAlignment()->setVertical('center');
} catch (PHPExcel_Exception $e) {
}

// Remplissage du tableau
$ligne = 3;
$total_dossier = 0;

/*
 * diagS diagnostique de sécurité
 * diagV diagnostique de voirie
 * diagOA diagnostique Ouvrage d'ART
 * dsr Dossier de Solidarité Rurale
 */
$AVP_PRO = array('min' => 100, 'total' => 0, 'max' => 0, 'nbre' => 0);
$DCE = array('min' => 100, 'total' => 0, 'max' => 0, 'nbre' => 0);
$mTrvx = array('min' => 100, 'total' => 0, 'max' => 0, 'nbre' => 0);
$datas = $db->query("SELECT * FROM dossier WHERE d1_mission = 'MOE' OR d2_mission = 'MOE' OR d3_mission = 'MOE' ORDER BY commune ASC");
foreach ($datas as $data) {
  if(!empty($data->ad_moe_avp_pro_envoi)){
    if ($annee == substr($data->ad_moe_avp_pro_envoi,0,4)) {
      if ($data->moe_avp_pro_tp < $AVP_PRO['min'] && $data->moe_avp_pro_tp > $AVP_PRO['max']){
        $AVP_PRO['min'] = $data->moe_avp_pro_tp;
        $AVP_PRO['max'] = $data->moe_avp_pro_tp;
      } elseif ($data->moe_avp_pro_tp > $AVP_PRO['max']){
        $AVP_PRO['max'] = $data->moe_avp_pro_tp;
      } elseif ($data->moe_avp_pro_tp < $AVP_PRO['min']){
        $AVP_PRO['min'] = $data->moe_avp_pro_tp;
      }
      $AVP_PRO['total'] = $AVP_PRO['total'] + $data->moe_avp_pro_tp;
      $AVP_PRO['nbre'] = $AVP_PRO['nbre'] + 1;
      $prestation = "AVP / PRO";
      $feuille_MOE->setCellValue('A'.$ligne,$data->numero.'-'.$data->commune);
      $feuille_MOE->setCellValue('B'.$ligne,$prestation);
      $feuille_MOE->setCellValue('C'.$ligne,$data->moe_avp_pro_tp);
      $ligne = $ligne +1;
    }
  }
  if(!empty($data->ad_moe_dce_envoi)){
    if ($annee == substr($data->ad_moe_dce_envoi,0,4)) {
      if ($data->moe_dce_tp < $DCE['min'] && $data->moe_dce_tp > $DCE['max']){
        $DCE['min'] = $data->moe_dce_tp;
        $DCE['max'] = $data->moe_dce_tp;
      } elseif ($data->moe_dce_tp > $DCE['max']){
        $DCE['max'] = $data->moe_dce_tp;
      } elseif ($data->moe_dce_tp < $DCE['min']){
        $DCE['min'] = $data->moe_dce_tp;
      }
      $DCE['total'] = $DCE['total'] + $data->moe_dce_tp;
      $DCE['nbre'] = $DCE['nbre'] + 1;
      $prestation = "DCE";
      $feuille_MOE->setCellValue('A'.$ligne,$data->numero.'-'.$data->commune);
      $feuille_MOE->setCellValue('B'.$ligne, $prestation);
      $feuille_MOE->setCellValue('C'.$ligne, $data->moe_dce_tp);
      $ligne = $ligne +1;
    }
  }
  if(!empty($data->ad_mtrvx_envoi)){
    if ($annee == substr($data->ad_mtrvx_envoi,0,4)) {
      if ($data->moe_mtrvx_tp < $mTrvx['min'] && $data->moe_mtrvx_tp > $mTrvx['max']){
        $mTrvx['min'] = $data->moe_mtrvx_tp;
        $mTrvx['max'] = $data->moe_mtrvx_tp;
      } elseif ($data->moe_mtrvx_tp > $mTrvx['max']){
        $mTrvx['max'] = $data->moe_mtrvx_tp;
      } elseif ($data->moe_mtrvx_tp < $mTrvx['min']){
        $mTrvx['min'] = $data->moe_mtrvx_tp;
      }
      $mTrvx['total'] = $mTrvx['total'] + $data->moe_mtrvx_tp;
      $mTrvx['nbre'] = $mTrvx['nbre'] + 1;
      $prestation = "Marché de Travaux";
      $feuille_MOE->setCellValue('A'.$ligne,$data->numero.'-'.$data->commune);
      $feuille_MOE->setCellValue('B'.$ligne, $prestation);
      $feuille_MOE->setCellValue('C'.$ligne, $data->moe_mtrvx_tp);
      $ligne = $ligne +1;
    }
  }
}
$ltotal = $ligne-1;
$ligne = $ligne + 2;
$feuille_MOE->setCellValue('A'.$ligne,'Prestation');
$feuille_MOE->setCellValue('B'.$ligne,'Pourcentage dossier');
$feuille_MOE->setCellValue('C'.$ligne,'nombres');
$feuille_MOE->setCellValue('D'.$ligne, 'min');
$feuille_MOE->setCellValue('E'.$ligne,'Moyenne');
$feuille_MOE->setCellValue('F'.$ligne,'Max');
$ligne = $ligne+1;

$nbreTotal = ($AVP_PRO['nbre'] + $DCE['nbre'] + $mTrvx['nbre']);

$feuille_MOE->setCellValue('A'.$ligne,'AVP/PRO');
if($AVP_PRO['nbre'] == 0 ){
  $feuille_MOE->setCellValue('B'.$ligne,0);
  $feuille_MOE->setCellValue('C'.$ligne,0);
  $feuille_MOE->setCellValue('D'.$ligne,0);
  $feuille_MOE->setCellValue('E'.$ligne,0);
  $feuille_MOE->setCellValue('F'.$ligne,0);
}else {
  $feuille_MOE->setCellValue('B'.$ligne,$AVP_PRO['nbre']/$nbreTotal);
  $feuille_MOE->setCellValue('C'.$ligne,$AVP_PRO['nbre']);
  $feuille_MOE->setCellValue('D'.$ligne,$AVP_PRO['min']);
  $feuille_MOE->setCellValue('E' . $ligne, $AVP_PRO['total'] / $AVP_PRO['nbre']);
  $feuille_MOE->setCellValue('F'.$ligne,$AVP_PRO['max']);
}
$feuille_MOE->getStyle('E'.$ligne.':E'.$ligne)->getNumberFormat()->applyFromArray(["code" => PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00]);
$feuille_MOE->getStyle('B'.$ligne.':B'.$ligne)->getNumberFormat()->applyFromArray(["code" => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00]);
$ligne = $ligne+1;

$feuille_MOE->setCellValue('A'.$ligne,'DCE');
if($DCE['nbre'] == 0 ){
  $feuille_MOE->setCellValue('B'.$ligne,0);
  $feuille_MOE->setCellValue('C'.$ligne,0);
  $feuille_MOE->setCellValue('D'.$ligne,0);
  $feuille_MOE->setCellValue('E'.$ligne,0);
  $feuille_MOE->setCellValue('F'.$ligne,0);
}else{
  $feuille_MOE->setCellValue('B'.$ligne,$DCE['nbre']/$nbreTotal);
  $feuille_MOE->setCellValue('C'.$ligne,$DCE['nbre']);
  $feuille_MOE->setCellValue('D'.$ligne,$DCE['min']);
  $feuille_MOE->setCellValue('E' . $ligne, $DCE['total'] / $DCE['nbre']);
  $feuille_MOE->setCellValue('F'.$ligne,$DCE['max']);
}
$feuille_MOE->getStyle('E'.$ligne.':E'.$ligne)->getNumberFormat()->applyFromArray(["code" => PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00]);
$feuille_MOE->getStyle('B'.$ligne.':B'.$ligne)->getNumberFormat()->applyFromArray(["code" => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00]);
$ligne = $ligne+1;

$feuille_MOE->setCellValue('A'.$ligne,"Marché de Travaux");
if($mTrvx['nbre'] == 0){
  $feuille_MOE->setCellValue('B'.$ligne,0);
  $feuille_MOE->setCellValue('C'.$ligne,0);
  $feuille_MOE->setCellValue('D'.$ligne,0);
  $feuille_MOE->setCellValue('E'.$ligne,0);
  $feuille_MOE->setCellValue('F'.$ligne,0);
}else{
  $feuille_MOE->setCellValue('B'.$ligne,$mTrvx['nbre']/$nbreTotal);
  $feuille_MOE->setCellValue('C'.$ligne,$mTrvx['nbre']);
  $feuille_MOE->setCellValue('D'.$ligne,$mTrvx['min']);
  $feuille_MOE->setCellValue('E'.$ligne,$mTrvx['total']/$mTrvx['nbre']);
  $feuille_MOE->setCellValue('F'.$ligne,$mTrvx['max']);
}
$feuille_MOE->getStyle('E'.$ligne.':E'.$ligne)->getNumberFormat()->applyFromArray(["code" => PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00]);
$feuille_MOE->getStyle('B'.$ligne.':B'.$ligne)->getNumberFormat()->applyFromArray(["code" => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00]);
$ligne = $ligne + 1;

$feuille_MOE->setCellValue('B'.$ligne,'Total');
$feuille_MOE->setCellValue('C'.$ligne,$nbreTotal);


//Allignement cellule
try {
  $feuille_MOE->getStyle('B3:C'.$ltotal)->getAlignment()->setHorizontal('center');
  $feuille_MOE->getStyle('A'.$ltotal)->getAlignment()->setHorizontal('left');
  $feuille_MOE->getStyle('A1:C'.$ltotal)->getAlignment()->setVertical('center');
} catch (PHPExcel_Exception $e) {
}

//style cellule bordure
try {
  $feuille_MOE->getStyle('A1:C'.$ltotal)->applyFromArray(
    array(
      'font' => array(
        'bold' => false,
        'name' => 'Calibri',
        'size' => 10,
      ),
    )
  );
  $feuille_MOE->getStyle('A1')->applyFromArray(
    array(
      'font' => array(
        'bold' => true,
        'name' => 'Calibri',
        'size' => 16,
      ),
    )
  );
  $feuille_MOE->getStyle('A'.($ligne-4))->applyFromArray(
    array(
      'font' => array(
        'bold' => true,
        'name' => 'Calibri',
        'size' => 10,
      ),
    )
  );
  $feuille_MOE->getStyle('A1:C'.$ltotal)->applyFromArray(
    array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
        )
      ),
    )
  );
  $ltotalresultat = $ligne - 4 ;
  $feuille_MOE->getStyle('A'.$ltotalresultat.':F'.$ligne)->applyFromArray(
    array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
        )
      ),
    )
  );
} catch (PHPExcel_Exception $e) {
}


// Mise en page impression
$haut = 1.4/2.54;
$bas = 1/2.54;
$droite = 0.5/2.54;
$gauche = 0.5/2.54;
$header = 0/2.54;
$footer = 0.5/2.54;
try {
  $feuille_MOE->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 3);
  $feuille_MOE->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
  $feuille_MOE->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
  $feuille_MOE->getPageSetup()->setHorizontalCentered(true);
  $feuille_MOE->getPageSetup()->setFitToPage(true);
  $feuille_MOE->getPageSetup()->setFitToWidth(1);
  $feuille_MOE->getPageSetup()->setFitToHeight(0);
  $feuille_MOE->getPageMargins()->setHeader($header);
  $feuille_MOE->getPageMargins()->setFooter($footer);
  $feuille_MOE->getPageMargins()->setTop($haut);
  $feuille_MOE->getPageMargins()->setBottom($bas);
  $feuille_MOE->getPageMargins()->setLeft($gauche);
  $feuille_MOE->getPageMargins()->setRight($droite);
} catch (PHPExcel_Exception $e) {
}

// Remplissage du tableau
$ligne = 3;
$total_dossier = 0;