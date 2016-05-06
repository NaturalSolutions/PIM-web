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
AND YEAR(o.field_bdni_b_p_date_value) <> 1666
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
AND YEAR(o.field_bdni_o_p_date_value) <> 1666
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
AND YEAR(o.field_bdni_h_p_date_value) <> 1666
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
AND YEAR(o.field_bdni_mt_p_date_value) <> 1666
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
AND YEAR(o.field_bdni_c_p_date_value) <> 1666
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
AND YEAR(o.field_bdni_e_p_date_value) <> 1666
GROUP BY t.name;