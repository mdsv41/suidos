<?php
/**
 * Created by PhpStorm.
 * User: MdSV
 * Date: 2019/02
 */

/*
 *
 *  Gestion du temps par prestation incluse
 *
 */


/*
 *  Entete tableau et mise en forme
 */

//Entete tableau donnée
$feuille_AMO->setCellValue('A1',$annee);
$feuille_AMO->setCellValue('A2','Dossier');
$feuille_AMO->setCellValue('B2','Prestation');
$feuille_AMO->setCellValue('C2','temps 1/2J');

//Largeur des colonnes
$feuille_AMO->getColumnDimension('A')->setWidth(40);
$feuille_AMO->getColumnDimension('B')->setWidth(30);
$feuille_AMO->getColumnDimension('C')->setWidth(10);
$feuille_AMO->getColumnDimension('D')->setWidth(10);
$feuille_AMO->getColumnDimension('E')->setWidth(12);
$feuille_AMO->getColumnDimension('E')->setWidth(10);

//Fusion des cellules
try {
  $feuille_AMO->mergeCells('A1:C1');
} catch (PHPExcel_Exception $e) {
}

//Allignement cellule
try {
  $feuille_AMO->getStyle('A1:C2')->getAlignment()->setHorizontal('center');
  $feuille_AMO->getStyle('A1:C2')->getAlignment()->setVertical('center');
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
$besoin = array('min' => 100, 'total' => 0, 'max' => 0, 'nbre' => 0);
$progtrv = array('min' => 100, 'total' => 0, 'max' => 0, 'nbre' => 0);
$consultMOE = array('min' => 100, 'total' => 0, 'max' => 0, 'nbre' => 0);
$datas = $db->query("SELECT * FROM dossier WHERE d1_mission = 'AMO' OR d2_mission = 'AMO' OR d3_mission = 'AMO' ORDER BY commune ASC");
foreach ($datas as $data) {
  if(!empty($data->ad_progbesoin_envoi)){
    if ($annee == substr($data->ad_progbesoin_envoi,0,4)) {
      if ($data->amo_besoin_tp < $besoin['min'] && $data->amo_besoin_tp > $besoin['max']){
        $besoin['min'] = $data->amo_besoin_tp;
        $besoin['max'] = $data->amo_besoin_tp;
      } elseif ($data->amo_besoin_tp > $besoin['max']){
        $besoin['max'] = $data->amo_besoin_tp;
      } elseif ($data->amo_besoin_tp < $besoin['min']){
        $besoin['min'] = $data->amo_besoin_tp;
      }
      $besoin['total'] = $besoin['total'] + $data->amo_besoin_tp;
      $besoin['nbre'] = $besoin['nbre'] + 1;
      $prestation = "Programme des besoins";
      $feuille_AMO->setCellValue('A'.$ligne,$data->numero.'-'.$data->commune);
      $feuille_AMO->setCellValue('B'.$ligne,$prestation);
      $feuille_AMO->setCellValue('C'.$ligne,$data->amo_besoin_tp);
      $ligne = $ligne +1;
    }
  }
  if(!empty($data->ad_progtravaux_envoi)){
    if ($annee == substr($data->ad_progtravaux_envoi,0,4)) {
      if ($data->amo_progtrvx_tp < $progtrv['min'] && $data->amo_progtrvx_tp > $progtrv['max']){
        $progtrv['min'] = $data->amo_progtrvx_tp;
        $progtrv['max'] = $data->amo_progtrvx_tp;
      } elseif ($data->amo_progtrvx_tp > $progtrv['max']){
        $progtrv['max'] = $data->amo_progtrvx_tp;
      } elseif ($data->amo_progtrvx_tp < $progtrv['min']){
        $progtrv['min'] = $data->amo_progtrvx_tp;
      }
      $progtrv['total'] = $progtrv['total'] + $data->amo_progtrvx_tp;
      $progtrv['nbre'] = $progtrv['nbre'] + 1;
      $prestation = "Programme des Travaux";
      $feuille_AMO->setCellValue('A'.$ligne,$data->numero.'-'.$data->commune);
      $feuille_AMO->setCellValue('B'.$ligne,$prestation);
      $feuille_AMO->setCellValue('C'.$ligne,$data->amo_progtrvx_tp);
      $ligne = $ligne +1;
    }
  }
  if(!empty($data->ad_consultmoe_rapport)){
    if ($annee == substr($data->ad_consultmoe_rapport,0,4)) {
      if ($data->amo_consultMO_tp < $consultMOE['min'] && $data->amo_consultMO_tp > $consultMOE['max']){
        $consultMOE['min'] = $data->amo_consultMO_tp;
        $consultMOE['max'] = $data->amo_consultMO_tp;
      } elseif ($data->amo_consultMO_tp > $consultMOE['max']){
        $consultMOE['max'] = $data->amo_consultMO_tp;
      } elseif ($data->amo_consultMO_tp < $consultMOE['min']){
        $consultMOE['min'] = $data->amo_consultMO_tp;
      }
      $consultMOE['total'] = $consultMOE['total'] + $data->amo_consultMO_tp;
      $consultMOE['nbre'] = $consultMOE['nbre'] + 1;
      $prestation = "Consultation MOE";
      $feuille_AMO->setCellValue('A'.$ligne,$data->numero.'-'.$data->commune);
      $feuille_AMO->setCellValue('B'.$ligne,$prestation);
      $feuille_AMO->setCellValue('C'.$ligne,$data->amo_consultMO_tp);
      $ligne = $ligne +1;
    }
  }
}

$ltotal = $ligne-1;
$ligne = $ligne + 2;
$feuille_AMO->setCellValue('A'.$ligne,'Prestation');
$feuille_AMO->setCellValue('B'.$ligne,'Pourcentage dossier');
$feuille_AMO->setCellValue('C'.$ligne,'nombres');
$feuille_AMO->setCellValue('D'.$ligne, 'min');
$feuille_AMO->setCellValue('E'.$ligne,'Moyenne');
$feuille_AMO->setCellValue('F'.$ligne,'Max');
$ligne = $ligne+1;

$nbreTotal = ($besoin['nbre'] + $progtrv['nbre'] + $consultMOE['nbre']);

$feuille_AMO->setCellValue('A'.$ligne,'Programme des Besoins');
if($besoin['nbre'] == 0 ){
  $feuille_AMO->setCellValue('B'.$ligne,0);
  $feuille_AMO->setCellValue('C'.$ligne,0);
  $feuille_AMO->setCellValue('D'.$ligne,0);
  $feuille_AMO->setCellValue('E'.$ligne,0);
  $feuille_AMO->setCellValue('F'.$ligne,0);
}else {
  $feuille_AMO->setCellValue('B'.$ligne,$besoin['nbre']/$nbreTotal);
  $feuille_AMO->setCellValue('C'.$ligne,$besoin['nbre']);
  $feuille_AMO->setCellValue('D'.$ligne,$besoin['min']);
  $feuille_AMO->setCellValue('E' . $ligne, $besoin['total'] / $besoin['nbre']);
  $feuille_AMO->setCellValue('F'.$ligne,$besoin['max']);
}
$feuille_AMO->getStyle('E'.$ligne.':E'.$ligne)->getNumberFormat()->applyFromArray(["code" => PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00]);
$feuille_AMO->getStyle('B'.$ligne.':B'.$ligne)->getNumberFormat()->applyFromArray(["code" => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00]);
$ligne = $ligne+1;

$feuille_AMO->setCellValue('A'.$ligne,'Programme des Travaux');
if($progtrv['nbre'] == 0 ){
  $feuille_AMO->setCellValue('B'.$ligne,0);
  $feuille_AMO->setCellValue('C'.$ligne,0);
  $feuille_AMO->setCellValue('D'.$ligne,0);
  $feuille_AMO->setCellValue('E'.$ligne,0);
  $feuille_AMO->setCellValue('F'.$ligne,0);
}else{
  $feuille_AMO->setCellValue('B'.$ligne,$progtrv['nbre']/$nbreTotal);
  $feuille_AMO->setCellValue('C'.$ligne,$progtrv['nbre']);
  $feuille_AMO->setCellValue('D'.$ligne,$progtrv['min']);
  $feuille_AMO->setCellValue('E' . $ligne, $progtrv['total'] / $progtrv['nbre']);
  $feuille_AMO->setCellValue('F'.$ligne,$progtrv['max']);
}
$feuille_AMO->getStyle('E'.$ligne.':E'.$ligne)->getNumberFormat()->applyFromArray(["code" => PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00]);
$feuille_AMO->getStyle('B'.$ligne.':B'.$ligne)->getNumberFormat()->applyFromArray(["code" => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00]);
$ligne = $ligne+1;

$feuille_AMO->setCellValue('A'.$ligne,'Consultation MOE');
if($consultMOE['nbre'] == 0){
  $feuille_AMO->setCellValue('B'.$ligne,0);
  $feuille_AMO->setCellValue('C'.$ligne,0);
  $feuille_AMO->setCellValue('D'.$ligne,0);
  $feuille_AMO->setCellValue('E'.$ligne,0);
  $feuille_AMO->setCellValue('F'.$ligne,0);
}else{
  $feuille_AMO->setCellValue('B'.$ligne,$consultMOE['nbre']/$nbreTotal);
  $feuille_AMO->setCellValue('C'.$ligne,$consultMOE['nbre']);
  $feuille_AMO->setCellValue('D'.$ligne,$consultMOE['min']);
  $feuille_AMO->setCellValue('E'.$ligne,$consultMOE['total']/$consultMOE['nbre']);
  $feuille_AMO->setCellValue('F'.$ligne,$consultMOE['max']);
}
$feuille_AMO->getStyle('E'.$ligne.':E'.$ligne)->getNumberFormat()->applyFromArray(["code" => PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00]);
$feuille_AMO->getStyle('B'.$ligne.':B'.$ligne)->getNumberFormat()->applyFromArray(["code" => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00]);
$ligne = $ligne+1;

$feuille_AMO->setCellValue('B'.$ligne,'Total');
$feuille_AMO->setCellValue('C'.$ligne,$nbreTotal);


//Allignement cellule
try {
  $feuille_AMO->getStyle('B3:C'.$ltotal)->getAlignment()->setHorizontal('center');
  $feuille_AMO->getStyle('A'.$ltotal)->getAlignment()->setHorizontal('left');
  $feuille_AMO->getStyle('A1:C'.$ltotal)->getAlignment()->setVertical('center');
} catch (PHPExcel_Exception $e) {
}

//style cellule bordure
try {
  $feuille_AMO->getStyle('A1:C'.$ltotal)->applyFromArray(
    array(
      'font' => array(
        'bold' => false,
        'name' => 'Calibri',
        'size' => 10,
      ),
    )
  );
  $feuille_AMO->getStyle('A1')->applyFromArray(
    array(
      'font' => array(
        'bold' => true,
        'name' => 'Calibri',
        'size' => 16,
      ),
    )
  );
  $feuille_AMO->getStyle('A'.($ligne-4))->applyFromArray(
    array(
      'font' => array(
        'bold' => true,
        'name' => 'Calibri',
        'size' => 10,
      ),
    )
  );
  $feuille_AMO->getStyle('A1:C'.$ltotal)->applyFromArray(
    array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
        )
      ),
    )
  );
  $ltotalresultat = $ligne - 4 ;
  $feuille_AMO->getStyle('A'.$ltotalresultat.':F'.$ligne)->applyFromArray(
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
  $feuille_AMO->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 3);
  $feuille_AMO->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
  $feuille_AMO->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
  $feuille_AMO->getPageSetup()->setHorizontalCentered(true);
  $feuille_AMO->getPageSetup()->setFitToPage(true);
  $feuille_AMO->getPageSetup()->setFitToWidth(1);
  $feuille_AMO->getPageSetup()->setFitToHeight(0);
  $feuille_AMO->getPageMargins()->setHeader($header);
  $feuille_AMO->getPageMargins()->setFooter($footer);
  $feuille_AMO->getPageMargins()->setTop($haut);
  $feuille_AMO->getPageMargins()->setBottom($bas);
  $feuille_AMO->getPageMargins()->setLeft($gauche);
  $feuille_AMO->getPageMargins()->setRight($droite);
} catch (PHPExcel_Exception $e) {
}
