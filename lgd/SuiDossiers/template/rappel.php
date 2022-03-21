<?php
/**
 * Created by PhpStorm.
 * User: manuel
 * Date: 18/05/2017
 * Time: 14:38
 */
?>
<div style="color: #394f79">
  <div class="row" style="border: solid 5px #a5bbd9; padding: 10px 0 10px 0;font-size: 100%">
    <div class="w-100" style="text-align: center">
      <h4><?php echo $datas->collectivite; ?></h4>
      Maire:&nbsp;<?php echo $datas->civilite; ?>&nbsp;<?php echo $datas->representant ?><br>
      <?php echo $datas->adresse; ?><br>
      <?php echo $datas->code_postal; ?>&nbsp;-&nbsp;<?php echo $datas->commune ?>
      <br>&nbsp;
    </div>
    <div class="row">
      <div class="col-7" style="font-size: 0.9em">
        tél:&nbsp;<?php echo $datas->telephone ?>
      </div>
      <div class="col-5" style="text-align: right">
        Division : <?php echo $presta->division ?>
      </div>
      <div class="w-100" >
        <div class="col-7" style="font-size: 0.9em">
          fax:&nbsp;<?php echo $datas->fax ?>
        </div>
      </div>
    </div>
    <div>
      courriel:&nbsp;<a href="mailto:<?php echo $datas->courriel ?>?subject=<?php echo $datas->commune.'&nbsp;-&nbsp;'.$datas->objet ?>"><?php echo $datas->courriel ?></a><br>
      web:&nbsp;<?php echo $datas->web ?>
    </div>
    <div style="text-align: right">
      date adhéssion : <?php echo affiche_date($presta->date_adhesion) ?>
    </div>
  </div>
  <div style="font-size: 5px"> &nbsp; </div>
  <div class="row" style="border: solid 5px #a5bbd9; padding: 10px 0 10px 0;font-size: 100%">
    <div class="col-4" style="text-align: right; padding: 0;">
      Saisine:<br>
      RDV:<br>
      Commande:<br>
    </div>
    <?php
    if ($datas->d3_rendu != ''){
      $commande = $datas->d3_rendu;
    }elseif ($datas->d2_rendu != ''){
      $commande = $datas->d2_rendu;
    }else{
      $commande = $datas->d1_rendu;
    }

    ?>
    <div class="col-8" style="text-align: left; padding: 0;">
      <b><?php echo affiche_date($datas->saisie_date) ?></b>
      <input type="text" name="saisine" value="<?php echo affiche_date($datas->saisie_date) ?>" hidden="hidden">
      <br>
      <b><input title="" type="text" class="datepicker" value="<?php echo affiche_date($datas->ad_gen_rdv) ?>" name="ad_gen_rdv" style="background: #a5bbd9; padding: initial"  size="10"></b>
      <br>
      <b><?php echo $commande ?></b>
      <br>
    </div>
    <div class="w-100"></div>
    <div class="col-4" style="text-align: right; padding: 0;">
      Interlocuteur:
    </div>
    <div class="col-8" style="text-align: left; padding: 0;">
      <input title="" name="interlocuteur" value="<?php echo $datas->interlocuteur; ?>" style=" background: #a5bbd9">
    </div>
    <div class="w-100"></div>
    <div class="col-4" style="text-align: right; padding: 0;">
      Tél:
    </div>
    <div class="col-8" style="text-align: left; padding: 0;">
      <input title="" name="interlocuteur_tel" value="<?php echo $datas->interlocuteur_tel ; ?>" style="background: #a5bbd9;">
    </div>
    <div class="w-100"></div>
    <p style="padding: 0 0 0 10px;font-size: 100%">
      Domaine d'intervention:&nbsp;<b><?php echo $datas->domaine; ?></b>
      <br>
      Type de voie:&nbsp;<b><?php echo $datas->type_voie; ?></b>
      <br>
      Contrainte:&nbsp;<b><?php echo $datas->contrainte; ?>&nbsp;-&nbsp;<?php echo affiche_date($datas->contrainte_date) ?></b>
      <br>
      Objet:&nbsp;<b><?php echo $datas->objet ?></b>
      <br>
      Echéance:&nbsp;<b><?php echo $datas->commande; ?>&nbsp;-&nbsp;<?php echo $datas->echeance; ?></b>
    </p>
  </div>
  <div style="font-size: 5px"> &nbsp; </div>
  <div>
    <div class="row" style="text-align: center; border: solid 5px #a5bbd9; padding: 10px 0 10px 0;font-size: 100%">
      <label for="commentaire" style="text-align: left">Informations :</label>
      <textarea id="commentaire" name="info"  style="border: none;color:#394f79;background:#8CA8CF;width:380px;height:170px;" disabled="disabled"><?php echo $datas->commentaire ?></textarea>
    </div>
  </div>
</div>

