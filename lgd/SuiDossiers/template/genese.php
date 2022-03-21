<div class="container-fluid" style="border: solid 2px #9c27b0; padding-bottom: 10px;">
    <h1 style="text-align: center"> Rappel saisie provisoire </h1>
    <div class="col-lg-6">
        <label for="dom_intervention">Domaine d'intervention : </label>
        <select id="dom_intervention" name="domaine" size="1">
            <option <?php if ($datas->domaine == "sécurité"): ?> selected="selected"<?php endif; ?>> sécurité </option>
            <option <?php if ($datas->domaine == "travaux de voirie"): ?> selected="selected"<?php endif; ?>> travaux de voirie </option>
            <option <?php if ($datas->domaine == "assainissement"): ?> selected="selected"<?php endif; ?>> assainissement </option>
            <option <?php if ($datas->domaine == "espaces publics"): ?> selected="selected"<?php endif; ?>> espaces publics </option>
        </select>
        <br>
        <label for="type_voie">Type de voie : </label>
        <select id="type_voie" name="type_voie" size="1">
            <option <?php if ($datas->type_voie == "Communal"): ?> selected="selected"<?php endif; ?>>Communal</option>
            <option <?php if ($datas->type_voie == "Départemental"): ?> selected="selected"<?php endif; ?>>Départemental</option>
            <option <?php if ($datas->type_voie == "Intercommunal"): ?> selected="selected"<?php endif; ?>>Intercommunal</option>
        </select>
        <br>
        <label for="presta">Prestation incluse : </label>
        <select id="presta" name="prestation_incluse" size="1">
            <?php
            if ($datas->prestation_incluse == 'OUI'){
                echo "<option selected=\"selected\">OUI</option>";
                echo "<option>NON</option>";
            } else {
                echo "<option selected=\"selected\">NON</option>";
                echo "<option>OUI</option>";
            }
            ?>
        </select>
        &nbsp; - &nbsp;
        <input title="" type="date" class="datepicker" name="prestation_date" value="<?php echo affiche_date($presta->prestation_date) ?>" size="8">
    </div>
    <div class="col-lg-6">
        <label for="archivage">Archivé :</label>
        <select id="archivage" name="archivage" size="1">
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
        <br>
        <label for="contrainte">Contrainte :</label>
        <select id="contrainte" name="contrainte">
            <option> </option>
            <option <?php if ($datas->contrainte == "Conseil Municipal"): ?> selected="selected"<?php endif; ?>>Conseil Municipal</option>
            <option <?php if ($datas->contrainte == "Budget"): ?> selected="selected"<?php endif; ?>>Budget</option>
            <option <?php if ($datas->contrainte == "Subvention"): ?> selected="selected"<?php endif; ?>>Subvention</option>
            <option <?php if ($datas->contrainte == "Travaux"): ?> selected="selected"<?php endif; ?>>Travaux</option>
        </select>
        &nbsp;-&nbsp;
        <input title="" type="date" class="datepicker" name="contrainte_date" value="<?php echo affiche_date($datas->contrainte_date) ?>" size="8">
        <br>
        <h4><label for="suiteadonner">Suite à donner :</label>
            <select id="suiteadonner" type="text" name="suite" size="1" style="width: 100px;">
                <option selected="selected">étude</option>
                <option>sans suite</option>
                <option>ré-orientation</option>
            </select>
            <br>
            <label for="ad_gen_rdv1">Date de RDV</label>
            <input id="ad_gen_rdv1" type="date"  value="<?php echo affiche_date($datas->ad_gen_rdv) ?>" size="8" disabled="disabled">
        </h4>
    </div>
    <div class="col-lg-12">
        <label for="objet">Objet :</label>
        <input id="objet" type="text" value="<?php echo $datas->objet ?>" name="objet" size="60">
        <br>
        <label for="commentaire">Information :</label>
        <textarea id="commentaire" name="info" class="table-bordered" style="width:1110px;height:128px;"><?php echo $datas->commentaire ?></textarea>
    </div>
