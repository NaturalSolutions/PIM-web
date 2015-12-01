-- Principes:
-- - une vue SQL pour chaque picto + une vue pour chaque barette (cette dernière appel simplement les vues par pictos)
-- - toutes ces vues sont préfixées par `picto_`
-- - une vue qui résume une barrette de picto s'appelle `picto_xxxx` et les vues des pictos de cette barette s'appellent `picto_xxxx_yyyy`
-- - les vues par picto ont toutes le même schéma à deux colonnes : `code_ile` et `niveau`
-- - pour "état des connaissances" et "intérêts des patrimoines", le niveau est une valeur entre 1 (nul) et 4 (fort/complet)
-- - pour "pressions" et "gestion/conservation", le niveau est une valeur entre 0 (pas de données/?) et 2 à 4 selon le nombre de picto

-- TODO/Questions :
-- - dans la catégorie "intérêts des patrimoines", les listes d'espèces n'ont pas été fournies dans les cas suivants : botanique, herpétologie, mammifères, faune marine, flore marine
-- - dans la catégorie "intérêts des patrimoines", la requête pour les invertébrés n'est pas décrite
--
-- TODO/debug :
-- - pour picto_etaco_soceco, supprimer le hack anti-doublons sur drp_content_type_bd_i_statut_de_propriete (enlever count et ajouter à la clause group by)

-- ----------------------------------------------------------------------------
-- État des connaissances
-- ----------------------------------------------------------------------------

-- Botanique

CREATE OR REPLACE VIEW picto_etaco_bota AS
SELECT
    t.name AS code_ile,
    if(sum(YEAR(o.field_bdni_b_p_date_value) < 2000) != 0, 1, 0) +
    if(sum(YEAR(o.field_bdni_b_p_date_value) >= 2000) != 0, 2, 0) + 1 AS niveau
FROM drp_term_data t
    LEFT JOIN drp_content_type_bd_ni_botanique_present o ON (t.tid = o.field_bdni_b_p_code_ile_ilot_value)
WHERE t.vid = 4
GROUP BY t.name;

-- Ornithologie

CREATE OR REPLACE VIEW picto_etaco_ornitho AS
SELECT
    t.name AS code_ile,
    if(sum(YEAR(o.field_bdni_o_p_date_value) < 2000) != 0, 1, 0) +
    if(sum(YEAR(o.field_bdni_o_p_date_value) >= 2000) != 0, 2, 0) + 1 AS niveau
FROM drp_term_data t
    LEFT JOIN drp_content_type_bd_ni_ornithologie_present o ON (t.tid = o.field_bdni_o_p_code_ile_ilot_value)
WHERE t.vid = 4
GROUP BY t.name;

-- Herpétologie

CREATE OR REPLACE VIEW picto_etaco_herpeto AS
SELECT
    t.name AS code_ile,
    if(sum(YEAR(o.field_bdni_h_p_date_value) < 2000) != 0, 1, 0) +
    if(sum(YEAR(o.field_bdni_h_p_date_value) >= 2000) != 0, 2, 0) + 1 AS niveau
FROM drp_term_data t
    LEFT JOIN drp_content_type_bd_ni_herpetologie_present o ON (t.tid = o.field_bdni_h_p_code_ile_ilot_value)
WHERE t.vid = 4
GROUP BY t.name;

-- Mammifères

CREATE OR REPLACE VIEW picto_etaco_mamm AS
SELECT
    t.name AS code_ile,
    if(sum(YEAR(o.field_bdni_mt_p_date_value) < 2000) != 0, 1, 0) +
    if(sum(YEAR(o.field_bdni_mt_p_date_value) >= 2000) != 0, 2, 0) + 1 AS niveau
FROM drp_term_data t
    LEFT JOIN drp_content_type_bd_ni_mam_terrestres_present o ON (t.tid = o.field_bdni_mt_p_code_ile_ilot_value)
WHERE t.vid = 4
GROUP BY t.name;

-- Chiroptères

CREATE OR REPLACE VIEW picto_etaco_chiro AS
SELECT
    t.name AS code_ile,
    if(sum(YEAR(o.field_bdni_c_p_date_value) < 2000) != 0, 1, 0) +
    if(sum(YEAR(o.field_bdni_c_p_date_value) >= 2000) != 0, 2, 0) + 1 AS niveau
