<?php

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
date_default_timezone_set('Europe/London');
/** Include PHPExcel */
require_once '../../app/database.php';
require_once '../../inc/connection.php';
require_once '../../inc/functions.php';
require_once '../../app/PHPExcel.php';
$db = new database($db_name, $db_user, $db_pass, $db_host);




$classeur = new PHPExcel();
// Set document properties

// Create a first sheet

$feuille = $classeur->getActiveSheet();
$feuille->setTitle('Liste d\'emmargement');


//      - insertion logo
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('PHPExcel logo');
$objDrawing->setDescription('PHPExcel logo');
$objDrawing->setPath('../img/LogoATD.jpg');
$objDrawing->setHeight(70);
$objDrawing->setCoordinates('D1');
$objDrawing->setOffsetX(-30);
$objDrawing->setOffsetY(-10);
$objDrawing->setWorksheet($classeur->getActiveSheet());

//
// Entête colonne
//

// Contenu
$feuille->setCellValue('A2', "Commune Adhérente");
$feuille->setCellValue('B2', "Nom du Représentant légal");
$feuille->setCellValue('C2', "Nom de la personne remplaçant le Représentant légal");
$feuille->setCellValue('D2', "Signature");

// Format
$feuille->getColumnDimension('A')->setWidth(35);
$feuille->getColumnDimension('B')->setWidth(25);
$feuille->getColumnDimension('C')->setWidth(25);
$feuille->getColumnDimension('D')->setWidth(35);
$feuille->getRowDimension(1,1)->setRowHeight(60);
$feuille->getStyle('A2:D2')->getAlignment()->setHorizontal('center');
$feuille->getStyle('A2:D2')->getAlignment()->setVertical('center');
$feuille->getStyle('A2:D2')->getAlignment()->setWrapText(true);
$feuille->getStyle('A2:D2')->applyFromArray(
    array(
        'font' => array(
            'bold'=>true,
            'name'=>'Calibri',
            'size'=>14,
            'color'=>array(
                'rgb'=>'000000')
        ),
        'borders'=> array(
            'allborders'=>array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color'=>array(
                    'rgb'=>'A0A0A0'
                )
            )
        )
    )
);



//
// Contenu tableau
//

// Variable

$i = 3;

// Requete
$req = $db->query('SELECT * FROM commune WHERE adhesion = "OUI" ORDER BY nom ASC');

// Remplissage du tableau
foreach ($req as $datas){

    // Contenue
    $feuille->setCellValue('A' . $i, $datas->nom);
    $feuille->setCellValue('B' . $i, $datas->representant);
    $feuille->setCellValue('C' . $i,'');
    $feuille->setCellValue('D' . $i, '');

    // Format
    $feuille->getStyle('A'.$i.':D'.$i)->getAlignment()->setVertical('center');
    $feuille->getStyle('A'.$i.':D'.$i)->getAlignment()->setWrapText(true);
    $feuille->getRowDimension($i,$i)->setRowHeight(40);
    $feuille->getStyle('A'.$i.':A'.$i)->applyFromArray(
        array(
            'font' => array(
                'bold'=>true,
                'name'=>'Calibri',
                'size'=>14,
                'color'=>array(
                    'rgb'=>'000000')
            ),
            'borders'=> array(
                'allborders'=>array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color'=>array(
                        'rgb'=>'A0A0A0'
                    )
                )
            )
        )
    );
    $feuille->getStyle('B'.$i.':D'.$i)->applyFromArray(
        array(
            'font' => array(
                'bold'=>true,
                'name'=>'Calibri',
                'size'=>11,
                'color'=>array(
                    'rgb'=>'000000')
            ),
            'borders'=> array(
                'allborders'=>array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color'=>array(
                        'rgb'=>'A0A0A0'
                    )
                )
            )
        )
    );
    $i++;
}


//
// Mise en page impression
//

// Zone d'impression
$feuille->getPageSetup()->setPrintArea('A1:D'.$i);


// Entête de page
$classeur->getActiveSheet()->getHeaderFooter()->setOddHeader('');
$classeur->getActiveSheet()->getHeaderFooter()->setEvenHeader('');


// Pied de page
$classeur->getActiveSheet()->getHeaderFooter()->setOddFooter('&R&D &T&C&F&LPage &P / &N');
$classeur->getActiveSheet()->getHeaderFooter()->setEvenFooter('&L&D &T&C&F&RPage &P / &N');

// ligne répéter en début de tableau
$classeur->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1,2);


// Format d'impression
$feuille->getPageSetup()->setOrientation(
    PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT)
    ->setFitToWidth(1)
    ->setFitToHeight(0);



// Téléchargement du fichier

$fichier = 'Export - liste emmargement.xls';

$ecrire = new PHPExcel_Writer_Excel5($classeur);
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition:inline;filename="'.$fichier.'"');
$ecrire->save('php://output');
