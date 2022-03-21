<?php
/**
 * Created by PhpStorm.
 * User: MdSV
 * Date: 2019-03
 */
require_once '../../app/database.php';
require_once '../../inc/connection.php';
require_once '../../inc/functions.php';
require_once '../../inc/dev.php';
if(session_status() === PHP_SESSION_NONE){session_start(); };
$db = new database($db_name, $db_user, $db_pass, $db_host);

if (!empty($_POST)) {
  if ($_POST['suite'] == "Sans suite") {
    $db->execute("UPDATE genese SET Affichage = TRUE, etat = 'sans_suite' WHERE id = '".$_SESSION['saisine']."'");
  } elseif ($_POST['suite'] == "Re-orientation") {
    $db->execute("UPDATE genese SET Affichage = TRUE, etat = 're-orientation' WHERE id = '".$_SESSION['saisine']."'");
  } else {
    $db->execute("UPDATE genese SET Affichage = TRUE, etat = 'etude' WHERE id = '".$_SESSION['saisine']."'");
    $requet = $db->queryOne("SELECT * FROM dossier ORDER BY numero DESC ");
    $dernum = $requet->numero;
    $annee = (int)date('Y');
    if (empty($dernum)) {
      $dernum = "0000-000";
    }
    if ((int)substr($dernum, 0, 4) <> $annee) {
      $dernum = date('Y') . "-001";
    } else {
      $numero = (int)substr($dernum, 5, 3);
      if ($numero < 9) {
        $numero1 = $numero + 1;
        $numero2 = "00" . $numero1;
      } elseif ($numero < 100) {
        $numero1 = $numero + 1;
        $numero2 = "0" . $numero1;
      } else {
        $numero = $numero + 1;
      }
      $dernum = $annee . "-" . $numero;
    }
    if ($_POST['numerofinal'] <> $dernum) {
      $dernum = $_POST['numerofinal'];
    }
    $req = "INSERT INTO dossier(
            numero,
            commune,
            adresse,
            code_postal,
            ville,
            telephone,
            fax,
            courriel,
            web,
            domaine,
            type_voie,
            saisie_date,
            commentaire,
            collectivite,
            fonction,
            civilite,
            representant,
            objet,
            d1_mission,
            d1_prestation,
            d1_rendu,
            d1_charge,
            id_genese,
            contrainte,
            contrainte_date,
            interlocuteur,
            interlocuteur_tel,
            Suite_Donnee
            ) VALUE (
            :numero,
            :commune,
            :adresse,
            :code_postal,
            :ville,
            :telephone,
            :fax,
            :courriel,
            :web,
            :domaine,
            :type_voie,
            :saisie_date,
            :commentaire,
            :collectivite,
            :fonction,
            :civilite,
            :representant,
            :objet,
            :d1_mission,
            :d1_prestation,
            :d1_rendu,
            :d1_charge,
            :id_genese,
            :contrainte,
            :contrainte_date,
            :interlocuteur,
            :interlocuteur_tel,
            :Suite_Donnee
            )
            ";

    echo "je lance la requette";
    $rep = array(
      "numero" => $dernum,
      "commune" => $_POST['commune'],
      "adresse" => $_POST['adresse'],
      "code_postal" => $_POST['code_postal'],
      "ville" => $_POST['ville'],
      "telephone" => $_POST['telephone'],
      "fax" => $_POST['fax'],
      "courriel" => $_POST['courriel'],
      "web" => $_POST['web'],
      "domaine" => $_POST['domaine'],
      "type_voie" => $_POST['type_voie'],
      "saisie_date" => $_POST['saisie_date'],
      "commentaire" => $_POST['commentaire'],
      "collectivite" => $_POST['collectivite'],
      "fonction" => $_POST['fonction'],
      "civilite" => $_POST['civilite'],
      "representant" => $_POST['maire'],
      "objet" => $_POST['objet'],
      "d1_mission" => $_POST['d1_mission'],
      "d1_prestation" => $_POST['d1_prestation'],
      "d1_rendu" => $_POST['d1_rendu'],
      "d1_charge" => $_POST['d1_charge'],
      "id_genese" => $_SESSION['saisine'],
      "contrainte" => $_POST['contrainte'],
      "contrainte_date" => $_POST['contrainte_date'],
      "interlocuteur" => $_POST['interlocuteur'],
      "interlocuteur_tel" => $_POST['interlocuteur_tel'],
      "Suite_Donnee" => $_POST['suite']
    );

    $db->prepare($req, $rep);

    echo "requette executer";
    require_once '../../app/PHPMailer/PHPMailerAutoload.php';
    $mails = $db->query('select * from users');
    foreach ($mails as $mail) {
      if (substr($mail->accreditation, 3, 1) == "1" && substr($mail->accreditation, 5, 1) == "0" ) {
        $courriel = new PHPMailer();
        $courriel->isSendmail();
        $courriel->setFrom($_SESSION['mail'], $_SESSION['user']);
        $courriel->addAddress($mail->mail, $mail->username);
        $courriel->Subject = 'Impression de chemise dossier';
        $courriel->Body = 'Merci d\'imprimer les chemises correspondantes au dossier n°:' . $dernum . '-' . $_POST['commune'];
        $courriel->AltBody = 'Merci d\'imprimer les chemises correspondantes au dossier n°:' . $dernum . '-' . $_POST['commune'];

        if(!$courriel->send()){
          echo '<h1>erreur, message non envoyé.</h1>';
          echo '<p> Mailer ERROR:'. $courriel->ErrorInfo .' </p>';
          die();
        }
      }
    }

  };

  header('location: ../SuiDossiers/index.php');
  // echo "<script type='text/javascript'>document.location.replace('./index.php');</script>";
};