FROM drp_term_data t
    LEFT JOIN drp_content_type_bd_ni_chiroptere_present o ON (t.tid = o.field_bdni_c_p_code_ile_ilot_value)
WHERE t.vid = 4
GROUP BY t.name;

-- Invertébrés

CREATE OR REPLACE VIEW picto_etaco_invert AS
SELECT
    t.name AS code_ile,
    if(sum(YEAR(o.field_bdni_e_p_date_value) < 2000) != 0, 1, 0) +
    if(sum(YEAR(o.field_bdni_e_p_date_value) >= 2000) != 0, 2, 0) + 1 AS niveau
FROM drp_term_data t
    LEFT JOIN drp_content_type_bd_ni_entomo_present o ON (t.tid = o.field_bdni_e_p_code_ile_ilot_value)
WHERE t.vid = 4
GROUP BY t.name;

-- Caractéristiques environnementales

CREATE OR REPLACE VIEW picto_etaco_carenv AS
SELECT
    t.name AS code_ile,
    CASE
        (dp.field_bdi_dp_topo_province_value IS NOT NULL) +
        (dp.field_bdi_dp_topo_region_value IS NOT NULL) +
        (dp.field_bdi_dp_localite_proche_value IS NOT NULL) +
        (dp.field_bdi_dp_topo_communes_value IS NOT NULL) +
        (dp.field_bdi_dp_sup_terrestre_ha_value IS NOT NULL) +
        (dp.field_bdi_dp_sup_amp_ha_value IS NOT NULL) +
        (dp.field_bdi_dp_altitude_metre_value IS NOT NULL) +
        (dp.field_bdi_dp_dist_cote_cont_value IS NOT NULL) +
        (dp.field_bdi_dp_cote_cont_reference_value IS NOT NULL) +
        (dp.field_bdi_dp_lineaire_cote_metre_value IS NOT NULL) +
        (ce.field_bdi_ce_origine_de_l_ile_value IS NOT NULL) +
        (ce.field_bdi_ce_dc_bioclimat_value IS NOT NULL) +
        (ce.field_bdi_ce_dc_vent_dominant_value IS NOT NULL) +
        (ce.field_bdi_ce_dc_temp_min_value IS NOT NULL) +
        (ce.field_bdi_ce_dc_temp_max_value IS NOT NULL) +
        (ce.field_bdi_ce_dc_pluviometrie_value IS NOT NULL) +
        (ce.field_bdi_ce_dc_sol_rocheux_value IS NOT NULL) +
        (ce.field_bdi_ce_dc_sol_sableux_value IS NOT NULL) +
        (ce.field_bdi_ce_dc_sol_terreux_value IS NOT NULL) +
        (ce.field_bdi_ce_dc_ressource_eau_value IS NOT NULL) +
        (ce.field_bdi_ce_dc_source_nb_value IS NOT NULL)
        WHEN 0 THEN 1
        WHEN 1 THEN 2
        WHEN 2 THEN 2
        WHEN 3 THEN 2
        WHEN 4 THEN 2
        WHEN 5 THEN 2
        WHEN 6 THEN 2
        WHEN 7 THEN 2
        WHEN 8 THEN 2
        WHEN 9 THEN 2
        WHEN 10 THEN 2
        WHEN 11 THEN 3
        WHEN 12 THEN 3
        WHEN 13 THEN 3
        WHEN 14 THEN 3
        WHEN 15 THEN 3
        WHEN 16 THEN 3
        WHEN 17 THEN 3
        WHEN 18 THEN 3
        WHEN 19 THEN 3
        WHEN 20 THEN 3
        WHEN 21 THEN 4
    END AS niveau
FROM drp_term_data t
    LEFT JOIN drp_content_type_bd_i_caracteristiques_environnem ce ON (t.tid = ce.field_bdi_ce_code_ile_ilot_value)
    LEFT JOIN drp_content_type_bd_i_description_physique dp ON (t.tid = dp.field_bdi_dp_nom_ile_code_ile_value)
WHERE t.vid = 4;

-- Socie économie

