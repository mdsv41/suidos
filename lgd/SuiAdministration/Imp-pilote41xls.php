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
require_once '../../inc/dev.php';
$db = new database($db_name, $db_user, $db_pass, $db_host);
use PhpOffice\PhpSpreadsheet\IOFactory;
require_once '../../app/Bootstrap.php';

require_once '../../template_header/administration.php'
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
    $dossier = './Imp-Commune/';
    $fichier = basename($_FILES['userfile']['name']);
    if(move_uploaded_file($_FILES['userfile']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
    {
      echo '<p align="center"> - Upload effectué avec succès ! - </p>';
    }
    else //Sinon (la fonction renvoie FALSE).
    {
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
    if (
      $sheetData[1]['A'] == 'siren_siret' &&
      $sheetData[1]['B'] == 'nom' &&
      $sheetData[1]['C'] == 'Nb_Habitant'
    ){
      ?>
      <p align="center"> - Fichier OK - </p>
      <p align="center"><b>Début de la mise à jour de la base Commune.</b></p>
      <p align="center"><b>Veuillez patienter ...</b></p>
      <?php
      $i = 2;
      $erreur = 0;
      while ($i <= $total || !empty($sheetData[$i]['A'])){
        $datas = $db->queryOne("SELECT * FROM commune WHERE siren_siret ='".$sheetData[$i]['A']."'");
        if(
          !empty($datas) &&
          $sheetData[$i]['A'] == $datas->siren_siret
        ){
          $req = 'UPDATE commune
            SET 
              commune.Nb_Habitant = :Nb_Habitant
            WHERE
              commune.siren_siret = :siren_siret
              ';
          $rep = array(
            'Nb_Habitant' => $sheetData[$i]['C'],
            'siren_siret' => $sheetData[$i]['A']
          );
          $db->prepare($req,$rep);
        }ELSE{
          $erreur++;
          echo '<p> - Erreur sur la ligne :'.$i.'</p>';
          echo var_dump(strval($sheetData[$i]['A'])) . ' - ' .var_dump($sheetData[$i]['B']) . ' - ' . var_dump(intval($sheetData[$i]['C']));
        }
        $i++;}
      ?>
      <p align="center"> -Transfert OK- </p>
      <p align="center"><b> <?php echo $total; ?> communes mises à jour et <?php echo $erreur; ?> erreur(s) trouvée(s).</b></p>
      <?php
    }else{
      ?>
      <p align="center"> - importation échouée - </p>
      <p align="center"><b>Désolé, mais le fichier n'est pas au bon format !!!</b></p>
      <p>Le format attendu est le suivant :</p>
      <p>[A] => siren_siret</p>
      <p>[B] => type</p>
      <p>[C] => collectivite</p>
      <p>[D] => nom</p>
      <p>[E] => adresse</p>
      <p>[F] => code_postal</p>
      <p>[G] => ville</p>
      <p>[H] => telephone</p>
      <p>[I] => fax</p>
      <p>[J] => courriel</p>
      <p>[K] => web</p>
      <p>[L] => civilite_maire</p>
      <p>[M] => maire</p>
      <p>[N] => Nb_Habitant</p>
      <p>[O] => arrondissement</p>
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