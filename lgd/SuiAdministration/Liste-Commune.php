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
<main role="main">
  <div>
    <h4 style="text-align: center">Liste des Communes et Communeautées de Communes</h4>
  </div>
  <div class="container-fluid">
    <table id="Tdossier" class="table table-hover">
      <thead>
      <tr>
        <th style="text-align: center;">Commune</th>
        <th style="text-align: center;">Maire</th>
        <th style="text-align: center;">Adhérante</th>
        <th style="text-align: center;">Date d'adhésion</th>
      </tr>
      </thead>
      <tbody>
      <?php
      $req = $db->query('SELECT * FROM commune order by nom ASC');
      foreach ($req as $datas) {
        ?>
        <tr id="<?= $datas->id ?>" onclick=MaJ('Commune',this.id)>
          <th style='text-align: center;'><?= $datas->nom ?></th>
          <th style='text-align: center;'><?= $datas->maire ?></th>
          <th style='text-align: center;'><?= $datas->adhesion ?></th>
          <th style='text-align: center;'><?= affiche_date($datas->date_adhesion) ?></th>
        </tr>
      <?php }; ?>
      </tbody>
    </table>
  </div>
</main>
<?php
include_once '../../template_footer/administration.php';