CREATE OR REPLACE VIEW picto_etaco_soceco AS
SELECT
    t.name AS code_ile,
    CASE
        (o.field_bdi_o_desserte_de_l_ile_value IS NOT NULL) +
        (count(oie.field_bdi_o_infrastruct_equip_value) > 0) +
        (count(oua.field_bdi_o_usages_actuels_value) > 0) +
        (count(oav.field_bdi_o_activites_visiteurs_value) > 0) +
        (count(p.field_bdi_pop_pp_nb_habitant_value) > 0) +
        (count(p.field_bdi_pop_pe_nb_value) > 0) +
        (count(p.field_bdi_pop_ft_nb_touriste_value) > 0) +
        (count(p.field_bdi_pop_ft_nb_touriste_max_value) > 0) +
        (count(p.field_bdi_pop_fm_nb_bateau_an_value) > 0) +
        (count(s.field_bdi_sp_public_value) > 0) +
        (count(s.field_bdi_sp_privee_value) > 0)
        WHEN 0 THEN 1
        WHEN 1 THEN 2
        WHEN 2 THEN 2
        WHEN 3 THEN 2
        WHEN 4 THEN 2
        WHEN 5 THEN 2
        WHEN 6 THEN 3
        WHEN 7 THEN 3
        WHEN 8 THEN 3
        WHEN 9 THEN 3
        WHEN 10 THEN 3
        WHEN 11 THEN 4
    END AS niveau
FROM drp_term_data t
    LEFT JOIN drp_content_type_bd_i_occupation o ON (t.tid = o.field_bdi_o_code_ile_ilot_value)
    LEFT JOIN drp_content_type_bd_i_multipop p ON (t.tid = p.field_bdi_pop_code_ile_ilot_value)
    LEFT JOIN drp_content_field_bdi_o_infrastruct_equip oie ON (o.vid = oie.vid)
    LEFT JOIN drp_content_field_bdi_o_usages_actuels oua ON (o.vid = oua.vid)
    LEFT JOIN drp_content_field_bdi_o_activites_visiteurs oav ON (o.vid = oav.vid)
    LEFT JOIN drp_content_type_bd_i_statut_de_propriete s ON (t.tid = field_bdi_sp_code_ile_ilot_value)
WHERE t.vid = 4
GROUP BY t.name, o.field_bdi_o_desserte_de_l_ile_value, o.vid;

-- Résumé

CREATE OR REPLACE VIEW picto_etaco AS
SELECT b.code_ile AS code_ile, b.niveau AS bota, o.niveau AS ornitho, h.niveau AS herpeto, m.niveau AS mamm, c.niveau AS chiro, i.niveau AS invert, ce.niveau AS carenv, se.niveau AS soceco
FROM picto_etaco_bota b, picto_etaco_ornitho o, picto_etaco_herpeto h, picto_etaco_mamm m, picto_etaco_chiro c, picto_etaco_invert i, picto_etaco_carenv ce, picto_etaco_soceco se
WHERE b.code_ile = o.code_ile
  AND b.code_ile = h.code_ile
  AND b.code_ile = m.code_ile
  AND b.code_ile = c.code_ile
  AND b.code_ile = i.code_ile
  AND b.code_ile = ce.code_ile
  AND b.code_ile = se.code_ile;

-- ----------------------------------------------------------------------------
-- Intérêts des patrimoines
-- ----------------------------------------------------------------------------

-- Botanique

-- Ornithologie

-- Pour vérifier les tid des termes à chercher :
-- select * from drp_term_data where name like 'Calonectris dio%' or name like 'Hydrobates pelag%' or name like 'Falco peregr%' or name like 'Phalacrocorax aristo%' or name like 'Pandion halia%' or name like 'Puffinus yelk%' or name like 'Falco eleo%' or name like 'Larus micha%' or name like 'Larus audoui%' or name like 'Bubo b%';
CREATE OR REPLACE VIEW picto_intepa_ornitho AS
SELECT
    t.name AS code_ile,
    CASE
        (coalesce(sum(o.field_bdni_o_p_taxon_value = 3513), 0) > 0) +
        (coalesce(sum(o.field_bdni_o_p_taxon_value = 3116), 0) > 0) +
        (coalesce(sum(o.field_bdni_o_p_taxon_value = 3227), 0) > 0) +
        (coalesce(sum(o.field_bdni_o_p_taxon_value = 3244), 0) > 0) +
        (coalesce(sum(o.field_bdni_o_p_taxon_value = 2890), 0) > 0) +
        (coalesce(sum(o.field_bdni_o_p_taxon_value IN (2930, 22614, 22615)), 0) > 0) +
        (coalesce(sum(o.field_bdni_o_p_taxon_value IN (3198, 22620)), 0) > 0) +
        (coalesce(sum(o.field_bdni_o_p_taxon_value IN (3119, 22616, 22617)), 0) > 0) +
        (coalesce(sum(o.field_bdni_o_p_taxon_value IN (3410, 22626)), 0) > 0) +
        (coalesce(sum(o.field_bdni_o_p_taxon_value IN (3371, 22624)), 0) > 0)
        WHEN 0 THEN 1
        WHEN 1 THEN 2
        WHEN 2 THEN 2
        WHEN 3 THEN 3
        WHEN 4 THEN 3
        WHEN 5 THEN 3
        ELSE 4
    END AS niveau
