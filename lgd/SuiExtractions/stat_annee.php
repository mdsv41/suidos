<?php
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

// define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Include  */
require_once '../../app/database.php';
require_once '../../inc/connection.php';
require_once '../../inc/functions.php';
require_once '../../app/PHPExcel.php';
$db = new database($db_name, $db_user, $db_pass, $db_host);

// Création d'un nouvelle objet PHPexcel
$classeur = new PHPExcel;

// Définiton de l'année choisi
$annee = $_GET['annee'];

//definition de la feuille
try {
  $feuille = $classeur->getActiveSheet();
} catch (PHPExcel_Exception $e) {
}
$feuille->setTitle('Statistique études');


//
//Entete tableau et mise en forme
//

//Entete tableau donnée
$feuille->setCellValue('A1', $annee);
$feuille->setCellValue('B1', 'AMO');
$feuille->setCellValue('L1', 'Prog. Travaux');
$feuille->setCellValue('M1', 'MOE');
$feuille->setCellValue('S1', 'preop');
$feuille->setCellValue('T1', 'Total livré');
$feuille->setCellValue('B2', 'INCLUSE');
$feuille->setCellValue('F2', 'PAYANTE');
$feuille->setCellValue('M2', 'PAYANTE');
$feuille->setCellValue('A3', 'Commune');
$feuille->setCellValue('B3', 'Voirie');
$feuille->setCellValue('C3', 'Sécurité');
$feuille->setCellValue('D3', 'DSR');
$feuille->setCellValue('E3', 'OA');
$feuille->setCellValue('F3', 'Voirie');
$feuille->setCellValue('G3', 'Sécurité');
$feuille->setCellValue('H3', 'Esp pub');
$feuille->setCellValue('I3', 'Ass');
$feuille->setCellValue('J3', 'Conseil');
$feuille->setCellValue('K3', 'OA');
$feuille->setCellValue('M3', 'Voirie');
$feuille->setCellValue('N3', 'Sécurité');
$feuille->setCellValue('O3', 'Esp pub');
$feuille->setCellValue('P3', 'Ass');
$feuille->setCellValue('Q3', 'Conseil');
$feuille->setCellValue('R3', 'OA');

//Largeur des colonnes
$feuille->getColumnDimension('A')->setWidth(40);
$feuille->getColumnDimension('B')->setWidth(8);
$feuille->getColumnDimension('C')->setWidth(8);
$feuille->getColumnDimension('D')->setWidth(8);
$feuille->getColumnDimension('E')->setWidth(8);
$feuille->getColumnDimension('F')->setWidth(8);
$feuille->getColumnDimension('G')->setWidth(8);
$feuille->getColumnDimension('H')->setWidth(8);
$feuille->getColumnDimension('I')->setWidth(8);
$feuille->getColumnDimension('J')->setWidth(8);
$feuille->getColumnDimension('K')->setWidth(8);
$feuille->getColumnDimension('L')->setWidth(8);
$feuille->getColumnDimension('M')->setWidth(8);
$feuille->getColumnDimension('N')->setWidth(8);
$feuille->getColumnDimension('O')->setWidth(8);
$feuille->getColumnDimension('P')->setWidth(8);
$feuille->getColumnDimension('Q')->setWidth(8);
$feuille->getColumnDimension('R')->setWidth(8);
$feuille->getColumnDimension('S')->setWidth(8);
$feuille->getColumnDimension('T')->setWidth(8);

//Fusion des cellules
try {
  $feuille->mergeCells('A1:A2');
  $feuille->mergeCells('B1:K1');
  $feuille->mergeCells('L1:L3');
  $feuille->mergeCells('M1:R1');
  $feuille->mergeCells('S1:S3');
  $feuille->mergeCells('T1:T3');
  $feuille->mergeCells('B2:E2');
  $feuille->mergeCells('F2:K2');
  $feuille->mergeCells('M2:R2');
} catch (PHPExcel_Exception $e) {
}


