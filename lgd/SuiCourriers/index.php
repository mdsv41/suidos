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

include_once '../../template_header/courrier.php';
?>
  <main role="main">
  <div class="row">
    <h3 class="w-100" style="text-align: center">Sui'Courriers</h3>
  </div>
  <div class="row">
  <div class="col-12">
  <div id="onglet">
  <ul>
    <li><a href="#depart">Depart</a></li>
    <li><a href="#arrive">Arrivé</a></li>
  </ul>
  <div id="depart" class="administratif" style="; font-size: 66%">
  <div class="administratif">
  <div class="container-fluid" style="border: solid 5px #0E6E61; padding: 10px 0 10px 0">
  <div style="display: flex" class="col-lg-12">
    <div style="text-align: center" class="col-lg-10"><h5>Courriers Départ</h5></div>
    <div style="text-align: center" class="col-lg-2"><button class="btn btn-primary" onclick="courrierDepart()">nouveau départ</button></div>
  </div>
  <div class="admin">
  <table id="Tdepart" class="table table-hover">
  <thead>
  <tr>
    <th style="width: 100px; text-align: center;">Date Départ</th>
    <th style="width: 80px; text-align: center;">Mise en signature</th>
    <th style="width: 80px; text-align: center;">Retour signature</th>
    <th style="width: 40px; text-align: center;">Signataire</th>
    <th style="width: 100px; text-align: center;">Numero</th>
    <th style="width: 30px; text-align: center;">Code</th>
    <th style="width: 30px; text-align: center;">Document</th>
    <th style="width: auto; text-align: center;">Destinataire</th>
    <th style="width: 300px; text-align: center;">Objet</th>
    <th style="width: 100px; text-align: center;">Dossier</th>
    <th style="width: 130px; text-align: center;">Lien</th>
    <th style="width: 40px; text-align: center;"></th>
  </tr>
  </thead>
  <tbody style="height: 250px">
<?php
$db = new database($db_name, $db_user, $db_pass, $db_host);
if(substr($_SESSION['level'],3,1)== "1") {
  $reps = $db->query('SELECT * FROM courriers_depart order by departDate desc');
}else{
  $reps = $db->query('SELECT * FROM courriers_depart where departCode = "Tech" order by departDate desc');
}
  foreach ($reps as $courrier) {
    ?>
    <tr>
      <th style='text-align: center'><?= $courrier->departDate; ?></th>
      <th style='text-align: center'><?= $courrier->departMiseSignature; ?></th>
      <th style='text-align: center'><?= $courrier->departRetourSignature; ?></th>
      <th style='text-align: center'><?= $courrier->departSignataire; ?></th>
      <th style='text-align: center'><?= $courrier->departNumero; ?></th>
      <th style='text-align: center'><?= $courrier->departCode; ?></th>
      <th style='text-align: center'><?= $courrier->departDocument; ?></th>
      <th style='text-align: center'><?= $courrier->departDestinataire; ?></th>
      <th style='text-align: center'><?= $courrier->departObjet; ?></th>
      <th style='text-align: center'><?= $courrier->departDossier; ?></th>
      <th style='text-align: center'><a href="<?= $courrier->departStockage; ?>" target="_blank"><?= $courrier->departLien; ?></a></th>
      <th style='text-align: center'>
        <button id="<?= $courrier->departId; ?>" onclick="modifDepart(this.id)">Modif</button>
      </th>
    </tr>
    <?php
  }
  ?>
  </tbody>
  </table>
  </div>
  </div>
  </div>
  </div>
  <div id="arrive" class="administratif" style="; font-size: 66%">
    <div class="administratif">
      <div class="container-fluid" style="border: solid 5px #0E6E61; padding: 10px 0 10px 0">
        <div style="display: flex" class="col-lg-12">
          <div style="text-align: center" class="col-lg-10"><h5>Courriers Arrivés</h5></div>
          <div style="text-align: center" class="col-lg-2"><button class="btn btn-primary" onclick="courrierArrive()">nouveau arrivé</button></div>
        </div>
        <div class="admin">
          <table id="Tarrive" class="table table-hover">
            <thead>
            <tr>
              <th style="width: 100px; text-align: center;">Date Arrivée</th>
              <th style="width: 100px; text-align: center;">N°</th>
              <th style="width: auto; text-align: center;">Expéditeur</th>
              <th style="width: 40px; text-align: center;">Type</th>
              <th style="width: 40px; text-align: center;">Document</th>
              <th style="width: 40px; text-align: center;">Code</th>
              <th style="width: 300px; text-align: center;">Objet</th>
              <th style="width: 100px; text-align: center;">Dossier</th>
              <th style="width: 130px; text-align: center;">Lien</th>
              <th style="width: 40px; text-align: center;"></th>
            </tr>
            </thead>
            <tbody style="height: 250px">
            <?php
            if(substr($_SESSION['level'],3,1)== "1") {
            $reps = $db->query('SELECT * FROM courriers_arrive order by arriveDate desc');
            }else{
            $reps = $db->query('SELECT * FROM courriers_arrive where arriveCode = "Tech" order by arriveDate desc');
            }
            foreach ($reps as $courrier) {
            ?>
              <tr>
                <th style='text-align: center'><?= $courrier->arriveDate; ?></th>
                <th style='text-align: center'><?= $courrier->arriveNumero; ?></th>
                <th style='text-align: center'><?= $courrier->arriveExpediteur; ?></th>
                <th style='text-align: center'><?= $courrier->arriveType; ?></th>
                <th style='text-align: center'><?= $courrier->arriveDocument; ?></th>
                <th style='text-align: center'><?= $courrier->arriveCode; ?></th>
                <th style='text-align: center'><?= $courrier->arriveObjet; ?></th>
                <th style='text-align: center'><?= $courrier->arriveDossier; ?></th>
                <th style='text-align: center'><a href="<?= $courrier->arriveStockage; ?>" target="_blank"><?= $courrier->arriveLien; ?></a></th>
                <th style='text-align: center'>
                  <button id="<?= $courrier->arriveId; ?>" onclick="modifArrive(this.id)">Modif</button>
                </th>
              </tr>
              <?php
            }
            ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
  </main>
  <?php
  include_once '../../template_footer/courrier.php';