FROM drp_term_data t
    LEFT JOIN drp_content_type_bd_ni_ornithologie_present o ON (t.tid = o.field_bdni_o_p_code_ile_ilot_value)
WHERE t.vid = 4
GROUP BY t.name;

-- Herpétologie

-- Mammifères

-- Chiroptères

CREATE OR REPLACE VIEW picto_intepa_chiro AS
SELECT
    t.name AS code_ile,
    CASE
        count(DISTINCT field_bdni_c_p_taxon_value)
        WHEN 0 THEN 1
        WHEN 1 THEN 2
        WHEN 2 THEN 3
        ELSE 4
    END AS niveau
FROM drp_term_data t
    LEFT JOIN drp_content_type_bd_ni_chiroptere_present c ON (t.tid = c.field_bdni_c_p_code_ile_ilot_value)
WHERE t.vid = 4
GROUP BY t.name;

-- Invertébrés

-- Faune marine

-- Flore marine

-- Paysage (Terre)

-- Pour vérifier les tid des termes à chercher :
-- select * from drp_term_data where vid = 57;
CREATE OR REPLACE VIEW picto_intepa_paysat AS
SELECT
    t.name AS code_ile,
    CASE
        count(DISTINCT oie.field_bdi_o_infrastruct_equip_value)
        WHEN 0 THEN 1
        WHEN 1 THEN 2
        WHEN 2 THEN 3
        ELSE 4
    END AS niveau
FROM drp_term_data t
    LEFT JOIN drp_content_type_bd_i_occupation o ON (t.tid = o.field_bdi_o_code_ile_ilot_value)
    LEFT JOIN drp_content_field_bdi_o_infrastruct_equip oie ON (o.vid = oie.vid AND oie.field_bdi_o_infrastruct_equip_value IN (58632, 44939, 44938, 44936, 44940, 58624, 44947, 58633))
WHERE t.vid = 4
GROUP BY t.name;

-- Création de richesse économique (Mer)

-- Pour vérifier les tid des termes à chercher :
-- select * from drp_term_data where vid = 58 and name = 'Pêche';
-- select * from drp_term_data where vid = 59 and (name like 'Chass%' or name like 'Nauti%' or name = 'Plongée' or name like 'Scoot%');
CREATE OR REPLACE VIEW picto_intepa_crem AS
SELECT
    t.name AS code_ile,
    CASE
        (o.field_bdi_o_desserte_de_l_ile_value IS NOT NULL) +
        (oua.field_bdi_o_usages_actuels_value IS NOT NULL) +
        count(DISTINCT oav.field_bdi_o_activites_visiteurs_value)
        WHEN 0 THEN 1
        WHEN 1 THEN 2
        WHEN 2 THEN 3
        ELSE 4
    END AS niveau
FROM drp_term_data t
    LEFT JOIN drp_content_type_bd_i_occupation o ON (t.tid = o.field_bdi_o_code_ile_ilot_value)
    LEFT JOIN drp_content_field_bdi_o_usages_actuels oua ON (o.vid = oua.vid AND oua.field_bdi_o_usages_actuels_value = 44852)
    LEFT JOIN drp_content_field_bdi_o_activites_visiteurs oav ON (o.vid = oav.vid AND oav.field_bdi_o_activites_visiteurs_value IN (44952, 44954, 44958, 44962))
