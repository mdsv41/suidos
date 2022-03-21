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
  $req = 'UPDATE commune SET 
     siren_siret = :siren_siret,
     type = :type,
     collectivite = :collectivite,
     nom = :nom,
     adresse = :adresse,
     code_postal = :code_postal,
     ville = :ville,
     telephone = :telephone,
     fax = :fax,
     courriel = :courriel,
     web = :web,
     civilite = :civilite,
     representant = :representant,
     fonction = :fonction,
     date_adhesion = :date_adhesion,
     adhesion = :adhesion,
     civilite_maire = :civilite_maire,
     maire = :maire,
     division = :division,
     Nb_Habitant = :Nb_Habitant,
     arrondissement = :arrondissement
     WHERE
      id = :id';
  $rep = array(
    'id' => $_POST['id'],
    'siren_siret' => $_POST['siren_siret'],
    'type' => $_POST['type'],
    'collectivite' => $_POST['collectivite'],
    'nom' => $_POST['nom'],
    'adresse' => $_POST['adresse'],
    'code_postal' => $_POST['code_postal'],
    'ville' => $_POST['ville'],
    'telephone' => $_POST['telephone'],
    'fax' => $_POST['fax'],
    'courriel' => $_POST['courriel'],
    'web' => $_POST['web'],
    'civilite' => $_POST['civilite'],
    'representant' => $_POST['representant'],
    'fonction' => $_POST['fonction'],
    'date_adhesion' => datetosql($_POST['date_adhesion']),
    'adhesion' => $_POST['adhesion'],
    'civilite_maire' => $_POST['civilite_maire'],
    'maire' => $_POST['maire'],
    'division' => $_POST['division'],
    'Nb_Habitant' => $_POST['Nb_Habitant'],
    'arrondissement' => $_POST['arrondissement']
  );
  try {
    $db->prepare($req, $rep);
  }
  catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
  }
  ?>
  <script>
      $lieu = $lieu = './Maj-Commune.php?numero='+<?= $_POST['id'] ?>;
      document.location.replace($lieu)
  </script>
  <?php
}

$datas = $db->queryOne("SELECT * FROM commune WHERE id = '".$_GET['numero']."'");