//Allignement cellule
try {
  $feuille->getStyle('A1:T3')->getAlignment()->setHorizontal('center');
  $feuille->getStyle('A1:T3')->getAlignment()->setVertical('center');
} catch (PHPExcel_Exception $e) {
}


// Remplissage du tableau
$ligne = 4;
$total_dossier = null;


$req = $db->query('SELECT * FROM dossier ORDER BY commune ASC ');
foreach ($req as $datas) {

  // Variable pour les AMO Incluse
  $pi_voirie = null;
  $pi_securite = null;
  $pi_dsr = null;
  $pi_oa = null;
  // Variable pour les AMO Payante
  $amo_securite = null;
  $amo_esp_pub = null;
  $amo_voirie = null;
  $amo_assainis = null;
  $amo_conseil = null;
  $amo_OA = null;
  // Variable pour les MOE Payante
  $moe_securite = null;
  $moe_esp_pub = null;
  $moe_voirie = null;
  $moe_assainis = null;
  $moe_conseil = null;
  $moe_OA = null;
  // Variable pour les PREOP
  $preop = null;
  // Variable pour les Programme des Travaux
  $progTrvx = null;

  //
  // Prestation Incluse
  //
  if (date("Y", strtotime($datas->ad_pi_envoi)) == $annee) {
    if ($datas->d1_facture == 'Cotisation') {
      switch ($datas->d1_prestation) {
        case 'Pré-diagnostic de voirie':
          $pi_voirie = $pi_voirie + 1;
          break;
        case 'Diagnostic de sécurité':
          $pi_securite = $pi_securite + 1;
          break;
        case 'Dossier DSR':
          $pi_dsr = $pi_dsr + 1;
          break;
        case "Ouvrages d'Art":
          $pi_oa = $pi_oa + 1;
          break;
      }
    } elseif ($datas->d2_facture == 'Cotisation') {
      switch ($datas->d2_prestation) {
        case 'Pré-diagnostic de voirie':
          $pi_voirie = $pi_voirie + 1;
          break;
        case 'Diagnostic de sécurité':
          $pi_securite = $pi_securite + 1;
          break;
        case 'Dossier DSR':
          $pi_dsr++;
          break;
        case "Ouvrages d'Art":
          $pi_oa = $pi_oa + 1;
          break;
      }
    } elseif ($datas->d3_facture == 'Cotisation') {
      switch ($datas->d3_prestation) {
        case 'Pré-diagnostic de voirie':
          $pi_voirie = $pi_voirie + 1;
          break;
        case 'Diagnostic de sécurité':
          $pi_securite = $pi_securite + 1;
          break;
        case 'Dossier DSR':
          $pi_dsr = $pi_dsr + 1;
          break;
        case "Ouvrages d'Art":
          $pi_oa = $pi_oa + 1;
          break;
      }
    } else {
      // $pi_voirie = 'erreur';
    }
  }

  //
  // AMO PAYANTE
  //

  if (date("Y", strtotime($datas->ad_progbesoin_envoi)) == $annee) {
    if ($datas->d1_rendu == 'Programme besoin' || $datas->d1_rendu == 'Programme pluriannuel') {
      switch ($datas->d1_prestation) {
        case "Ouvrages d'Art":
          $amo_OA = $amo_OA + 1;
          break;
        case "Aménagements de sécurité":
          $amo_securite = $amo_securite + 1;
          break;
        case "Aménagements espaces publics":
          $amo_esp_pub = $amo_esp_pub + 1;
          break;
        case "Assainissemet pluviale":
          $amo_assainis = $amo_assainis + 1;
          break;
        case "Programme entretien":
        case "Travaux de voirie":
          $amo_voirie = $amo_voirie + 1;
          break;
        case "Vacation":
          $amo_conseil = $amo_conseil + 1;
          break;
      }
    } elseif ($datas->d2_rendu == 'Programme besoin' || $datas->d1_rendu == 'Programme pluriannuel') {
      switch ($datas->d2_prestation) {
        case "Ouvrages d'Art":
          $amo_OA = $amo_OA + 1;
          break;
        case "Aménagements de sécurité":
          $amo_securite = $amo_securite + 1;
          break;
        case "Aménagements espaces publics":
          $amo_esp_pub = $amo_esp_pub + 1;
          break;
        case "Assainissemet pluviale":
          $amo_assainis = $amo_assainis + 1;
          break;
        case "Programme entretien":
        case "Travaux de voirie":
          $amo_voirie = $amo_voirie + 1;
          break;
        case "Vacation":
          $amo_conseil = $amo_conseil + 1;
          break;
      }
    } elseif ($datas->d3_rendu == 'Programme besoin' || $datas->d1_rendu == 'Programme pluriannuel') {
      switch ($datas->d3_prestation) {
        case "Ouvrages d'Art":
          $amo_OA = $amo_OA + 1;
          break;
        case "Aménagements de sécurité":
          $amo_securite = $amo_securite + 1;
          break;
        case "Aménagements espaces publics":
          $amo_esp_pub = $amo_esp_pub + 1;
          break;
        case "Assainissemet pluviale":
          $amo_assainis = $amo_assainis + 1;
          break;
        case "Programme entretien":
        case "Travaux de voirie":
          $amo_voirie = $amo_voirie + 1;
          break;
        case "Vacation":
          $amo_conseil = $amo_conseil + 1;
          break;
      }
    } else {
      // $amo_voirie = 'Errreur';
    }
  }

  if (date("Y", strtotime($datas->ad_consultmoe_marche)) == $annee) {
    if ($datas->d1_rendu == 'Consultation MOE') {
      switch ($datas->d1_prestation) {
        case "Ouvrages d'Art":
          $amo_OA = $amo_OA + 1;
          break;
        case "Aménagements de sécurité":
          $amo_securite = $amo_securite + 1;
          break;
        case "Aménagements espaces publics":
          $amo_esp_pub = $amo_esp_pub + 1;
          break;
        case "Assainissemet pluviale":
          $amo_assainis = $amo_assainis + 1;
          break;
        case "Programme entretien":
        case "Travaux de voirie":
          $amo_voirie = $amo_voirie + 1;
          break;
        case "Vacation":
          $amo_conseil = $amo_conseil + 1;
          break;
      }
    } elseif ($datas->d2_rendu == 'Consultation MOE') {
      switch ($datas->d2_prestation) {
        case "Ouvrages d'Art":
          $amo_OA = $amo_OA + 1;
          break;
        case "Aménagements de sécurité":
          $amo_securite = $amo_securite + 1;
          break;
        case "Aménagements espaces publics":
          $amo_esp_pub = $amo_esp_pub + 1;
          break;
        case "Assainissemet pluviale":
          $amo_assainis = $amo_assainis + 1;
          break;
        case "Programme entretien":
        case "Travaux de voirie":
          $amo_voirie = $amo_voirie + 1;
          break;
        case "Vacation":
          $amo_conseil = $amo_conseil + 1;
          break;
      }
    } elseif ($datas->d3_rendu == 'Consultation MOE') {
      switch ($datas->d3_prestation) {
        case "Ouvrages d'Art":
          $amo_OA = $amo_OA + 1;
          break;
        case "Aménagements de sécurité":
          $amo_securite = $amo_securite + 1;
          break;
        case "Aménagements espaces publics":
          $amo_esp_pub = $amo_esp_pub + 1;
          break;
        case "Assainissemet pluviale":
          $amo_assainis = $amo_assainis + 1;
          break;
        case "Programme entretien":
        case "Travaux de voirie":
          $amo_voirie = $amo_voirie + 1;
          break;
        case "Vacation":
          $amo_conseil = $amo_conseil + 1;
          break;
      }
    } else {
      // $amo_voirie = 'Errreur';
    }
  }

  //
  // MOE PAYANTE
  //
  if (date("Y", strtotime($datas->ad_moe_avp_pro_envoi)) == $annee) {
    if ($datas->d1_rendu == 'AVP/PRO') {
      switch ($datas->d1_prestation) {
        case "Ouvrages d'Art":
          $moe_OA = $moe_OA + 1;
          break;
        case "Aménagements de sécurité":
          $moe_securite = $moe_securite + 1;
          break;
        case "Aménagements espaces publics":
          $moe_esp_pub = $moe_esp_pub + 1;
          break;
        case "Assainissemet pluviale":
          $moe_assainis = $moe_assainis + 1;
          break;
        case "Programme entretien":
        case "Travaux de voirie":
          $moe_voirie = $moe_voirie + 1;
          break;
        case "Vacation":
          $moe_conseil = $moe_conseil + 1;
          break;
      }
    } elseif ($datas->d2_rendu == 'AVP/PRO') {
      switch ($datas->d2_prestation) {
        case "Ouvrages d'Art":
          $moe_OA = $moe_OA + 1;
          break;
        case "Aménagements de sécurité":
          $moe_securite = $moe_securite + 1;
          break;
        case "Aménagements espaces publics":
          $moe_esp_pub = $moe_esp_pub + 1;
          break;
        case "Assainissemet pluviale":
          $moe_assainis = $moe_assainis + 1;
          break;
        case "Programme entretien":
        case "Travaux de voirie":
          $moe_voirie = $moe_voirie + 1;
          break;
        case "Vacation":
          $moe_conseil = $moe_conseil + 1;
          break;
      }
    } elseif ($datas->d3_rendu == 'AVP/PRO') {
      switch ($datas->d3_prestation) {
        case "Ouvrages d'Art":
          $moe_OA = $moe_OA + 1;
          break;
        case "Aménagements de sécurité":
          $moe_securite = $moe_securite + 1;
          break;
        case "Aménagements espaces publics":
          $moe_esp_pub = $moe_esp_pub + 1;
          break;
        case "Assainissemet pluviale":
          $moe_assainis = $moe_assainis + 1;
          break;
        case "Programme entretien":
        case "Travaux de voirie":
          $moe_voirie = $moe_voirie + 1;
          break;
        case "Vacation":
          $moe_conseil = $moe_conseil + 1;
          break;
      }
    } else {
      // $moe_voirie = 'Errreur';
    }
  }
  if (date("Y", strtotime($datas->ad_moe_dce_envoi)) == $annee) {
    if ($datas->d1_rendu == 'DCE') {
      switch ($datas->d1_prestation) {
        case "Ouvrages d'Art":
          $moe_OA = $moe_OA + 1;
          break;
        case "Aménagements de sécurité":
          $moe_securite = $moe_securite + 1;
          break;
        case "Aménagements espaces publics":
          $moe_esp_pub = $moe_esp_pub + 1;
          break;
        case "Assainissemet pluviale":
          $moe_assainis = $moe_assainis + 1;
          break;
        case "Programme entretien":
        case "Travaux de voirie":
          $moe_voirie = $moe_voirie + 1;
          break;
        case "Vacation":
          $moe_conseil = $moe_conseil + 1;
          break;
      }
    } elseif ($datas->d2_rendu == 'DCE') {
      switch ($datas->d2_prestation) {
        case "Ouvrages d'Art":
          $moe_OA = $moe_OA + 1;
          break;
        case "Aménagements de sécurité":
          $moe_securite = $moe_securite + 1;
          break;
        case "Aménagements espaces publics":
          $moe_esp_pub = $moe_esp_pub + 1;
          break;
        case "Assainissemet pluviale":
          $moe_assainis = $moe_assainis + 1;
          break;
        case "Programme entretien":
        case "Travaux de voirie":
          $moe_voirie = $moe_voirie + 1;
          break;
        case "Vacation":
          $moe_conseil = $moe_conseil + 1;
          break;
      }
    } elseif ($datas->d3_rendu == 'DCE') {
      switch ($datas->d3_prestation) {
        case "Ouvrages d'Art":
          $moe_OA = $moe_OA + 1;
          break;
        case "Aménagements de sécurité":
          $moe_securite = $moe_securite + 1;
          break;
        case "Aménagements espaces publics":
          $moe_esp_pub = $moe_esp_pub + 1;
          break;
        case "Assainissemet pluviale":
          $moe_assainis = $moe_assainis + 1;
          break;
        case "Programme entretien":
        case "Travaux de voirie":
          $moe_voirie = $moe_voirie + 1;
          break;
        case "Vacation":
          $moe_conseil = $moe_conseil + 1;
          break;
      }
    } else {
      // $moe_voirie = 'Errreur';
    }
  }
  if (date("Y", strtotime($datas->ad_mtrvx_envoi)) == $annee) {
    if ($datas->d1_rendu == 'Marché travaux') {
      switch ($datas->d1_prestation) {
        case "Ouvrages d'Art":
          $moe_OA = $moe_OA + 1;
          break;
        case "Aménagements de sécurité":
          $moe_securite = $moe_securite + 1;
          break;
        case "Aménagements espaces publics":
          $moe_esp_pub = $moe_esp_pub + 1;
          break;
        case "Assainissemet pluviale":
          $moe_assainis = $moe_assainis + 1;
          break;
        case "Programme entretien":
        case "Travaux de voirie":
          $moe_voirie = $moe_voirie + 1;
          break;
        case "Vacation":
          $moe_conseil = $moe_conseil + 1;
          break;
      }
    } elseif ($datas->d2_rendu == 'Marché travaux') {
      switch ($datas->d2_prestation) {
        case "Ouvrages d'Art":
          $moe_OA = $moe_OA + 1;
          break;
        case "Aménagements de sécurité":
          $moe_securite = $moe_securite + 1;
          break;
        case "Aménagements espaces publics":
          $moe_esp_pub = $moe_esp_pub + 1;
          break;
        case "Assainissemet pluviale":
          $moe_assainis = $moe_assainis + 1;
          break;
        case "Programme entretien":
        case "Travaux de voirie":
          $moe_voirie = $moe_voirie + 1;
          break;
        case "Vacation":
          $moe_conseil = $moe_conseil + 1;
          break;
      }
    } elseif ($datas->d3_rendu == 'Marché travaux') {
      switch ($datas->d3_prestation) {
        case "Ouvrages d'Art":
          $moe_OA = $moe_OA + 1;
          break;
        case "Aménagements de sécurité":
          $moe_securite = $moe_securite + 1;
          break;
        case "Aménagements espaces publics":
          $moe_esp_pub = $moe_esp_pub + 1;
          break;
        case "Assainissemet pluviale":
          $moe_assainis = $moe_assainis + 1;
          break;
        case "Programme entretien":
        case "Travaux de voirie":
          $moe_voirie = $moe_voirie + 1;
          break;
        case "Vacation":
          $moe_conseil = $moe_conseil + 1;
          break;
      }
    } else {
      // $moe_voirie = 'Errreur';
    }
  }

  //
  // Etude pre-operationnelle
  //
  if (date("Y", strtotime($datas->ad_preop_topo_marche)) == $annee) {
    $preop = $preop + 1;
  }
  if (date("Y", strtotime($datas->ad_preop_compt_marche)) == $annee) {
    $preop = $preop + 1;
  }
  if (date("Y", strtotime($datas->ad_preop_autre_marche)) == $annee) {
    $preop = $preop + 1;
  }

  //
  // Vacation
  //
  if (date("Y", strtotime($datas->ad_vac_rapport)) == $annee) {
    if ($datas->vac_domaine == 'Vacation MOE') {
      $moe_conseil = $moe_conseil + 1;
    } else {
      $moe_conseil = $moe_conseil + 1;
    }
  }

  //
  // Programme Travaux
  //
  if (date("Y", strtotime($datas->ad_progtravaux_envoi)) == $annee) {
    $progTrvx = $progTrvx + 1;
  }


  $verif = $pi_voirie + $pi_securite + $pi_dsr + $pi_oa + $amo_securite + $amo_esp_pub + $amo_voirie + $amo_assainis + $amo_conseil + $amo_OA + $moe_securite + $moe_esp_pub + $moe_voirie + $moe_assainis + $moe_conseil + $preop + $moe_OA;
  if ($verif > 0) {
    $feuille->setCellValue('A' . $ligne, $datas->numero . '-' . $datas->commune);
    $feuille->setCellValue('B' . $ligne, $pi_voirie);
    $feuille->setCellValue('C' . $ligne, $pi_securite);
    $feuille->setCellValue('D' . $ligne, $pi_dsr);
    $feuille->setCellValue('E' . $ligne, $pi_oa);
    $feuille->setCellValue('F' . $ligne, $amo_voirie);
    $feuille->setCellValue('G' . $ligne, $amo_securite);
    $feuille->setCellValue('H' . $ligne, $amo_esp_pub);
    $feuille->setCellValue('I' . $ligne, $amo_assainis);
    $feuille->setCellValue('J' . $ligne, $amo_conseil);
    $feuille->setCellValue('K' . $ligne, $amo_OA);
    $feuille->setCellValue('L' . $ligne, $progTrvx);
    $feuille->setCellValue('M' . $ligne, $moe_voirie);
    $feuille->setCellValue('N' . $ligne, $moe_securite);
    $feuille->setCellValue('O' . $ligne, $moe_esp_pub);
    $feuille->setCellValue('P' . $ligne, $moe_assainis);
    $feuille->setCellValue('Q' . $ligne, $moe_conseil);
    $feuille->setCellValue('R' . $ligne, $moe_OA);
    $feuille->setCellValue('S' . $ligne, $preop);
    //TOTAL PAR LIGNE
    $feuille->setCellValue('T' . $ligne, '=SUM(B' . $ligne . ':S' . $ligne . ')');
    $ligne++;

  }

}


