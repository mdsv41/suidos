<?php
/**
 * Created by PhpStorm.
 * User: MdSV
 * Date: 2019-03
 */
if(session_status() === PHP_SESSION_NONE){session_start(); };
require_once '../../app/database.php';
require_once '../../inc/connection.php';
require_once '../../inc/functions.php';
require_once '../../inc/dev.php';

include_once '../../template_header/archive.php';
?>
<main role="main" style="font-size: 0.8em">
  <div class="row">
    <h3 class="w-100" style="text-align: center">Dossiers Archivés</h3>
  </div>
  <div>&nbsp;</div>
  <table id="Tdossier" class="table table-hover">
    <thead>
    <tr>
      <th style="width: 80px; text-align: center;">N°</th>
      <th style="width: 60px; text-align: center;">Etape</th>
      <th style="width: 60px; text-align: center;">Echéance</th>
      <th style="width: 165px; text-align: center;">commune</th>
      <th style="width: 240px; text-align: center;">objet</th>
      <th style="width: 50px; text-align: center;">chargé</th>
      <th style="width: 140px; text-align: center;">termier</th>
    </tr>
    </thead>
    <tbody style="font-size: 1em">
    <?php
    $db = new database($db_name, $db_user, $db_pass, $db_host);
    $res = $db->query("SELECT * FROM dossier WHERE archive <> 'NON'");
    foreach ($res as $datas){
      if(!empty($datas->d3_charge)){
        $charge = $datas->d3_charge;
      }ELSEIF(!empty($datas->d2_charge)){
        $charge = $datas->d2_charge;
      }ELSEIF(!empty($datas->d1_charge)){
        $charge = $datas->d1_charge;
      }ELSE{
        $charge = " - ";
      }
      echo '<tr id="'.$datas->numero.'" onclick="selecdossier(this.id)">';
      echo "<th style='text-align: center'>" .$datas->numero. "</th>";
      echo "<th style='text-align: center'>" .$datas->commande. "</th>";
      echo "<th style='text-align: center'>" .$datas->echeance. "</th>";
      echo "<th>" .$datas->commune. "</th>";
      echo "<th>" .$datas->objet. "</th>";
      echo '<th style="text-align: center;">' .$charge. '</th>';
      echo "<th>" .etape_en_cour($datas). "</th>";
      echo "</tr>";
    }
    ?>
    </tbody>
  </table>
</main>
<?php
include_once '../../template_footer/archive.php';