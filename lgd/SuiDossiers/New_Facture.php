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

$db = new database($db_name, $db_user, $db_pass, $db_host);
$numero = $_GET['numero'];
$req= $db->queryOne("SELECT * FROM dossier where numero = '".$numero."'");
$erreur = '';
if (!empty($_POST)) {
  $datas = $db->queryOne("SELECT * FROM Facturation WHERE id = '".$_POST['rendu_selected']."'");
  $rendu_selected = $_POST['rendu_selected'];
  if($_POST['btn'] == "calcul"){
    $rendu = $datas->Nom;
    $id = $_POST['rendu_selected'];
    $M_besoin = $_POST['M_besoin'];
    $M_trvx = $_POST['M_trvx'];
    $M_estimation = $_POST['M_estimation'];
    if(!empty($datas->Comparaison)){
      $compar = $M_trvx * ($datas->T_comparaison - 1 );
      if ($M_estimation < $M_trvx+$compar && $M_estimation > $M_trvx-$compar){
        $M_fac = $M_trvx * ($datas->taux/100);
        $T_facture = "travaux";
        $btn="enregistrement";
      }elseif ($M_estimation < $M_trvx-$compar){
        $M_fac = $M_estimation * ($datas->taux/100);
        $erreur = "<10% ";
        $T_facture = "estimation";
        $btn="enregistrement";
      }elseif ($M_estimation > $M_trvx+$compar){
        $M_fac = $M_estimation * ($datas->taux/100);
        $erreur = ">10% ";
        $T_facture = "estimation";
        $btn="enregistrement";
      }
    }else{
      switch ($datas->Type_facture){
        case "f":
          $T_facture = $datas->calcul ;
          $M_fac = $datas->forfait;
          $btn="enregistrement";
          break;
        case "t":
          $T_facture = $datas->calcul ;
          if ($datas->calcul == 'besoins'){
            $M_fac = $_POST['M_besoin'] * (($datas->taux/100));
          }ELSEIF ($datas->calcul == 'travaux'){
            $M_fac = $_POST['M_trvx'] * (($datas->taux/100));
          }ELSEIF ($datas->calcul == 'estimation'){
            $M_fac = $_POST['M_estimation'] * (($datas->taux/100));
          }
          $btn="enregistrement";
          break;
        case "mt":
          $T_facture = $datas->calcul ;
          if ($datas->calcul == 'besoins'){
            if ($_POST['M_besoin'] * (($datas->taux/100)) >= $datas->min){
              $M_fac = $_POST['M_besoin'] * (($datas->taux/100));
              $T_facture = $datas->calcul ;
            }ELSE{
              $M_fac = $datas->min;
              $T_facture = $datas->calcul ;
            }
          }ELSEIF ($datas->calcul == 'travaux'){
            if ($_POST['M_trvx'] * (($datas->taux/100)) >= $datas->min){
              $M_fac = $_POST['M_trvx'] * (($datas->taux/100));
              $T_facture = $datas->calcul ;
            }ELSE{
              $M_fac = $datas->min;
              $T_facture = $datas->calcul ;
            }
          }ELSEIF ($datas->calcul == 'estimation'){
            if ($_POST['M_estimation'] * (($datas->taux/100)) >= $datas->min){
              $M_fac = $_POST['M_estimation'] * (($datas->taux/100));
              $T_facture = $datas->calcul ;
            }ELSE{
              $M_fac = $datas->min;
              $T_facture = $datas->calcul ;
            }
          }
          $btn="enregistrement";
          break;
        case "tm":
          $T_facture = $datas->calcul ;
          if ($datas->calcul == 'besoin'){
            if ($_POST['M_besoin'] * (($datas->taux/100)) <= $datas->max){
              $M_fac = $_POST['M_besoin'] * (($datas->taux/100));
            }ELSE{
              $M_fac = $datas->max;
            }
          }ELSEIF ($datas->calcul == 'travaux'){
            if ($_POST['M_trvx'] * (($datas->taux/100)) <= $datas->max){
              $M_fac = $_POST['M_trvx'] * (($datas->taux/100));
            }ELSE{
              $M_fac = $datas->max;
            }
          }ELSEIF ($datas->calcul == 'estimation'){
            if ($_POST['M_estimation'] * (($datas->taux/100)) <= $datas->max){
              $M_fac = $_POST['M_estimation'] * (($datas->taux/100));
            }ELSE{
              $M_fac = $datas->max;
            }
          }
          $btn="enregistrement";
          break;
        case "mtm":
          $T_facture = $datas->calcul ;
          if($datas->calcul == 'besoin'){
            if (($_POST['M_besoin'] * (($datas->taux/100)) >= $datas->min) && ($_POST['M_besoin'] * ($datas->taux/100) <= $datas->max)){
              $M_fac = $_POST['M_besoin'] * ($datas->taux/100);
            }ELSEIF($_POST['M_besoin'] * ($datas->taux/100) < $datas->min){
              $M_fac = $datas->min;
            }ELSEIF ($_POST['M_besoin'] * ($datas->taux/100) > $datas->max){
              $M_fac = $datas->max;
            }
          }elseif ($datas->calcul == 'travaux'){
            if (($_POST['M_trvx'] * (($datas->taux/100)) >= $datas->min) && ($_POST['M_trvx'] * ($datas->taux/100) <= $datas->max)){
              $M_fac = $_POST['M_trvx'] * ($datas->taux/100);
            }ELSEIF($_POST['M_trvx'] * ($datas->taux/100) < $datas->min){
              $M_fac = $datas->min;
            }ELSEIF ($_POST['M_trvx'] * ($datas->taux/100) > $datas->max){
              $M_fac = $datas->max;
            }
          }elseif ($datas->calcul == 'estimation'){
            if (($_POST['M_estimation'] * (($datas->taux/100)) >= $datas->min) && ($_POST['M_estimation'] * ($datas->taux/100) <= $datas->max)){
              $M_fac = $_POST['M_estimation'] * ($datas->taux/100);
            }ELSEIF($_POST['M_estimation'] * ($datas->taux/100) < $datas->min){
              $M_fac = $datas->min;
            }ELSEIF ($_POST['M_estimation'] * ($datas->taux/100) > $datas->max){
              $M_fac = $datas->max;
            }
          }
          $btn="enregistrement";
          break;
      }
    }
  }ELSEIF($_POST['btn'] == 'enregistrement'){
    $req = 'INSERT INTO facture(
          numero,
          mission,
          rendu,
          formule,
          m_besoin,
          m_travaux,
          m_estimation,
          m_facture,
          F_forfait,
          F_min,
          F_taux,
          F_max,
          date_creation,
          T_facture)
          VALUE (
          :numero,
          :mission,
          :rendu,
          :formule,
          :m_besoin,
          :m_travaux,
          :m_estimation,
          :m_facture,
          :F_forfait,
          :F_min,
          :F_taux,
          :F_max,
          :date_creation,
          :T_facture
          )'
    ;
    $rep = array(
      "numero" => $_GET['numero'],
      "mission" => $datas->type,
      "rendu" => $datas->Nom,
      "formule" => $datas->Type_facture,
      "m_besoin" => $_POST['M_besoin'],
      "m_travaux" => $_POST['M_trvx'],
      "m_estimation" => $_POST['M_estimation'],
      "m_facture" => $_POST['M_fac'],
      "F_forfait" => $datas->forfait,
      "F_min" => $datas->min,
      "F_taux" => $datas->taux,
      "F_max" => $datas->max,
      "date_creation" => date('Y-m-d'),
      "T_facture" => $_POST['T_facture']
    );
    $db->prepare($req, $rep);
    header("location: ./dossier.php?numero=".$_POST['numero']);
    $btn="quit";
  };
}else{
  $btn = "calcul";
  $numero = $_GET['numero'];
  $dossier = $db->queryOne("SELECT * FROM dossier where numero = '".$numero."'");
  $M_besoin = $dossier->montant_besoin;
  $M_trvx = $dossier->montant_trvx;
  $M_estimation = $dossier->montant_estim;
  $M_fac = 0;
  $rendu_selected = '';
}
$numero = $_GET['numero'];
$dossier = $db->queryOne("SELECT * FROM dossier where numero = '".$numero."'");
$M_besoin = $dossier->montant_besoin;
$M_trvx = $dossier->montant_trvx;
$M_estimation = $dossier->montant_estim;