$ligne = $ligne - 1;
$ltotal = $ligne + 1;
$TotalDossier = $ligne - 3;

//TOTAL PAR COLONNES
$feuille->setCellValue('A' . $ltotal, 'Dossiers traités: ' . $TotalDossier);
$feuille->setCellValue('B' . $ltotal, '=SUM(B4:B' . $ligne . ')');
$feuille->setCellValue('C' . $ltotal, '=SUM(C4:C' . $ligne . ')');
$feuille->setCellValue('D' . $ltotal, '=SUM(D4:D' . $ligne . ')');
$feuille->setCellValue('E' . $ltotal, '=SUM(E4:E' . $ligne . ')');
$feuille->setCellValue('F' . $ltotal, '=SUM(F4:F' . $ligne . ')');
$feuille->setCellValue('G' . $ltotal, '=SUM(G4:G' . $ligne . ')');
$feuille->setCellValue('H' . $ltotal, '=SUM(H4:H' . $ligne . ')');
$feuille->setCellValue('I' . $ltotal, '=SUM(I4:I' . $ligne . ')');
$feuille->setCellValue('J' . $ltotal, '=SUM(J4:J' . $ligne . ')');
$feuille->setCellValue('K' . $ltotal, '=SUM(K4:K' . $ligne . ')');
$feuille->setCellValue('L' . $ltotal, '=SUM(L4:L' . $ligne . ')');
$feuille->setCellValue('M' . $ltotal, '=SUM(M4:M' . $ligne . ')');
$feuille->setCellValue('N' . $ltotal, '=SUM(N4:N' . $ligne . ')');
$feuille->setCellValue('O' . $ltotal, '=SUM(O4:O' . $ligne . ')');
$feuille->setCellValue('P' . $ltotal, '=SUM(P4:P' . $ligne . ')');
$feuille->setCellValue('Q' . $ltotal, '=SUM(Q4:Q' . $ligne . ')');
$feuille->setCellValue('R' . $ltotal, '=SUM(R4:R' . $ligne . ')');
$feuille->setCellValue('S' . $ltotal, '=SUM(S4:S' . $ligne . ')');
$feuille->setCellValue('T' . $ltotal, '=SUM(T4:T' . $ligne . ')');