</div>
<div class="container-fluid" style="border: solid 2px #9c27b0; padding-bottom: 10px;">
    <h1 style="text-align: center"> Validation </h1>
    <div class="col-lg-4" style="text-align: right; border: solid 1px #ffffff;">
        <h1 style="text-align: center"> 1ére demande</h1>
        <label for="d1_facture">imputation</label>
        <select id="d1_facture" type="text" class="table-bordered" name="d1_facture" size="1" style="width: 250px;">
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
        <br>
        <label for="d1_mission">MISSION</label>
        <select id="d1_mission" type="text" class="table-bordered" name="d1_mission" size="1" style="width: 250px;">
            <?php
            $req = $pdo->query('SELECT * FROM mission');
            while ($opmission = $req->fetch(PDO::FETCH_OBJ)){
                if ($datas->d1_mission == $opmission->name){
                    echo '<option selected ="selected">'.$opmission->name.'</option>';
                } else {
                    echo "<option>".$opmission->name."</option>";
                }
            };
            ?>
        </select>
        <br>
        <label for="d1_prestation">PRESTATION</label>
        <select id="d1_prestation" type="text" class="table-bordered" name="d1_prestation" size="1" style="width: 250px;">
            <?php
            $req = $pdo->query('SELECT * FROM prestation');
            while ($opprestation = $req->fetch(PDO::FETCH_OBJ)){
                if ($datas->d1_prestation == $opprestation->name){
                    echo '<option selected ="selected">'.$opprestation->name.'</option>';
                } else {
                    echo "<option>".$opprestation->name."</option>";
                }
            };
            ?>
        </select>
        <br>
        <label for="d1_rendu">RENDU</label>
        <select id="d1_rendu" type="text" class="table-bordered" name="d1_rendu" size="1" style="width: 250px;">
            <?php
            $req = $pdo->query('SELECT * FROM rendu');
            while ($oprendu = $req->fetch(PDO::FETCH_OBJ)){
                if ($datas->d1_rendu == $oprendu->name){
                    echo "<option selected =\"selected\">".$oprendu->name."</option>";
                } else {
                    echo "<option>".$oprendu->name."</option>";
                }
            };
            ?>
        </select>
        <br>
        <label for="d1_charge">CHARGE</label>
        <select id="d1_charge" type="text" class="table-bordered" name="d1_charge_affaire"  size="1" style="width: 250px;">
            <?php
            $req2 = $db->query('SELECT * FROM users');
            foreach ($req2 as $charges){
                if ($charges->accreditation = 10) {
                    if ($datas->d1_charge == $charges->username){
                        echo '<option selected=\"selected\">' .$charges->username. "</option>";
                    }else{
                        echo "<option>" .$charges->username. "</option>";
                    };
                } elseif ($charges->accreditation = 111 ) {
                    if ($datas->d1_charge_affaire == $charges->username){
                        echo '<option selected=\"selected\">' .$charges->username. "</option>";
                    }else{
                        echo "<option>" .$charges->username. "</option>";
                    };
                };
            };
            ?>
        </select>
        <br>
        <label for="d1_echeance">ECHEANCE</label>
        <input id="d1_echeance" type="date" class="datepicker" name="d1_echeance" value="<?php echo affiche_date($datas->d1_echeance) ?>">
    </div>
    <div class="col-lg-4" style="text-align: right;border: solid 1px #ffffff;">
        <h1 style="text-align: center"> 2ème demande</h1>
        <label for="d2_facture">imputation</label>
        <select id="d2_facture" type="text" class="table-bordered" name="d2_facture" size="1" style="width: 250px;">
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
        <br>
        <label for="d2_mission">MISSION</label>
        <select id="d2_mission" type="text" class="table-bordered" name="d2_mission" size="1" style="width: 250px;">
            <?php
            $req = $pdo->query('SELECT * FROM mission');
            while ($opmission = $req->fetch(PDO::FETCH_OBJ)){
                if ($datas->d2_mission == $opmission->name){
                    echo "<option selected =\"selected\">".$opmission->name."</option>";
                } else {
                    echo "<option>".$opmission->name."</option>";
                }
            };
            ?>
        </select>
        <br>
        <label for="d2_prestation">PRESTATION</label>
        <select id="d2_prestation" type="text" class="table-bordered" name="d2_prestation" size="1" style="width: 250px;">
            <?php
            $req = $pdo->query('SELECT * FROM prestation');
            while ($opprestation = $req->fetch(PDO::FETCH_OBJ)){
                if ($datas->d2_prestation == $opprestation->name){
                    echo "<option selected =\"selected\">".$opprestation->name."</option>";
                } else {
                    echo "<option>".$opprestation->name."</option>";
                }
            };
            ?>
        </select>
        <br>
        <label for="d2_rendu">RENDU</label>
        <select id="d2_rendu" type="text" class="table-bordered" name="d2_rendu" size="1" style="width: 250px;">
            <?php
            $req = $pdo->query('SELECT * FROM rendu');
            while ($oprendu = $req->fetch(PDO::FETCH_OBJ)){
                if ($datas->d2_rendu == $oprendu->name){
                    echo "<option selected =\"selected\">".$oprendu->name."</option>";
                } else {
                    echo "<option>".$oprendu->name."</option>";
                }
            };
            ?>
        </select>
        <br>
        <label for="d2_charge">CHARGE</label>
        <select id="d2_charge" type="text" class="table-bordered" name="d2_charge_affaire"  size="1" style="width: 250px;">
            <option selected></option>
            <?php
            $req2 = $db->query('SELECT * FROM users');
            foreach ($req2 as $charges){
                if ($charges->accreditation = 10) {
                    if ($datas->d2_charge == $charges->username){
                        echo '<option selected=\"selected\">' .$charges->username. "</option>";
                    }else{
                        echo "<option>" .$charges->username. "</option>";
                    };
                } elseif ($charges->accreditation = 111 ) {
                    if ($datas->d2_charge == $charges->username){
                        echo '<option selected=\"selected\">' .$charges->username. "</option>";
                    }else{
                        echo "<option>" .$charges->username. "</option>";
                    };
                };
            };
            ?>
        </select>
        <br>
        <label for="d2_echeance">ECHEANCE</label>
        <input id="d2_echeance" type="date" class="datepicker" name="d2_echeance" value="<?php echo affiche_date($datas->d2_echeance) ?>">
    </div>
    <div class="col-lg-4" style="text-align: right; border: solid 1px #ffffff;">
        <h1 style="text-align: center"> 3ème demande</h1>
        <label for="d3_facture">imputation</label>
        <select id="d3_facture" type="text" class="table-bordered" name="d3_facture" size="1" style="width: 250px;">
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
        <br>
        <label for="d3_mission">MISSION</label>
        <select id="d3_mission" type="text" class="table-bordered" name="d3_mission" size="1" style="width: 250px;">
            <?php
            $req = $pdo->query('SELECT * FROM mission');
            while ($opmission = $req->fetch(PDO::FETCH_OBJ)){
                if ($datas->d3_mission == $opmission->name){
                    echo "<option selected =\"selected\">".$opmission->name."</option>";
                } else {
                    echo "<option>".$opmission->name."</option>";
                }
            };
            ?>
        </select>
        <br>
        <label for="d3_prestation">PRESTATION</label>
        <select id="d3_prestation" type="text" class="table-bordered" name="d3_prestation" size="1" style="width: 250px;">
            <?php
            $req = $pdo->query('SELECT * FROM prestation');
            while ($opprestation = $req->fetch(PDO::FETCH_OBJ)){
                if ($datas->d3_prestation == $opprestation->name){
                    echo "<option selected =\"selected\">".$opprestation->name."</option>";
                } else {
                    echo "<option>".$opprestation->name."</option>";
                }
            };
            ?>
        </select>
        <br>
        <label for="d3_rendu">RENDU</label>
        <select id="d3_rendu" type="text" class="table-bordered" name="d3_rendu" size="1" style="width: 250px;">
            <?php
            $req = $pdo->query('SELECT * FROM rendu');
            while ($oprendu = $req->fetch(PDO::FETCH_OBJ)){
                if ($datas->d3_rendu == $oprendu->name){
                    echo "<option selected =\"selected\">".$oprendu->name."</option>";
                } else {
                    echo "<option>".$oprendu->name."</option>";
                }
            };
            ?>
        </select>
        <br>
        <label for="d3_charge">CHARGE</label>
        <select id="d3_charge" type="text" class="table-bordered" name="d3_charge_affaire"  size="1" style="width: 250px;">
            <option selected></option>
            <?php
            $req2 = $db->query('SELECT * FROM users');
            foreach ($req2 as $charges){
                if ($charges->accreditation = 10) {
                    if ($datas->d3_charge == $charges->username){
                        echo '<option selected=\"selected\">' .$charges->username. "</option>";
                    }else{
                        echo "<option>" .$charges->username. "</option>";
                    };
                } elseif ($charges->accreditation = 111 ) {
                    if ($datas->d3_charge == $charges->username){
                        echo '<option selected=\"selected\">' .$charges->username. "</option>";
                    }else{
                        echo "<option>" .$charges->username. "</option>";
                    };
                };
            };
            ?>
        </select>
        <br>
        <label for="d3_echeance">ECHEANCE</label>
        <input id="d3_echeance" type="date" class="datepicker" name="d3_echeance" value="<?php echo affiche_date($datas->d3_echeance) ?>">
    </div>
</div>
<div class="container-fluid" style="border: solid 2px #9c27b0; padding-bottom: 10px;">
    <h1 style="text-align: center">Facturation</h1>
    <div class="col-lg-8" style="border: solid 1px #ffffff;">
        <h1 style="text-align: center"> AMO </h1>
    </div>
    <div class="col-lg-4" style="border: solid 1px #ffffff;">
        <h1 style="text-align: center"> MOE </h1>
    </div>
</div>
<div class="container-fluid" style="border: solid 2px #9c27b0; padding-bottom: 10px;">
    <h1 style="text-align: center">Statistiques</h1>
    <div class="col-lg-4" style="border: solid 1px #ffffff;">
        <h1 style="text-align: center"> Activité agence </h1>
    </div>
    <div class="col-lg-4" style="border: solid 1px #ffffff;">
        <h1 style="text-align: center"> Bilan technique </h1>
    </div>
    <div class="col-lg-4" style="border: solid 1px #ffffff;">
        <h1 style="text-align: center"> Extraction </h1>
    </div>
</div>