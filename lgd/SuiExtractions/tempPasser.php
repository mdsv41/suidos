<?php
/**
 * Created by PhpStorm.
 * User: MdSV
 * Date: 2019-02
 */

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Include  */
require_once '../../app/database.php';
require_once '../../inc/connection.php';
require_once '../../inc/functions.php';
require_once '../../app/PHPExcel.php';
$db = new database($db_name, $db_user, $db_pass, $db_host);

// Création d'un nouvelle objet PHPexcel
$classeur = new PHPExcel;

// Définiton de l'année choisi
$annee = $_GET['annee_pi'];

//definition de la feuille
try {
  $feuille_PI = $classeur->getActiveSheet();
  $feuille_PI->setTitle('PI');
  $feuille_AMO = $classeur->createSheet(1);
  $feuille_AMO->setTitle('AMO');
  $feuille_MOE = $classeur->createSheet(2);
  $feuille_MOE->setTitle('MOE');
} catch (PHPExcel_Exception $e) {
  echo 'Erreur :'.$e;
}

require 'tempPasser_PI.php';
require 'tempPasser_AMO.php';
require 'tempPasser_MOE.php';

// Export du fichier excel
$fichier = 'Statistique-Temps-Passe-'.$annee.'.xls';

$ecrire = new PHPExcel_Writer_Excel5($classeur);
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition:inline;filename="'.$fichier.'"');
try {
  $ecrire->save('php://output');
} catch (PHPExcel_Writer_Exception $e) {
}