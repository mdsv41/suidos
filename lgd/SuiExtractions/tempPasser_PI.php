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
$feuille_PI->setCellValue('A1',$annee);
$feuille_PI->setCellValue('A2','Dossier');
$feuille_PI->setCellValue('B2','Prestation');
$feuille_PI->setCellValue('C2','temps 1/2J');

//Largeur des colonnes
$feuille_PI->getColumnDimension('A')->setWidth(40);
$feuille_PI->getColumnDimension('B')->setWidth(30);
$feuille_PI->getColumnDimension('C')->setWidth(10);
$feuille_PI->getColumnDimension('D')->setWidth(10);
$feuille_PI->getColumnDimension('E')->setWidth(12);
$feuille_PI->getColumnDimension('E')->setWidth(10);

//Fusion des cellules
try {
  $feuille_PI->mergeCells('A1:C1');
} catch (PHPExcel_Exception $e) {
}

//Allignement cellule
try {
  $feuille_PI->getStyle('A1:C2')->getAlignment()->setHorizontal('center');
  $feuille_PI->getStyle('A1:C2')->getAlignment()->setVertical('center');
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
$diagS = array('min' => 100, 'total' => 0, 'max' => 0, 'nbre' => 0);
$diagV = array('min' => 100, 'total' => 0, 'max' => 0, 'nbre' => 0);
$diagOA = array('min' => 100, 'total' => 0, 'max' => 0, 'nbre' => 0);
$dsr = array('min' => 100, 'total' => 0, 'max' => 0, 'nbre' => 0);
$datas = $db->query('SELECT * FROM dossier ORDER BY numero ASC');
foreach ($datas as $data) {
  if(!empty($data->ad_pi_envoi) ) {
    if ($annee == substr($data->ad_pi_envoi,0,4)) {
      if ($data->d1_prestation == "Diagnostic de sécurité" || $data->d2_prestation == "Diagnostic de sécurité" || $data->d3_prestation == "Diagnostic de sécurité") {
        if ($data->amo_pi_tp < $diagS['min'] && $data->amo_pi_tp > $diagS['max']) {
          $diagS['min'] = $data->amo_pi_tp;
          $diagS['max'] = $data->amo_pi_tp;
        } elseif ($data->amo_pi_tp > $diagS['max']) {
          $diagS['max'] = $data->amo_pi_tp;
        } elseif ($data->amo_pi_tp < $diagS['min']) {
          $diagS['min'] = $data->amo_pi_tp;
        }
        $diagS['total'] = $diagS['total'] + $data->amo_pi_tp;
        $diagS['nbre'] = $diagS['nbre'] + 1;
        $prestation = "Diagnostic de sécurité";
      }
      if ($data->d1_prestation == "Pré-diagnostic de voirie" || $data->d2_prestation == "Pré-diagnostic de voirie" || $data->d3_prestation == "Pré-diagnostic de voirie") {
        if ($data->amo_pi_tp < $diagV['min'] && $data->amo_pi_tp > $diagV['max']) {
          $diagV['min'] = $data->amo_pi_tp;
          $diagV['max'] = $data->amo_pi_tp;
        } elseif ($data->amo_pi_tp > $diagV['max']) {
          $diagV['max'] = $data->amo_pi_tp;
        } elseif ($data->amo_pi_tp < $diagV['min']) {
          $diagV['min'] = $data->amo_pi_tp;
        }
        $diagV['total'] = $diagV['total'] + $data->amo_pi_tp;
        $diagV['nbre'] = $diagV['nbre'] + 1;
        $prestation = "Pré-diagnostic de voirie";
      }
      if ($data->d1_prestation == "Dossier DSR" || $data->d2_prestation == "Dossier DSR" || $data->d3_prestation == "Dossier DSR") {
        if ($data->amo_pi_tp < $dsr['min'] && $data->amo_pi_tp > $dsr['max']) {
          $dsr['min'] = $data->amo_pi_tp;
          $dsr['max'] = $data->amo_pi_tp;
        } elseif ($data->amo_pi_tp > $dsr['max']) {
          $dsr['max'] = $data->amo_pi_tp;
        } elseif ($data->amo_pi_tp < $dsr['min']) {
          $dsr['min'] = $data->amo_pi_tp;
        }
        $dsr['total'] = $dsr['total'] + $data->amo_pi_tp;
        $dsr['nbre'] = $dsr['nbre'] + 1;
        $prestation = "Dossier DSR";
      }
      if ($data->d1_prestation == "Ouvrages d'Art" || $data->d2_prestation == "Ouvrages d'Art" || $data->d3_prestation == "Ouvrages d'Art") {
        if ($data->amo_pi_tp < $diagOA['min'] && $data->amo_pi_tp > $diagOA['max']) {
          $diagOA['min'] = $data->amo_pi_tp;
          $diagOA['max'] = $data->amo_pi_tp;
        } elseif ($data->amo_pi_tp > $diagOA['max']) {
          $diagOA['max'] = $data->amo_pi_tp;
        } elseif ($data->amo_pi_tp < $diagOA['min']) {
          $diagOA['min'] = $data->amo_pi_tp;
        }
        $diagOA['total'] = $diagOA['total'] + $data->amo_pi_tp;
        $diagOA['nbre'] = $diagOA['nbre'] + 1;
        $prestation = "Ouvrage d'Art";
      }
      $feuille_PI->setCellValue('A' . $ligne, $data->numero . '-' . $data->commune);
      $feuille_PI->setCellValue('B' . $ligne, $prestation);
      $feuille_PI->setCellValue('C' . $ligne, $data->amo_pi_tp);
      $ligne = $ligne + 1;
    }
  }
}
$ltotal = $ligne-1;
$ligne = $ligne + 2;
$feuille_PI->setCellValue('A'.$ligne,'Prestation');
$feuille_PI->setCellValue('B'.$ligne,'Pourcentage dossier');
$feuille_PI->setCellValue('C'.$ligne,'nombres');
$feuille_PI->setCellValue('D'.$ligne, 'min');
$feuille_PI->setCellValue('E'.$ligne,'Moyenne');
$feuille_PI->setCellValue('F'.$ligne,'Max');
$ligne = $ligne+1;

$nbreTotal = ($diagS['nbre'] + $diagV['nbre'] + $dsr['nbre'] + $diagOA['nbre']);

$feuille_PI->setCellValue('A'.$ligne,'Diagnostic de sécurité');
if($diagS['nbre'] == 0 ){
  $feuille_PI->setCellValue('B'.$ligne,0);
  $feuille_PI->setCellValue('C'.$ligne,0);
  $feuille_PI->setCellValue('D'.$ligne,0);
  $feuille_PI->setCellValue('E'.$ligne,0);
  $feuille_PI->setCellValue('F'.$ligne,0);
}else {
  $feuille_PI->setCellValue('B'.$ligne,$diagS['nbre']/$nbreTotal);
  $feuille_PI->setCellValue('C'.$ligne,$diagS['nbre']);
  $feuille_PI->setCellValue('D'.$ligne,$diagS['min']);
  $feuille_PI->setCellValue('E' . $ligne, $diagS['total'] / $diagS['nbre']);
  $feuille_PI->setCellValue('F'.$ligne,$diagS['max']);
}
$feuille_PI->getStyle('E'.$ligne.':E'.$ligne)->getNumberFormat()->applyFromArray(["code" => PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00]);
$feuille_PI->getStyle('B'.$ligne.':B'.$ligne)->getNumberFormat()->applyFromArray(["code" => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00]);
$ligne = $ligne+1;

$feuille_PI->setCellValue('A'.$ligne,'Pré-diagnostic de voirie');
if($diagV['nbre'] == 0 ){
  $feuille_PI->setCellValue('B'.$ligne,0);
  $feuille_PI->setCellValue('C'.$ligne,0);
  $feuille_PI->setCellValue('D'.$ligne,0);
  $feuille_PI->setCellValue('E'.$ligne,0);
  $feuille_PI->setCellValue('F'.$ligne,0);
}else{
  $feuille_PI->setCellValue('B'.$ligne,$diagV['nbre']/$nbreTotal);
  $feuille_PI->setCellValue('C'.$ligne,$diagV['nbre']);
  $feuille_PI->setCellValue('D'.$ligne,$diagV['min']);
  $feuille_PI->setCellValue('E' . $ligne, $diagV['total'] / $diagV['nbre']);
  $feuille_PI->setCellValue('F'.$ligne,$diagV['max']);
}
$feuille_PI->getStyle('E'.$ligne.':E'.$ligne)->getNumberFormat()->applyFromArray(["code" => PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00]);
$feuille_PI->getStyle('B'.$ligne.':B'.$ligne)->getNumberFormat()->applyFromArray(["code" => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00]);
$ligne = $ligne+1;

$feuille_PI->setCellValue('A'.$ligne,'Dossier DSR');
if($dsr['nbre'] == 0){
  $feuille_PI->setCellValue('B'.$ligne,0);
  $feuille_PI->setCellValue('C'.$ligne,0);
  $feuille_PI->setCellValue('D'.$ligne,0);
  $feuille_PI->setCellValue('E'.$ligne,0);
  $feuille_PI->setCellValue('F'.$ligne,0);
}else{
  $feuille_PI->setCellValue('B'.$ligne,$dsr['nbre']/$nbreTotal);
  $feuille_PI->setCellValue('C'.$ligne,$dsr['nbre']);
  $feuille_PI->setCellValue('D'.$ligne,$dsr['min']);
  $feuille_PI->setCellValue('E'.$ligne,$dsr['total']/$dsr['nbre']);
  $feuille_PI->setCellValue('F'.$ligne,$dsr['max']);
}
$feuille_PI->getStyle('E'.$ligne.':E'.$ligne)->getNumberFormat()->applyFromArray(["code" => PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00]);
$feuille_PI->getStyle('B'.$ligne.':B'.$ligne)->getNumberFormat()->applyFromArray(["code" => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00]);
$ligne = $ligne+1;

$feuille_PI->setCellValue('A'.$ligne,"Ouvrage d'Art");
if($diagOA['nbre'] == 0){
  $feuille_PI->setCellValue('B'.$ligne,0);
  $feuille_PI->setCellValue('C'.$ligne,0);
  $feuille_PI->setCellValue('D'.$ligne,0);
  $feuille_PI->setCellValue('E'.$ligne,0);
  $feuille_PI->setCellValue('F'.$ligne,0);
}else{
  $feuille_PI->setCellValue('B'.$ligne,$diagOA['nbre']/$nbreTotal);
  $feuille_PI->setCellValue('C'.$ligne,$diagOA['nbre']);
  $feuille_PI->setCellValue('D'.$ligne,$diagOA['min']);
  $feuille_PI->setCellValue('E'.$ligne,$diagOA['total']/$diagOA['nbre']);
  $feuille_PI->setCellValue('F'.$ligne,$diagOA['max']);
}
$feuille_PI->getStyle('E'.$ligne.':E'.$ligne)->getNumberFormat()->applyFromArray(["code" => PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00]);
$feuille_PI->getStyle('B'.$ligne.':B'.$ligne)->getNumberFormat()->applyFromArray(["code" => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00]);
$ligne = $ligne + 1;

$feuille_PI->setCellValue('B'.$ligne,'Total');
$feuille_PI->setCellValue('C'.$ligne,$nbreTotal);


//Allignement cellule
try {
  $feuille_PI->getStyle('B3:C'.$ltotal)->getAlignment()->setHorizontal('center');
  $feuille_PI->getStyle('A'.$ltotal)->getAlignment()->setHorizontal('left');
  $feuille_PI->getStyle('A1:C'.$ltotal)->getAlignment()->setVertical('center');
} catch (PHPExcel_Exception $e) {
}

//style cellule bordure
try {
  $feuille_PI->getStyle('A1:C'.$ltotal)->applyFromArray(
    array(
      'font' => array(
        'bold' => false,
        'name' => 'Calibri',
        'size' => 10,
      ),
    )
  );
  $feuille_PI->getStyle('A1')->applyFromArray(
    array(
      'font' => array(
        'bold' => true,
        'name' => 'Calibri',
        'size' => 16,
      ),
    )
  );
  $feuille_PI->getStyle('A'.($ligne-5))->applyFromArray(
    array(
      'font' => array(
        'bold' => true,
        'name' => 'Calibri',
        'size' => 10,
      ),
    )
  );
  $feuille_PI->getStyle('A1:C'.$ltotal)->applyFromArray(
    array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
        )
      ),
    )
  );
  $ltotalresultat = $ligne - 5 ;
  $feuille_PI->getStyle('A'.$ltotalresultat.':F'.$ligne)->applyFromArray(
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
  $feuille_PI->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 3);
  $feuille_PI->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
  $feuille_PI->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
  $feuille_PI->getPageSetup()->setHorizontalCentered(true);
  $feuille_PI->getPageSetup()->setFitToPage(true);
  $feuille_PI->getPageSetup()->setFitToWidth(1);
  $feuille_PI->getPageSetup()->setFitToHeight(0);
  $feuille_PI->getPageMargins()->setHeader($header);
  $feuille_PI->getPageMargins()->setFooter($footer);
  $feuille_PI->getPageMargins()->setTop($haut);
  $feuille_PI->getPageMargins()->setBottom($bas);
  $feuille_PI->getPageMargins()->setLeft($gauche);
  $feuille_PI->getPageMargins()->setRight($droite);
} catch (PHPExcel_Exception $e) {
}