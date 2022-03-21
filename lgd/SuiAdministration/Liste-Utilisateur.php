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
<div style="width:1024px; height: 720px;">
  <div class="" style="width:1024px; height: 100px;">
    <div>
      <h4 style="text-align: center">Liste des utilisateurs</h4>
    </div>

    <p>
      <button type="submit" class="btn btn-primary" onclick=New('Utilisateur')> Nouvelle utilisateur </button> &nbsp;
    </p>
  </div>
  <div class="container-fluid">
    <table id="Tdossier" class="table table-hover">
      <thead>
      <tr>
        <th style="width: 100px; text-align: center">Nom</th>
        <th style="width: 100px; text-align: center">courriel</th>
        <th style="width: 100px; text-align: center">Initial</th>
      </tr>
      </thead>
      <tbody>
      <?php
      $req = $db->query('SELECT * FROM users');
      foreach ($req as $datas){
        ?>
        <tr id="<?php echo $datas->id; ?>" onclick="MaJ('Utilisateur',this.id)">
          <th style="text-align: center;"><?php echo $datas->nom; ?> </th>
          <th style="text-align: center;"><?php echo $datas->mail; ?> </th>
          <th style="text-align: center;"><?php echo $datas->initial; ?> </th>
        </tr>
        <?php
      };
      ?>
      </tbody>
    </table>
  </div>
</div>
</main>
<?php
include_once '../../template_footer/administration.php';

