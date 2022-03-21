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

if(!empty($_POST)){
  $req = $db->exec("INSERT INTO prestation (name) VALUE ('".$_POST['nom']."')");
  echo "<script type='text/javascript'>document.location.replace('./Liste-Prestation.php');</script>";
}

require_once '../../template_header/administrationDisabled.php'
?>
<main role="main">
  <div class="container gene">
    <div class="row">
      <div class="col-lg-12">
        <div class="container-fluid">
          <div  class="table-bordered" style="padding: 5px;">
            <form method="post">
              <fieldset class="table-bordered">
                <h2> Nouvelle Prestation</h2>
                <div>
                  <p>
                    <label for="nom">Prestation :</label>
                    <input type="text" id="nom" name="nom" style="background: #0d87e9; width: 400px" size="250" width="200">
                  </p>
                </div>
              </fieldset>
              <fieldset style="margin-top: 12px;">
                <div class="col-lg-2" style="padding: 0 15px 15px 15px">
                  <button type="submit" class="btn btn-success btn-lg">Enregistrer</button>
                </div>
                <div class="col-lg-3 col-lg-offset-7" style="padding: 0 15px 15px 15px">
                  <button type="reset" class="btn btn-danger btn-lg" onclick=Liste('Prestation')>Annuler / Quitter</button>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php
include_once '../../template_footer/administration.php';