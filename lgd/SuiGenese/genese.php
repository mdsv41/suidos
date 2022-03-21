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
if (!empty($_POST)){
  $req = "INSERT INTO genese(
        commune,
        adresse,
        code_postal,
        ville,
        telephone,
        fax,
        courriel,
        web,
        interlocuteur,
        interlocuteur_tel,
        domaine,
        type_voie,
        saisie,
        saisie_date,
        commentaire,
        Affichage,
        etat,
        collectivite,
        fonction,
        civilite,
        representant,
        contrainte,
        contrainte_date,
        maire,
        civilite_maire)
        VALUE (
        :commune,
        :adresse,
        :codepostal,
        :ville,
        :telephone,
        :fax,
        :courriel,
        :web,
        :interlocuteur,
        :interlocuteur_tel,
        :domaine,
        :typevoie,
        :saisie,
        :saisiedate,
        :commentaire,
        :Affichage,
        :etat,
        :collectivite,
        :fonction,
        :civilite,
        :representant,
        :contrainte,
        :contrainte_date,
        :maire,
        :civilite_maire
        )";
  $rep = array(
    "commune" => $_POST['commune'],
    "adresse" => $_POST['adresse'],
    "codepostal" => $_POST['codepostal'],
    "ville" => $_POST['ville'],
    "telephone" => $_POST['telephone'],
    "fax" => $_POST['fax'],
    "courriel" => $_POST['courriel'],
    "web" => $_POST['web'],
    "interlocuteur" => $_POST['interlocuteur'],
    "interlocuteur_tel" =>$_POST['interlocuteur_tel'],
    "domaine" => $_POST['domaine'],
    "typevoie" => $_POST['type_voie'],
    "saisie" => $_SESSION['user'],
    "saisiedate" => date ('Y-m-d'),
    "commentaire" => $_POST['commentaire'],
    "Affichage" => false,
    "etat" => 'en attente',
    "collectivite" => $_POST['collectivite'],
    "fonction" => $_POST['fonction'],
    "civilite" => $_POST['civilite'],
    "representant" => $_POST['representant'],
    "contrainte" => $_POST['contrainte'],
    "contrainte_date" => $_POST['contrainte_date'],
    "maire" => $_POST['maire'],
    "civilite_maire" => $_POST['civilite_maire']
  );
  try {
    $db->prepare($req, $rep);
  }
  catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
  }
  echo "<script type='text/javascript'> document.location.replace('./index.php'); </script>";
}
$req = "SELECT * FROM commune WHERE id = '".$_GET['numero']."'";
$datas = $db->queryOne($req);
$annee = (int)date('Y');
if ($annee > (int)substr($datas->prestation_date,0,4)){
  $prestation = "";
}else{
  $prestation = $datas->prestation_date;
}

include_once '../../template_header/geneseDisabled.php';
?>

