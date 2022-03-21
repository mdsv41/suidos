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
?>

<main role="main">
<div class="container gen">
    <div class="row">
        <h3>Import courrier depart</h3>
      <form method="post" enctype="multipart/form-data" action="Imp-courrierDep.php">
        <label for="fichier">Veuillez selectionner un fichier excel (xlsx):</label>
        <input id="fichier" type="file" class="btn" name="userfile" value="table" />
        <input type="submit" class="btn btn-primary" name="submit" value="Mettre à jour le logiciel" />
      </form>
      <h3>Import courrier arriver</h3>
      <form method="post" enctype="multipart/form-data" action="Imp-courrierArv.php">
        <label for="fichier">Veuillez selectionner un fichier excel (xlsx):</label>
        <input id="fichier" type="file" class="btn" name="userfile" value="table" />
        <input type="submit" class="btn btn-primary" name="submit" value="Mettre à jour le logiciel" />
      </form>
        <a href="./index.php" class="btn btn-danger" role="button" aria-pressed="true">Annuler</a>
    </div>
</div>
</main>
<?php
include_once '../../template_footer/administration.php';

