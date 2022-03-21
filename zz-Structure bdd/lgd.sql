-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `lgd`
--

-- --------------------------------------------------------

--
-- Structure de la table `avenant`
--

CREATE TABLE `avenant` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commune`
--

CREATE TABLE `commune` (
  `id` int(11) NOT NULL,
  `siren_siret` varchar(15) NOT NULL,
  `type` varchar(250) NOT NULL DEFAULT 'commune',
  `collectivite` varchar(250) DEFAULT NULL,
  `nom` varchar(250) DEFAULT NULL,
  `adresse` longtext,
  `code_postal` int(11) DEFAULT NULL,
  `ville` varchar(250) DEFAULT NULL,
  `telephone` varchar(14) DEFAULT NULL,
  `fax` varchar(14) DEFAULT NULL,
  `courriel` varchar(250) DEFAULT NULL,
  `web` varchar(250) DEFAULT NULL,
  `civilite` varchar(250) DEFAULT NULL,
  `representant` varchar(250) DEFAULT NULL,
  `fonction` varchar(250) DEFAULT NULL,
  `date_adhesion` date DEFAULT NULL,
  `adhesion` varchar(3) DEFAULT 'NON',
  `civilite_maire` varchar(250) DEFAULT NULL,
  `maire` varchar(250) DEFAULT NULL,
  `prestation_incluse` varchar(3) DEFAULT 'NON',
  `prestation_date` date DEFAULT NULL,
  `division` varchar(3) DEFAULT NULL,
  `Nb_Habitant` int(11) DEFAULT NULL,
  `arrondissement` varchar(50) DEFAULT NULL,
  `canton` varchar(250) DEFAULT NULL,
  `delaisexecution` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `convention`
--

CREATE TABLE `convention` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `courriers_arrive`
--

CREATE TABLE `courriers_arrive` (
  `arriveId` int(11) NOT NULL,
  `arriveDate` varchar(10) DEFAULT NULL,
  `arriveNumero` varchar(15) DEFAULT NULL,
  `arriveExpediteur` varchar(250) DEFAULT NULL,
  `arriveType` varchar(50) DEFAULT NULL,
  `arriveDocument` varchar(50) DEFAULT NULL,
  `arriveCode` varchar(50) DEFAULT NULL,
  `arriveObjet` varchar(250) DEFAULT NULL,
  `arriveDossier` varchar(10) DEFAULT NULL,
  `arriveLien` varchar(250) DEFAULT NULL,
  `arriveStockage` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `courriers_code`
--

CREATE TABLE `courriers_code` (
  `codeId` int(11) NOT NULL,
  `codeName` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `courriers_depart`
--

CREATE TABLE `courriers_depart` (
  `departId` int(11) NOT NULL,
  `departDate` varchar(15) DEFAULT NULL,
  `departMiseSignature` varchar(15) DEFAULT NULL,
  `departRetourSignature` varchar(15) DEFAULT NULL,
  `departSignataire` varchar(10) DEFAULT NULL,
  `departNumero` varchar(15) DEFAULT NULL,
  `departCode` varchar(5) DEFAULT NULL,
  `departAuteur` varchar(10) DEFAULT NULL,
  `departDocument` varchar(50) DEFAULT NULL,
  `departDestinataire` varchar(250) DEFAULT NULL,
  `departObjet` varchar(250) DEFAULT NULL,
  `departDossier` varchar(10) DEFAULT NULL,
  `departLien` varchar(250) DEFAULT NULL,
  `departStockage` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `courriers_document`
--

CREATE TABLE `courriers_document` (
  `docId` int(11) NOT NULL,
  `docName` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `courriers_type`
--

CREATE TABLE `courriers_type` (
  `typeId` int(11) NOT NULL,
  `typeName` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `dossier`
--

CREATE TABLE `dossier` (
  `id` int(11) NOT NULL,
  `commune` varchar(250) DEFAULT NULL,
  `adresse` varchar(250) DEFAULT NULL,
  `code_postal` int(11) DEFAULT NULL,
  `ville` varchar(250) DEFAULT NULL,
  `telephone` varchar(14) DEFAULT NULL,
  `fax` varchar(14) DEFAULT NULL,
  `courriel` varchar(250) DEFAULT NULL,
  `web` varchar(250) DEFAULT NULL,
  `domaine` varchar(250) DEFAULT NULL,
  `type_voie` varchar(250) DEFAULT NULL,
  `saisie_date` date DEFAULT NULL,
  `commentaire` longtext,
  `collectivite` varchar(250) DEFAULT NULL,
  `fonction` varchar(250) DEFAULT NULL,
  `civilite` varchar(250) DEFAULT NULL,
  `representant` varchar(250) DEFAULT NULL,
  `numero` varchar(250) DEFAULT NULL,
  `objet` varchar(250) DEFAULT NULL,
  `d1_mission` varchar(250) DEFAULT NULL,
  `d1_facture` varchar(50) NOT NULL,
  `d1_prestation` varchar(250) DEFAULT NULL,
  `d1_rendu` varchar(250) DEFAULT NULL,
  `d1_charge` varchar(250) DEFAULT NULL,
  `echeance` date DEFAULT NULL,
  `d2_mission` varchar(250) DEFAULT NULL,
  `d2_facture` varchar(50) NOT NULL,
  `d2_prestation` varchar(250) DEFAULT NULL,
  `d2_rendu` varchar(250) DEFAULT NULL,
  `d2_charge` varchar(250) DEFAULT NULL,
  `d2_echeance` date DEFAULT NULL,
  `d3_mission` varchar(250) DEFAULT NULL,
  `d3_facture` varchar(50) NOT NULL,
  `d3_prestation` varchar(250) DEFAULT NULL,
  `d3_rendu` varchar(250) DEFAULT NULL,
  `d3_charge` varchar(250) DEFAULT NULL,
  `d3_echeance` date DEFAULT NULL,
  `prestation_incluse` varchar(3) DEFAULT NULL,
  `prestation_date` date DEFAULT NULL,
  `amo_besoin_deb` date DEFAULT NULL,
  `amo_besoin_fin` date DEFAULT NULL,
  `amo_besoin_tp` int(11) DEFAULT NULL,
  `amo_besoin_avis` date DEFAULT NULL,
  `amo_besoin_val_dossier` date DEFAULT NULL,
  `amo_besoin_dr_envoi` date DEFAULT NULL,
  `amo_besoin_dr_retour` date DEFAULT NULL,
  `amo_besoin_mail_dossier` date DEFAULT NULL,
  `amo_besoin_courrier_dossier` date NOT NULL,
  `amo_besoin_facture` date DEFAULT NULL,
  `amo_consultMO_deb` date DEFAULT NULL,
  `amo_consultMO_fin` date DEFAULT NULL,
  `amo_consultMO_tp` int(11) DEFAULT NULL,
  `amo_consultMO_avis1` date DEFAULT NULL,
  `amo_consultMO_val_dossier` date DEFAULT NULL,
  `amo_consultMO_courrier_dossier` date DEFAULT NULL,
  `amo_consultMO_analy` date DEFAULT NULL,
  `amo_consultMO_avis2` date DEFAULT NULL,
  `amo_consultMO_val_analy` date DEFAULT NULL,
  `amo_consultMO_courrier_analy` date DEFAULT NULL,
  `amo_consultMO_facture` date DEFAULT NULL,
  `amo_progtrvx_deb` date DEFAULT NULL,
  `amo_progtrvx_fin` date DEFAULT NULL,
  `amo_progtrvx_tp` int(11) NOT NULL,
  `amo_progtrvx_val_dossier` date DEFAULT NULL,
  `amo_progtrvx_mail_dossier` date NOT NULL,
  `amo_progtrvx_courrier_dossier` date DEFAULT NULL,
  `amo_pi_deb` date DEFAULT NULL,
  `amo_pi_fin` date DEFAULT NULL,
  `amo_pi_tp` int(11) DEFAULT NULL,
  `amo_pi_avis` date DEFAULT NULL,
  `amo_pi_val_dossier` date DEFAULT NULL,
  `amo_pi_dr_envoi` date DEFAULT NULL,
  `amo_pi_courrier_dossier` date DEFAULT NULL,
  `preop_topo_deb` date DEFAULT NULL,
  `preop_topo_avis1` date DEFAULT NULL,
  `preop_topo_val_dossier` date DEFAULT NULL,
  `preop_topo_courrier_dossier` date DEFAULT NULL,
  `preop_topo_analy` date DEFAULT NULL,
  `preop_topo_avis2` date DEFAULT NULL,
  `preop_topo_val_analy` date DEFAULT NULL,
  `preop_topo_courrier_analy` date DEFAULT NULL,
  `preop_topo_facture` date DEFAULT NULL,
  `preop_compt_deb` date DEFAULT NULL,
  `preop_compt_avis1` date DEFAULT NULL,
  `preop_compt_val_dossier` date DEFAULT NULL,
  `preop_compt_courrier_dossier` date DEFAULT NULL,
  `preop_compt_analy` date DEFAULT NULL,
  `preop_compt_avis2` date DEFAULT NULL,
  `preop_compt_val_analy` date DEFAULT NULL,
  `preop_compt_courrier_analy` date DEFAULT NULL,
  `preop_compt_facture` date DEFAULT NULL,
  `preop_autre_deb` date DEFAULT NULL,
  `preop_autre_avis1` date DEFAULT NULL,
  `preop_autre_val_dossier` date DEFAULT NULL,
  `preop_autre_courrier_dossier` date DEFAULT NULL,
  `preop_autre_analy` date DEFAULT NULL,
  `preop_autre_avis2` date DEFAULT NULL,
  `preop_autre_val_analy` date DEFAULT NULL,
  `preop_autre_courrier_analy` date DEFAULT NULL,
  `preop_autre_facture` date DEFAULT NULL,
  `moe_avp_pro_deb` date DEFAULT NULL,
  `moe_avp_pro_fin` date DEFAULT NULL,
  `moe_avp_pro_tp` int(11) DEFAULT NULL,
  `moe_avp_pro_avis1` date DEFAULT NULL,
  `moe_avp_pro_val_dossier` date DEFAULT NULL,
  `moe_avp_pro_mail_dossier` date DEFAULT NULL,
  `moe_avp_pro_courrier_dossier` date DEFAULT NULL,
  `moe_avp_pro_analy` date DEFAULT NULL,
  `moe_avp_pro_avis2` date DEFAULT NULL,
  `moe_avp_pro_val_analy` date DEFAULT NULL,
  `moe_avp_pro_courrier_analy` date DEFAULT NULL,
  `moe_avp_pro_facture` date DEFAULT NULL,
  `moe_dce_deb` date DEFAULT NULL,
  `moe_dce_fin` date DEFAULT NULL,
  `moe_dce_tp` int(11) DEFAULT NULL,
  `moe_dce_avis1` date DEFAULT NULL,
  `moe_dce_val_dossier` date DEFAULT NULL,
  `moe_dce_mail_dossier` date DEFAULT NULL,
  `moe_dce_courrier_dossier` date DEFAULT NULL,
  `moe_dce_analy` date DEFAULT NULL,
  `moe_dce_avis2` date DEFAULT NULL,
  `moe_dce_val_analy` date DEFAULT NULL,
  `moe_dce_courrier_analy` date DEFAULT NULL,
  `moe_dce_facture` date DEFAULT NULL,
  `moe_mtrvx_deb` date DEFAULT NULL,
  `moe_mtrvx_fin` date DEFAULT NULL,
  `moe_mtrvx_tp` int(11) DEFAULT NULL,
  `moe_mtrvx_avis1` date DEFAULT NULL,
  `moe_mtrvx_val_dossier` date DEFAULT NULL,
  `moe_mtrvx_mail_dossier` date DEFAULT NULL,
  `moe_mtrvx_courrier_dossier` date DEFAULT NULL,
  `moe_mtrvx_analy` date DEFAULT NULL,
  `moe_mtrvx_avis2` date DEFAULT NULL,
  `moe_mtrvx_val_analy` date DEFAULT NULL,
  `moe_mtrvx_courrier_analy` date DEFAULT NULL,
  `moe_mtrvx_facture` date DEFAULT NULL,
  `vac_domaine` varchar(250) DEFAULT NULL,
  `vac_deb` date DEFAULT NULL,
  `vac_rapport` date DEFAULT NULL,
  `vac_valid` date DEFAULT NULL,
  `vac_courrier` date DEFAULT NULL,
  `vac_facture` date DEFAULT NULL,
  `ad_gen_rdv` date DEFAULT NULL,
  `ad_pi_envoi` date DEFAULT NULL,
  `conv_redaction` date DEFAULT NULL,
  `conv_commune1` date DEFAULT NULL,
  `conv_retour` date DEFAULT NULL,
  `conv_president` date DEFAULT NULL,
  `conv_commune2` date DEFAULT NULL,
  `av1_objet` varchar(250) DEFAULT NULL,
  `av1_redaction` date DEFAULT NULL,
  `av1_commune1` date DEFAULT NULL,
  `av1_retour` date DEFAULT NULL,
  `av1_president` date DEFAULT NULL,
  `av1_commune2` date DEFAULT NULL,
  `av2_objet` varchar(250) DEFAULT NULL,
  `av2_redaction` date DEFAULT NULL,
  `av2_commune1` date DEFAULT NULL,
  `av2_retour` date DEFAULT NULL,
  `av2_president` date DEFAULT NULL,
  `av2_commune2` date DEFAULT NULL,
  `av3_objet` varchar(250) DEFAULT NULL,
  `av3_redaction` date DEFAULT NULL,
  `av3_commune1` date DEFAULT NULL,
  `av3_retour` date DEFAULT NULL,
  `av3_president` date DEFAULT NULL,
  `av3_commune2` date DEFAULT NULL,
  `ad_progbesoin_envoi` date DEFAULT NULL,
  `ad_progbesoin_facture` date DEFAULT NULL,
  `ad_progtravaux_envoi` date DEFAULT NULL,
  `ad_consultmoe_marche` date DEFAULT NULL,
  `ad_consultmoe_rapport` date DEFAULT NULL,
  `ad_consultmoe_facture` date DEFAULT NULL,
  `ad_preop_topo_marche` date DEFAULT NULL,
  `ad_preop_topo_rapport` date DEFAULT NULL,
  `ad_preop_topo_facture` date DEFAULT NULL,
  `ad_preop_compt_marche` date DEFAULT NULL,
  `ad_preop_compt_rapport` date DEFAULT NULL,
  `ad_preop_compt_facture` date DEFAULT NULL,
  `ad_preop_autre_marche` date DEFAULT NULL,
  `ad_preop_autre_rapport` date DEFAULT NULL,
  `ad_preop_autre_facture` date DEFAULT NULL,
  `ad_moe_avp_pro_envoi` date DEFAULT NULL,
  `ad_moe_avp_pro_ret_val` date DEFAULT NULL,
  `ad_moe_avp_pro_facture` date DEFAULT NULL,
  `ad_moe_dce_envoi` date DEFAULT NULL,
  `ad_moe_dce_rapport` date DEFAULT NULL,
  `ad_moe_dce_ret_val` date DEFAULT NULL,
  `ad_moe_dce_facture` date DEFAULT NULL,
  `ad_mtrvx_envoi` date DEFAULT NULL,
  `ad_mtrvx_facture` date DEFAULT NULL,
  `ad_vac_rapport` date DEFAULT NULL,
  `ad_vac_conv` date DEFAULT NULL,
  `ad_vac_facture` date DEFAULT NULL,
  `archive` varchar(10) DEFAULT 'NON',
  `id_genese` int(11) DEFAULT NULL,
  `contrainte` varchar(250) DEFAULT NULL,
  `contrainte_date` varchar(250) DEFAULT NULL,
  `montant_besoin` decimal(10,0) DEFAULT NULL,
  `montant_trvx` decimal(10,0) DEFAULT NULL,
  `montant_estim` decimal(10,0) DEFAULT NULL,
  `amo_pi_mail_dossier` date DEFAULT NULL,
  `amo_consultMO_mail_dossier` date DEFAULT NULL,
  `amo_consultMO_mail_analy` date DEFAULT NULL,
  `preop_topo_mail_dossier` date DEFAULT NULL,
  `preop_topo_mail_analy` date DEFAULT NULL,
  `preop_compt_mail_dossier` date DEFAULT NULL,
  `preop_compt_mail_analy` date DEFAULT NULL,
  `preop_autre_mail_dossier` date DEFAULT NULL,
  `preop_autre_mail_analy` date DEFAULT NULL,
  `commande` varchar(250) DEFAULT NULL,
  `interlocuteur` varchar(250) DEFAULT NULL,
  `interlocuteur_tel` varchar(14) DEFAULT NULL,
  `moe_avp_pro_dr_envoi` date DEFAULT NULL,
  `moe_avp_pro_dr_retour` date DEFAULT NULL,
  `moe_dce_mail_analy` date DEFAULT NULL,
  `moe_mtrvx_dr_envoi` date DEFAULT NULL,
  `moe_mtrvx_dr_analy` date DEFAULT NULL,
  `moe_mtrvx_dr_retour` date DEFAULT NULL,
  `moe_mtrvx_mail_analy` date DEFAULT NULL,
  `division` varchar(3) DEFAULT NULL,
  `date_adhesion` date DEFAULT NULL,
  `BT_ContenueMission` longtext,
  `BT_DetailTrvx` longtext,
  `BT_Objectif` longtext,
  `BT_Besoin` longtext,
  `Suite_Donnee` varchar(250) DEFAULT NULL,
  `canton` varchar(250) DEFAULT NULL,
  `delaisexcution` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `facturation`
--

CREATE TABLE `facturation` (
  `id` int(11) NOT NULL,
  `Nom` varchar(250) DEFAULT NULL,
  `type` varchar(3) DEFAULT NULL,
  `Type_facture` varchar(3) DEFAULT NULL,
  `calcul` varchar(250) DEFAULT NULL,
  `taux` double DEFAULT NULL,
  `max` int(11) DEFAULT NULL,
  `min` int(11) DEFAULT NULL,
  `forfait` int(11) DEFAULT NULL,
  `Comparaison` varchar(250) DEFAULT NULL,
  `T_comparaison` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `id` int(11) NOT NULL,
  `numero` varchar(8) DEFAULT NULL,
  `mission` varchar(3) DEFAULT NULL,
  `rendu` varchar(250) DEFAULT NULL,
  `formule` varchar(3) DEFAULT NULL,
  `m_besoin` double DEFAULT NULL,
  `m_travaux` double DEFAULT NULL,
  `m_estimation` double DEFAULT NULL,
  `m_facture` double DEFAULT NULL,
  `F_forfait` int(11) DEFAULT NULL,
  `F_min` int(11) DEFAULT NULL,
  `F_taux` int(11) DEFAULT NULL,
  `F_max` int(11) DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  `date_modification` date DEFAULT NULL,
  `T_facture` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `genese`
--

CREATE TABLE `genese` (
  `id` int(11) NOT NULL,
  `commune` varchar(250) NOT NULL,
  `adresse` varchar(250) NOT NULL,
  `code_postal` int(11) NOT NULL,
  `ville` varchar(250) NOT NULL,
  `telephone` varchar(14) NOT NULL,
  `fax` varchar(14) NOT NULL,
  `courriel` varchar(250) NOT NULL,
  `web` varchar(250) NOT NULL,
  `interlocuteur` varchar(250) NOT NULL,
  `interlocuteur_tel` varchar(14) NOT NULL,
  `domaine` varchar(250) NOT NULL,
  `type_voie` varchar(250) NOT NULL,
  `saisie` varchar(250) NOT NULL,
  `saisie_date` date NOT NULL,
  `commentaire` longtext NOT NULL,
  `Affichage` bit(1) NOT NULL DEFAULT b'0',
  `etat` varchar(250) NOT NULL DEFAULT 'en attente',
  `collectivite` varchar(250) DEFAULT NULL,
  `fonction` varchar(250) DEFAULT NULL,
  `civilite` varchar(250) DEFAULT NULL,
  `representant` varchar(250) DEFAULT NULL,
  `contrainte` varchar(250) DEFAULT NULL,
  `contrainte_date` varchar(250) DEFAULT NULL,
  `maire` varchar(250) DEFAULT NULL,
  `civilite_maire` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `mission`
--

CREATE TABLE `mission` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `oa_identification`
--

CREATE TABLE `oa_identification` (
  `id` int(11) NOT NULL,
  `commune_id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `voie_portee` varchar(250) NOT NULL,
  `obstacle_franchi` varchar(250) NOT NULL,
  `gestionnaire` varchar(250) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `prestation`
