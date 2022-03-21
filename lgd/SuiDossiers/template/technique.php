<div class="technique">
  <div class="container-fluid" style="border: solid 5px #F4C88D;font-size: 100%">
    <div style="padding-top: 5px">
      <p style="text-align: center; font-size: 125%"> Point étape </p>
      <div class="row">
        <div class="col-1">
          <p style="text-align: right"></p>
        </div>
        <div class="col-4" style="text-align: center">
          1er demande
        </div>
        <div class="col-4" style="text-align: center">
          2éme demande
        </div>
        <div class="col-3" style="text-align: center">
          3éme demande
        </div>
        <div class="w-100"></div>
        <div class="col-1" style="text-align: right">
          Imputation
        </div>
        <div class="col-4" style="text-align: center">
          <?php echo $datas->d1_facture; ?>
        </div>
        <div class="col-4" style="text-align: center">
          <?php echo $datas->d2_facture; ?>
        </div>
        <div class="col-3" style="text-align: center">
          <?php echo $datas->d3_facture; ?>
        </div>
        <div class="w-100"></div>
        <div class="col-1" style="text-align: right">
          Mission
        </div>
        <div class="col-4" style="text-align: center">
          <?php echo $datas->d1_mission; ?>
        </div>
        <div class="col-4" style="text-align: center">
          <?php echo $datas->d2_mission; ?>
        </div>
        <div class="col-3" style="text-align: center">
          <?php echo $datas->d3_mission; ?>
        </div>
        <div class="w-100"></div>
        <div class="col-1" style="text-align: right">
          Prestation
        </div>
        <div class="col-4" style="text-align: center">
          <?php echo $datas->d1_prestation; ?>
        </div>
        <div class="col-4" style="text-align: center">
          <?php echo $datas->d2_prestation; ?>
        </div>
        <div class="col-3" style="text-align: center">
          <?php echo $datas->d3_prestation; ?>
        </div>
        <div class="w-100"></div>
        <div class="col-1" style="text-align: right">
          Rendu
        </div>
        <div class="col-4" style="text-align: center">
          <?php echo $datas->d1_rendu; ?>
        </div>
        <div class="col-4" style="text-align: center">
          <?php echo $datas->d2_rendu; ?>
        </div>
        <div class="col-3" style="text-align: center">
          <?php echo $datas->d3_rendu; ?>
        </div>
        <div class="w-100"></div>
        <div class="col-1" style="text-align: right">
          Chargé
        </div>
        <div class="col-4" style="text-align: center">
          <?php echo $datas->d1_charge; ?>
        </div>
        <div class="col-4" style="text-align: center">
          <?php echo $datas->d2_charge; ?>
        </div>
        <div class="col-3" style="text-align: center">
          <?php echo $datas->d3_charge; ?>
        </div>
      </div>

    </div>
  </div>
  <div class="container" style="font-size: 5px"> &nbsp; </div>
  <div class="container-fluid technique" style="border: solid 5px #F4C88D; padding-top: 5px; padding-bottom: 5px; font-size: 85%">
    <div class="row">
      <div class="col-2"></div>
      <div class="col-4 AMO" style="padding: initial; text-align: center"> <b>études AMO</b> </div>
      <div class="col-3 preop" style="padding: initial; text-align: center"> <b>études pré-op</b> </div>
      <div class="col-3 MOE" style="padding: initial; text-align: center"> <b>études MOE</b> </div>
      <div class="w-100"></div>
      <div class="col-2">&nbsp;</div>
      <div class="col-1 AMO" style="padding:initial; text-align: center">prestation</div>
      <div class="col-1 AMO" style="padding: initial; text-align: center">prog.</div>
      <div class="col-1 AMO" style="padding: initial; text-align: center">prog.</div>
      <div class="col-1 AMO" style="padding: initial; text-align: center">consult.</div>
      <div class="col-1 preop" style="padding: initial; text-align: center">consult.</div>
      <div class="col-1 preop" style="padding: initial; text-align: center">consult.</div>
      <div class="col-1 preop" style="padding: initial; text-align: center">consult.</div>
      <div class="col-1 MOE" style="padding: initial; text-align: center">AVP</div>
      <div class="col-1 MOE" style="padding: initial; text-align: center">DCE</div>
      <div class="col-1 MOE" style="padding: initial; text-align: center">marché</div>
      <div class="w-100"></div>
      <div class="col-2">&nbsp;</div>
      <div class="col-1 AMO" style="padding: initial; text-align: center">incluses</div>
      <div class="col-1 AMO" style="padding: initial; text-align: center">besoins</div>
      <div class="col-1 AMO" style="padding: initial; text-align: center">travaux</div>
      <div class="col-1 AMO" style="padding: initial; text-align: center">MOE</div>
      <div class="col-1 preop" style="padding: initial; text-align: center">topo</div>
      <div class="col-1 preop" style="padding: initial; text-align: center">comptages</div>
      <div class="col-1 preop" style="padding: initial; text-align: center">autres</div>
      <div class="col-1 MOE" style="padding: initial; text-align: center">PRO</div>
      <div class="col-1 MOE" style="padding: initial; text-align: center">&nbsp;</div>
      <div class="col-1 MOE" style="padding: initial; text-align: center">travaux</div>
      <div class="w-100"></div>
      <div class="col-2" style=" text-align: right">début</div>
      <div class="col-1" style="padding: initial; font-size: 85%;">
        <input title="" id="amo_pi_deb" style="text-align: center" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_pi_deb) ?>" name="amo_pi_deb" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%;">
        <input title="" id="amo_besoin_deb" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_besoin_deb) ?>" name="amo_besoin_deb" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_progtrvx_deb" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_progtrvx_deb) ?>" name="amo_progtrvx_deb" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_consultMO_deb" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_consultMO_deb) ?>" name="amo_consultMO_deb" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_topo_deb" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_topo_deb) ?>" name="preop_topo_deb" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_compt_deb" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_compt_deb) ?>" name="preop_compt_deb" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_autre_deb" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_autre_deb) ?>" name="preop_autre_deb" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_avp_pro_deb" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_avp_pro_deb) ?>" name="moe_avp_pro_deb" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_dce_deb" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_dce_deb) ?>" name="moe_dce_deb" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_mtrvx_deb" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_mtrvx_deb) ?>" name="moe_mtrvx_deb" size="7">
      </div>
      <div class="w-100"></div>
      <div class="col-2" style="text-align: right">fin</div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_pi_fin" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_pi_fin) ?>" name="amo_pi_fin" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_besoin_fin" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_besoin_fin) ?>" name="amo_besoin_fin" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_progtrvx_fin" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_progtrvx_fin) ?>" name="amo_progtrvx_fin" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_consultMO_fin" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_consultMO_fin) ?>" name="amo_consultMO_fin" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_avp_pro_fin" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_avp_pro_fin) ?>" name="moe_avp_pro_fin" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_dce_fin" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_dce_fin) ?>" name="moe_dce_fin" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_mtrvx_fin" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_mtrvx_fin) ?>" name="moe_mtrvx_fin" size="7">
      </div>
      <div class="w-100"></div>
      <div class="col-2" style="text-align: right">validation</div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_pi_valid" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_pi_val_dossier) ?>" name="amo_pi_val_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_besoin_valid" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_besoin_val_dossier) ?>" name="amo_besoin_val_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_progtrvx_valid" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_progtrvx_val_dossier) ?>" name="amo_progtrvx_val_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_consultMO_val_dossier" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_consultMO_val_dossier) ?>" name="amo_consultMO_val_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_topo_val_dossier" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_topo_val_dossier) ?>" name="preop_topo_val_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_compt_val_dossier" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_compt_val_dossier) ?>" name="preop_compt_val_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_autre_val_dossier" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_autre_val_dossier) ?>" name="preop_autre_val_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_avp_pro_val_dossier" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_avp_pro_val_dossier) ?>" name="moe_avp_pro_val_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_dce_val_dossier" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_dce_val_dossier) ?>" name="moe_dce_val_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_mtrvx_val_dossier" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_mtrvx_val_dossier) ?>" name="moe_mtrvx_val_dossier" size="7">
      </div>
      <div class="w-100"></div>
      <div class="col-2" style="text-align: right">temps 1/2j</div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_pi_tp" type="number" class="AMO" value="<?php echo affiche_nombre($datas->amo_pi_tp) ?>" name="amo_pi_tp" style="width: 58px">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_besoin_tp" type="number" class="AMO" value="<?php echo affiche_nombre($datas->amo_besoin_tp) ?>" name="amo_besoin_tp" style="width: 58px">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_progtrvx_tp" type="number" class="AMO" value="<?php echo affiche_nombre($datas->amo_progtrvx_tp) ?>" name="amo_progtrvx_tp" style="width: 58px">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_consultMO_tp" type="number" class="AMO" value="<?php echo affiche_nombre($datas->amo_consultMO_tp) ?>" name="amo_consultMO_tp" style="width: 58px">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_avp_pro_tp" type="number" class="MOE" value="<?php echo affiche_nombre($datas->moe_avp_pro_tp) ?>" name="moe_avp_pro_tp" style="width: 58px">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_dce_tp" type="number" class="MOE" value="<?php echo affiche_nombre($datas->moe_dce_tp) ?>" name="moe_dce_tp" style="width: 58px">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_mtrvx_tp" type="number" class="MOE" value="<?php echo affiche_nombre($datas->moe_mtrvx_tp) ?>" name="moe_mtrvx_tp" style="width: 58px">
      </div>
      <div class="w-100"></div>
      <div class="col-2" style="text-align: right">DR</div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_pi_dr_envoi" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_pi_dr_envoi) ?>" name="amo_pi_dr_envoi" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_besoin_dr_envoi" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_besoin_dr_envoi) ?>" name="amo_besoin_dr_envoi" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_avp_pro_dr_envoi" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_avp_pro_dr_envoi) ?>" name="moe_avp_pro_dr_envoi" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_mtrvx_dr_envoi" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_mtrvx_dr_envoi) ?>" name="moe_mtrvx_dr_envoi" size="7">
      </div>
      <div class="w-100"></div>
      <div class="col-2" style="text-align: right">retour DR</div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_besoin_dr_retour" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_besoin_dr_retour) ?>" name="amo_besoin_dr_retour" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_avp_pro_dr_retour" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_avp_pro_dr_retour) ?>" name="moe_avp_pro_dr_retour" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_mtrvx_dr_retour" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_mtrvx_dr_retour) ?>" name="moe_mtrvx_dr_retour" size="7">
      </div>
      <div class="w-100"></div>
      <div class="col-2" style="text-align: right">mél. mairie</div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_pi_mail_dossier" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_pi_mail_dossier) ?>" name="amo_pi_mail_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_besoin_mail_dossier" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_besoin_mail_dossier) ?>" name="amo_besoin_mail_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_progtrvx_mail_dossier" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_progtrvx_mail_dossier) ?>" name="amo_progtrvx_mail_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_consultMO_mail_dossier" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_consultMO_mail_dossier) ?>" name="amo_consultMO_mail_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_topo_mail_dossier" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_topo_mail_dossier) ?>" name="preop_topo_mail_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_compt_mail_dossier" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_compt_mail_dossier) ?>" name="preop_compt_mail_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_autre_mail_dossier" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_autre_mail_dossier) ?>" name="preop_autre_mail_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_avp_pro_mail_dossier" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_avp_pro_mail_dossier) ?>" name="moe_avp_pro_mail_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_dce_mail_dossier" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_dce_mail_dossier) ?>" name="moe_dce_mail_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_mtrvx_mail_dossier" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_mtrvx_mail_dossier) ?>" name="moe_mtrvx_mail_dossier" size="7">
      </div>
      <div class="w-100"></div>
      <div class="col-2" style="text-align: right">courrier</div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_pi_courrier_dossier" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_pi_courrier_dossier) ?>" name="amo_pi_courrier_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_besoin_courrier_dossier" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_besoin_courrier_dossier) ?>" name="amo_besoin_courrier_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_progtrvx_courrier_dossier" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_progtrvx_courrier_dossier) ?>" name="amo_progtrvx_courrier_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_consultMO_courrier_dossier" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_consultMO_courrier_dossier) ?>" name="amo_consultMO_courrier_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_topo_courrier_dossier" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_topo_courrier_dossier) ?>" name="preop_topo_courrier_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_compt_courrier_dossier" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_compt_courrier_dossier) ?>" name="preop_compt_courrier_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_autre_courrier_dossier" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_autre_courrier_dossier) ?>" name="preop_autre_courrier_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_avp_pro_courrier_dossier" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_avp_pro_courrier_dossier) ?>" name="moe_avp_pro_courrier_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_dce_courrier_dossier" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_dce_courrier_dossier) ?>" name="moe_dce_courrier_dossier" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_mtrvx_courrier_dossier" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_mtrvx_courrier_dossier) ?>" name="moe_mtrvx_courrier_dossier" size="7">
      </div>
      <div class="w-100"></div>
      <div class="col-2" style="text-align: right">analyse offres</div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_consultMO_analy" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_consultMO_analy) ?>" name="amo_consultMO_analy" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_topo_analy" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_topo_analy) ?>" name="preop_topo_analy" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_compt_analy" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_compt_analy) ?>" name="preop_compt_analy" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_autre_analy" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_autre_analy) ?>" name="preop_autre_analy" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_dce_analy" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_dce_analy) ?>" name="moe_dce_analy" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_mtrvx_analy" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_mtrvx_analy) ?>" name="moe_mtrvx_analy" size="7">
      </div>
      <div class="col-2" style="text-align: right">Validation</div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_consultMO_val_analy" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_consultMO_val_analy) ?>" name="amo_consultMO_val_analy" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_topo_val_analy" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_topo_val_analy) ?>" name="preop_topo_val_analy" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_compt_val_analy" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_compt_val_analy) ?>" name="preop_compt_val_analy" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_autre_val_analy" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_autre_val_analy) ?>" name="preop_autre_val_analy" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_dce_val_analy" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_dce_val_analy) ?>" name="moe_dce_val_analy" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_mtrvx_val_analy" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_mtrvx_val_analy) ?>" name="moe_mtrvx_val_analy" size="7">
      </div>
      <div class="col-2" style="text-align: right">mél. mairie</div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_consultMO_mail_analy" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_consultMO_mail_analy) ?>" name="amo_consultMO_mail_analy" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_topo_mail_analy" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_topo_mail_analy) ?>" name="preop_topo_mail_analy" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_compt_mail_analy" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_compt_mail_analy) ?>" name="preop_compt_mail_analy" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_autre_mail_analy" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_autre_mail_analy) ?>" name="preop_autre_mail_analy" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_dce_mail_analy" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_dce_mail_analy) ?>" name="moe_dce_mail_analy" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_mtrvx_mail_analy" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_mtrvx_mail_analy) ?>" name="moe_mtrvx_mail_analy" size="7">
      </div>
      <div class="col-2" style="text-align: right">courrier</div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_consultMO_courrier_analy" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_consultMO_courrier_analy) ?>" name="amo_consultMO_courrier_analy" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_topo_courrier_analy" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_topo_courrier_analy) ?>" name="preop_topo_courrier_analy" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_compt_courrier_analy" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_compt_courrier_analy) ?>" name="preop_compt_courrier_analy" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_autre_courrier_analy" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_autre_courrier_analy) ?>" name="preop_autre_courrier_analy" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_dce_courrier_analy" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_dce_courrier_analy) ?>" name="moe_dce_courrier_analy" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_mtrvx_courrier_analy" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_mtrvx_courrier_analy) ?>" name="moe_mtrvx_courrier_analy" size="7">
      </div>
      <div class="col-12">&nbsp;</div>
      <div class="col-4" style="text-align: center">
        <label for="montant_besoin">montant besoins</label>
        <br>
        <input title="" id="montant_besoin" type="number" class="vacation" value="<?php echo affiche_nombre($datas->montant_besoin) ?>" name="montant_besoin" size="7">
      </div>
      <div class="col-4" style="text-align: center">
        <label for="montant_trvx">montant travaux</label>
        <br>
        <input title="" id="montant_trvx" type="number" class="vacation" value="<?php echo affiche_nombre($datas->montant_trvx) ?>" name="montant_trvx" size="7">
      </div>
      <div class="col-4" style="text-align: center">
        <label for="montant_estim">estimation</label>
        <br>
        <input title="" id="montant_estim" type="number" class="vacation" value="<?php echo affiche_nombre($datas->montant_estim) ?>" name="montant_estim" size="7">
      </div>
      <div class="col-12">&nbsp;</div>
      <div class="col-2" style="text-align: right">facturation</div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_besoin_facture" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_besoin_facture) ?>" name="amo_besoin_facture" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        &nbsp;
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="amo_consultMO_facture" type="text" class="datepicker AMO" value="<?php echo affiche_date($datas->amo_consultMO_facture) ?>" name="amo_consultMO_facture" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_topo_facture" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_topo_facture) ?>" name="preop_topo_facture" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_compt_facture" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_compt_facture) ?>" name="preop_compt_facture" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="preop_autre_facture" type="text" class="datepicker preop" value="<?php echo affiche_date($datas->preop_autre_facture) ?>" name="preop_autre_facture" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_avp_pro_facture" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_avp_pro_facture) ?>" name="moe_avp_pro_facture" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_dce_facture" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_dce_facture) ?>" name="moe_dce_facture" size="7">
      </div>
      <div class="col-1" style="padding: initial; font-size: 85%">
        <input title="" id="moe_mtrvx_facture" type="text" class="datepicker MOE" value="<?php echo affiche_date($datas->moe_mtrvx_facture) ?>" name="moe_mtrvx_facture" size="7">
      </div>
      <div class="col-1">
        &nbsp;
      </div>
      <div class="col-1">
        &nbsp;
      </div>
    </div>
  </div>
  <div class="container" style="font-size: 5px"> &nbsp; </div>
  <div class="container-fluid" style="border: solid 5px #F4C88D; padding-top: 5px; padding-bottom: 5px; font-size: 85%">
    <p style="text-align: center; font-size: 115%"> <b>vacations</b> </p>
    <div class="row">
      <div class="col-2" style="text-align: center;">
        <label for="vac_domaine">domaine</label>
        <br>
        <select id="vac_domaine" type="text" class="table-bordered vacation" name="vac_domaine" size="1" style="width: 125px;">
          <?php
          $req = $db->query('SELECT * FROM vacation');
          foreach ($req as $opdomaine){
            if ($datas->vac_domaine == $opdomaine->name){
              echo "<option selected =\"selected\">".$opdomaine->name."</option>";
            } else {
              echo "<option>".$opdomaine->name."</option>";
            }
          };
          ?>
        </select>
      </div>
      <div class="col-2" style="text-align: center">
        <label for="vac_deb">intervention</label>
        <br>
        <input title="" id="vac_deb" type="text" class="datepicker vacation" value="<?php echo affiche_date($datas->vac_deb) ?>" name="vac_deb" size="7">
      </div>
      <div class="col-2" style="text-align: center;">
        <label for="vac_rapport">rapport</label>
        <br>
        <input title="" id="vac_rapport" type="text" class="datepicker vacation" value="<?php echo affiche_date($datas->vac_rapport) ?>" name="vac_rapport" size="7">
      </div>
      <div class="col-2" style="text-align: center;">
        <label for="vac_valid">validation</label>
        <br>
        <input title="" id="vac_valid" type="text" class="datepicker vacation" value="<?php echo affiche_date($datas->vac_valid) ?>" name="vac_valid" size="7">
      </div>
      <div class="col-2" style="text-align: center;">
        <label for="vac_courrier">courrier</label>
        <br>
        <input title="" id="vac_courrier" type="text" class="datepicker vacation" value="<?php echo affiche_date($datas->vac_courrier) ?>" name="vac_courrier" size="7">
      </div>
      <div class="col-2" style="text-align: center;">
        <label for="vac_fact">facture</label>
        <br>
        <input title="" id="vac_fact" type="text" class="datepicker vacation" value="<?php echo affiche_date($datas->vac_facture) ?>" name="vac_facture" size="7">
      </div>
    </div>

  </div>
</div>
