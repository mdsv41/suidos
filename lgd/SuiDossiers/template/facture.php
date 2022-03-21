<?php
/**
 * Created by PhpStorm.
 * User: manuel
 * Date: 02/05/2017
 * Time: 11:00
 */


/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** definition du temps en francais */
date_default_timezone_set('Europe/Paris');
setlocale(LC_ALL, array('fr_FR.UTF-8','fr_FR@euro','fr_FR','french'));

/** Include PHPExcel */
require_once '../../../inc/connection.php';
require_once '../../../app/database.php';
require_once '../../../app/PHPExcel.php';
require_once '../../../app/PHPExcel/IOFactory.php';
require_once '../../../inc/functions.php';
$db = new database($db_name, $db_user, $db_pass, $db_host);

// Recherche des données
$datas = $db->queryOne("SELECT * FROM dossier WHERE numero='".$_GET['numero']."'");
$facture = $db->queryOne("SELECT * FROM facture WHERE id ='".$_GET['id']."'");


if ($facture->formule == "f"){
    $form_calcul = "Forfait";
}ELSE IF ($facture->formule == "t"){
    $form_calcul = $facture->F_taux." %";
}ELSE IF ($facture->formule == "mt"){
    $form_calcul = $facture->F_min." < ".$facture->F_taux. " %";
}ELSE IF ($facture->formule == "tm"){
    $form_calcul = $facture->F_taux." %  < ".$facture->F_max;
}ELSE IF ($facture->formule == "mtm"){
    $form_calcul = $facture->F_min." < ".$facture->F_taux." %  < ".$facture->F_max;
}ELSE{
    $form_calcul = "";
};
switch ($facture->T_facture){
    case ("besoin"):
        $T_facture = "Montant besoins";
        $M_base = $facture->m_besoin;
        break;
    case ("travaux"):
        $T_facture = "Montant travaux";
        $M_base = $facture->m_travaux;
        break;
    case("estimation"):
        $T_facture = "Montant estimation";
        $M_base = $facture->m_estimation;
        break;
    default:
        $T_facture = "Montant forfaitaire";
        $M_base = $facture->F_forfait;
}

// Création d'un nouvelle objet PHPexcel
$classeur = new PHPExcel;

//definition de la feuille
try {
  $feuille = $classeur->getActiveSheet();
} catch (PHPExcel_Exception $e) {
}
$feuille->setTitle('Facture');

//Tableau donnée
$feuille->setCellValue("A12","domaine d'intervention");
$feuille->setCellValue("B12","mission");
$feuille->setCellValue("C12","rendu");
$feuille->setCellValue("D12","taux");
$feuille->setCellValue("E12",$T_facture);
$feuille->setCellValue("F12","montant à facturer");
$feuille->setCellValue("A13",$datas->domaine);
$feuille->setCellValue("B13",strtoupper($facture->mission));
$feuille->setCellValue("C13",$facture->rendu);
$feuille->setCellValue("D13",$form_calcul);
$feuille->setCellValue("E13",$M_base." €");
$feuille->setCellValue("F13",$facture->m_facture." € HT");
$feuille->setCellValue("A17","Pièces jointes :");
$feuille->setCellValue("A18","Convention");
$feuille->setCellValue("A19","Avenant n°1");
$feuille->setCellValue("E22",strftime("%A %d %B %Y"));
// $feuille->setCellValue("E24","Jaime CAMARENA");
$feuille->setCellValue("E25","responsable technique");



$feuille->setCellValue("F5","DEMANDE DE FACTURE");
$feuille->setCellValue("F7","Commune de ".$datas->commune);
$feuille->setCellValue("F8",$datas->objet);
$feuille->setCellValue("A9","dossier n° ".$facture->numero);
$feuille->setCellValue("A10","BASE DE FACTURATION");

//  - Mise en page
try {
  $feuille->getStyle('F5')->applyFromArray(
    array(
      'font' => array(
        'bold' => true,
        'name' => 'Calibri',
        'size' => 16,
        'color' => array(
          'rgb' => '0080FF'
        )
      ),
    )
  );
  $feuille->getStyle('F7')->applyFromArray(
    array(
      'font' => array(
        'bold'=>true,
        'name'=>'Calibri',
        'size'=>16,
        'color'=>array(
          'rgb'=>'0080FF'
        )
      ),
    )
  );
  $feuille->getStyle('F8')->applyFromArray(
    array(
      'font' => array(
        'bold'=>true,
        'name'=>'Calibri',
        'size'=>14,
        'color'=>array(
          'rgb'=>'0080FF'
        )
      ),
    )
  );
  $feuille->getStyle('A10')->applyFromArray(
    array(
      'font' => array(
        'bold'=>true,
        'name'=>'Calibri',
        'size'=>14,
        'color'=>array(
          'rgb'=>'0080FF'
        )
      ),
    )
  );
} catch (PHPExcel_Exception $e) {
}


//      - Largeur de colonne
$feuille->getColumnDimension('A')->setWidth(30);
$feuille->getColumnDimension('B')->setWidth(10);
$feuille->getColumnDimension('C')->setWidth(30);
$feuille->getColumnDimension('D')->setWidth(20);
$feuille->getColumnDimension('E')->setWidth(20);
$feuille->getColumnDimension('F')->setWidth(17.83);

//      -Alignement texte
try {
  $feuille->getStyle('F1:F8')->getAlignment()->setHorizontal('right');
  $feuille->getStyle('A12:F13')->getAlignment()->setHorizontal('center');
  $feuille->getStyle('E22:E25')->getAlignment()->setHorizontal('center');
} catch (PHPExcel_Exception $e) {
}



//      - insertion logo

try {
  $objDrawing = new PHPExcel_Worksheet_Drawing();
  $objDrawing->setName('PHPExcel logo');
  $objDrawing->setDescription('PHPExcel logo');
  $objDrawing->setPath('../../img/LogoATD.jpg');
  $objDrawing->setHeight(70);
  $objDrawing->setCoordinates('F2');
  $objDrawing->setOffsetX(-30);
  $objDrawing->setOffsetY(-20);
  $objDrawing->setWorksheet($classeur->getActiveSheet());
} catch (PHPExcel_Exception $e) {
}


//style cellule bordure
try {
  $feuille->getStyle('A12:F13')->applyFromArray(
    array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
        )
      )
    )
  );
} catch (PHPExcel_Exception $e) {
}


//      - Mise en page impression
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





$ecrire = new PHPExcel_Writer_Excel5($classeur);
header('Content-type: application/vnd.ms-tdb');
header('Content-Disposition: inline; filename=facture.xls');
try {
  $ecrire->save('php://output');
} catch (PHPExcel_Writer_Exception $e) {
}

//$ecrire = PHPExcel_IOFactory::createWriter($classeur,'Excel5');
//$ecrire->save(str_replace('.php', '.xls', __FILE__));
