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
            <p>
            <h4 style="text-align: center">Liste des missions</h4>
            </p>
            <p>
                <button type="submit" class="btn btn-primary" onclick=New('Mission')> Nouvelle Mission </button> &nbsp;
            </p>
        </div>
        <div class="container-fluid">
            <table id="Tdossier" class="table table-hover">
                <thead>
                <tr>
                    <th style="width: 100px; text-align: center">Nom</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $req = $db->query('SELECT * FROM mission');
                foreach ($req as $datas){
                    ?>
                    <tr id="<?= $datas->id; ?>" onclick="MaJ('Mission',this.id)">
                        <th style="text-align: center;"><?= $datas->name; ?> </th>
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