require_once '../../template_header/administrationDisabled.php'
?>
<main role="main">
  <div class="gene">
    <div class="row">
      <div class="w-100">
        <div class="container-fluid">
          <div  class="table-bordered" style="padding: 5px;">
            <form method="post" class="row">
              <fieldset class="table-bordered w-100">
                <div  style="padding: 5px 15px 15px 15px" class="row">
                  <div class="w-100">
                    <h5 style="text-align: center">Siren - Siret :
                      <input class="gen" title="" type="text" value="<?php echo $datas->siren_siret ?>" name="siren_siret" size="10">
                      &nbsp; &nbsp;Type etablissement :
                      <select class="gen" title="type" name="type">
                        <option <?php if ($datas->type == ""): ?> selected="selected"<?php endif; ?>></option>
                        <option <?php if ($datas->type == "Commune"): ?> selected="selected"<?php endif; ?>>Commune</option>
                        <option <?php if ($datas->type == "Communauté de communes"): ?> selected="selected"<?php endif; ?>>Communauté de communes</option>
                        <option <?php if ($datas->type == "Communauté d'agglomération"): ?> selected="selected"<?php endif; ?>>Communauté d'agglomération</option>
                      </select>
                    </h5>
                    <h4 style="text-align: center">Nom long<br/> <input class="gen" title="" type="text" value="<?php echo $datas->collectivite ?>" name="collectivite" size="70"></h4>
                    <h4 style="text-align: center">Nom court<br/><input class="gen" title="" type="text" value="<?php echo $datas->nom ?>" name="nom" size="70"></h4>
                  </div>
                  <div class="col-7">
                    <address>
                      <strong>adresse :</strong><br>
                      <h4>
                        <input class="gen" title="" type="text" value="<?php echo $datas->adresse ?>" name="adresse" size="40"><br>
                        <br>
                        <input class="gen" title="" value="<?php echo $datas->code_postal ?>" name="code_postal"  size="4">
                        <input class="gen" title="" type="text" value="<?php echo $datas->ville ?>" name="ville"  size="25">
                      </h4>
                    </address>
                  </div>
                  <div class="col-4">
                    <strong>contact :</strong><br>
                    <p>
                      <label for="telephone">Tel.:</label>
                      <input class="gen" id="telephone" type="text" value="<?php echo $datas->telephone ?>" name="telephone">
                      <br>
                      <label for="fax">fax:</label>
                      <input class="gen" id="fax" type="text" value="<?php echo $datas->fax ?>" name="fax"><br>
                      <label for="courriel">email:</label>
                      <input class="gen" id="courriel" type="text" value="<?php echo $datas->courriel ?>" name="courriel" size="25"><br>
                      <label for="web">Site :</label>
                      <input class="gen" id="web" type="text" value="<?php echo $datas->web ?>" name="web" size="25"><br>
                    </p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-7">
                    <p style="padding-left: 20px">
                      <label for="adhe">Adhérent :</label>
                      <select id="adhe" class="gen" name="adhesion" size="1">
                        <option <?php if ($datas->adhesion == "OUI"): ?> selected="selected"<?php endif; ?>> OUI </option>
                        <option <?php if ($datas->adhesion == "NON"): ?> selected="selected"<?php endif; ?>> NON </option>
                      </select>
                      &nbsp;&nbsp;
                      <label for="date-adhesion">Date d'adhésion :</label>
                      <input id="date-adhesion" class="gen datepicker" name="date_adhesion" type="text" value="<?= $datas->date_adhesion ?>" size="10">
                    </p>
                  </div>
                  <div class="col-5">
                    <p>
                      <label for="Nb_Habitant">Pop.:</label>
                      <input id="Nb_Habitant" type="number" class="gen" value="<?php echo $datas->Nb_Habitant ?>" name="Nb_Habitant" size="2">
                    </p>
                  </div>
                </div>
              </fieldset>
              <fieldset class="table-bordered w-100">
                <div class="col-1"></div>
                <div class="col-11">
                  <h5>
                    <label for="maire">Maire :</label>
                    <input class="gen" title="civilite_maire" type="text" value="<?php echo $datas->civilite_maire ?>" name="civilite_maire" size="7">
                    <input class="gen" id="maire" type="text" value="<?php echo $datas->maire ?>" name="maire" size="30">
                  </h5>
                </div>
              </fieldset>
              <fieldset class="table-bordered w-100">
                <div class="col-1"></div>
                <div class="col-11">
                  <p>
                    <label for="representant">Représentant :</label>
                    <input class="gen" title="civilite" type="text" value="<?php echo $datas->civilite ?>" name="civilite" size="7">
                    <input class="gen" id="representant" type="text" value="<?php echo $datas->representant ?>" name="representant" size="30">
                    <input class="gen" title="fonction" type="text" value="<?php echo $datas->fonction ?>" name="fonction" size="30">
                  </p>
                </div>
              </fieldset>
              <fieldset class="table-bordered w-100">
                <div class="col-1"></div>
                <div class="col-11">
                  <p>
                    <label for="division">division routière :</label>
                    <select id="division" class="gen" name="division" style="width: 100px;">
                      <option <?php if ($datas->division == ""): ?> selected="selected"<?php endif; ?>></option>
                      <option <?php if ($datas->division == "DRC"): ?> selected="selected"<?php endif; ?>> DRC </option>
                      <option <?php if ($datas->division == "DRN"): ?> selected="selected"<?php endif; ?>> DRN </option>
                      <option <?php if ($datas->division == "DRS"): ?> selected="selected"<?php endif; ?>> DRS </option>
                    </select>
                    &nbsp;&nbsp;
                    <label for="arrondissement">Arrondissement</label>
                    <select id="arrondissement" class="gen" name="arrondissement" style="width: 200px;">
                      <option <?php if ($datas->arrondissement == ""): ?> selected="selected"<?php endif; ?>></option>
                      <option <?php if ($datas->arrondissement == "BLOIS"): ?> selected="selected"<?php endif; ?>> BLOIS </option>
                      <option <?php if ($datas->arrondissement == "VENDOME"): ?> selected="selected"<?php endif; ?>> VENDOME </option>
                      <option <?php if ($datas->arrondissement == "ROMORANTIN"): ?> selected="selected"<?php endif; ?>> ROMORANTIN </option>
                      <option <?php if ($datas->arrondissement == "EPCI"): ?> selected="selected"<?php endif; ?>> EPCI </option>
                    </select>
                  </p>
                </div>
              </fieldset>
              <fieldset style="margin-top: 12px;" class="w-100">
                <div class="row">
                  <div class="col-1">&nbsp;</div>
                  <div class="col-2" style="padding: 0 15px 15px 15px">
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                  </div>
                  <div class="col-8" style="padding: 0 15px 15px 15px; text-align: right">
                    <button type="reset" class="btn btn-danger" onclick="Liste('Commune')">Annuler / Quitter</button>
                  </div>
                  <div class="col-1">&nbsp;</div>
                </div>
              </fieldset>
              <input type="number" title="id" name="id" value="<?php echo $datas->id; ?>" hidden="hidden">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php
include_once '../../template_footer/administration.php';
