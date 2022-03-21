<?php
/**
 * Created by PhpStorm.
 * User: MdSV
 * Date: 2019-03
 */
if(session_status() === PHP_SESSION_NONE){session_start(); };
/** Include PHPExcel */
require_once '../../app/database.php';
require_once '../../inc/connection.php';
require_once '../../inc/functions.php';
require_once '../../app/PHPExcel.php';
$db = new database($db_name, $db_user, $db_pass, $db_host);

use PhpOffice\PhpSpreadsheet\IOFactory;

require_once '../../app/Bootstrap.php';

?>
  <main role="main">
    <div class="container gen">
      <?php
      // $test =  extract(filter_input_array(INPUT_GET));
      $fichier = $_FILES["userfile"]["name"];
      // echo 'Le fichier importé est :'.$fichier;
      if ($fichier){
      // $fp = fopen($_FILES["userfile"]["tmp_name"],"r");
      echo     '<p align="center"> - importation réussie - </p>';
      $dossier = './Imp-Courrier/';
      $fichier = basename($_FILES['userfile']['name']);
      if(move_uploaded_file($_FILES['userfile']['tmp_name'], $dossier . $fichier)){
        echo '<p align="center"> - Upload effectué avec succès ! - </p>';
      } else {
        echo '<p align="center"> - Echec de l\'upload ! - </p>';
      }
      $excel = $dossier.$fichier;
      $fp = fopen($excel,"r");
      // Chargement du fichier Excel
      $spreadsheet = IOFactory::load($excel);
      echo '<p align="center"> - chargement fichier Excel :'.$excel.' - </p>';
      /**
       * récupération de la première feuille du fichier Excel
       * @var PHPExcel_Worksheet $sheet
       */
      // $sheet = $spreadsheet->getSheet(0);
      $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
      //echo '<pre>'.print_r($sheetData[1],true).'</pre>';
      $total = sizeof($sheetData)-1;
      ?>
      <p align="center"> - Vérification du fichier - </p>
      <p align="center"><b>Veuillez patienter ...</b></p>
      <?php
      if ($sheetData[1]['A'] == 'departDate') {
        echo '<p align="center"> - Fichier OK - </p>';
        echo '<p align="center"><b>Début de la mise à jour de la base Commune.</b></p>';
        echo '<p align="center"><b>Veuillez patienter ...</b></p>';
        $i = 2;
        $erreur = 0;
        while ($i <= sizeof($sheetData) || !empty($sheetData[$i]['A'])) {
          echo '<p> Ligne :'.$i."</p>";
          $req = 'INSERT INTO courriers_depart SET 
                              departDate = :departDate,
                              departMiseSignature = :departMiseSignature,
                              departRetourSignature = :departRetourSignature,
                              departSignataire = :departSignataire,
                              departNumero = :departNumero,
                              departCode = :departCode,
                              departAuteur = :departAuteur,
                              departDocument = :departDocument,
                              departDestinataire = :departDestinataire,
                              departObjet = :departObjet,
                              departDossier = :departDossier,
                              departLien = :departLien,
                              departStockage = :departStockage
                              ';
          $rep = array(
            'departDate' => $sheetData[$i]['A'],
            'departMiseSignature' => $sheetData[$i]['B'],
            'departRetourSignature' => $sheetData[$i]['C'],
            'departSignataire' => $sheetData[$i]['D'],
            'departNumero' => $sheetData[$i]['E'],
            'departCode' => $sheetData[$i]['F'],
            'departAuteur' => $sheetData[$i]['G'],
            'departDocument' => $sheetData[$i]['H'],
            'departDestinataire' => $sheetData[$i]['I'],
            'departObjet' => $sheetData[$i]['J'],
            'departDossier' => $sheetData[$i]['K'],
            'departLien' => $sheetData[$i]['L'],
            'departStockage' => $sheetData[$i]['M']
          );
            $db->prepare($req, $rep);
          $i++;}
        ?>
        <p align="center"> -Transfert OK- </p>
        <p align="center"><b> <?php echo $total; ?> communes mises à jour et <?php echo $erreur; ?> erreur(s) trouvée(s).</b></p>
        <?php
      }else{
        ?>
        <p align="center"> - importation échouée - </p>
        <p align="center"><b>Désolé, mais le fichier n'est pas au bon format !!!</b></p>
        <?php
      }
      ?>
    </div>
    <?php
    exit();
    };
    // Chargement du fichier Excel
    $spreadsheet = IOFactory::load($fichier);
    echo $spreadsheet;
    /**
     * récupération de la première feuille du fichier Excel
     * @var PHPExcel_Worksheet $sheet
     */
    // $sheet = $spreadsheet->getSheet(0);
    $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    echo '<pre>'.print_r($sheetData,true).'</pre>';
    echo sizeof($sheetData);
    echo '<br> affiche ligne 0 <br>';
    echo '<pre>'.print_r($sheetData[2],true).'</pre>';
    while ($i < sizeof($sheetData)){
      echo $sheetData[$i][E];
      echo'<br>';
      echo $sheetData[$i][F];
      echo '<br>';
      echo $sheetData[$i][G].'-'.$sheetData[$i][H];
      echo '<br>';
      $i++;
    }
    ?>
  </main>
<?php
include_once '../../template_footer/administration.php';


