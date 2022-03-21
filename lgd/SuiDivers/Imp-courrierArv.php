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
      if ($sheetData[1]['A'] == 'arriveDate') {
        echo '<p align="center"> - Fichier OK - </p>';
        echo '<p align="center"><b>Début de la mise à jour de la base Commune.</b></p>';
        echo '<p align="center"><b>Veuillez patienter ...</b></p>';
        $i = 2;
        $erreur = 0;
        while ($i <= sizeof($sheetData) || !empty($sheetData[$i]['A'])) {
          echo '<p> Ligne :'.$i."</p>";
          $req = 'INSERT INTO courriers_arrive SET 
                              arriveDate = :arriveDate,
                              arriveNumero = :arriveNumero,
                              arriveExpediteur = :arriveExpediteur,
                              arriveType = :arriveType,
                              arriveDocument = :arriveDocument,
                              arriveCode = :arriveCode,
                              arriveObjet = :arriveObjet,
                              arriveDossier = :arriveDossier,
                              arriveLien = :arriveLien,
                              arriveStockage = :arriveStockage
                              ';
          $rep = array(
            'arriveDate' => $sheetData[$i]['A'],
            'arriveNumero' => $sheetData[$i]['B'],
            'arriveExpediteur' => $sheetData[$i]['C'],
            'arriveType' => $sheetData[$i]['D'],
            'arriveDocument' => $sheetData[$i]['E'],
            'arriveCode' => $sheetData[$i]['F'],
            'arriveObjet' => $sheetData[$i]['G'],
            'arriveDossier' => $sheetData[$i]['H'],
            'arriveLien' => $sheetData[$i]['I'],
            'arriveStockage' => $sheetData[$i]['J']
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


