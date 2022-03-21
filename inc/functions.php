<?php
function affiche_date($date){
    if ($date == "0000-00-00" || $date == null){
        $date = "";
        return $date;
    }else{
        return $date;
    }
}
function affiche_nombre($nombre){
    if ($nombre == "0" || $nombre == null){
        $nombre = "";
        return $nombre;
    }else{
        return $nombre;
    }
}

function telephone($nombre){
    if ($nombre == 0 || $nombre == null) {
        $nombre = null;
        return $nombre;
    }else {
        $nombre = sprintf("%'.010d", $nombre);
        return $nombre;
    }

}

function date_oui_non($date){
    if ($date == "0000-00-00" || $date == null){
        $date = "-";
        return $date;
    }else{
        $date = "X";
        return $date;
    }
}

function array_search_all($needle, $haystack){
    #array_search_match($needle, $haystack) returns all the keys of the values that match $needle in $haystack
    foreach ($haystack as $k=>$v) {
        if($haystack[$k]==$needle){
            $array1[] = $k;
        }
    }
    return ($array1);
}

function datetosql($date){
  if ($date == ""){
    $date = null;
    return $date;
  }else{
    return $date;
  }
}

function datetosql2($date){
  if ($date == ""){
    $date = "0000-00-00";
    return $date;
  }else{
    return $date;
  }
}

function numtosql($num){
    return (int)$num;
}

function etape_en_cour($dossier){

    $array = array(
        "En attente" => "",
        "moe mtrvx facture" => affiche_date($dossier->moe_mtrvx_facture),
        "moe mtrvx courrier dossier" => affiche_date($dossier->moe_mtrvx_courrier_dossier),
        "moe mtrvx val dossier" => affiche_date($dossier->moe_mtrvx_val_dossier),
        "moe mtrvx fin" => affiche_date($dossier->moe_mtrvx_fin),
        "moe mtrvx deb" => affiche_date($dossier->moe_mtrvx_deb),
        "moe dce facture" => affiche_date($dossier->moe_dce_facture),
        "moe dce courrier dossier" => affiche_date($dossier->moe_dce_courrier_dossier),
        "moe dce val dossier" => affiche_date($dossier->moe_dce_val_dossier),
        "moe dce fin" => affiche_date($dossier->moe_dce_fin),
        "moe dce deb" => affiche_date($dossier->moe_dce_deb),
        "moe avp pro facture" => affiche_date($dossier->moe_avp_pro_facture),
        "moe avp pro courrier dossier" => affiche_date($dossier->moe_avp_pro_courrier_dossier),
        "moe avp pro val dossier" => affiche_date($dossier->moe_avp_pro_val_dossier),
        "moe avp pro fin" => affiche_date($dossier->moe_avp_pro_fin),
        "moe avp pro deb" => affiche_date($dossier->moe_avp_pro_deb),
        "amo consultMO facture" => affiche_date($dossier->amo_consultMO_facture),
        "amo consultMO courrier dossier" => affiche_date($dossier->amo_consultMO_courrier_dossier),
        "amo consultMO val dossier" => affiche_date($dossier->amo_consultMO_val_dossier),
        "amo consultMO fin" => affiche_date($dossier->amo_consultMO_fin),
        "amo consultMO deb" => affiche_date($dossier->amo_consultMO_deb),
        "amo progtrvx courrier dossier" => affiche_date($dossier->amo_progtrvx_courrier_dossier),
        "amo progtrvx fin" => affiche_date($dossier->amo_progtrvx_fin),
        "amo progtrvx deb" => affiche_date($dossier->amo_progtrvx_deb),
        "amo besoin facture" => affiche_date($dossier->amo_besoin_facture),
        "amo besoin courrier_dossier" => affiche_date($dossier->amo_besoin_courrier_dossier),
        "amo besoin DR envoi" => affiche_date($dossier->amo_besoin_dr_envoi),
        "amo besoin val dossier" => affiche_date($dossier->amo_besoin_val_dossier),
        "amo besoin fin" => affiche_date($dossier->amo_besoin_fin),
        "amo besoin deb" => affiche_date($dossier->amo_besoin_deb),
        "amo pi courrier_dossier" => affiche_date($dossier->amo_pi_courrier_dossier),
        "amo pi DR envoi" => affiche_date($dossier->amo_pi_dr_envoi),
        "amo pi val dossier" => affiche_date($dossier->amo_pi_val_dossier),
        "amo pi fin" => affiche_date($dossier->amo_pi_fin),
        "amo pi deb" => affiche_date($dossier->amo_pi_deb),
        "ad moe mtrvx facture" => affiche_date($dossier->ad_mtrvx_facture),
        "ad moe mtrvx envoi" => affiche_date($dossier->ad_mtrvx_envoi),
        "ad moe dce facture" => affiche_date($dossier->ad_moe_dce_facture),
        "ad moe dce ret val" => affiche_date($dossier->ad_moe_dce_ret_val),
        "ad moe dce envoi" => affiche_date($dossier->ad_moe_dce_envoi),
        "ad moe avp pro facture" => affiche_date($dossier->ad_moe_avp_pro_facture),
        "ad moe avp pro ret val" => affiche_date($dossier->ad_moe_avp_pro_ret_val),
        "ad moe avp pro envoi" => affiche_date($dossier->ad_moe_avp_pro_envoi),
        "ad preop autre facture" => affiche_date($dossier->ad_preop_autre_facture),
        "ad preop autre rapport" => affiche_date($dossier->ad_preop_autre_rapport),
        "ad preop autre marche" => affiche_date($dossier->ad_preop_autre_marche),
        "ad preop compt facture" => affiche_date($dossier->ad_preop_compt_facture),
        "ad preop compt rapport" => affiche_date($dossier->ad_preop_compt_rapport),
        "ad preop compt marche" => affiche_date($dossier->ad_preop_compt_marche),
        "ad preop topo facture" => affiche_date($dossier->ad_preop_topo_facture),
        "ad preop topo rapport" => affiche_date($dossier->ad_preop_topo_rapport),
        "ad preop topo marche" => affiche_date($dossier->ad_preop_topo_marche),
        "ad consultmoe facture" => affiche_date($dossier->ad_consultmoe_facture),
        "ad consultmoe rapport" => affiche_date($dossier->ad_consultmoe_rapport),
        "ad consultmoe marche" => affiche_date($dossier->ad_consultmoe_marche),
        "ad progtravaux envoi" => affiche_date($dossier->ad_progtravaux_envoi),
        "ad progbesoin facture" => affiche_date($dossier->ad_progbesoin_facture),
        "ad pi envoi" => affiche_date($dossier->ad_pi_envoi),
        "ad rdv" => affiche_date($dossier->ad_gen_rdv),
        "av3 commune2" => affiche_date($dossier->av3_commune2),
        "av3 commune1" => affiche_date($dossier->av3_commune1),
        "av3 redaction" => affiche_date($dossier->av3_redaction),
        "av2 commune2" => affiche_date($dossier->av2_commune2),
        "av2 commune1" => affiche_date($dossier->av2_commune1),
        "av2 redaction" => affiche_date($dossier->av2_redaction),
        "av1 commune2" => affiche_date($dossier->av1_commune2),
        "av1 commune1" => affiche_date($dossier->av1_commune1),
        "av1 redaction" => affiche_date($dossier->av1_redaction),
        "conv commune2" => affiche_date($dossier->conv_commune2),
        "conv commune1" => affiche_date($dossier->conv_commune1),
        "conv redaction" => affiche_date($dossier->conv_redaction)

    );

    $retour = array_search(max($array),$array);

    return($retour);
}