$lpourcentage = $ltotal + 1;
$feuille->setCellValue('B' . $lpourcentage, '=B' . $ltotal . '/SUM(B' . $ltotal . ':E' . $ltotal . ')');
$feuille->setCellValue('C' . $lpourcentage, '=C' . $ltotal . '/SUM(B' . $ltotal . ':E' . $ltotal . ')');
$feuille->setCellValue('D' . $lpourcentage, '=D' . $ltotal . '/SUM(B' . $ltotal . ':E' . $ltotal . ')');
$feuille->setCellValue('E' . $lpourcentage, '=E' . $ltotal . '/SUM(B' . $ltotal . ':E' . $ltotal . ')');
$feuille->setCellValue('F' . $lpourcentage, '=F' . $ltotal . '/SUM(F' . $ltotal . ':K' . $ltotal . ')');
$feuille->setCellValue('G' . $lpourcentage, '=G' . $ltotal . '/SUM(F' . $ltotal . ':K' . $ltotal . ')');
$feuille->setCellValue('H' . $lpourcentage, '=H' . $ltotal . '/SUM(F' . $ltotal . ':K' . $ltotal . ')');
$feuille->setCellValue('I' . $lpourcentage, '=I' . $ltotal . '/SUM(F' . $ltotal . ':K' . $ltotal . ')');
$feuille->setCellValue('J' . $lpourcentage, '=J' . $ltotal . '/SUM(F' . $ltotal . ':K' . $ltotal . ')');
$feuille->setCellValue('K' . $lpourcentage, '=K' . $ltotal . '/SUM(F' . $ltotal . ':K' . $ltotal . ')');

