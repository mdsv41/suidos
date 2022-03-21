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
require_once '../../template_header/administrationDisabled.php'
?>

<main role="main">
<div class="container gen">
    <div class="row">
        <h3>Mise à jour des données de la commune</h3>
        <form method="post" enctype="multipart/form-data" action="Imp-pilote41xls.php">
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

