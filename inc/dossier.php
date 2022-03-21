<?php
require_once '../app/database.php';
require_once './connection.php';
require_once './dev.php';
require_once './functions.php';
$db = new database($db_name, $db_user, $db_pass, $db_host);
if(isset($_POST['archive'])){
  if ($_POST['archive'] == "archive") {
    $req = "UPDATE dossier SET archive = 'OUI' WHERE numero ='".$_POST['numero']."'";
    $db->exec($req);
    ?>
    <script type="text/javascript">document.location.replace('../lgd/SuiDossiers/index.php);</script>
    <?php
  } elseif ($_POST['archive'] == "desarchive") {
    $req = "UPDATE dossier SET archive = 'NON' WHERE numero ='".$_POST['numero']."'";
    $db->exec($req);
    ?>
    <script type="text/javascript">document.location.replace('../lgd/SuiDossiers/index.php);</script>
    <?php
  }
}

if ($_POST['d1_facture'] == "Cotisation" ){
  $req = "UPDATE commune SET prestation_date ='".datetosql($_POST['saisine'])."' WHERE nom ='".$_POST['commune']."'";
  $db->exec($req);
}

$req = "UPDATE dossier SET
  domaine = :domaine,
  type_voie = :type_voie,
  objet = :objet,
  commentaire = :commentaire,
  echeance = :echeance,
  d1_mission = :d1_mission,
  d1_facture = :d1_facture,
  d1_prestation = :d1_prestation,
  d1_rendu = :d1_rendu,
  d1_charge = :d1_charge,
  d2_mission = :d2_mission,
  d2_prestation = :d2_prestation,
  d2_rendu = :d2_rendu,
  d2_facture = :d2_facture,
  d2_charge = :d2_charge,
  d3_mission = :d3_mission,
  d3_facture = :d3_facture,
  d3_prestation = :d3_prestation,
  d3_rendu = :d3_rendu,
  d3_charge = :d3_charge,
  amo_pi_deb = :amo_pi_deb,
  amo_pi_fin = :amo_pi_fin,
  amo_pi_val_dossier = :amo_pi_val_dossier,
  amo_pi_tp = :amo_pi_tp,
  amo_pi_mail_dossier = :amo_pi_mail_dossier,
  amo_pi_dr_envoi = :amo_pi_dr_envoi,
  amo_pi_courrier_dossier = :amo_pi_courrier_dossier,
  amo_besoin_deb = :amo_besoin_deb,
  amo_besoin_fin = :amo_besoin_fin,
  amo_besoin_val_dossier = :amo_besoin_val_dossier,
  amo_besoin_tp = :amo_besoin_tp,
  amo_besoin_dr_envoi = :amo_besoin_dr_envoi,
  amo_besoin_dr_retour = :amo_besoin_dr_retour,
  amo_besoin_mail_dossier = :amo_besoin_mail_dossier,
  amo_besoin_courrier_dossier= :amo_besoin_courrier_dossier,
  amo_besoin_facture = :amo_besoin_facture,
  amo_progtrvx_deb = :amo_progtrvx_deb,
  amo_progtrvx_fin = :amo_progtrvx_fin,
  amo_progtrvx_val_dossier = :amo_progtrvx_val_dossier,
  amo_progtrvx_tp = :amo_progtrvx_tp,
  amo_progtrvx_mail_dossier = :amo_progtrvx_mail_dossier,
  amo_progtrvx_courrier_dossier = :amo_progtrvx_courrier_dossier,
  amo_consultMO_deb = :amo_consultMO_deb,
  amo_consultMO_fin = :amo_consultMO_fin,
  amo_consultMO_val_dossier = :amo_consultMO_val_dossier,
  amo_consultMO_tp = :amo_consultMO_tp,
  amo_consultMO_mail_dossier = :amo_consultMO_mail_dossier,
  amo_consultMO_courrier_dossier = :amo_consultMO_courrier_dossier,
  amo_consultMO_analy = :amo_consultMO_analy,
  amo_consultMO_val_analy = :amo_consultMO_val_analy,
  amo_consultMO_mail_analy = :amo_consultMO_mail_analy,
  amo_consultMO_courrier_analy = :amo_consultMO_courrier_analy,
  amo_consultMO_facture = :amo_consultMO_facture,
  amo_consultMO_deb = :amo_consultMO_deb,
  amo_consultMO_fin = :amo_consultMO_fin,
  amo_consultMO_val_dossier = :amo_consultMO_val_dossier,
  amo_consultMO_tp = :amo_consultMO_tp,
  amo_consultMO_mail_dossier = :amo_consultMO_mail_dossier,
  amo_consultMO_courrier_dossier = :amo_consultMO_courrier_dossier,
  amo_consultMO_analy = :amo_consultMO_analy,
  amo_consultMO_val_analy = :amo_consultMO_val_analy,
  amo_consultMO_mail_analy = :amo_consultMO_mail_analy,
  amo_consultMO_courrier_analy = :amo_consultMO_courrier_analy,
  amo_consultMO_facture = :amo_consultMO_facture,
  preop_topo_deb = :preop_topo_deb,
  preop_topo_val_dossier = :preop_topo_val_dossier,
  preop_topo_mail_dossier = :preop_topo_mail_dossier,
  preop_topo_courrier_dossier = :preop_topo_courrier_dossier,
  preop_topo_analy = :preop_topo_analy,
  preop_topo_val_analy = :preop_topo_val_analy,
  preop_topo_mail_analy = :preop_topo_mail_analy,
  preop_topo_courrier_analy = :preop_topo_courrier_analy,
  preop_topo_facture = :preop_topo_facture,
  preop_compt_deb = :preop_compt_deb,
  preop_compt_val_dossier = :preop_compt_val_dossier,
  preop_compt_mail_dossier = :preop_compt_mail_dossier,
  preop_compt_courrier_dossier = :preop_compt_courrier_dossier,
  preop_compt_analy = :preop_compt_analy,
  preop_compt_val_analy = :preop_compt_val_analy,
  preop_compt_mail_analy = :preop_compt_mail_analy,
  preop_compt_courrier_analy = :preop_compt_courrier_analy,
  preop_compt_facture = :preop_compt_facture,
  preop_autre_deb = :preop_autre_deb,
  preop_autre_val_dossier = :preop_autre_val_dossier,
  preop_autre_mail_dossier = :preop_autre_mail_dossier,
  preop_autre_courrier_dossier = :preop_autre_courrier_dossier,
  preop_autre_analy = :preop_autre_analy,
  preop_autre_val_analy = :preop_autre_val_analy,
  preop_autre_mail_analy = :preop_autre_mail_analy,
  preop_autre_courrier_analy = :preop_autre_courrier_analy,
  preop_autre_facture = :preop_autre_facture,
  moe_avp_pro_deb = :moe_avp_pro_deb,
  moe_avp_pro_fin = :moe_avp_pro_fin,
  moe_avp_pro_val_dossier = :moe_avp_pro_val_dossier,
  moe_avp_pro_tp = :moe_avp_pro_tp,
  moe_avp_pro_dr_envoi = :moe_avp_pro_dr_envoi,
  moe_avp_pro_dr_retour = :moe_avp_pro_dr_retour,
  moe_avp_pro_mail_dossier = :moe_avp_pro_mail_dossier,
  moe_avp_pro_courrier_dossier = :moe_avp_pro_courrier_dossier,
  moe_avp_pro_facture = :moe_avp_pro_facture,
  moe_dce_deb = :moe_dce_deb,
  moe_dce_fin = :moe_dce_fin,
  moe_dce_val_dossier = :moe_dce_val_dossier,
  moe_dce_tp = :moe_dce_tp,
  moe_dce_mail_dossier = :moe_dce_mail_dossier,
  moe_dce_courrier_dossier = :moe_dce_courrier_dossier,
  moe_dce_analy = :moe_dce_analy,
  moe_dce_val_analy = :moe_dce_val_analy,
  moe_dce_mail_analy = :moe_dce_mail_analy,
  moe_dce_courrier_analy = :moe_dce_courrier_analy,
  moe_dce_facture = :moe_dce_facture,
  moe_mtrvx_deb = :moe_mtrvx_deb,
  moe_mtrvx_fin = :moe_mtrvx_fin,
  moe_mtrvx_val_dossier = :moe_mtrvx_val_dossier,
  moe_mtrvx_tp = :moe_mtrvx_tp,
  moe_mtrvx_dr_envoi = :moe_mtrvx_dr_envoi,
  moe_mtrvx_dr_retour = :moe_mtrvx_dr_retour,
  moe_mtrvx_mail_dossier = :moe_mtrvx_mail_dossier,
  moe_mtrvx_courrier_dossier = :moe_mtrvx_courrier_dossier,
  moe_mtrvx_analy = :moe_mtrvx_analy,
  moe_mtrvx_val_analy = :moe_mtrvx_val_analy,
  moe_mtrvx_mail_analy = :moe_mtrvx_mail_analy,
  moe_mtrvx_courrier_analy = :moe_mtrvx_courrier_analy,
  moe_mtrvx_facture = :moe_mtrvx_facture,
  montant_besoin = :montant_besoin,
  montant_trvx = :montant_trvx,
  montant_estim = :montant_estim,
  vac_domaine = :vac_domaine,
  vac_deb = :vac_deb,
  vac_rapport = :vac_rapport,
  vac_valid = :vac_valid,
  vac_courrier = :vac_courrier,
  vac_facture = :vac_facture,
  ad_gen_rdv = :ad_gen_rdv,
  ad_pi_envoi = :ad_pi_envoi,
  conv_redaction = :conv_redaction,
  conv_commune1 = :conv_commune1,
  conv_retour = :conv_retour,
  conv_president = :conv_president,
  conv_commune2 = :conv_commune2,
  av1_objet = :av1_objet,
  av1_redaction = :av1_redaction,
  av1_commune1 = :av1_commune1,
  av1_retour = :av1_retour,
  av1_president = :av1_president,
  av1_commune2 = :av1_commune2,
  av2_objet = :av2_objet,
  av2_redaction = :av2_redaction,
  av2_commune1 = :av2_commune1,
  av2_retour = :av2_retour,
  av2_president = :av2_president,
  av2_commune2 = :av2_commune2,
  av3_objet = :av3_objet,
  av3_redaction = :av3_redaction,
  av3_commune1 = :av3_commune1,
  av3_retour = :av3_retour,
  av3_president = :av3_president,
  av3_commune2 = :av3_commune2,
  ad_progbesoin_envoi = :ad_progbesoin_envoi,
  ad_progbesoin_facture = :ad_progbesoin_facture,
  ad_progtravaux_envoi = :ad_progtravaux_envoi,
  ad_consultmoe_marche = :ad_consultmoe_marche,
  ad_consultmoe_rapport = :ad_consultmoe_rapport,
  ad_consultmoe_facture = :ad_consultmoe_facture,
  ad_preop_topo_marche = :ad_preop_topo_marche,
  ad_preop_topo_rapport = :ad_preop_topo_rapport,
  ad_preop_topo_facture = :ad_preop_topo_facture,
  ad_preop_compt_marche = :ad_preop_compt_marche,
  ad_preop_compt_rapport = :ad_preop_compt_rapport,
  ad_preop_compt_facture = :ad_preop_compt_facture,
  ad_preop_autre_marche = :ad_preop_autre_marche,
  ad_preop_autre_rapport = :ad_preop_autre_rapport,
  ad_preop_autre_facture = :ad_preop_autre_facture,
  ad_moe_avp_pro_envoi = :ad_moe_avp_pro_envoi,
  ad_moe_avp_pro_facture = :ad_moe_avp_pro_facture,
  ad_moe_dce_envoi = :ad_moe_dce_envoi,
  ad_moe_dce_rapport = :ad_moe_dce_rapport,
  ad_moe_dce_ret_val = :ad_moe_dce_ret_val,
  ad_moe_dce_facture = :ad_moe_dce_facture,
  ad_mtrvx_envoi = :ad_mtrvx_envoi,
  ad_mtrvx_facture = :ad_mtrvx_facture,
  ad_vac_rapport = :ad_vac_rapport,
  ad_vac_conv = :ad_vac_conv,
  ad_vac_facture = :ad_vac_facture,
  contrainte = :contrainte,
  contrainte_date = :contrainte_date,
  commande = :commande,
  interlocuteur = :interlocuteur,
  interlocuteur_tel = :interlocuteur_tel,
  BT_Besoin = :BT_Besoin,
  BT_Objectif = :BT_Objectif,
  BT_DetailTrvx = :BT_DetailTrvx,
  BT_ContenueMission = :BT_ContenueMission,
  Suite_Donnee = :Suite_Donnee,
  delaisexcution = :delaisexcution
            WHERE
            numero = '".$_POST['numero']."'";

$rep = array(
  'domaine' => $_POST['domaine'],
  'type_voie' => $_POST['type_voie'],
  'objet' => $_POST['objet'],
  'commentaire' => $_POST['info'],
  'echeance' => datetosql($_POST['echeance']),
  'd1_mission' => $_POST['d1_mission'],
  'd1_facture' => $_POST['d1_facture'],
  'd1_prestation' => $_POST['d1_prestation'],
  'd1_rendu' => $_POST['d1_rendu'],
  'd1_charge' => $_POST['d1_charge_affaire'],
  'd2_mission' => $_POST['d2_mission'],
  'd2_prestation' => $_POST['d2_prestation'],
  'd2_rendu' => $_POST['d2_rendu'],
  'd2_facture' =>$_POST['d2_facture'],
  'd2_charge' => $_POST['d2_charge_affaire'],
  'd3_mission' => $_POST['d3_mission'],
  'd3_facture' => $_POST['d3_facture'],
  'd3_prestation' => $_POST['d3_prestation'],
  'd3_rendu' => $_POST['d3_rendu'],
  'd3_charge' => $_POST['d3_charge_affaire'],
  'amo_pi_deb' => datetosql($_POST['amo_pi_deb']),
  'amo_pi_fin' => datetosql($_POST['amo_pi_fin']),
  'amo_pi_val_dossier' => datetosql($_POST['amo_pi_val_dossier']),
  'amo_pi_tp' => numtosql($_POST['amo_pi_tp']),
  'amo_pi_mail_dossier' => datetosql($_POST['amo_pi_mail_dossier']),
  'amo_pi_dr_envoi' => datetosql($_POST['amo_pi_dr_envoi']),
  'amo_pi_courrier_dossier' => datetosql($_POST['amo_pi_courrier_dossier']),
  'amo_besoin_deb' => datetosql($_POST['amo_besoin_deb']),
  'amo_besoin_fin' => datetosql($_POST['amo_besoin_fin']),
  'amo_besoin_val_dossier' => datetosql($_POST['amo_besoin_val_dossier']),
  'amo_besoin_tp' => numtosql($_POST['amo_besoin_tp']),
  'amo_besoin_dr_envoi' => datetosql($_POST['amo_besoin_dr_envoi']),
  'amo_besoin_dr_retour' => datetosql($_POST['amo_besoin_dr_retour']),
  'amo_besoin_mail_dossier' => datetosql($_POST['amo_besoin_mail_dossier']),
  'amo_besoin_courrier_dossier' => datetosql($_POST['amo_besoin_courrier_dossier']),
  'amo_besoin_facture' => datetosql($_POST['amo_besoin_facture']),
  'amo_progtrvx_deb' => datetosql($_POST['amo_progtrvx_deb']),
  'amo_progtrvx_fin' => datetosql($_POST['amo_progtrvx_fin']),
  'amo_progtrvx_val_dossier' => datetosql($_POST['amo_progtrvx_val_dossier']),
  'amo_progtrvx_tp' => numtosql($_POST['amo_progtrvx_tp']),
  'amo_progtrvx_mail_dossier' => datetosql($_POST['amo_progtrvx_mail_dossier']),
  'amo_progtrvx_courrier_dossier' => datetosql($_POST['amo_progtrvx_courrier_dossier']),
  'amo_consultMO_deb' => datetosql($_POST['amo_consultMO_deb']),
  'amo_consultMO_fin' => datetosql($_POST['amo_consultMO_fin']),
  'amo_consultMO_val_dossier' => datetosql($_POST['amo_consultMO_val_dossier']),
  'amo_consultMO_tp' => numtosql($_POST['amo_consultMO_tp']),
  'amo_consultMO_mail_dossier' => datetosql($_POST['amo_consultMO_mail_dossier']),
  'amo_consultMO_courrier_dossier' => datetosql($_POST['amo_consultMO_courrier_dossier']),
  'amo_consultMO_analy' => datetosql($_POST['amo_consultMO_analy']),
  'amo_consultMO_val_analy' => datetosql($_POST['amo_consultMO_val_analy']),
  'amo_consultMO_mail_analy' => datetosql($_POST['amo_consultMO_mail_analy']),
  'amo_consultMO_courrier_analy' => datetosql($_POST['amo_consultMO_courrier_analy']),
  'amo_consultMO_facture' => datetosql($_POST['amo_consultMO_facture']),
  'preop_topo_deb' => datetosql($_POST['preop_topo_deb']),
  'preop_topo_val_dossier' => datetosql($_POST['preop_topo_val_dossier']),
  'preop_topo_mail_dossier' => datetosql($_POST['preop_topo_mail_dossier']),
  'preop_topo_courrier_dossier' => datetosql($_POST['preop_topo_courrier_dossier']),
  'preop_topo_analy' => datetosql($_POST['preop_topo_analy']),
  'preop_topo_val_analy' => datetosql($_POST['preop_topo_val_analy']),
  'preop_topo_mail_analy' => datetosql($_POST['preop_topo_mail_analy']),
  'preop_topo_courrier_analy' => datetosql($_POST['preop_topo_courrier_analy']),
  'preop_topo_facture' => datetosql($_POST['preop_topo_facture']),
  'preop_compt_deb' => datetosql($_POST['preop_compt_deb']),
  'preop_compt_val_dossier' => datetosql($_POST['preop_compt_val_dossier']),
  'preop_compt_mail_dossier' => datetosql($_POST['preop_compt_mail_dossier']),
  'preop_compt_courrier_dossier' => datetosql($_POST['preop_compt_courrier_dossier']),
  'preop_compt_analy' => datetosql($_POST['preop_compt_analy']),
  'preop_compt_val_analy' => datetosql($_POST['preop_compt_val_analy']),
  'preop_compt_mail_analy' => datetosql($_POST['preop_compt_mail_analy']),
  'preop_compt_courrier_analy' => datetosql($_POST['preop_compt_courrier_analy']),
  'preop_compt_facture' => datetosql($_POST['preop_compt_facture']),
  'preop_autre_deb' => datetosql($_POST['preop_autre_deb']),
  'preop_autre_val_dossier' => datetosql($_POST['preop_autre_val_dossier']),
  'preop_autre_mail_dossier' => datetosql($_POST['preop_autre_mail_dossier']),
  'preop_autre_courrier_dossier' => datetosql($_POST['preop_autre_courrier_dossier']),
  'preop_autre_analy' => datetosql($_POST['preop_autre_analy']),
  'preop_autre_val_analy' => datetosql($_POST['preop_autre_val_analy']),
  'preop_autre_mail_analy' => datetosql($_POST['preop_autre_mail_analy']),
  'preop_autre_courrier_analy' => datetosql($_POST['preop_autre_courrier_analy']),
  'preop_autre_facture' => datetosql($_POST['preop_autre_facture']),
  'moe_avp_pro_deb' => datetosql($_POST['moe_avp_pro_deb']),
  'moe_avp_pro_fin' => datetosql($_POST['moe_avp_pro_fin']),
  'moe_avp_pro_val_dossier' => datetosql($_POST['moe_avp_pro_val_dossier']),
  'moe_avp_pro_tp' => numtosql($_POST['moe_avp_pro_tp']),
  'moe_avp_pro_dr_envoi' => datetosql($_POST['moe_avp_pro_dr_envoi']),
  'moe_avp_pro_dr_retour' => datetosql($_POST['moe_avp_pro_dr_retour']),
  'moe_avp_pro_mail_dossier' => datetosql($_POST['moe_avp_pro_mail_dossier']),
  'moe_avp_pro_courrier_dossier' => datetosql($_POST['moe_avp_pro_courrier_dossier']),
  'moe_avp_pro_facture' => datetosql($_POST['moe_avp_pro_facture']),
  'moe_dce_deb' => datetosql($_POST['moe_dce_deb']),
  'moe_dce_fin' => datetosql($_POST['moe_dce_fin']),
  'moe_dce_val_dossier' => datetosql($_POST['moe_dce_val_dossier']),
  'moe_dce_tp' => numtosql($_POST['moe_dce_tp']),
  'moe_dce_mail_dossier' => datetosql($_POST['moe_dce_mail_dossier']),
  'moe_dce_courrier_dossier' => datetosql($_POST['moe_dce_courrier_dossier']),
  'moe_dce_analy' => datetosql($_POST['moe_dce_analy']),
  'moe_dce_val_analy' => datetosql($_POST['moe_dce_val_analy']),
  'moe_dce_mail_analy' => datetosql($_POST['moe_dce_mail_analy']),
  'moe_dce_courrier_analy' => datetosql($_POST['moe_dce_courrier_analy']),
  'moe_dce_facture' => datetosql($_POST['moe_dce_facture']),
  'moe_mtrvx_deb' => datetosql($_POST['moe_mtrvx_deb']),
  'moe_mtrvx_fin' => datetosql($_POST['moe_mtrvx_fin']),
  'moe_mtrvx_val_dossier' => datetosql($_POST['moe_mtrvx_val_dossier']),
  'moe_mtrvx_tp' => numtosql($_POST['moe_mtrvx_tp']),
  'moe_mtrvx_dr_envoi' => datetosql($_POST['moe_mtrvx_dr_envoi']),
  'moe_mtrvx_dr_retour' => datetosql($_POST['moe_mtrvx_dr_retour']),
  'moe_mtrvx_mail_dossier' => datetosql($_POST['moe_mtrvx_mail_dossier']),
  'moe_mtrvx_courrier_dossier' => datetosql($_POST['moe_mtrvx_courrier_dossier']),
  'moe_mtrvx_analy' => datetosql($_POST['moe_mtrvx_analy']),
  'moe_mtrvx_val_analy' => datetosql($_POST['moe_mtrvx_val_analy']),
  'moe_mtrvx_mail_analy' => datetosql($_POST['moe_mtrvx_mail_analy']),
  'moe_mtrvx_courrier_analy' => datetosql($_POST['moe_mtrvx_courrier_analy']),
  'moe_mtrvx_facture' => datetosql($_POST['moe_mtrvx_facture']),
  'montant_besoin' => numtosql($_POST['montant_besoin']),
  'montant_trvx' => numtosql($_POST['montant_trvx']),
  'montant_estim' => numtosql($_POST['montant_estim']),
  'vac_domaine' => $_POST['vac_domaine'],
  'vac_deb' => datetosql($_POST['vac_deb']),
  'vac_rapport' => datetosql($_POST['vac_rapport']),
  'vac_valid' => datetosql($_POST['vac_valid']),
  'vac_courrier' => datetosql($_POST['vac_courrier']),
  'vac_facture' => datetosql($_POST['vac_facture']),
  'ad_gen_rdv' => datetosql($_POST['ad_gen_rdv']),
  'ad_pi_envoi' => datetosql($_POST['ad_pi_envoi']),
  'conv_redaction' => datetosql($_POST['conv_redaction']),
  'conv_commune1' => datetosql($_POST['conv_commune1']),
  'conv_retour' => datetosql($_POST['conv_retour']),
  'conv_president' => datetosql($_POST['conv_president']),
  'conv_commune2' => datetosql($_POST['conv_commune2']),
  'av1_objet' => $_POST['av1_objet'],
  'av1_redaction' => datetosql($_POST['av1_redaction']),
  'av1_commune1' => datetosql($_POST['av1_commune1']),
  'av1_retour' => datetosql($_POST['av1_retour']),
  'av1_president' => datetosql($_POST['av1_president']),
  'av1_commune2' => datetosql($_POST['av1_commune2']),
  'av2_objet' => datetosql($_POST['av2_objet']),
  'av2_redaction' => datetosql($_POST['av2_redaction']),
  'av2_commune1' => datetosql($_POST['av2_commune1']),
  'av2_retour' => datetosql($_POST['av2_retour']),
  'av2_president' => datetosql($_POST['av2_president']),
  'av2_commune2' => datetosql($_POST['av2_commune2']),
  'av3_objet' => $_POST['av3_objet'],
  'av3_redaction' => datetosql($_POST['av3_redaction']),
  'av3_commune1' => datetosql($_POST['av3_commune1']),
  'av3_retour' => datetosql($_POST['av3_retour']),
  'av3_president' => datetosql($_POST['av3_president']),
  'av3_commune2' => datetosql($_POST['av3_commune2']),
  'ad_progbesoin_envoi' => datetosql($_POST['ad_progbesoin_envoi']),
  'ad_progbesoin_facture' => datetosql($_POST['ad_progbesoin_facture']),
  'ad_progtravaux_envoi' => datetosql($_POST['ad_progtravaux_envoi']),
  'ad_consultmoe_marche' => datetosql($_POST['ad_consultmoe_marche']),
  'ad_consultmoe_rapport' => datetosql($_POST['ad_consultmoe_rapport']),
  'ad_consultmoe_facture' => datetosql($_POST['ad_consultmoe_facture']),
  'ad_preop_topo_marche' => datetosql($_POST['ad_preop_topo_marche']),
  'ad_preop_topo_rapport' => datetosql($_POST['ad_preop_topo_rapport']),
  'ad_preop_topo_facture' => datetosql($_POST['ad_preop_topo_facture']),
  'ad_preop_compt_marche' => datetosql($_POST['ad_preop_compt_marche']),
  'ad_preop_compt_rapport' => datetosql($_POST['ad_preop_compt_rapport']),
  'ad_preop_compt_facture' => datetosql($_POST['ad_preop_compt_facture']),
  'ad_preop_autre_marche' => datetosql($_POST['ad_preop_autre_marche']),
  'ad_preop_autre_rapport' => datetosql($_POST['ad_preop_autre_rapport']),
  'ad_preop_autre_facture' => datetosql($_POST['ad_preop_autre_facture']),
  'ad_moe_avp_pro_envoi' => datetosql($_POST['ad_moe_avp_pro_envoi']),
  'ad_moe_avp_pro_facture' => datetosql($_POST['ad_moe_avp_pro_facture']),
  'ad_moe_dce_envoi' => datetosql($_POST['ad_moe_dce_envoi']),
  'ad_moe_dce_rapport' => datetosql($_POST['ad_moe_dce_rapport']),
  'ad_moe_dce_ret_val' => datetosql($_POST['ad_moe_dce_ret_val']),
  'ad_moe_dce_facture' => datetosql($_POST['ad_moe_dce_facture']),
  'ad_mtrvx_envoi' => datetosql($_POST['ad_mtrvx_envoi']),
  'ad_mtrvx_facture' => datetosql($_POST['ad_mtrvx_facture']),
  'ad_vac_rapport' => datetosql($_POST['ad_vac_rapport']),
  'ad_vac_conv' => datetosql($_POST['ad_vac_conv']),
  'ad_vac_facture' => datetosql($_POST['ad_vac_facture']),
  'contrainte' => datetosql($_POST['contrainte']),
  'contrainte_date' => $_POST['contrainte_date'],
  'commande' => $_POST['commande'],
  'interlocuteur' => $_POST['interlocuteur'],
  'interlocuteur_tel' => $_POST['interlocuteur_tel'],
  'BT_Besoin' => $_POST['BT_Besoin'],
  'BT_Objectif' =>$_POST['BT_Objectif'],
  'BT_DetailTrvx' =>$_POST['BT_DetailTrvx'],
  'BT_ContenueMission' =>$_POST['BT_ContenueMission'],
  'Suite_Donnee' =>$_POST['Suite_Donnee'],
  'delaisexcution' =>$_POST['delaisexecution']
  );
try {
  $db->prepare($req, $rep);
}
catch(Exception $e) {
  die('Erreur : '.$e->getMessage());
}
$redirection = "../lgd/SuiDossiers/dossier.php?numero=".$_POST['numero'];
?>
<h2><?= $redirection ?></h2>
   <script type="text/javascript">document.location.replace('<?= $redirection; ?>');</script>
