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
$req = "SELECT * FROM dossier WHERE numero ='".$_GET['numero']."'";
$datas = $db->queryOne($req);
$_SESSION['saisine'] = $datas->id;

$annee = (int)date('Y');

$req = "SELECT * FROM commune WHERE nom ='" .$datas->commune."'";
$presta = $db->queryOne($req);

if ($annee > (int)substr($presta->prestation_date,0,4)){
  $prestation = "";
}else{
  $prestation = $presta->prestation_date;
}

include_once '../../template_header/dossierDisabled.php';
?>
<main role="main">
    <div class="row">
      <form action="../../inc/dossier.php" method="post" class="container-fluid">
        <input title="" name="commune" value="<?php echo $datas->commune ?>" hidden="hidden">
        <fieldset style="padding-bottom: 15px;">
          <div class="row">
            <div class="col-1" style="padding: initial; text-align: right">
              <p style="font-size: 3px">&nbsp;</p>
              <a href="<?php echo "./tdb/Base_technique.php?numero=" . $datas->numero ?>"
                 class="btn btn-primary" role="button" aria-pressed="true">Données</a>
            </div>
            <div class="col-7" style="padding: initial">
              <h3 style="text-align: center"> <?php echo $datas->numero;
                echo "-";
                echo ucfirst($datas->commune);
                echo " - ";
                echo $datas->objet ?></h3>
              <input title="" type="text" value="<?php echo $datas->numero ?>" name="numero"
                     hidden="hidden">
              <input title="" type="text" value="<?php echo $datas->commune ?>" name="commune" hidden="hidden">
            </div>
            <div class="col-2" style="padding: initial; text-align: left">
              <p style="font-size: 3px">&nbsp;</p>
              <button id="<?php echo $datas->numero ?>" class="btn btn-success" type="submit"> Enregistrer </button>
              <button class="btn btn-danger" type="reset" onclick="annuler()"> Quitter</button>
              <p style="font-size: 3px">&nbsp;</p>
            </div>
            <div class="col-2" style="padding: initial; text-align: right">
              <p style="font-size: 3px">&nbsp;</p>
              <?php
              if (substr($_SESSION['level'], 2,1)== "1") {
                if($datas->archive == "OUI"){
                  echo '<button class="btn btn-warning" type="submit" name="archive" value="desarchive"> Désarchiver </button>';
                }else {
                  echo '<button class="btn btn-warning" type="submit" name="archive" value="archive"> Archiver </button>';
                }
              }
              ?>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div id="onglet">
                <?php
                if (substr($_SESSION['level'],0,4)== "1011") {
                  echo '<ul>';
                  echo '<li><a href="#admin1">ADMINISTRATIF</li>';
                  echo '<li><a href="#tech1">TECHNIQUE</a></li>';
                  echo '<li><a href="#btech1">BASE TECHNIQUE</a></li>';
                  echo '<li><a href="#gen1">GESTIONNAIRE</a></li>';
                  echo '</ul>';
                  echo '<div id="admin1" class="administratif">';
                  require_once './template/administratif.php';
                  echo '</div>';
                  echo '<div id="tech1" class="technique">';
                  require_once './template/technique.php';
                  echo '</div>';
                  echo '<div id="btech1" class="gestionnaire">';
                  require_once './template/Base_tech.php';
                  echo '</div>';
                  echo '<div id="gen1" class="gestionnaire">';
                  require_once './template/gestionnaire-consultation.php';
                  echo '</div>';
                } elseif (substr($_SESSION['level'],0,4)== "1000") {
                  echo '<ul>';
                  echo '<li><a href="#tech10">TECHNIQUE</a></li>';
                  echo '<li><a href="#btech10">BASE TECHNIQUE</a></li>';
                  echo '<li><a href="#admin10">ADMINISTRATIF</a></li>';
                  echo '<li><a href="#gen10">GESTIONNAIRE</a></li>';
                  echo '</ul>';
                  echo '<div id="tech10" class="technique">';
                  require_once './template/technique.php';
                  echo '</div>';
                  echo '<div id="btech10" class="gestionnaire">';
                  require_once './template/Base_tech.php';
                  echo '</div>';
                  echo '<div id="admin10" class="administratif">';
                  require_once './template/administratif.php';
                  echo '</div>';
                  echo '<div id="gen10" class="gestionnaire">';
                  require_once './template/gestionnaire-consultation.php';
                  echo '</div>';
                } elseif (substr($_SESSION['level'],0,4)== "1111") {
                  echo '<ul>';
                  echo '<li><a href="#gen111">GESTIONNAIRE</a></li>';
                  echo '<li><a href="#btech111">BASE TECHNIQUE</a></li>';
                  echo '<li><a href="#tech111">TECHNIQUE</a></li>';
                  echo '<li><a href="#admin111">ADMINISTRATIF</a></li>';
                  echo '</ul>';
                  echo '<div id="gen111" class="gestionnaire">';
                  require_once './template/gestionnaire.php';
                  echo '</div>';
                  echo '<div id="btech111" class="gestionnaire">';
                  require_once './template/Base_tech.php';
                  echo '</div>';
                  echo '<div id="tech111">';
                  require_once './template/technique.php';
                  echo '</div>';
                  echo '<div id="admin111" class="admin">';
                  require_once './template/administratif.php';
                  echo '</div>';
                } elseif (substr($_SESSION['level'],0,4)== "1110") {
                  echo '<ul>';
                  echo '<li><a href="#gen111">GESTIONNAIRE</a></li>';
                  echo '<li><a href="#btech111">BASE TECHNIQUE</a></li>';
                  echo '<li><a href="#tech111">TECHNIQUE</a></li>';
                  echo '<li><a href="#admin111">ADMINISTRATIF</a></li>';
                  echo '</ul>';
                  echo '<div id="gen111" class="gestionnaire">';
                  require_once './template/gestionnaire.php';
                  echo '</div>';
                  echo '<div id="btech111" class="gestionnaire">';
                  require_once './template/Base_tech.php';
                  echo '</div>';
                  echo '<div id="tech111">';
                  require_once './template/technique.php';
                  echo '</div>';
                  echo '<div id="admin111" class="admin">';
                  require_once './template/administratif.php';
                  echo '</div>';
                } else {
                  echo "<script type='text/javascript'>document.location.replace('./index.php');</script>";
                }
                ?>
              </div>
            </div>
            <div class="col-4">
              <?php
              if ($_SESSION['level'] == 10) {
                include './template/rappel.php';
              }else{
                include './template/rappel.php';
              }
              ?>
            </div>
          </div>
          <input title="" type="text" name="commune" value="<?php echo $datas->commune ?>" hidden="hidden">
        </fieldset>
      </form>
    </div>
</main>
<?php
include_once '../../template_footer/dossier.php';