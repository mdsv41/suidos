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

include_once '../../template_header/genese.php';
?>

<main role="main">
  <div class="row">
    <h3 class="w-100" style="text-align: center">Génése</h3>
  </div>
  <div class="w-100">
    <table id="Tcommune" class="table table-hover">
      <thead>
      <tr>
        <th style="text-align: center">Commune</th>
        <th style="text-align: center">Maire</th>
        <th style="text-align: center">tél</th>
      </tr>
      </thead>
      <tbody>
      <?php
      $db = new database($db_name, $db_user, $db_pass, $db_host);
      $req = $db->query('SELECT * FROM commune where adhesion = "OUI"');
      foreach ($req as $datas){
        ?>
        <tr id="<?= $datas->id; ?>" onclick="select(this.id)">
          <th style="text-align: center;"><?= $datas->nom; ?></th>
          <th style="text-align: center;"><?= $datas->maire; ?></th>
          <th style="text-align: center;"><?= $datas->telephone; ?></th>
        </tr>
        <?php
      };
      ?>
      </tbody>
    </table>
  </div>
</main>
<?php
include_once '../../template_footer/genese.php';