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
  if(isset($_POST['choix0'])){
    $accreditation = $_POST['choix0'];
  }else{
    $accreditation = '0';
  }
  if(isset($_POST['choix1'])){
    $accreditation = $accreditation.$_POST['choix1'];
  }else{
    $accreditation = $accreditation.'0';
  }
  if(isset($_POST['choix2'])){
    $accreditation = $accreditation.$_POST['choix2'];
  }else{
    $accreditation = $accreditation.'0';
  }
  if(isset($_POST['choix3'])){
    $accreditation = $accreditation.$_POST['choix3'];
  }else{
    $accreditation = $accreditation.'0';
  }
  if(isset($_POST['choix4'])){
    $accreditation = $accreditation.$_POST['choix4'];
  }else{
    $accreditation = $accreditation.'0';
  }
  if(isset($_POST['choix5'])){
    $accreditation = $accreditation.$_POST['choix5'];
  }else{
    $accreditation = $accreditation.'0';
  }

  $accreditation = (int)$accreditation;

  $req = 'UPDATE users SET password = :password, mail = :mail, accreditation = :accreditation, initial = :initial
    WHERE id = :login';
  $rep=array(
    'password' => $_POST['password'],
    'mail' => $_POST['mail'],
    'accreditation' => $accreditation,
    'initial' => $_POST['initial'],
    'login' => $_POST['id']
  );
  $db->prepare($req,$rep);
  ?>
  <script type='text/javascript'>document.location.replace('./Liste-Utilisateur.php');</script>
<?php
}
$datas = $db->queryOne("SELECT * FROM users WHERE id = '".$_GET['numero']."'");

require_once '../../template_header/administrationDisabled.php'
?>
<main role="main">
  <div class="container gene">
    <div class="row">
      <div class="w-100">
        <div class="container-fluid">
          <div  class="table-bordered" style="padding: 5px;">
            <form method="post">
              <fieldset class="table-bordered">
                <h2> Mise à jour utilisateur <strong><?= $datas->nom ?></strong></h2>
                <input type="text" name="id" value="<?= $datas->id ?>" hidden>
                <div>
                  <p>
                    <label for="password">Mot de passe :</label>
                    <input type="text" id="password" name="password" style="background: #0d87e9" value="<?= $datas->password; ?>">
                  </p>
                  <p>
                    <label for="mail">Courriel :</label>
                    <input type="email" id="mail" name="mail" style="background: #0d87e9" value="<?= $datas->mail ?>" size="50">
                  </p>
                  <p>
                    <label for="accreditation">Droit :</label>
                    <?php if (substr($datas->accreditation,0,1)== "1"){
                      echo '<INPUT type="checkbox" name="choix0" value="1" checked> Génése';
                    }else{
                      echo '<INPUT type="checkbox" name="choix0" value="1"> Génése';
                    }; ?>
                    <?php if (substr($datas->accreditation,1,1)== "1"){
                      echo '<INPUT type="checkbox" name="choix1" value="1" checked> Validation';
                    }else{
                      echo '<INPUT type="checkbox" name="choix1" value="1"> Validation';
                    }; ?>
                    <?php if (substr($datas->accreditation,2,1)== "1"){
                      echo '<INPUT type="checkbox" name="choix2" value="1" checked> Archivage';
                    }else{
                      echo '<INPUT type="checkbox" name="choix2" value="1"> Archivage';
                    }; ?>
                    <?php if (substr($datas->accreditation,3,1)== "1"){
                      echo '<INPUT type="checkbox" name="choix3" value="1" checked> Administratif';
                    }else{
                      echo '<INPUT type="checkbox" name="choix3" value="1"> Administratif';
                    }; ?>
                    <?php if (substr($datas->accreditation,4,1)== "1"){
                      echo '<INPUT type="checkbox" name="choix4" value="1" checked> Tdb Technique';
                    }else{
                      echo '<INPUT type="checkbox" name="choix4" value="1"> Tdb Technique';
                    }; ?>
                    <?php if (substr($datas->accreditation,5,1)== "1"){
                      echo '<INPUT type="checkbox" name="choix5" value="1" checked> Tdb Administratif';
                    }else{
                      echo '<INPUT type="checkbox" name="choix5" value="1"> Tdb Administratif';
                    }; ?>
                  </p>
                  <p>
                    <label for="initial">Initial :</label>
                    <input type="text" id="initial" name="initial" style="background: #0d87e9" value="<?= $datas->initial ?>" size="4" maxlength="4">
                  </p>
                </div>
              </fieldset>
              <fieldset style="margin-top: 12px;">
                <div class="col-lg-2" style="padding: 0 15px 15px 15px">
                  <button type="submit" class="btn btn-success btn-lg">Enregistrer</button>
                </div>
                <div class="col-lg-3 col-lg-offset-7" style="padding: 0 15px 15px 15px">
                  <button type="reset" class="btn btn-danger btn-lg" onclick="Liste('Utilisateur')">Annuler / Quitter</button>
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