WHERE t.vid = 4
GROUP BY t.name, o.field_bdi_o_desserte_de_l_ile_value, oua.field_bdi_o_usages_actuels_value, o.vid;

-- Création de richesse économique (Terre)

-- Pour vérifier les tid des termes à chercher :
-- select * from drp_term_data where vid = 58 and (name like 'Agric%' or name like 'Carr%' or name = 'Elevage' or name = 'Tourisme');
-- select * from drp_term_data where vid = 59 and (name like 'Activ%' or name like 'Restau%' or name like 'Rando%');
CREATE OR REPLACE VIEW picto_intepa_cret AS
SELECT
    t.name AS code_ile,
    CASE
        (o.field_bdi_o_desserte_de_l_ile_value IS NOT NULL) +
        (oua.field_bdi_o_usages_actuels_value IS NOT NULL) +
        count(DISTINCT oav.field_bdi_o_activites_visiteurs_value)
        WHEN 0 THEN 1
        WHEN 1 THEN 2
        WHEN 2 THEN 3
        ELSE 4
    END AS niveau
FROM drp_term_data t
    LEFT JOIN drp_content_type_bd_i_occupation o ON (t.tid = o.field_bdi_o_code_ile_ilot_value)
    LEFT JOIN drp_content_field_bdi_o_usages_actuels oua ON (o.vid = oua.vid AND oua.field_bdi_o_usages_actuels_value IN (44848, 44849, 44850, 44855))
    LEFT JOIN drp_content_field_bdi_o_activites_visiteurs oav ON (o.vid = oav.vid AND oav.field_bdi_o_activites_visiteurs_value IN (44949, 58625, 44961, 44960))
WHERE t.vid = 4
GROUP BY t.name, o.field_bdi_o_desserte_de_l_ile_value, oua.field_bdi_o_usages_actuels_value, o.vid;

-- Résumé

CREATE OR REPLACE VIEW picto_intepa AS
SELECT o.code_ile AS code_ile, 1 AS bota, o.niveau AS ornitho, 1 AS herpeto, 1 AS mamm, c.niveau AS chiro, 1 AS invert, 1 AS faunem, 1 AS florem, pt.niveau AS paysat, rm.niveau AS crem, rt.niveau AS cret
FROM picto_intepa_ornitho o, picto_etaco_chiro c, picto_intepa_paysat pt, picto_intepa_crem rm, picto_intepa_cret rt
WHERE o.code_ile = c.code_ile
  AND o.code_ile = pt.code_ile
  AND o.code_ile = rm.code_ile
  AND o.code_ile = rt.code_ile;

-- ----------------------------------------------------------------------------
-- Pressions
-- ----------------------------------------------------------------------------

-- Desserte par navette

CREATE OR REPLACE VIEW picto_press_denav AS
SELECT
    t.name AS code_ile,
    CASE o.field_bdi_o_desserte_de_l_ile_value
        WHEN 'OUI' THEN 2
        WHEN 'NON' THEN 1
        ELSE 0
    END AS niveau
FROM drp_term_data t
    LEFT JOIN drp_content_type_bd_i_occupation o ON (t.tid = o.field_bdi_o_code_ile_ilot_value)
WHERE t.vid = 4;

-- Présence de bâti

-- Pour vérifier les tid des termes à chercher :
-- select * from drp_term_data where vid = 57 and (name = 'Aucun' or name like 'Epave%');
CREATE OR REPLACE VIEW picto_press_preba AS
SELECT
    t.name AS code_ile,
    CASE
        WHEN count(oie.field_bdi_o_infrastruct_equip_value) = 0 THEN 0
        WHEN sum(oie.field_bdi_o_infrastruct_equip_value in (58623, 58635, 58634)) = count(oie.field_bdi_o_infrastruct_equip_value) THEN 1
        ELSE 2
    END AS niveau
FROM drp_term_data t
    LEFT JOIN drp_content_type_bd_i_occupation o ON (t.tid = o.field_bdi_o_code_ile_ilot_value)
    LEFT JOIN drp_content_field_bdi_o_infrastruct_equip oie ON (o.vid = oie.vid)
WHERE t.vid = 4
GROUP BY t.name;

-- Activités touristisques

