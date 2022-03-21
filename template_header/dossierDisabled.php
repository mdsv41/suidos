<?php
/**
 * Created by PhpStorm.
 * User: MdSV
 * Date: 2019-03
 */
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v3.8.5">
  <title>Sui'Dossiers</title>
  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.css" rel="stylesheet">
  <link href="../css/jquery-ui.css" rel="stylesheet">
  <!-- Bibliothéque JS-->
  <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="../js/jquery-ui.js"></script>
  <script type="text/javascript" src="../js/dataTable.js"></script>
  <script type="text/javascript" src="../js/modal.js"></script>
  <!-- Custom styles for this template -->
  <link href="../css/atd.css" rel="stylesheet">
  <!-- Custom js for this template -->
  <script type="text/javascript">
      $(function(){
          $( ".datepicker").datepicker({
              altField: "#datepicker",
              closeText: 'Fermer',
              prevText: 'Précédent',
              nextText: 'Suivant',
              currentText: 'Aujourd\'hui',
              monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
              monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
              dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
              dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
              dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
              weekHeader: 'Sem.',
              dateFormat: 'yy-mm-dd'
          });
      });
      $(function(){
          $( "#onglet" ).tabs();
      });
      function annuler() {
          document.location.replace('./index.php');
      }
  </script>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" style="color: white">ATD 41</a>
  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <?php
      if(substr($_SESSION['level'],0,1)== "1") {
        ?>
        <li class="nav-item">
          <a class="nav-link disabled" href="../SuiGenese/index.php">Génése</a>
        </li>
        <?php
      }
      if(substr($_SESSION['level'],1,1)== "1") {
        $db = new database($db_name, $db_user, $db_pass, $db_host);
        $res = $db->query("SELECT * FROM genese WHERE Affichage = 0");
        if (!empty($res)) {
          ?>
          <li class="nav-item">
            <a class="nav-link disabled" href="../SuiGenese/attente.php">Validation</a>
          </li>
          <?php
        }
      }
      ?>
      <?php
      if(substr($_SESSION['level'],0,1)== "1") {
        ?>
        <li class="nav-item">
          <a class="nav-link disabled active" href="../SuiDossiers/index.php">Dossiers</a>
        </li>
      <?php
      }else{
      ?>
        <script type="text/javascript">document.location.replace('../deconnection.php');</script>
        <?php
      }
      if(substr($_SESSION['level'],2,1)== "1") {
        ?>
        <li class="nav-item">
          <a href="../SuiDossiers/archiveListe.php" class="nav-link disabled">Archives</a>
        </li>
        <?php
      }
      if(substr($_SESSION['level'],0,1)== "1") {
        ?>
        <li class="nav-item">
          <a class="nav-link disabled" href="../SuiCourriers/index.php">Courriers</a>
        </li>
        <?php
      }
      if(substr($_SESSION['level'],0,1)== "1") {
        ?>
        <li class="nav-item">
          <a class="nav-link disabled" href="../SuiEstimations/index.php">Estimations</a>
        </li>
        <?php
      }
      if(substr($_SESSION['level'],3,1)== "1") {
        ?>
        <li class="nav-item">
          <a class="nav-link disabled" href="../SuiExtractions/index.php">Extraction</a>
        </li>
        <?php
      }
      if(substr($_SESSION['level'],3,1)== "1") {
        ?>
        <li class="nav-item">
          <a class="nav-link disabled" href="../SuiAdministration/index.php">Administration</a>
        </li>
        <?php
      }
      ?>
    </ul>
    <div class="my-2 my-lg-0">
      <?php if(substr($_SESSION['level'],4,1)== "1") { ?>
      <a href="./tdb/tdb-tech.php" class="btn btn-secondary my-2 my-sm-0 disabled" role="button" aria-pressed="true">TdB Technique</a>
      <?php }
      if(substr($_SESSION['level'],5,1)== "1") { ?>
        <a href="./tdb/tdb-activite.php" class="btn btn-secondary my-2 my-sm-0 disabled" role="button" aria-pressed="true">TdB Activité</a>
      <?php } ?>
      <a href="../deconnection.php" class="btn btn-secondary my-2 my-sm-0 disabled" role="button" aria-pressed="true">Déconnection</a>
    </div>
  </div>
</nav>