include_once '../../template_header/dossierDisabled.php';
?>
<main role="main">
  <div class="container-fluid">
    <form method="post" class="row">
      <div class="w-100" style="padding: initial">
        <h3 style="text-align: center"> <?php echo $dossier->numero; echo " - "; echo ucfirst($dossier->commune); echo " - " ; echo $dossier->objet ?></h3>
        <input title="" type="text" value="<?php echo $dossier->numero ?>" name="numero" hidden="hidden">
        <br>
        <br>
        <div class="w-100">&nbsp;</div>
        <div class="w-100" style="padding: initial; text-align: center;">
          <label for="rendu">rendu</label>
          <select id="rendu" name="rendu_selected">
            <option>-- Rendu --</option>
            <optgroup label="AMO">
              <?php
              $req = $db->query('SELECT * FROM Facturation WHERE type = "amo"');
              foreach ($req as $rendu){
                if($rendu_selected == $rendu->id){
                  echo "<option value='".$rendu->id."' selected='selected'>".$rendu->Nom."</option>";
                }ELSE{
                  echo "<option value='".$rendu->id."'>".$rendu->Nom."</option>";
                }
              }
              ?>
            </optgroup>
            <optgroup label="MOE">
              <?php
              $req = $db->query('SELECT * FROM Facturation WHERE type = "moe"');
              foreach ($req as $rendu){
                if($rendu_selected == $rendu->id){
                  echo "<option value='".$rendu->id."' selected='selected'>".$rendu->Nom."</option>";
                }ELSE{
                  echo "<option value='".$rendu->id."'>".$rendu->Nom."</option>";
                }
              }
              ?>
            </optgroup>
            <optgroup label="FOR">
              <?php
              $req = $db->query('SELECT * FROM Facturation WHERE type = "for"');
              foreach ($req as $rendu){
                if($rendu_selected == $rendu->id){
                  echo "<option value='".$rendu->id."' selected='selected'>".$rendu->Nom."</option>";
                }ELSE{
                  echo "<option value='".$rendu->id."'>".$rendu->Nom."</option>";
                }
              }
              ?>
            </optgroup>
          </select>
        </div>
        <div class="w-100">&nbsp;</div>
        <div class="row">
          <div class="col-6" style="padding: initial; text-align: right">
            Montant besoin :
          </div>
          <div class="col-6" style="padding: initial; text-align: left">
            <input title="" type="number" value="<?php echo $M_besoin ?>" name="M_besoin" disabled="disabled">
            <input title="" type="number" value="<?php echo $M_besoin ?>" name="M_besoin" hidden>
          </div>
          <div class="col-6" style="padding: initial; text-align: right">
            Montant travaux :
          </div>
          <div class="col-6" style="padding: initial; text-align: left">
            <input title="" type="number" value="<?php echo $M_trvx ?>" name="M_trvx" disabled="disabled">
            <input title="" type="number" value="<?php echo $M_trvx ?>" name="M_trvx" hidden>
          </div>
          <div class="col-6" style="padding: initial; text-align: right">
            Montant estimation :
          </div>
          <div class="col-6" style="padding: initial; text-align: left">
            <input title="" type="number" value="<?php echo $M_estimation ?>" name="M_estimation" disabled="disabled">
            <input title="" type="number" value="<?php echo $M_estimation ?>" name="M_estimation" hidden>
          </div>
        </div>
        <div class="w-100">&nbsp;</div>
        <div class="row">
          <div class="col-6" style="padding: initial; text-align: right">
            Montant Facture :
          </div>
          <div class="col-6" style="padding: initial; text-align: left;">
            <input title="" value="<?php echo $erreur.$M_fac ?>" disabled="disabled">
            <input title="" value="<?php echo $M_fac ?>" name="M_fac" hidden>
          </div>
        </div>
        <input title="" value="<?php echo $T_facture ?>" name="T_facture" hidden>
        <div class="col-12" style="padding: initial; text-align: center">
          <br>
          <br>
          <?php
          if($btn == "enregistrement"){
            echo '<button class="btn btn-success" type="submit" name="btn" value="enregistrement"> Enregistrement </button>';
            echo '<button id="'.$numero.'" class="btn btn-danger" type="reset" onclick="selecdossier(this.id)"> Quitter </button>';
          }ELSE{
            echo '<button class="btn btn-success" type="submit" name="btn"  value="calcul"> Calcul </button>';
            echo '<button id="'.$numero.'" class="btn btn-danger" type="reset" onclick="selecdossier(this.id)"> Quitter </button>';
          }
          ?>

        </div>
      </div>
    </form>
  </div>
</main>
<?php
include_once '../../template_footer/dossier.php';