$_SESSION['saisine'] = $_GET['numero'];
$datas = $db->queryOne("SELECT * FROM genese WHERE id = '".$_GET['numero']."'");
$dernierdossier = $db->queryOne("SELECT * FROM dossier ORDER BY numero DESC ");
$dernum = $dernierdossier->numero;
$annee = (int)date('Y');
echo $dernum;
if (empty($dernum)) {
  $dernum = "0000-000";
}
if ((int)substr($dernum, 0, 4) <> $annee) {
  $dernum = date('Y') . "-001";
} else {
  $numero = (int)substr($dernum, 5, 3);
  if ($numero < 9) {
    $numero1 = $numero + 1;
    $numero2 = "00" . $numero1;
  } elseif ($numero < 100) {
    $numero1 = $numero + 1;
    $numero2 = "0" . $numero1;
  } else {
    $numero2 = $numero + 1;
  }
  $dernum = $annee . "-" . $numero2;
}
$presta = $db->queryOne("SELECT * FROM commune WHERE nom ='".$datas->commune."'");
if ($annee > (int)substr($presta->prestation_date,0,4)){
  $prestation = "";
}else{
  $prestation = $presta->prestation_date;
}

include_once '../../template_header/validationDisabled.php';
?>
<main role="main" class="container" style="font-size: 0.75em">
  <div class="row">
    <form method="post">
      <fieldset class="table-bordered" style="padding-bottom: 15px;">
        <div>
          <h3 style="text-align: center"> Dossier n°<input title="" type="text" value="<?= $dernum; ?>" name="numerofinal"> Commnue:<input title="" type="text" value="<?= ucfirst($datas->commune) ?>" name="commune"></h3>
          <div style="text-align: right;">
            <button type="submit" class="btn btn-success">valider</button>
            <button type="reset" class="btn btn-danger" onclick="annuler()">Annuler</button>
          </div>
          <div style="border: solid 2px #9c27b0; padding-bottom: 10px;">
            <h3> Rappel saisie provisoire </h3>
            <div class="row">
              <div class="col-6">
                <label for="dom_intervention">Domaine d'intervention : </label>
                <select id="dom_intervention" name="domaine"  size="1">
                  <option <?php if ($datas->domaine == "sécurité"): ?> selected="selected"<?php endif; ?>> sécurité </option>
                  <option <?php if ($datas->domaine == "travaux de voirie"): ?> selected="selected"<?php endif; ?>> travaux de voirie </option>
                  <option <?php if ($datas->domaine == "assainissement"): ?> selected="selected"<?php endif; ?>> assainissement </option>
                  <option <?php if ($datas->domaine == "espaces publics"): ?> selected="selected"<?php endif; ?>> espaces publics </option>
                </select>
                <br>
                <label for="type_voie">Type de voie : </label>
                <select id="type_voie" name="type_voie" size="1">
                  <?php
                  echo "<option selected='selected'>".$datas->type_voie."</option>";
                  $req = $db->query('SELECT * FROM voie');
                  foreach ($req as $opvoie){
                    echo "<option>".$opvoie->name."</option>";
                  };
                  ?>
                </select>
                <br>
                <label for="interlocuteur">interlocuteur:</label>
                <input id="interlocuteur" type="text" value="<?= $datas->interlocuteur ?>" name="interlocuteur">
                <label for="interlocuteur_tel">Tél.:</label>
                <input id="interlocuteur_tel" type="text" value="<?= $datas->interlocuteur_tel ?>" name="interlocuteur_tel">
                <br>
                <label for="prestation_incluse">Prestation incluse : </label>
                <input id="prestation_incluse" type="date" value="<?= $prestation ?>" name="prestation_incluse" size="8" disabled="disabled">
              </div>
              <div class="col-6">
                <div class="col-6">
                  <?= $datas->collectivite; ?><br>
                  <?= $datas->adresse; ?><br>
                  <?= $datas->code_postal; ?>&nbsp;-&nbsp;<?= $datas->commune ?>
                </div>
                <div class="col-6">
                  Maire : <?= $datas->civilite_maire."&nbsp".$datas->maire ?><br>
                  <input type="text" name="civilite_maire" value="<?= $datas->civilite_maire ?>" hidden>
                  <input type="text" name="maire" value="<?= $datas->maire ?>" hidden>
                  tél:&nbsp;<?= $datas->telephone ?><br>
                  fax:&nbsp;<?= $datas->fax ?><br>
                </div>
                <div class="w-100" style="text-align: left">
                  Contraine :
                  <select title="" name="contrainte">
                    <option> </option>
                    <option <?php if ($datas->contrainte == "Conseil Municipal"): ?> selected="selected"<?php endif; ?>>Conseil Municipal</option>
                    <option <?php if ($datas->contrainte == "Budget"): ?> selected="selected"<?php endif; ?>>Budget</option>
                    <option <?php if ($datas->contrainte == "Subvention"): ?> selected="selected"<?php endif; ?>>Subvention</option>
                    <option <?php if ($datas->contrainte == "Travaux"): ?> selected="selected"<?php endif; ?>>Travaux</option>
                  </select>
                  &nbsp;-&nbsp;
                  <input title="" type="text" class="" name="contrainte_date" value="<?= $datas->contrainte_date ?>">
                </div>
              </div>
              <div class="w-100" style="text-align: center">
                <h4><U>Suite à donnée :</U>
                  <select title="Suite à donner" type="text" class="table-bordered" name="suite" size="1" style="width: 100px;">
                    <option selected="selected">Etude</option>
                    <option>Sans suite</option>
                    <option>Re-orientation</option>
                  </select>
                </h4>
              </div>
            </div>
            <div class="w-100">
              <label for="commentaire">Observation :</label>
              <textarea id="commentaire" name="commentaire" class="table-bordered" style="width:1110px;height:128px;"><?= $datas->commentaire ?></textarea>
            </div>
          </div>
          <div class="container" style="border: solid 2px #9c27b0; padding-bottom: 10px;">
            <h3 style="text-align: center;"> Validation </h3>
            <div class="w-100" style=" padding-bottom: 10px;">
              <label for="objet">Objet:</label>
              <input id="objet" type="text" name="objet" size="150">
            </div>
            <div class="col-4" style="text-align: right; border: solid 1px #ffffff;">
              <h3 style="text-align: center"> 1ère demande</h3>
              <label for="d1_mission">MISSION</label>
              <select id="d1_mission" type="text" class="table-bordered" name="d1_mission" size="1" style="width: 250px;">
                <option selected></option>
                <?php
                $req = $db->query('SELECT * FROM mission');
                foreach ($req as $opmission){
                  echo "<option>".$opmission->name."</option>";
                };
                ?>
              </select>
              <br>
              <label for="d1_prestation">DOMAINE</label>
              <select id="d1_prestation" type="text" class="table-bordered" name="d1_prestation" size="1" style="width: 250px;">
                <option selected></option>
                <?php
                $req = $db->query('SELECT * FROM prestation');
                foreach ($req as $opmission){
                  echo "<option>".$opmission->name."</option>";
                };
                ?>
              </select>
              <br>
              <label for="d1_rendu">RENDU</label>
              <select id="d1_rendu" type="text" class="table-bordered" name="d1_rendu" size="1" style="width: 250px;">
                <option selected> </option>
                <?php
                $req = $db->query('SELECT * FROM rendu');
                foreach ($req as $oprendu){
                  echo "<option>".$oprendu->name."</option>";
                };
                ?>
              </select>
              <br>
              <label for="d1_charge">CHARGE</label>
              <select id="d1_charge" type="text" class="table-bordered" name="d1_charge"  size="1" style="width: 250px;">
                <option selected></option>
                <?php
                $req2 = $db->query('SELECT * FROM users');
                foreach ($req2 as $charges){
                  if ($charges->accreditation = 10 || $charges->accreditation = 111 ) {
                    echo "<option>" .$charges->initial. "</option>";
                  }
                };
                ?>
              </select>
            </div>
          </div>
        </div>
        <input title="" type="text" value="<?= $datas->collectivite ?>" name="collectivite" hidden="hidden">
        <input title="" type="text" value="<?= $datas->adresse ?>" name="adresse" hidden="hidden">
        <input title="" type="number" value="<?= $datas->code_postal ?>" name="code_postal" hidden="hidden">
        <input title="" type="text" value="<?= $datas->fonction ?>" name="fonction" hidden="hidden">
        <input title="" type="text" value="<?= $datas->civilite ?>" name="civilite" hidden="hidden">
        <input title="" type="text" value="<?= $datas->representant ?>" name="representant" hidden="hidden">
        <input title="" type="text" value="<?= $datas->telephone ?>" name="telephone" hidden="hidden">
        <input title="" type="text" value="<?= $datas->fax ?>" name="fax" hidden="hidden">
        <input title="" type="text" value="<?= $datas->courriel ?>" name="courriel" hidden="hidden">
        <input title="" type="text" value="<?= $datas->web ?>" name="web" hidden="hidden">
        <input title="" type="date" value="<?= $datas->saisie_date ?>" name="saisie_date" hidden="hidden">
        <input title="" type="text" value="<?= $datas->ville ?>" name="ville" hidden="hidden">
      </fieldset>
    </form>
  </div>
</main>
<?php
include_once '../../template_footer/validation.php';