--

CREATE TABLE `prestation` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rendu`
--

CREATE TABLE `rendu` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `initial` char(5) DEFAULT NULL,
  `mail` varchar(250) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL,
  `tel` varchar(14) DEFAULT NULL,
  `username` varchar(250) DEFAULT NULL,
  `accreditation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `vacation`
--

CREATE TABLE `vacation` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `voie`
--

CREATE TABLE `voie` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avenant`
--
ALTER TABLE `avenant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commune`
--
ALTER TABLE `commune`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `convention`
--
ALTER TABLE `convention`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `courriers_arrive`
--
ALTER TABLE `courriers_arrive`
  ADD PRIMARY KEY (`arriveId`);

--
-- Index pour la table `courriers_code`
--
ALTER TABLE `courriers_code`
  ADD PRIMARY KEY (`codeId`);

--
-- Index pour la table `courriers_depart`
--
ALTER TABLE `courriers_depart`
  ADD PRIMARY KEY (`departId`);

--
-- Index pour la table `dossier`
--
ALTER TABLE `dossier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `facturation`
--
ALTER TABLE `facturation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `genese`
--
ALTER TABLE `genese`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mission`
--
ALTER TABLE `mission`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `oa_identification`
--
ALTER TABLE `oa_identification`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `prestation`
--
ALTER TABLE `prestation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rendu`
--
ALTER TABLE `rendu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vacation`
--
ALTER TABLE `vacation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `voie`
--
ALTER TABLE `voie`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avenant`
--
ALTER TABLE `avenant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commune`
--
ALTER TABLE `commune`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `convention`
--
ALTER TABLE `convention`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `courriers_arrive`
--
ALTER TABLE `courriers_arrive`
  MODIFY `arriveId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `courriers_code`
--
ALTER TABLE `courriers_code`
  MODIFY `codeId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `courriers_depart`
--
ALTER TABLE `courriers_depart`
  MODIFY `departId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `dossier`
--
ALTER TABLE `dossier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `facturation`
--
ALTER TABLE `facturation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `genese`
--
ALTER TABLE `genese`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `mission`
--
ALTER TABLE `mission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `oa_identification`
--
ALTER TABLE `oa_identification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `prestation`
--
ALTER TABLE `prestation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `rendu`
--
ALTER TABLE `rendu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `vacation`
--
ALTER TABLE `vacation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `voie`
--
ALTER TABLE `voie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
