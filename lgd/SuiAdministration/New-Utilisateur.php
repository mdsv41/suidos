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

if(!empty($_GET)){
  if(isset($_GET['choix0'])){
    $accreditation = $_GET['choix0'];
  }else{
    $accreditation = '0';
  }
  if(isset($_GET['choix1'])){
    $accreditation = $accreditation.$_GET['choix1'];
  }else{
    $accreditation = $accreditation.'0';
  }
  if(isset($_GET['choix2'])){
    $accreditation = $accreditation.$_GET['choix2'];
  }else{
    $accreditation = $accreditation.'0';
  }
  if(isset($_GET['choix3'])){
    $accreditation = $accreditation.$_GET['choix3'];
  }else{
    $accreditation = $accreditation.'0';
  }
  if(isset($_GET['choix4'])){
    $accreditation = $accreditation.$_GET['choix4'];
  }else{
    $accreditation = $accreditation.'0';
  }
  if(isset($_GET['choix5'])){
    $accreditation = $accreditation.$_GET['choix5'];
  }else{
    $accreditation = $accreditation.'0';
  }

  $accreditation = (int)$accreditation;
  $req = $db->exec("INSERT INTO users ( username, password, mail, accreditation, initial, nom, prenom) VALUE ('".$_GET['login']."', '".$_GET['password']."', '".$_GET['mail']."', '".$accreditation."', '".$_GET['initial']."', '".$_GET['nom']."', '".$_GET['prenom']."')");
  echo "<script type='text/javascript'>document.location.replace('./Liste-Utilisateur.php');</script>";
}

require_once '../../template_header/administrationDisabled.php'
?>
<main role="main">
<div class="container gene">
  <div class="row">
    <div class="col-lg-12">
      <div class="container-fluid">
        <div  class="table-bordered" style="padding: 5px;">
          <form method="get">
            <fieldset class="table-bordered">
              <h2> Nouvelle Utilisateur</h2>
              <div>
                <p>
                  <label for="nom">Nom :</label>
                  <input type="text" id="nom" name="nom" style="background: #0d87e9">
                </p>
                <p>
                  <label for="prenom">Prénom :</label>
                  <input type="text" id="prenom" name="prenom" style="background: #0d87e9">
                </p>
                <p>
                  <label for="login">Login</label>
                  <input type="text" id="login" name="login" style="background: #0d87e9">
                </p>
                <p>
                  <label for="password">Mot de passe :</label>
                  <input type="text" id="password" name="password" style="background: #0d87e9">
                </p>
                <p>
                  <label for="mail">Courriel :</label>
                  <input type="email" id="mail" name="mail" style="background: #0d87e9">
                </p>
                <p>
                  <label for="accreditation">Droit :</label>
                  <INPUT id="accreditation" type="checkbox" name="choix0" value="1"> Génése
                  <INPUT id="accreditation" type="checkbox" name="choix1" value="1"> Validation
                  <INPUT id="accreditation" type="checkbox" name="choix2" value="1"> Archivage
                  <INPUT id="accreditation" type="checkbox" name="choix3" value="1"> Administratif
                  <INPUT id="accreditation" type="checkbox" name="choix4" value="1"> Tdb Technique
                  <INPUT id="accreditation" type="checkbox" name="choix5" value="1"> Tdb Administratif
                </p>
                <p>
                  <label for="initial">Initial :</label>
                  <input type="text" id="initial" name="initial" style="background: #0d87e9" size="4" maxlength="4">
                </p>
              </div>
            </fieldset>
            <fieldset style="margin-top: 12px;">
              <div class="col-lg-2" style="padding: 0 15px 15px 15px">
                <button type="submit" class="btn btn-success btn-lg">Enregistrer</button>
              </div>
              <div class="col-lg-3 col-lg-offset-7" style="padding: 0 15px 15px 15px">
                <button type="reset" class="btn btn-danger btn-lg" onclick=Liste('Utilisateur')>Annuler / Quitter</button>
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