-- Pour vérifier les tid des termes à chercher :
-- select * from drp_term_data where vid = 59 and name = 'Aucun';
CREATE OR REPLACE VIEW picto_press_actou AS
SELECT
    t.name AS code_ile,
    CASE
        WHEN count(oav.field_bdi_o_activites_visiteurs_value) = 0 THEN 0
        WHEN sum(oav.field_bdi_o_activites_visiteurs_value = 58626) = count(oav.field_bdi_o_activites_visiteurs_value) THEN 1
        ELSE 2
    END AS niveau
FROM drp_term_data t
    LEFT JOIN drp_content_type_bd_i_occupation o ON (t.tid = o.field_bdi_o_code_ile_ilot_value)
    LEFT JOIN drp_content_field_bdi_o_activites_visiteurs oav ON (o.vid = oav.vid)
WHERE t.vid = 4
GROUP BY t.name;

-- Présence d'habitants à l'année

CREATE OR REPLACE VIEW picto_press_haban AS
SELECT
    t.name AS code_ile,
    CASE
        WHEN count(po.field_bdi_pop_pp_nb_habitant_value) = 0 THEN 0
        WHEN max(po.field_bdi_pop_pp_nb_habitant_value) = 0 THEN 1
        ELSE 2
    END AS niveau
FROM drp_term_data t
    LEFT JOIN drp_content_type_bd_i_multipop po ON (t.tid = po.field_bdi_pop_code_ile_ilot_value AND coalesce(po.field_bdi_pop_annee_value, 0) = (
        SELECT max(coalesce(field_bdi_pop_annee_value, 0))
        FROM drp_content_type_bd_i_multipop pi
        WHERE pi.field_bdi_pop_code_ile_ilot_value = po.field_bdi_pop_code_ile_ilot_value
    ))
WHERE t.vid = 4
GROUP BY t.name;

-- Utilitaire pour des requêtes très similaires (améliore les temps de réponse sur la requête de résumé)

CREATE OR REPLACE VIEW picto_press_base_pm AS
SELECT
    t.name AS code_ile,
    CASE
        WHEN 'Fort' IN (pm.field_bdi_pm_ter_niv_freq_humain_value, pm.field_bdi_pm_terre_impact_faune_value) THEN 4
        WHEN 'Moyen' IN (pm.field_bdi_pm_ter_niv_freq_humain_value, pm.field_bdi_pm_terre_impact_faune_value) THEN 3
        WHEN 'Faible' IN (pm.field_bdi_pm_ter_niv_freq_humain_value, pm.field_bdi_pm_terre_impact_faune_value) THEN 2
        WHEN 'Pas d''impact' IN (pm.field_bdi_pm_ter_niv_freq_humain_value, pm.field_bdi_pm_terre_impact_faune_value) THEN 1
        ELSE 0
    END AS imusat,
    CASE
        WHEN 'Fort' IN (pm.field_bdi_pm_mer_niv_freq_humain_value, pm.field_bdi_pm_mer_impact_faune_value) THEN 4
        WHEN 'Moyen' IN (pm.field_bdi_pm_mer_niv_freq_humain_value, pm.field_bdi_pm_mer_impact_faune_value) THEN 3
        WHEN 'Faible' IN (pm.field_bdi_pm_mer_niv_freq_humain_value, pm.field_bdi_pm_mer_impact_faune_value) THEN 2
        WHEN 'Pas d''impact' IN (pm.field_bdi_pm_mer_niv_freq_humain_value, pm.field_bdi_pm_mer_impact_faune_value) THEN 1
        ELSE 0
    END AS imusam,
    CASE field_bdi_pm_terre_impact_flore_value
        WHEN 'Fort' THEN 4
        WHEN 'Moyen' THEN 3
        WHEN 'Faible' THEN 2
        WHEN 'Pas d''impact' THEN 1
        ELSE 0
    END AS eet,
    CASE field_bdi_pm_mer_impact_flore_value
        WHEN 'Fort' THEN 4
        WHEN 'Moyen' THEN 3
        WHEN 'Faible' THEN 2
        WHEN 'Pas d''impact' THEN 1
        ELSE 0
    END AS eem
FROM drp_term_data t
    LEFT JOIN drp_content_type_bd_i_problemes_et_menaces pm ON (t.tid = pm.field_bdi_pm_code_ile_ilot_value)
