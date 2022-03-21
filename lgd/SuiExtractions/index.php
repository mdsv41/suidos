<?php
/**
 * Created by PhpStorm.
 * User: MdSV
 * Date: 2019-03
 */
if(session_status() === PHP_SESSION_NONE){session_start(); };
require_once '../../app/database.php';
require_once '../../inc/connection.php';
require_once '../../inc/dev.php';
$annee = (int)date('Y');
$annee = $annee-1 ;

include_once '../../template_header/extraction.php';
?>
<main role="main" class="container">
  <div class="row">
    <h3 class="w-100" style="text-align: center">Sui'Extraction</h3>
  </div>
  <div class="row gen">
    <div class="w-100 table-bordered gen" style="padding: 5px; margin: 5px;">
      <form action="./stat_annee.php" class="row">
        <div class="col-3" style="text-align: right">
          <label for="annee" style="color: #000000">Statistique Dossiers :</label>
        </div>
        <div class="col-2">
          <input id="annee" style="color: #000000; width: 75px" type="number" name="annee" placeholder="Année" value="<?= $annee ?>" required>
          <input type="submit" style="color: #000000">
        </div>
      </form>
      <div class="w-100">&nbsp;</div>
      <form action="./tempPasser.php" class="row">
        <div class="col-3" style="text-align: right">
          <label for="annee_pi" style="color: #000000">Temps par prestation :</label>
        </div>
        <div class="col-2">
          <input id="annee_pi" style="color: #000000; width: 75px" type="number" name="annee_pi" placeholder="Année" value="<?= $annee ?>" required>
          <input type="submit" style="color: #000000">
        </div>
      </form>
    </div>
  </div>
  <div class="w-100">&nbsp;</div>

</main>
<?php
include_once '../../template_footer/extraction.php';