$feuille->setCellValue('M' . $lpourcentage, '=M' . $ltotal . '/SUM(M' . $ltotal . ':R' . $ltotal . ')');
$feuille->setCellValue('N' . $lpourcentage, '=N' . $ltotal . '/SUM(M' . $ltotal . ':R' . $ltotal . ')');
$feuille->setCellValue('O' . $lpourcentage, '=O' . $ltotal . '/SUM(M' . $ltotal . ':R' . $ltotal . ')');
$feuille->setCellValue('P' . $lpourcentage, '=P' . $ltotal . '/SUM(M' . $ltotal . ':R' . $ltotal . ')');
$feuille->setCellValue('Q' . $lpourcentage, '=Q' . $ltotal . '/SUM(M' . $ltotal . ':R' . $ltotal . ')');
$feuille->setCellValue('R' . $lpourcentage, '=R' . $ltotal . '/SUM(M' . $ltotal . ':R' . $ltotal . ')');

try {
  $feuille->getStyle('B' . $lpourcentage . ':R' . $lpourcentage)->getNumberFormat()->applyFromArray(["code" => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE]);
} catch (PHPExcel_Exception $e) {
}


$lpourTotal = $lpourcentage + 2;
$lDossierTotal = $lpourcentage + 1;
$feuille->setCellValue('B' . $lDossierTotal, '=SUM(B' . $ltotal . ':E' . $ltotal . ')');
$feuille->setCellValue('F' . $lDossierTotal, '=SUM(F' . $ltotal . ':S' . $ltotal . ')');
$feuille->setCellValue('B' . $lpourTotal, '=SUM(B' . $ltotal . ':E' . $ltotal . ')/T' . $ltotal);
$feuille->setCellValue('F' . $lpourTotal, '=SUM(F' . $ltotal . ':S' . $ltotal . ')/T' . $ltotal);

