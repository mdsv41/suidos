<div class="gestionnaire" style="font-size: 1.07em ">
  <div style="border: solid 5px #C481B2; padding: 10px 0 10px 0; font-size: 75%" class="container">
    <p style="text-align: center; font-size: 125%"> <b>CONTEXTE</b> </p>
    <div class="row">
      <div class="col-3" style="text-align: right">
        <label for="dom_intervention">Domaine d'intervention : </label>
        <br>
        <label for="type_voie">Type de voie : </label>
        <br>
        <label for="presta">Prestation incluse : </label>
      </div>
      <div class="col-3" style="text-align: left">
        <select id="dom_intervention" class="gest" name="domaine" style="width: 160px;">
          <option <?php if ($datas->domaine == "sécurité"): ?> selected="selected"<?php endif; ?>> sécurité </option>
          <option <?php if ($datas->domaine == "travaux de voirie"): ?> selected="selected"<?php endif; ?>> travaux de voirie </option>
          <option <?php if ($datas->domaine == "assainissement"): ?> selected="selected"<?php endif; ?>> assainissement </option>
          <option <?php if ($datas->domaine == "espaces publics"): ?> selected="selected"<?php endif; ?>> espaces publics </option>
        </select>
        <br>
        <select id="type_voie" class="gest" name="type_voie" style="width: 160px;">
          <?php
          echo "<option selected='selected'>".$datas->type_voie."</option>";
          $rep = $db->query('SELECT * FROM voie');
          foreach ($rep as $voie){
            echo "<option>".$voie->name."</option>";
          }
          ?>
        </select>
        <br>
        <input title="" type="text" class="datepicker gest" name="prestation_date" value="<?php echo affiche_date($prestation) ?>" style="width: 160px" disabled="disabled">
      </div>
      <div class="col-2" style="text-align: right">

        <label for="Suite_Donner">Suite à donner :</label>
        <br>
        <label for="contrainte">Contrainte :</label>

        <br>
        <label for="">Etape :</label>

      </div>
      <div class="clo-4" style="text-align: left">
        <select id="Suite_Donner" class="gest" type="text" name="Suite_Donnee" size="1" style="width: 100px;">
          <option> </option>
          <option <?php if ($datas->Suite_Donnee == "Etude"): ?> selected="selected" <?php endif; ?>>Etude</option>
          <option <?php if ($datas->Suite_Donnee == "Sans suite"): ?> selected="selected" <?php endif; ?>>Sans suite</option>
          <option <?php if ($datas->Suite_Donnee == "Re-orientation"): ?> selected="selected" <?php endif; ?>>Re-orientation</option>
        </select> &nbsp;
        <!--
            <label for="archivage">Archivé :</label>
            <select id="archivage" class="gest"" name="archivage" size="1">
            <?php
        if ($datas->archive == 'OUI'){
          echo "<option selected=\"selected\">OUI</option>";
          echo "<option>NON</option>";
        } else {
          echo "<option selected=\"selected\">NON</option>";
          echo "<option>OUI</option>";
        }
        ?>
            </select>
            -->
        <br>
        <select id="contrainte" class="gest"" name="contrainte">
        <option> </option>
        <option <?php if ($datas->contrainte == "Conseil Municipal"): ?> selected="selected"<?php endif; ?>>Conseil Municipal</option>
        <option <?php if ($datas->contrainte == "Budget"): ?> selected="selected"<?php endif; ?>>Budget</option>
        <option <?php if ($datas->contrainte == "Subvention"): ?> selected="selected"<?php endif; ?>>Subvention</option>
        <option <?php if ($datas->contrainte == "Travaux"): ?> selected="selected"<?php endif; ?>>Travaux</option>
        </select>
        <input title="" class="gest" type="text" name="contrainte_date" value="<?php echo $datas->contrainte_date; ?>" style="width: 98px; text-align: center">
        <br>
        <input id="" type="text" name="commande" value="<?php echo $datas->commande; ?>" class="gest" size="10">
        &nbsp;
        <label for="echeance">Echéance :</label>
        <input id="echeance" name="echeance" value="<?php echo affiche_date($datas->echeance); ?>" class="datepicker gest" size="10">
      </div>
      <div class="w-100"></div>
      <div class="col-2" style="text-align: right">
        <label for="objet">Objet :</label>
        <br>
        <label for="commentaire">Information :</label>
      </div>
      <div class="col-10">
        <input id="objet" type="text" class="gest" value="<?php echo $datas->objet ?>" name="objet" style="width: 609px">
        <br>
        <textarea id="commentaire" name="info" class="table-bordered gest" style="width:609px;height:96px;"><?php echo $datas->commentaire ?></textarea>
      </div>
    </div>

  </div>
  <div style="font-size: 5px"> &nbsp; </div>
  <div class="container" style="border: solid 5px #C481B2; padding: 10px 0 10px 0;font-size: 75%">
    <p style="text-align: center; font-size: 125%"> Validation </p>

    <div class="row">
      <div class="col-1">
      </div>
      <div class="col-3" style="text-align: center">
        <p style="font-size: 150%"> 1er demande </p>
      </div>
      <div class="col-1">
      </div>
      <div class="col-3" style="text-align: center">
        <p style="font-size: 150%"> 2éme demande </p>
      </div>
      <div class="col-1">
      </div>
      <div class="col-3" style="text-align: center">
        <p style="font-size: 150%"> 3éme demande </p>
      </div>
      <div class="w-100"></div>
      <div class="col-1">
        <p style="text-align: right">Imputation</p>
      </div>
      <div class="col-3" style="text-align: center">
        <select id="d1_facture" type="text" class="table-bordered gest" name="d1_facture" size="1" style="width: 175px;">
          <?php
          if ($datas->d1_facture == "Cotisation"){
            echo '<option></option>';
            echo '<option selected="selected">Cotisation</option>';
            echo '<option>Payante</option>';
          }elseif ($datas->d1_facture == "Payante") {
            echo '<option></option>';
            echo '<option>Cotisation</option>';
            echo '<option selected="selected">Payante</option>';
          }else {
            echo '<option selected="selected"></option>';
            echo '<option>Cotisation</option>';
            echo '<option>Payante</option>';
          }
          ?>
        </select>
      </div>
      <div class="col-1">
      </div>
      <div class="col-3" style="text-align: center">
        <select id="d2_facture" type="text" class="table-bordered gest" name="d2_facture" size="1" style="width: 175px;">
          <?php
          if ($datas->d2_facture == "Cotisation"){
            echo '<option></option>';
            echo '<option selected="selected">Cotisation</option>';
            echo '<option>Payante</option>';
          }elseif ($datas->d2_facture == "Payante") {
            echo '<option></option>';
            echo '<option>Cotisation</option>';
            echo '<option selected="selected">Payante</option>';
          }else {
            echo '<option selected="selected"></option>';
            echo '<option>Cotisation</option>';
            echo '<option>Payante</option>';
          }
          ?>
        </select>
      </div>
      <div class="col-1">
      </div>
      <div class="col-3" style="text-align: center">
        <select id="d3_facture" type="text" class="table-bordered gest" name="d3_facture" size="1" style="width: 175px;">
          <?php
          if ($datas->d3_facture == "Cotisation"){
            echo '<option></option>';
            echo '<option selected="selected">Cotisation</option>';
            echo '<option>Payante</option>';
          }elseif ($datas->d3_facture == "Payante") {
            echo '<option></option>';
            echo '<option>Cotisation</option>';
            echo '<option selected="selected">Payante</option>';
          }else {
            echo '<option selected="selected"></option>';
            echo '<option>Cotisation</option>';
            echo '<option>Payante</option>';
          }
          ?>
        </select>
      </div>
      <div class="w-100"></div>
      <div class="col-1" style="text-align: right">
        <p>Mission</p>
      </div>
      <div class="col-3"style="text-align: center">
        <select id="d1_mission" type="text" class="table-bordered gest" name="d1_mission" size="1" style="width: 175px;">
          <?php
          $req = $db->query('SELECT * FROM mission');
          foreach ($req as $opmission){
            if ($datas->d1_mission == $opmission->name){
              echo "<option selected =\"selected\">".$opmission->name."</option>";
            } else {
              echo "<option>".$opmission->name."</option>";
            }
          }
          ?>
        </select>
      </div>
      <div class="col-1">
      </div>
      <div class="col-3" style="text-align: center">
        <select id="d2_mission" type="text" class="table-bordered gest" name="d2_mission" size="1" style="width: 175px;">
          <?php
          $req = $db->query('SELECT * FROM mission');
          foreach ($req as $opmission){
            if ($datas->d2_mission == $opmission->name){
              echo "<option selected =\"selected\">".$opmission->name."</option>";
            } else {
              echo "<option>".$opmission->name."</option>";
            }
          }
          ?>
        </select>
      </div>
      <div class="col-1">
      </div>
      <div class="col-3" style="text-align: center">
        <select id="d3_mission" type="text" class="table-bordered gest" name="d3_mission" size="1" style="width: 175px;">
          <?php
          $req = $db->query('SELECT * FROM mission');
          foreach ($req as $opmission){
            if ($datas->d3_mission == $opmission->name){
              echo "<option selected =\"selected\">".$opmission->name."</option>";
            } else {
              echo "<option>".$opmission->name."</option>";
            }
          }
          ?>
        </select>
      </div>
      <div class="w-100"></div>
      <div class="col-1" style="text-align: right">
        <p>Prestation</p>
      </div>
      <div class="col-3"style="text-align: center">
        <select id="d1_prestation" type="text" class="table-bordered gest" name="d1_prestation" size="1" style="width: 175px;">
          <?php
          $req = $db->query('SELECT * FROM prestation');
          foreach ($req as $opprestation){
            if ($datas->d1_prestation == $opprestation->name){
              echo "<option selected =\"selected\">".$opprestation->name."</option>";
            } else {
              echo "<option>".$opprestation->name."</option>";
            }
          }
          ?>
        </select>
      </div>
      <div class="col-1">
      </div>
      <div class="col-3" style="text-align: center">
        <select id="d2_prestation" type="text" class="table-bordered gest" name="d2_prestation" size="1" style="width: 175px;">
          <?php
          $req = $db->query('SELECT * FROM prestation');
          foreach ($req as $opprestation){
            if ($datas->d2_prestation == $opprestation->name){
              echo "<option selected =\"selected\">".$opprestation->name."</option>";
            } else {
              echo "<option>".$opprestation->name."</option>";
            }
          }
          ?>
        </select>
      </div>
      <div class="col-1">
      </div>
      <div class="col-3" style="text-align: center">
        <select id="d3_prestation" type="text" class="table-bordered gest" name="d3_prestation" size="1" style="width: 175px;">
          <?php
          $req = $db->query('SELECT * FROM prestation');
          foreach ($req as $opprestation){
            if ($datas->d3_prestation == $opprestation->name){
              echo "<option selected =\"selected\">".$opprestation->name."</option>";
            } else {
              echo "<option>".$opprestation->name."</option>";
            }
          }
          ?>
        </select>
      </div>
      <div class="w-100"></div>
      <div class="col-1" style="text-align: right">
        <p>Rendu</p>
      </div>
      <div class="col-3"style="text-align: center">
        <select id="d1_rendu" type="text" class="table-bordered gest" name="d1_rendu" size="1" style="width: 175px;">
          <?php
          $req = $db->query('SELECT * FROM rendu');
          foreach ($req as $oprendu){
            if ($datas->d1_rendu == $oprendu->name){
              echo "<option selected =\"selected\">".$oprendu->name."</option>";
            } else {
              echo "<option>".$oprendu->name."</option>";
            }
          }
          ?>
        </select>
      </div>
      <div class="col-1">
      </div>
      <div class="col-3" style="text-align: center">
        <select id="d2_rendu" type="text" class="table-bordered gest" name="d2_rendu" size="1" style="width: 175px;">
          <?php
          $req = $db->query('SELECT * FROM rendu');
          foreach ($req as $oprendu){
            if ($datas->d2_rendu == $oprendu->name){
              echo "<option selected =\"selected\">".$oprendu->name."</option>";
            } else {
              echo "<option>".$oprendu->name."</option>";
            }
          }
          ?>
        </select>
      </div>
      <div class="col-1">
      </div>
      <div class="col-3" style="text-align: center">
        <select id="d3_rendu" type="text" class="table-bordered gest" name="d3_rendu" size="1" style="width: 175px;">
          <?php
          $req = $db->query('SELECT * FROM rendu');
          foreach ($req as $oprendu){
            if ($datas->d3_rendu == $oprendu->name){
              echo "<option selected =\"selected\">".$oprendu->name."</option>";
            } else {
              echo "<option>".$oprendu->name."</option>";
            }
          }
          ?>
        </select>
      </div>
      <div class="w-100"></div>
      <div class="col-1" style="text-align: right">
        <p>Chargé</p>
      </div>
      <div class="col-3"style="text-align: center">
        <select id="d1_charge" type="text" class="table-bordered gest" name="d1_charge_affaire"  size="1" style="width: 175px;">
          <?php
          echo '<option selected=\"selected\">' .$datas->d1_charge. "</option>";
          $req = $db->query('SELECT * FROM users');
          foreach ($req as $charges) {
            echo "<option>" .$charges->initial. "</option>";
          }
          ?>
        </select>
      </div>
      <div class="col-1">
      </div>
      <div class="col-3" style="text-align: center">
        <select id="d2_charge" type="text" class="table-bordered gest" name="d2_charge_affaire"  size="1" style="width: 175px;">
          <option selected></option>
          <?php
          echo '<option selected=\"selected\">' .$datas->d2_charge. "</option>";
          $req = $db->query('SELECT * FROM users');
          foreach ($req as $charges) {
            echo "<option>" .$charges->initial. "</option>";
          }
          ?>
        </select>
      </div>
      <div class="col-1">
      </div>
      <div class="col-3" style="text-align: center">
        <select id="d3_charge" type="text" class="table-bordered gest" name="d3_charge_affaire"  size="1" style="width: 175px;">
          <option selected></option>
          <?php
          echo '<option selected=\"selected\">' .$datas->d3_charge. "</option>";
          $req = $db->query('SELECT * FROM users');
          foreach ($req as $charges) {
            echo "<option>" .$charges->initial. "</option>";
          }
          ?>
        </select>
      </div>
    </div>
  </div>
  <div style="font-size: 5px"> &nbsp; </div>
  <div id="facturation" class="container" style="border: solid 5px #C481B2; padding: 10px 0 10px 0; font-size: 75%">
    <p style="text-align: center; font-size: 125%">Facturation</p>
    <table class="table table-hover">
      <thead>
      <tr>
        <th style="width: 70px; text-align: center;">Mission</th>
        <th style=" text-align: center;">Rendu</th>
        <th style="width: 200px; text-align: center;">Formule</th>
        <th style="width: 100px; text-align: center;">Montant Besoin</th>
        <th style="width: 100px; text-align: center;">Montant travaux</th>
        <th style="width: 100px; text-align: center;">Estimation</th>
        <th style="width: 100px; text-align: center;">Facture</th>
        <th style="width: 20px; text-align: center;"></th>
      </tr>
      </thead>
      <tbody>
      <?php
      $req = "SELECT * FROM facture WHERE numero = '".$datas->numero."'";
      $req = $db->query($req);
      foreach ($req as $facture){
        if ($facture->formule == "f"){
          $form_calcul = "Forfait : ".$facture->F_forfait."€";
        }ELSE IF ($facture->formule == "t"){
          $form_calcul = $facture->F_taux."%";
        }ELSE IF ($facture->formule == "mt"){
          $form_calcul = $facture->F_min." < ".$facture->F_taux. "%";
        }ELSE IF ($facture->formule == "tm"){
          $form_calcul = $facture->F_taux."% < ".$facture->F_max;
        }ELSE IF ($facture->formule == "mtm"){
          $form_calcul = $facture->F_min." < ".$facture->F_taux."% < ".$facture->F_max;
        }ELSE{
          $form_calcul = "";
        };
        ?>
        <tr id="<?= $facture->id; ?>" onclick="selecfacture(this.id)">
          <th style="text-align: center"><?= $facture->mission; ?></th>
          <th><?=$facture->rendu; ?></th>
          <th style="text-align: center"><?= $form_calcul; ?></th>
          <th style="text-align: center"><?= affiche_nombre($facture->m_besoin); ?></th>
          <th style="text-align: center"><?= affiche_nombre($facture->m_travaux); ?></th>
          <th style="text-align: center"><?= affiche_nombre($facture->m_estimation); ?></th>
          <th style="text-align: center"><?= affiche_nombre($facture->m_facture); ?></th>
          <th style="text-align: center"><a href="./template/facture.php?id=<?= $facture->id; ?>&numero=<?= $datas->numero; ?>" class="btn-success" role="button"><span class="ui-icon ui-icon-print"></span></a></th>
        </tr>
        <?php
      }
      ?>
      </tbody>
    </table>
    <div style="text-align: center">
      <a href="<?php echo "./New_Facture.php?numero=".$datas->numero ?>" class="btn btn-primary" role="button" aria-pressed="true">Nouvelle Facture</a>
    </div>
  </div>

</div>
