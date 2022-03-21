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
  <title>Sui'Administration</title>
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
          $( "#onglet" ).tabs();
      });
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
          <a class="nav-link" href="../SuiGenese/index.php">Génése</a>
        </li>
        <?php
      }
      if(substr($_SESSION['level'],1,1)== "1") {
        $db = new database($db_name, $db_user, $db_pass, $db_host);
        $res = $db->query("SELECT * FROM genese WHERE Affichage = 0");
        if (!empty($res)) {
          ?>
          <li class="nav-item">
            <a class="nav-link" href="../SuiGenese/attente.php">Validation</a>
          </li>
          <?php
        }
      }
      ?>
      <?php
      if(substr($_SESSION['level'],0,1)== "1") {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="../SuiDossiers/index.php">Dossiers</a>
        </li>
        <?php
      }
      if(substr($_SESSION['level'],2,1)== "1") {
        ?>
        <li class="nav-item">
          <a href="../SuiDossiers/archiveListe.php" class="nav-link">Archives</a>
        </li>
        <?php
      }
      if(substr($_SESSION['level'],0,1)== "1") {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="../SuiCourriers/index.php">Courriers</a>
        </li>
        <?php
      }
      if(substr($_SESSION['level'],0,1)== "1") {
        ?>
        <li class="nav-item">
          <a class="nav-link active" href="../SuiEstimations/index.php">Estimations</a>
        </li>
      <?php
      }else{
      ?>
        <script type="text/javascript">document.location.replace('../deconnection.php');</script>
        <?php
      }
      if(substr($_SESSION['level'],3,1)== "1") {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="../SuiExtractions/index.php">Extraction</a>
        </li>
        <?php
      }
      if(substr($_SESSION['level'],3,1)== "1") {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="../SuiAdministration/index.php">Administration</a>
        </li>
        <?php
      }
      ?>
    </ul>
    <div class="my-2 my-lg-0">
      <a href="../deconnection.php" class="btn btn-secondary my-2 my-sm-0" role="button" aria-pressed="true">Déconnection</a>
    </div>
  </div>
</nav>