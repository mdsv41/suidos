<!--
ONGLET ADMINISTRATIF
-->


<div class="administratif">

  <!-- convention -->
  <div class="container-fluid" style="text-align: center; border: solid 5px #0e6e61; font-size: 85%">
    <p style="text-align: center; font-size: 125%"> Convention </p>
    <div class="row">
      <div class="col-1" style="text-align: center; padding: initial;">
        mission
      </div>
      <div class="col-5" style="text-align: center; padding: initial;">
        objet
      </div>
      <div class="col-1" style="text-align: center; padding: initial;">
        rédaction
      </div>
      <div class="col-1" style="text-align: center; padding: initial;">
        commune
      </div>
      <div class="col-1" style="text-align: center; padding: initial;">
        retour
      </div>
      <div class="col-1" style="text-align: center; padding: initial;">
        président
      </div>
      <div class="col-1" style="text-align: center; padding: initial;">
        commune
      </div>
      <div class="col-12" style="font-size: 1px">&nbsp;</div>
      <?php
      if ($datas->d1_facture == "Payante"){ ?>
        <div class="col-1" style="text-align: center; padding: initial">
          <p style=" text-align: center; padding: initial" class="admin"><?php echo $datas->d1_mission ?></p>
        </div>
        <div class="col-5" style="text-align: center; padding: initial">
          <p style=" text-align: center; padding: initial" class="admin"><?php echo $datas->d1_prestation ?></p>
        </div>
        <?php
      }elseif ($datas->d2_facture == "Payante"){ ?>
        <div class="col-1" style="text-align: center; padding: initial">
          <input title="" type="text" class="table-bordered"  value="<?php echo $datas->d2_mission ?>" style="width: 45px;" disabled="disabled">
        </div>
        <div class="col-5" style="text-align: center; padding: initial">
          <input title="" type="text" class="table-bordered"  value="<?php echo $datas->d2_prestation ?>" style="width: 200px" disabled="disabled">
        </div>
        <?php
      }elseif ($datas->d3_facture == "Payante"){ ?>
        <div class="col-1" style="text-align: center; padding: initial">
          <input title="" type="text" class="table-bordered"  value="<?php echo $datas->d3_mission ?>" style="width: 45px; text-align: center; padding: initial;" disabled="disabled">
        </div>
        <div class="col-5" style="text-align: center; padding: initial">
          <input title="" type="text" class="table-bordered"  value="<?php echo $datas->d3_prestation ?>" style="width: 200px" disabled="disabled">
        </div>
        <?php
      }else { ?>
        <div class="col-1">
          &nbsp;
        </div>
        <div class="col-5">
          &nbsp;
        </div>
        <?php
      }
      ?>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->conv_redaction) ?>" name="conv_redaction" style="padding: initial" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->conv_commune1) ?>" name="conv_commune1" style="padding: initial" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->conv_retour) ?>" name="conv_retour" style="padding: initial" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->conv_president) ?>" name="conv_president" style="padding: initial" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->conv_commune2) ?>" name="conv_commune2" style="padding: initial" class="datepicker admin" size="7">
      </div>
    </div>
    <div class="container" style="font-size: 5px"> &nbsp; </div>
  </div>
  <div class="container" style="font-size: 5px"> &nbsp; </div>


  <!-- avenant -->
  <div class="container-fluid" style="text-align: center ;border: solid 5px #0e6e61; padding-top: 5px; padding-bottom: 5px; font-size: 85%">
    <p style="text-align: center; font-size: 125%"> Avenant </p>
    <div class="row">
      <div class="col-2" style="text-align: center; padding: initial">
        n°
      </div>
      <div class="col-4" style="text-align: center; padding: initial">
        objet
      </div>
      <div class="col-1" style="text-align: center; padding: initial">
        rédaction
      </div>
      <div class="col-1" style="text-align: center; padding: initial">
        commune
      </div>
      <div class="col-1" style="text-align: center; padding: initial">
        retour
      </div>
      <div class="col-1" style="text-align: center; padding: initial">
        président
      </div>
      <div class="col-1" style="text-align: center; padding: initial">
        commune
      </div>
      <div class="col-1" style="text-align: center; padding: initial">&nbsp;</div>
      <div class="col-2" style="text-align: center; padding: initial"> 1 </div>
      <div class="col-4" style="text-align: center; padding: initial; font-size: 85%">
        <select title="" type="text" class="table-bordered admin" name="av1_objet" size="1" style="width: 200px; padding: initial">
          <?php
          $req = $db->query('SELECT * FROM avenant');
          foreach ($req as $opavenant){
            if ($datas->av1_objet == $opavenant->name){
              echo "<option selected =\"selected\">".$opavenant->name."</option>";
            } else {
              echo "<option>".$opavenant->name."</option>";
            }
          };
          ?>
        </select>
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->av1_redaction) ?>" name="av1_redaction" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->av1_commune1) ?>" name="av1_commune1" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->av1_retour) ?>" name="av1_retour" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->av1_president) ?>" name="av1_president" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->av1_commune2) ?>" name="av1_commune2" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">&nbsp;</div>
      <div class="col-2" style="text-align: center; padding: initial; font-size: 85%"> 2 </div>
      <div class="col-4" style="text-align: center; padding: initial; font-size: 85%">
        <select title="" type="text" class="table-bordered admin" name="av2_objet" size="1" style="width: 200px;">
          <?php
          $req = $db->query('SELECT * FROM avenant');
          foreach ($req as $opavenant){
            if ($datas->av2_objet == $opavenant->name){
              echo "<option selected =\"selected\">".$opavenant->name."</option>";
            } else {
              echo "<option>".$opavenant->name."</option>";
            }
          };
          ?>
        </select>
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->av2_redaction) ?>" name="av2_redaction" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->av2_commune1) ?>" name="av2_commune1" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->av2_retour) ?>" name="av2_retour" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->av2_president) ?>" name="av2_president" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->av2_commune2) ?>" name="av2_commune2" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">&nbsp;</div>
      <div class="col-2" style="text-align: center; padding: initial; font-size: 85%"> 3 </div>
      <div class="col-4" style="text-align: center; padding: initial; font-size: 85%">
        <select title="" type="text" class="table-bordered admin" name="av3_objet" size="1" style="width: 200px;">
          <?php
          $req = $db->query('SELECT * FROM avenant');
          foreach ($req as $opavenant){
            if ($datas->av3_objet == $opavenant->name){
              echo "<option selected =\"selected\">".$opavenant->name."</option>";
            } else {
              echo "<option>".$opavenant->name."</option>";
            }
          };
          ?>
        </select>
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->av3_redaction) ?>" name="av3_redaction" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->av3_commune1) ?>" name="av3_commune1" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->av3_retour) ?>" name="av3_retour" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->av3_president) ?>" name="av3_president" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->av3_commune2) ?>" name="av3_commune2" class="datepicker admin" size="7">
      </div>
      <div class="col-12" style="font-size: 4px">&nbsp;</div>
    </div>
  </div>
  <div class="container" style="font-size: 5px"> &nbsp; </div>

  <!-- AMO -->
  <div class="container-fluid" style="text-align: center ;border: solid 5px #0e6e61; padding-top: 5px; padding-bottom: 5px; font-size: 85%">
    <p style="text-align: center; font-size: 125%"> AMO </p>
    <div class="row">
      <div class="col-3" style="text-align: right; padding: initial;">
        Objet &nbsp;
      </div>
      <div class="col-1" style="text-align: center; padding: initial;">
        dossier
      </div>
      <div class="col-1" style="text-align: center; padding: initial;">
        marché
      </div>
      <div class="col-1" style="text-align: center; padding: initial;">
        rapport
      </div>
      <div class="col-1" style="text-align: center; padding: initial;">
        ret/val
      </div>
      <div class="col-1" style="text-align: center; padding: initial;">
        convention
      </div>
      <div class="col-1" style="text-align: center; padding: initial;">
        facture
      </div>
      <div class="col-3" style="padding: initial">&nbsp;</div>
      <div class="col-3" style="text-align: right; padding: initial;">
        Prestation incluse &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" class="datepicker admin" type="text" value="<?php echo affiche_date($datas->ad_pi_envoi) ?>" name="ad_pi_envoi" size="7">
      </div>
      <div class="col-8" style="padding: initial">&nbsp;</div>
      <div class="col-12" style="font-size: 1px">&nbsp;</div>
      <div class="col-3" style="text-align: right; padding: initial">
        programme besoins &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_progbesoin_envoi) ?>" name="ad_progbesoin_envoi" class="datepicker admin" size="7">
      </div>
      <div class="col-4" style="padding: initial; font-size: 85%">&nbsp;</div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_progbesoin_facture) ?>" name="ad_progbesoin_facture" class="datepicker admin" size="7">
      </div>
      <div class="col-3" style="text-align: center; padding: initial; font-size: 85%">&nbsp;</div>
      <div class="col-12" style="font-size: 1px">&nbsp;</div>
      <div class="col-3" style="text-align: right; padding: initial">
        Programme travaux &nbsp;
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_progtravaux_envoi) ?>" name="ad_progtravaux_envoi" class="datepicker admin" size="7">
      </div>
      <div class="col-8" style="padding: initial; font-size: 85%">&nbsp;</div>
      <div class="col-12" style="font-size: 1px">&nbsp;</div>
      <div class="col-3" style="text-align: right; padding: initial">
        Consultation MOE &nbsp;
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">&nbsp;</div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_consultmoe_marche) ?>" name="ad_consultmoe_marche" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_consultmoe_rapport) ?>" name="ad_consultmoe_rapport" class="datepicker admin" size="7">
      </div>
      <div class="col-2" style="text-align: center; padding: initial; font-size: 85%">&nbsp;</div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_consultmoe_facture) ?>" name="ad_consultmoe_facture" class="datepicker admin" size="7">
      </div>
      <div class="col-3" style="text-align: center; padding: initial; font-size: 85%">&nbsp;</div>
      <div class="col-12" style="font-size: 1px">&nbsp;</div>
      <div class="col-3" style="text-align: right; padding: initial">
        Etude pré-op. topo &nbsp;
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">&nbsp;</div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_preop_topo_marche) ?>" name="ad_preop_topo_marche" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_preop_topo_rapport) ?>" name="ad_preop_topo_rapport" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">&nbsp;</div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">&nbsp;</div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_preop_topo_facture) ?>" name="ad_preop_topo_facture" class="datepicker admin" size="7">
      </div>
      <div class="col-3" style="text-align: center; padding: initial; font-size: 85%">&nbsp;</div>
      <div class="col-12" style="font-size: 1px">&nbsp;</div>
      <div class="col-3" style="text-align: right; padding: initial">
        Etude pré-op. comptage &nbsp;
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_preop_compt_marche) ?>" name="ad_preop_compt_marche" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_preop_compt_rapport) ?>" name="ad_preop_compt_rapport" class="datepicker admin" size="7">
      </div>
      <div class="col-2" style="text-align: center; padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_preop_compt_facture) ?>" name="ad_preop_compt_facture" class="datepicker admin" size="7">
      </div>
      <div class="col-3" style="text-align: center; padding: initial; font-size: 85%">&nbsp;</div>
      <div class="col-12" style="font-size: 1px">&nbsp;</div>
      <div class="col-3" style="text-align: right; padding: initial">
        Etude pré-op. autre &nbsp;
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_preop_autre_marche) ?>" name="ad_preop_autre_marche" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_preop_autre_rapport) ?>" name="ad_preop_autre_rapport" class="datepicker admin" size="7">
      </div>
      <div class="col-2" style="text-align: center; padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_preop_autre_facture) ?>" name="ad_preop_autre_facture" class="datepicker admin" size="7">
      </div>
      <div class="col-12" style="font-size: 4px">&nbsp;</div>
    </div>

  </div>
  <div class="container" style="font-size: 5px"> &nbsp; </div>

  <!-- MOE -->
  <div class="container-fluid" style="text-align: center; border: solid 5px #0e6e61; padding-top: 5px; padding-bottom: 5px;font-size: 85%">
    <p style="text-align: center; font-size: 125%"> MOE </p>
    <div class="row">
      <div class="col-3" style="text-align: right; padding: initial">
        Objet &nbsp;
      </div>
      <div class="col-1" style="text-align: center; padding: initial;">
        dossier
      </div>
      <div class="col-1" style="text-align: center; padding: initial;">
        marché
      </div>
      <div class="col-1" style="text-align: center; padding: initial;">
        rapport
      </div>
      <div class="col-1" style="text-align: center; padding: initial;">
        ret/val
      </div>
      <div class="col-1" style="text-align: center; padding: initial;">
        convention
      </div>
      <div class="col-1" style="text-align: center; padding: initial;">
        facture
      </div>
      <div class="col-12" style="font-size: 1px">&nbsp;</div>
      <div class="col-3" style="text-align: right; padding: initial">
        AVP / PRO &nbsp;
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_moe_avp_pro_envoi) ?>" name="ad_moe_avp_pro_envoi" class="datepicker admin" size="7">
      </div>
      <div class="col-4" style="text-align: center; padding: initial; font-size: 85%">&nbsp;</div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_moe_avp_pro_facture) ?>" name="ad_moe_avp_pro_facture" class="datepicker admin" size="7">
      </div>
      <div class="col-12" style="font-size: 1px">&nbsp;</div>
      <div class="col-3" style="text-align: right; padding: initial">
        DCE &nbsp;
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_moe_dce_envoi) ?>" name="ad_moe_dce_envoi" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_moe_dce_rapport) ?>" name="ad_moe_dce_rapport" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_moe_dce_ret_val) ?>" name="ad_moe_dce_ret_val" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_moe_dce_facture) ?>" name="ad_moe_dce_facture" class="datepicker admin" size="7">
      </div>
      <div class="col-12" style="font-size: 1px">&nbsp;</div>
      <div class="col-3" style="text-align: right; padding: initial">
        Marché travaux &nbsp;
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_mtrvx_envoi) ?>" name="ad_mtrvx_envoi" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_mtrvx_facture) ?>" name="ad_mtrvx_facture" class="datepicker admin" size="7">
      </div>
      <div class="col-12" style="font-size: 4px">&nbsp;</div>
    </div>
  </div>
  <div class="container" style="font-size: 5px"> &nbsp; </div>

  <!-- vacation -->
  <div class="container-fluid" style="text-align: center; border: solid 5px #0e6e61; padding-top: 5px; padding-bottom: 5px;font-size: 85%">
    <h4>Vacation</h4>
    <div class="row">
      <div class="col-3" style="text-align: right; padding: initial">
        Objet
      </div>
      <div class="col-1" style="text-align: center; padding: initial">
        &nbsp;
      </div>
      <div class="col-1" style="text-align: center; padding: initial">
        &nbsp;
      </div>
      <div class="col-1" style="text-align: center; padding: initial">
        rapport
      </div>
      <div class="col-1" style="text-align: center; padding: initial">
        &nbsp;
      </div>
      <div class="col-1" style="text-align: center; padding: initial">
        convention
      </div>
      <div class="col-1" style="text-align: center; padding: initial">
        facture
      </div>
      <div class="col-3" style="text-align: center; padding: initial">&nbsp;</div>
      <div class="col-3" style="text-align: right; padding: initial;">
        Vacations
      </div>
      <div class="col-2" style="text-align: center; padding: initial; font-size: 85%">&nbsp;</div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_vac_rapport) ?>" name="ad_vac_rapport" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_vac_conv) ?>" name="ad_vac_conv" class="datepicker admin" size="7">
      </div>
      <div class="col-1" style="text-align: center; padding: initial; font-size: 85%">
        <input title="" type="text" value="<?php echo affiche_date($datas->ad_vac_facture) ?>" name="ad_vac_facture" class="datepicker admin" size="7">
      </div>
      <div class="col-12" style="font-size: 4px">&nbsp;</div>
    </div>
  </div>
</div>
