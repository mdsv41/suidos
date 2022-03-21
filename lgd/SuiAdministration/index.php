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

include_once '../../template_header/administration.php'
?>

<main role="main" class="container">
  <div class="row">
    <h3 class="w-100" style="text-align: center">Sui'Extraction</h3>
  </div>
  <div class="gen" style="margin: 5px;padding: 5px;">
    <div  class="row table-bordered" style="padding: 5px; margin: 5px;">
      <div class="w-100">
        <h4 style="text-align: center;">Extraction des données</h4>
      </div>
      <div class="w-100">
        <p><a href="./Exp-commune.php" type="button" class="btn btn-default btn-lg">Extration des données générales des communes</a></p>
        <p><a href="./Exp-emmargement.php" type="button" class="btn btn-default btn-lg">Liste d'émargements</a></p>
        <p><a href="./Exp-Dossier-Par-Canton.php" type="button" class="btn btn-default btn-lg">Export dossier par canton</a></p>
      </div>
    </div>
    <div  class="table-bordered" style="padding: 5px; margin: 5px;">
      <div class="w-100">
        <h4 style="text-align: center;">Mise à jour des données</h4>
      </div>
      <div class="w-100" style="text-align: center">
        <p>
          <a href="./Liste-Commune.php" type="button" class="btn btn-default btn-lg">Communes</a>
          <a href="./Liste-Utilisateur.php" type="button" class="btn btn-default btn-lg">Utlisateurs</a>
          <a href="./Liste-Prestation.php" type="button" class="btn btn-default btn-lg">Prestations</a>
          <a href="./Liste-Rendu.php" type="button" class="btn btn-default btn-lg">Rendus</a>
          <a href="./Liste-Mission.php" type="button" class="btn btn-default btn-lg">Mission</a>
        </p>
      </div>
    </div>
    <div  class="table-bordered" style="padding: 5px; margin: 5px;">
      <div class="w-100">
        <h4 style="text-align: center;">Importer des données</h4>
      </div>
      <div class="w-100" style="text-align: center">
        <p><a href="Imp-pilote41.php" type="button" class="btn btn-default btn-lg">Données Pilote41</a></p>
      </div>
    </div>
  </div>
</main>
<?php
include_once '../../template_footer/administration.php';
