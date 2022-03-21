<?php
/**
 * Created by PhpStorm.
 * User: MdSV
 * Date: 2019-03
 */
require_once '../../app/database.php';
require_once '../../inc/connection.php';
require_once '../../inc/dev.php';
if(session_status() === PHP_SESSION_NONE){session_start(); };

include_once '../../template_header/validation.php';
?>

<main role="main" style="text-align: center">
  <div class="row">
    <h3 class="w-100" style="text-align: center">Dossier en attente de validation</h3>
  </div>
  <table id="TAttente" class="table table-hover">
    <thead>
    <tr>
      <th style="width: 150px;text-align: center;">date</th>
      <th style="width: auto;text-align: center;">commune</th>
      <th style="width: 150px;text-align: center;">domaine</th>
      <th style="width: 150px;text-align: center;">interlocuteur</th>
      <th style="width: 150px;text-align: center;">tel</th>
      <th style="width: 150px;text-align: center;">saisie</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($res as $datas){
      ?>
      <tr id="<?= $datas->id; ?>" onclick="selecvalid(this.id)">
        <th style="text-align: center;"><?= $datas->saisie_date ?></th>
        <th style="text-align: center;"><?= strtoupper($datas->ville) ?></th>
        <th style="text-align: center;"><?= $datas->domaine ?></th>
        <th style="text-align: center;"><?= $datas->interlocuteur ?></th>
        <th style="text-align: center;"><?= $datas->interlocuteur_tel ?></th>
        <th style="text-align: center;"><?= $datas->saisie ?></th>
      </tr>
      <?php
    };
    ?>
    </tbody>
  </table>
</main>
<?php
include_once '../../template_footer/validation.php';