<main role="main" style="font-size: 75%">
  <div class="container gene" >
    <div  class="table-bordered" style="padding: 5px;">
      <form method="post">
        <fieldset class="table-bordered">
          <div  style="padding: 5px 15px 15px 15px">
            <h3 style="text-align: center">Données commune de <input class="gen" title="" type="text" value="<?php echo $datas->nom ?>" name="commune"></h3>
            <div class="row">
              <div class="col-6">
                <address>
                  <strong>adresse :</strong><br>
                  <h3>
                    <input class="gen" title="" type="text" value="<?php echo $datas->adresse ?>" name="adresse" size="28"><br>
                    <br>
                    <input class="gen" title="" value="<?php echo $datas->code_postal ?>" name="codepostal"  size="4">
                    <input class="gen" title="" type="text" value="<?php echo $datas->ville ?>" name="ville"  size="25">
                  </h3>
                </address>
              </div>
              <div class="col-6">
                <strong>contact :</strong><br>
                <h5>
                  <label for="telephone">Tel.:</label>
                  <input class="gen" id="telephone" type="text" value="<?php echo $datas->telephone ?>" name="telephone">
                  <br>
                  <label for="fax">fax:</label>
                  <input class="gen" id="fax" type="text" value="<?php echo $datas->fax ?>" name="fax"><br>
                  <label for="courriel">email:</label>
                  <input class="gen" id="courriel" type="text" value="<?php echo $datas->courriel ?>" name="courriel"><br>
                  <label for="web">Site :</label>
                  <input class="gen" id="web" type="text" value="<?php echo $datas->web ?>" name="web"><br>
                  <label for="maire">Maire :</label>
                  <input class="gen" type="text" value="<?php echo $datas->civilite_maire ?>" name="civilite_maire" maxlength="8" size="8">
                  <input class="gen" id="maire" type="text" value="<?php echo $datas->maire ?>" name="maire">
                </h5>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <h4>Adhérent : <?php echo $datas->adhesion ?><span style="margin-left: 4em;">Date d'adhésion :</span> <?php echo $datas->date_adhesion ?></h4>
                <h5>
                  <div class="col-12">
                    <label for="date_prestation">Prestation incluse :</label>
                    <input class="gen" id="date_prestation" type="date" value="<?php echo $prestation; ?>" size="7" disabled="disabled">
                  </div>
                  <div class="col-12">
                    <label for="interlocuteur"> interlocuteur : </label>
                    <input id="interlocuteur" type="text" class="table-bordered gen" name="interlocuteur" size="30">
                    <label for="interlocuteur_tel">tél.:</label>
                    <input id="interlocuteur_tel" type="text" class="table-bordered gen" name="interlocuteur_tel">
                  </div>
                </h5>
              </div>
            </div>
          </div>
        </fieldset>

        <fieldset class="table-bordered">
          <div style="padding: 0 15px 15px 15px">
            <p style="text-align: center"> demande : </p>
            <div class="row">
              <div class="col-lg-8">
                <p style="text-align: center"> &nbsp; </p>
                <label for="domaine" style="width: 200px; text-align: right;"> domaine d'intervention :</label>
                <select class="gen" style="width: 250px" id="domaine" name="domaine" size="1">
                  <option> </option>
                  <option> sécurité </option>
                  <option> travaux de voirie </option>
                  <option> assainissement </option>
                  <option> espaces publics </option>
                </select>
                <br>
                <label for="voie" style="width: 200px; text-align: right"> type de voie :</label>
                <select class="gen" style="width: 250px" id="voie" name="type_voie" size="1">
                  <?php
                  $req = $db->query('SELECT * FROM voie');
                  foreach ($req as $opvoie) {
                    if ($opvoie == "Communale"){
                      echo "<option selected='selected'>".$opvoie->name."</option>";
                    } else {
                      echo "<option>".$opvoie->name."</option>";
                    }
                  };
                  ?>
                </select>
              </div>
              <div class="col-lg-4">
                <p style="text-align: center; width: 180px">Contrainte de délais</p>
                <label for="contrainte" style="text-align: right;"> Type :</label>
                <select class="gen" style="width: 150px" id="contrainte" name="contrainte">
                  <option> </option>
                  <option> Conseil Municipal </option>
                  <option> Budget </option>
                  <option> Subvention </option>
                  <option> Travaux </option>
                </select>
                <br>
                <label for="contrainte_date" style="text-align: right"> Date :</label>
                <input id="contrainte_date" type="text" class="gen" name="contrainte_date">
              </div>
            </div>
          </div>
        </fieldset>

        <fieldset class="table-bordered">
          <div style="padding: 0 15px 15px 15px">
            <p style="text-align: center"> Observations </p>
            <div align="center">
              <textarea title="" id="commentaire" name="commentaire" class="table-bordered gen" style="width:100%;height:100px;"></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-6" style="padding: 0 15px 15px 15px">
              <button type="submit" class="btn btn-success btn-lg">valider</button>
            </div>
            <div class="col-6" align="right" style="padding: 0 15px 15px 15px">
              <button type="reset" class="btn btn-danger btn-lg" onclick="annuler()">Annuler</button>
            </div>
          </div>

          <input class="gen" title="" value="<?php echo $datas->collectivite ?>" name="collectivite" hidden="hidden">
          <input class="gen" title="" value="<?php echo $datas->fonction ?>" name="fonction" hidden="hidden">
          <input class="gen" title="" value="<?php echo $datas->civilite ?>" name="civilite" hidden="hidden">
          <input class="gen" title="" value="<?php echo $datas->representant ?>" name="representant" hidden="hidden">
        </fieldset>
      </form>
    </div>
  </div>
</main>
<?php
include_once '../../template_footer/genese.php';