try {
  $feuille->mergeCells('B' . $lDossierTotal . ':E' . $lDossierTotal);
  $feuille->mergeCells('F' . $lDossierTotal . ':S' . $lDossierTotal);
  $feuille->mergeCells('B' . $lpourTotal . ':E' . $lpourTotal);
  $feuille->mergeCells('F' . $lpourTotal . ':S' . $lpourTotal);

} catch (PHPExcel_Exception $e) {
}
try {
  $feuille->getStyle('B' . $lpourTotal . ':S' . $lpourTotal)->getNumberFormat()->applyFromArray(["code" => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE]);
} catch (PHPExcel_Exception $e) {
}

//Allignement cellule
try {
  $feuille->getStyle('B1:T' . $lpourTotal)->getAlignment()->setHorizontal('center');
  $feuille->getStyle('A' . $ltotal)->getAlignment()->setHorizontal('center');
  $feuille->getStyle('A1:T' . $lpourTotal)->getAlignment()->setVertical('center');
} catch (PHPExcel_Exception $e) {
}

//style cellule bordure
try {
  $feuille->getStyle('A1:T' . $lpourTotal)->applyFromArray(
    array(
      'font' => array(
        'bold' => false,
        'name' => 'Calibri',
        'size' => 10,
      ),
    )
  );
  $feuille->getStyle('A1')->applyFromArray(
    array(
      'font' => array(
        'bold' => true,
        'name' => 'Calibri',
        'size' => 16,
      ),
    )
  );
  $feuille->getStyle('A' . $ltotal)->applyFromArray(
    array(
      'font' => array(
        'bold' => true,
        'name' => 'Calibri',
        'size' => 10,
      ),
    )
  );
  $feuille->getStyle('A1:T' . $ltotal)->applyFromArray(
    array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
        )
      ),
    )
  );
  $feuille->getStyle('B' . $ligne . ':S' . $lpourTotal)->applyFromArray(
    array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
        )
      ),
    )
  );
  $feuille->getStyle('B4:T' . $ligne)->applyFromArray(
    array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_DOTTED,
        )
      ),
    )
  );
  $feuille->getStyle('B2:E' . $lpourcentage)->applyFromArray(
    array(
      'borders' => array(
        'outline' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
        )
      ),
    )
  );
  $feuille->getStyle('F2:K' . $lpourcentage)->applyFromArray(
    array(
      'borders' => array(
        'outline' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
        )
      ),
    )
  );
  $feuille->getStyle('M2:R' . $lpourcentage)->applyFromArray(
    array(
      'borders' => array(
        'outline' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
        )
      ),
    )
  );
  $feuille->getStyle('B1:K' . $lpourcentage)->applyFromArray(
    array(
      'borders' => array(
        'outline' => array(
          'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
        )
      ),
    )
  );
  $feuille->getStyle('M1:R' . $lpourcentage)->applyFromArray(
    array(
      'borders' => array(
        'outline' => array(
          'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
        )
      ),
    )
  );
  $feuille->getStyle('S1:S' . $lpourcentage)->applyFromArray(
    array(
      'borders' => array(
        'outline' => array(
          'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
        )
      ),
    )
  );
  $feuille->getStyle('T1:T' . $ltotal)->applyFromArray(
    array(
      'borders' => array(
        'outline' => array(
          'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
        )
      ),
    )
  );
  $feuille->getStyle('B' . $lpourcentage . ':S' . $lpourTotal)->applyFromArray(
    array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
        )
      ),
    )
  );
} catch (PHPExcel_Exception $e) {
}

//$feuille->getRowDimension('2')->setRowHeight(252);
try {
  $feuille->getStyle('A1:S' . $ltotal)->getAlignment()->setWrapText(true);
} catch (PHPExcel_Exception $e) {
}

// Mise en page impression
$haut = 1.4 / 2.54;
$bas = 1 / 2.54;
$droite = 0.5 / 2.54;
$gauche = 0.5 / 2.54;
$header = 0 / 2.54;
$footer = 0.5 / 2.54;
try {
  $classeur->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 3);
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


// Export du fichier excel
$fichier = 'Statistique_études-' . $annee . '.xls';

$ecrire = new PHPExcel_Writer_Excel5($classeur);
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition:inline;filename="' . $fichier . '"');
try {
  $ecrire->save('php://output');
} catch (PHPExcel_Writer_Exception $e) {
}