WHERE t.vid = 4;

-- Impacts des usages (Terre)

CREATE OR REPLACE VIEW picto_press_imusat AS
SELECT code_ile, imusat AS niveau
FROM picto_press_base_pm;

-- Impacts des usages (Mer)

CREATE OR REPLACE VIEW picto_press_imusam AS
SELECT code_ile, imusam AS niveau
FROM picto_press_base_pm;

-- Espèces envahissantes terrestres

CREATE OR REPLACE VIEW picto_press_eet AS
SELECT code_ile, eet AS niveau
FROM picto_press_base_pm;

-- Espèces envahissantes marines

CREATE OR REPLACE VIEW picto_press_eem AS
SELECT code_ile, eem AS niveau
FROM picto_press_base_pm;

-- Résumé

CREATE OR REPLACE VIEW picto_press AS
SELECT d.code_ile AS code_ile, d.niveau AS denav, p.niveau AS preba, a.niveau AS actou, h.niveau AS haban, pm.imusat, pm.imusam, pm.eet, pm.eem
FROM picto_press_denav d, picto_press_preba p, picto_press_actou a, picto_press_haban h, picto_press_base_pm pm
WHERE d.code_ile = p.code_ile
  AND d.code_ile = a.code_ile
  AND d.code_ile = h.code_ile
  AND d.code_ile = pm.code_ile;

-- ----------------------------------------------------------------------------
-- Gestion / Conservation
-- ----------------------------------------------------------------------------

-- Statut de protection terrestre

-- Pour vérifier les tid des termes à chercher :
-- select * from drp_term_data where vid = 54 and name = 'Pas de statut de protection';
CREATE OR REPLACE VIEW picto_gecon_spt AS
SELECT
    t.name AS code_ile,
    CASE
        WHEN count(sp.field_bdi_spt_statut_protection_value) = 0 THEN 0
        WHEN sum(sp.field_bdi_spt_statut_protection_value = 58622) = count(sp.field_bdi_spt_statut_protection_value) THEN 1
        ELSE 2
    END AS niveau
FROM drp_term_data t
    LEFT JOIN (
        drp_content_type_bd_i_statut_de_protection sp JOIN
        drp_content_field_bdi_spt_aire_concernee ac ON (sp.vid = ac.vid AND ac.field_bdi_spt_aire_concernee_value = 'Terre')
    ) ON (t.tid = sp.field_bdi_spt_code_ile_ilot_value)
WHERE t.vid = 4
GROUP BY t.name;

-- Statut de protection marin

-- Pour vérifier les tid des termes à chercher :
-- select * from drp_term_data where vid = 54 and name = 'Pas de statut de protection';
CREATE OR REPLACE VIEW picto_gecon_spm AS
SELECT
    t.name AS code_ile,
    CASE
        WHEN count(sp.field_bdi_spt_statut_protection_value) = 0 THEN 0
        WHEN sum(sp.field_bdi_spt_statut_protection_value = 58622) = count(sp.field_bdi_spt_statut_protection_value) THEN 1
        ELSE 2
    END AS niveau
FROM drp_term_data t
    LEFT JOIN (
        drp_content_type_bd_i_statut_de_protection sp JOIN
        drp_content_field_bdi_spt_aire_concernee ac ON (sp.vid = ac.vid AND ac.field_bdi_spt_aire_concernee_value = 'Mer')
    ) ON (t.tid = sp.field_bdi_spt_code_ile_ilot_value)
WHERE t.vid = 4
GROUP BY t.name;

-- Utilitaires pour des requêtes très similaires (améliore les temps de réponse sur la requête de résumé)

CREATE OR REPLACE VIEW picto_gecon_base_gest AS
SELECT
    t.name AS code_ile,
    CASE g.field_bdi_g_exist_gestionnaire_value
        WHEN 'Oui' THEN 2
        WHEN 'Non' THEN 1
        ELSE 0
    END AS exgest,
    CASE g.field_bdi_g_surveillance_de_site_value
        WHEN 'Permanente' THEN 3
        WHEN 'Temporaire' THEN 2
        WHEN 'Semi-permanente' THEN 2
        WHEN 'En projet' THEN 1
        WHEN 'Pas de surveillance' THEN 1
        WHEN 'Non' THEN 1
        ELSE 0
    END AS pregest,
    CASE g.field_bdi_g_comite_gestion_value
        WHEN 'Oui' THEN 2
        WHEN 'Non' THEN 1
        ELSE 0
    END AS cogest,
    IF(
        g.field_bdi_g_res_bateau_value IS NULL AND
        g.field_bdi_g_res_plongee_value IS NULL AND
        g.field_bdi_g_res_accueil_value IS NULL AND
        g.field_bdi_g_res_analyse_value IS NULL AND
        g.field_bdi_g_res_transport_value IS NULL,
        0,
        CASE coalesce(g.field_bdi_g_res_bateau_value = 'Oui', 0) +
             coalesce(g.field_bdi_g_res_plongee_value = 'Oui', 0) +
             coalesce(g.field_bdi_g_res_accueil_value = 'Oui', 0) +
             coalesce(g.field_bdi_g_res_analyse_value = 'Oui', 0) +
             coalesce(g.field_bdi_g_res_transport_value = 'Oui', 0)
            WHEN 5 THEN 3
            WHEN 0 THEN 1
            ELSE 2
        END
    ) AS moydi,
    CASE g.field_bdi_g_etat_plan_gestion_value
        WHEN 'Oui' THEN 3
        WHEN 'En projet' THEN 2
        WHEN 'Non' THEN 1
        ELSE 0
    END AS plagest
FROM drp_term_data t
    LEFT JOIN drp_content_type_bd_i_gestionnaire g ON (t.tid = g.field_bdi_g_code_ile_ilot_value)
WHERE t.vid = 4;

CREATE OR REPLACE VIEW picto_gecon_base_regl AS
SELECT
    t.name AS code_ile,
    CASE r.field_bdi_ra_acces_value
        WHEN 'Autorisé' THEN 2
        WHEN 'Réglementé' THEN 2
        WHEN 'Interdit' THEN 1
        ELSE 0
    END AS accaut,
    CASE r.field_bdi_ra_peche_value
        WHEN 'Autorisé' THEN 2
        WHEN 'Réglementé' THEN 2
        WHEN 'Interdit' THEN 1
        ELSE 0
    END AS pecaut
FROM drp_term_data t
    LEFT JOIN drp_content_type_bd_i_reglementation_activite r ON (t.tid = r.field_bdi_ra_code_ile_ilot_value)
WHERE t.vid = 4;

-- Existence d'un gestionnaire

CREATE OR REPLACE VIEW picto_press_pregest AS
SELECT code_ile, pregest AS niveau
FROM picto_gecon_base_gest;

-- Présence d'un gestionnaire sur le site

CREATE OR REPLACE VIEW picto_press_exgest AS
SELECT code_ile, exgest AS niveau
FROM picto_gecon_base_gest;

-- Comité de gestion

CREATE OR REPLACE VIEW picto_press_cogest AS
SELECT code_ile, cogest AS niveau
FROM picto_gecon_base_gest;

-- Moyens disponibles

CREATE OR REPLACE VIEW picto_press_moydi AS
SELECT code_ile, moydi AS niveau
FROM picto_gecon_base_gest;

-- Plan de gestion

CREATE OR REPLACE VIEW picto_press_plagest AS
SELECT code_ile, plagest AS niveau
FROM picto_gecon_base_gest;

-- Accès autorisé sur le site

CREATE OR REPLACE VIEW picto_press_accaut AS
SELECT code_ile, accaut AS niveau
FROM picto_gecon_base_regl;

-- Pêche autorisée sur le site

CREATE OR REPLACE VIEW picto_press_pecaut AS
SELECT code_ile, pecaut AS niveau
FROM picto_gecon_base_regl;

-- Résumé

CREATE OR REPLACE VIEW picto_gecon AS
SELECT spt.code_ile, spt.niveau AS spt, spm.niveau AS spm, g.exgest, g.pregest, g.cogest, g.moydi, g.plagest, r.accaut, r.pecaut
FROM picto_gecon_spt spt, picto_gecon_spm spm, picto_gecon_base_gest g, picto_gecon_base_regl r
WHERE spt.code_ile = spm.code_ile
  AND spt.code_ile = g.code_ile
  AND spt.code_ile = r.code_ile;
