<?php
require_once('PIM_ficheIle_charts.inc');
require_once('PIM_ficheIle_commons.inc');
require_once('PIM_ficheIle_tabs.inc');

/*--------------------------------------------------------
**  BDI node level
**--------------------------------------------------------*/
function pim_fi_node_bd_i_callback ($tid, $op = 'view', $node_type, $nid=NULL) {
  if (isset($_REQUEST['destination'])) {
    unset($_REQUEST['destination']);
  }
  if (empty($tid)) {
    drupal_set_message(t('No Island Selected'));
    return theme('status_messages', 'block');
  }
  if (! is_numeric($tid) ) {
    $array_tid = taxonomy_get_term_by_name($tid);
    $tid = $array_tid[0]->tid;
  }
  if (strpos($node_type, 'bd_i_') !== 0) {
    drupal_set_message(t('Wrong Callback for node type: ').$node_type);
    return theme('status_messages', 'block');
  }
  if ($nid == null) {
    $nid = pim_fi_get_single_nid($tid, $node_type);
  }
  /* node_load($node, $revision, $reset) */
  /* $reset: Whether to reset the internal node_load cache
  *  set to TRUE = don't keep in function local cache
  *  recommended in case of many node_load
  */
  
  
  switch($op) {
    case 'view':
      $node = node_load($nid, $revision=NULL, $reset=TRUE);
      if (empty($node)) {
        $out = pim_fi_set_pageheader($tid);
        $out .= pim_fi_set_emptycontent();
        $out .= pim_fi_set_empty_bdi_nodelevel($node_type);
        $out .= pim_fi_set_pagefooter($tid);
        return $out;
      }
      
      $out = "";
      $out .= node_view($node, $teaser = FALSE, $page = FALSE, $links = TRUE);
      return $out;
      break;
      
    case 'edit':
      //$node = node_load($nid, $revision=NULL, $reset=FALSE);
      //if (empty($node)) {
      if ($nid == NULL) {
        //Create a BDI Node
        $node_type = str_replace("_","-",$node_type);
        $redirect = 'node/add/'. $node_type .'/'. $tid;
        drupal_goto($redirect);
        break;
      }
      $redirect = 'node/' . $nid . '/edit';
      drupal_goto($redirect);
      break;
      
    case 'create':
      $node_type = str_replace("_","-",$node_type);
      $redirect = 'node/add/' . $node_type.'/'. $tid;
      drupal_goto($redirect);
      break;
    
  }
}


/*--------------------------------------------------------
**  BDN node level
**--------------------------------------------------------*/
function pim_fi_node_bd_n_callback ($tid, $op = 'view', $node_type, $nid) {
  global $pim_fi_nodetype2url;
  pim_fi_set_nodetype2url();
  
  if (isset($_REQUEST['destination'])) {
    unset($_REQUEST['destination']);
  }
  if (empty($tid)) {
    drupal_set_message(t('No Island Selected'));
    return theme('status_messages', 'block');
  }
  if (! is_numeric($tid) ) {
    $array_tid = taxonomy_get_term_by_name($tid);
    $tid = $array_tid[0]->tid;
  }
  if (strpos($node_type, 'bd_ni_') !== 0) {
    drupal_set_message(t('Wrong Callback for node type: ').$node_type);
    return theme('status_messages', 'block');
  }
  if (($nid==NULL) and ($op <> 'create')) {
    drupal_set_message(t('nid is null!! problem with: ').$node_type);
    return theme('status_messages', 'block');
  }
  
  
  /* node_load($node, $revision, $reset) */
  /* $reset: Whether to reset the internal node_load cache
  *  set to TRUE = don't keep in function local cache
  *  recommended in case of many node_load
  */
  switch($op) {
    case 'view':
      $node = node_load($nid, NULL, NULL);
      $out = pim_fi_set_pageheader($tid);
      $out .= node_view($node, $teaser = FALSE, $page = FALSE, $links = TRUE);
      $out .= pim_fi_set_pagefooter($tid);
      return $out;
      break;
      
    case 'edit':
      $redirect = 'node/' . $nid . '/edit';
      drupal_goto($redirect);
      break;
    
    case 'create':
      $node_type = str_replace("_","-",$node_type);
      $redirect = 'node/add/' . $node_type.'/'. $tid;
      drupal_goto($redirect);
      break;
   
   /*   
    case 'list':
      $redirect = 'fiche-Ile/'.$tid.'/'.$pim_fi_nodetype2url[$node_type]['url'];
      drupal_goto($redirect);
      break;
   */
  }
}
/*--------------------------------------------------------
**  BDI Multi Node View
**--------------------------------------------------------*/
function _bd_i_multinode_callback ($tid, $op, $node_type, $head, $sql) {
  global $pim_fi_nodetype2url;
  global $user;
  global $base_url;
  
  if (i18n_get_lang() == "fr") {
	$lang = "";
  } else {
	$lang = i18n_get_lang()."/";
  }
  
  if (isset($_REQUEST['destination'])) {
    unset($_REQUEST['destination']);
  }
  $path =  $base_url."/".$_GET['q'];
  
  if (empty($tid)) {
    drupal_set_message(t('No Island Selected'));
    return theme('status_messages', 'block');
  }
  if (! is_numeric($tid) ) {
    $array_tid = taxonomy_get_term_by_name($tid);
    $tid = $array_tid[0]->tid;
  }
  $list_islands = $tid;
  $array_islands = pim_fi_get_archipel_islands($tid);
  if (isset($array_islands) and (!empty($array_islands))) {
    foreach($array_islands as $island_id) {
      $list_islands .= ", ".$island_id;
    }
  }
  
  $items_per_page = 50;
  
  $args = array($list_islands);

  //$query = sprintf($sql,$args);
  
  $sql_count = "select count(*) from (".$sql.")T";  
  $sql .= tablesort_sql($head);

  $result = pager_query($sql,
                        $items_per_page, 0,
                        $sql_count,
                        $args);
  $total = db_result(db_query($sql_count, $args));
  if ($total > $items_per_page) $total .= " (".$items_per_page." ".t('per page').")";
                     
  while ($record = db_fetch_array($result)) {
      $row2add = array();
      foreach($head as $col) {
           $row2add[] = array('data' => $record[$col['field']]);
      }
      
      if (pim_fi_node_access('update', NULL, $node_type)) {
        $row2add[] = 
          array('data' => "<a alt='".t('Edit Data')."' title='".t('Edit Data')."' href='".$base_url."/".$lang."node/".$record['nid']."/edit'>".t("Edit")."</a>");
      }
      $rows[] = $row2add;
  }
  
  $out = pim_fi_set_pageheader($tid);
  $out .= pim_fi_set_tableheader(t("Total: ").$total);

  $out .= "<div class='table-report'>";
  
  if ((!isset($rows)) or (empty($rows))) {
    $out .= pim_fi_set_emptycontent();
    $out .= pim_fi_set_empty_bdi_listlevel($node_type);
  } else {
    $out .= theme_table($head, $rows);
    $out .= theme('pager', NULL, $items_per_page, 0);
  }
  
  $out .= "</div>";
  $out .= pim_fi_set_pagefooter($tid);
  return $out;
  
}

function pim_fi_view_bd_i_protection_callback ($tid, $op = 'view', $node_type) {
  $head = array(
    array('data' => t('Level'), 'field' => 'level', 'sort' => 'desc'),
    array('data' => t('Protection status'), 'field' => 'protection', 'sort' => 'asc'),
    array('data' => t('Year'), 'field' => 'annee'),
    array('data' => t('Concerned area'), 'field' => 'concerned_area'),
    array('data' => t('Island'), 'field' => 'ile'),
  );
  $sql = "SELECT statuts.parentname AS level,
        CASE
            WHEN (statuts.name is NULL)
            THEN field_bdi_spt_statut_autre_value
            ELSE statuts.name
        END AS protection,
        CASE
            WHEN (YEAR(field_bdi_spt_annee_value) = 1666) OR (YEAR(field_bdi_spt_annee_value) = 0)
            THEN 'NC'
            ELSE YEAR(field_bdi_spt_annee_value)
        END AS annee,
        concerned_area,
        ti.name AS ile,
        p.nid as nid
FROM drp_content_type_bd_i_statut_de_protection p
    LEFT JOIN (
        -- Liste des statuts de protection avec leur niveau.
        SELECT t_prot.tid AS tid, t_prot.name AS name, t_level.name AS parentname
        FROM drp_term_data t_prot, drp_term_hierarchy hp, drp_term_data t_level
        WHERE t_prot.vid = 54
          AND t_prot.tid = hp.tid
          AND hp.parent = t_level.tid
          AND t_level.vid = 54
        UNION
        SELECT t_prot.tid AS tid, NULL AS name, t_prot.name AS parentname
        FROM drp_term_data t_prot, drp_term_hierarchy hp
        WHERE t_prot.vid = 54 AND t_prot.tid = hp.tid AND hp.parent = 0
    ) statuts ON (statuts.tid = p.field_bdi_spt_statut_protection_value)
    JOIN drp_term_data ti ON (ti.tid = p.field_bdi_spt_code_ile_ilot_value AND ti.vid = 4)
    LEFT JOIN (
        SELECT GROUP_CONCAT(field_bdi_spt_aire_concernee_value SEPARATOR '; ') AS concerned_area, nid
        FROM drp_content_field_bdi_spt_aire_concernee
        WHERE field_bdi_spt_aire_concernee_value IS NOT NULL
        GROUP BY nid
    ) ca ON (ca.nid = p.nid)
WHERE p.field_bdi_spt_code_ile_ilot_value IN (%s)";
  
    return _bd_i_multinode_callback($tid, $op, $node_type, $head, $sql);
}

function pim_fi_node_bd_i_multipop_callback ($tid, $op = 'view', $node_type) {
  $head = array(
    array('data' => t('Island'), 'field' => 'ile'),
    array('data' => t('Year'), 'field' => 'year', 'sort' => 'asc'),
    array('data' => t('Nb of permanent inhabitants'), 'field' => 'pp_nb'),
    array('data' => t('Nb of persons during summer'), 'field' => 'pe_nb'),
    array('data' => t('Min visitors number'), 'field' => 'min_tour_nb'),
    array('data' => t('Max visitors number'), 'field' => 'max_tour_nb'),
    array('data' => t('Nb. of boats per year'), 'field' => 'bateau_nb'),
  );
  $sql = "SELECT
        p.nid as nid,
        ti.name AS ile,
        YEAR(field_bdi_pop_annee_value) AS year,
        field_bdi_pop_pp_nb_habitant_value AS pp_nb,
        field_bdi_pop_pe_nb_value AS pe_nb,
        field_bdi_pop_ft_nb_touriste_value AS min_tour_nb,
        field_bdi_pop_ft_nb_touriste_max_value AS max_tour_nb,
        field_bdi_pop_fm_nb_bateau_an_value AS bateau_nb
    FROM drp_content_type_bd_i_multipop p, drp_term_data ti
    WHERE ti.tid = p.field_bdi_pop_code_ile_ilot_value AND ti.vid = 4 AND p.field_bdi_pop_code_ile_ilot_value IN (%s)";
  return _bd_i_multinode_callback($tid, $op, $node_type, $head, $sql);
}

/*--------------------------------------------------------
**  BDI Custom View
**--------------------------------------------------------*/
function pim_fi_view_bd_i_documents_callback ($tid) {
  global $pim_fi_nodetype2url;
  global $user;
  global $base_url;
  
  if (i18n_get_lang() == "fr") {
	$lang = "";
  } else {
	$lang = i18n_get_lang()."/";
  }
  
  if (isset($_REQUEST['destination'])) {
    unset($_REQUEST['destination']);
  }
  $path =  $base_url."/".$_GET['q'];
  
  if (empty($tid)) {
    drupal_set_message(t('No Island Selected'));
    return theme('status_messages', 'block');
  }
  if (! is_numeric($tid) ) {
    $array_tid = taxonomy_get_term_by_name($tid);
    $tid = $array_tid[0]->tid;
  }
  $list_islands = $tid;
  $array_islands = pim_fi_get_archipel_islands($tid);
  if (isset($array_islands) and (!empty($array_islands))) {
    foreach($array_islands as $island_id) {
      $list_islands .= ", ".$island_id;
    }
  }
  $motscles_field = 'd.field_document_mots_cles_value';
  $synonyms = taxonomy_get_synonyms($tid);
  /* not working */
  $check_motscles = "(d.field_document_mots_cles_value like '%%".$synonyms[0]."%%')";
  
  $items_per_page = 50;
  
  $head = array(
    array('data' => t('Title'), 'field' => 'titre', 'sort' => 'asc'),
    array('data' => t('Author'), 'field' => 'auteur'),
    array('data' => t('Date'), 'field' => 'annee'),
  );
  $sql = "SELECT d.field_document_titre_value as titre,
          d.field_document_auteur_value as auteur,
          year(d.field_document_annee_value),
          d.nid as nid
          from drp_content_type_document d
          inner join drp_term_node t
          on t.nid = d.nid
          Where t.tid in (%s)
          UNION
          SELECT d.field_document_titre_value as titre,
          d.field_document_auteur_value as auteur,
          year(d.field_document_annee_value),
          d.nid as nid
          from drp_content_type_document d
          Where d.field_document_mots_cles_value like '%%%s%%'";
          
  $sql = "SELECT d.field_document_titre_value as titre,
          d.field_document_auteur_value as auteur,
          year(d.field_document_annee_value),
          d.nid as nid
          from drp_content_type_document d
          inner join drp_content_field_document_nom_ile_code_ile iles
          on iles.nid = d.nid
          Where iles.field_document_nom_ile_code_ile_value in (%s)
          UNION
          SELECT d.field_document_titre_value as titre,
          d.field_document_auteur_value as auteur,
          year(d.field_document_annee_value),
          d.nid as nid
          from drp_content_type_document d
          Where d.field_document_mots_cles_value like '%%%s%%'";
  
  $args = array($list_islands, $synonyms[0]);

  $query = sprintf($sql,$args[0],$args[1]);
  //print $query;
  
  $sql_count = "select count(*) from (".$sql.")T";  
  $sql .= tablesort_sql($head);

  $result = pager_query($sql,
                        $items_per_page, 0,
                        $sql_count,
                        $args);
  $total = db_result(db_query($sql_count, $args));
  if ($total > $items_per_page) $total .= " (".$items_per_page." ".t('per page').")";
                     
  while ($record = db_fetch_object($result)) {
    $rows[] = array(
      array('data' => $record->titre),
      array('data' => $record->auteur),
      array('data' => $record->annee),
      array('data' => "<a alt='".t('View Document')."' title='".t('View Document')."' href='".$base_url."/".$lang."node/".$record->nid."'>".t("View")."</a>"),
      );
	  
  }
  
  $out = pim_fi_set_pageheader($tid);
  $out .= pim_fi_set_tableheader(t("Total: ").$total);

  $out .= "<div class='table-report'>";
  
  if ((!isset($rows)) or (empty($rows))) {
    $out .= pim_fi_set_emptycontent();
  } else {
    $out .= theme_table($head, $rows);
    $out .= theme('pager', NULL, $items_per_page, 0);
  }
  
  $out .= "</div>";
  $out .= pim_fi_set_pagefooter($tid);
  return $out;
  
}

function pim_fi_view_bd_i_photos_callback ($tid) {
  global $pim_fi_nodetype2url;
  global $user;
  global $base_url;
  
  if (isset($_REQUEST['destination'])) {
    unset($_REQUEST['destination']);
  }
  if (empty($tid)) {
    drupal_set_message(t('No Island Selected'));
    return theme('status_messages', 'block');
  }
  if (! is_numeric($tid) ) {
    $array_tid = taxonomy_get_term_by_name($tid);
    $tid = $array_tid[0]->tid;
  }
  
  //$photo_html = pim_fi_get_picture($tid, $lightbox = TRUE, $returnDefault = FALSE);
  
  $out = pim_fi_set_pageheader($tid);
  $out .= "<div class='table-report'>";
  
  /*if ((!isset($photo_html)) or (empty($photo_html))) {
    $out .= pim_fi_set_emptycontent();
  } else {
    $out .= $photo_html;
  }*/
	$viewName = 'view_bd_ni_photos_illustrations';
	$display_id = 'block_1';
	$myArgs = array($tid);
	$out .= views_embed_view($viewName, $display_id, $tid);
  $out .= "</div>";
  $out .= pim_fi_set_pagefooter($tid);
  return $out;
}
/*--------------------------------------------------------
**  BDN Multi node View (Inventories List)
**--------------------------------------------------------*/
function pim_fi_view_bd_n_callback ($tid, $op = 'view', $node_type) {
  global $pim_fi_nodetype2url;
  global $user;
  global $base_url;
  
  if (i18n_get_lang() == "fr") {
	$lang = "";
  } else {
	$lang = i18n_get_lang()."/";
  }
  $path =  $base_url."/".$lang.$_GET['q'];
  
  if (isset($_REQUEST['destination'])) {
    unset($_REQUEST['destination']);
  }
  
  
  if (empty($tid)) {
    drupal_set_message(t('No Island Selected'));
    return theme('status_messages', 'block');
  }
  if (! is_numeric($tid) ) {
    $array_tid = taxonomy_get_term_by_name($tid);
    $tid = $array_tid[0]->tid;
  }
  $list_islands = $tid;
  $is_archipel = 0;
  $array_islands = pim_fi_get_archipel_islands($tid);
  if (isset($array_islands) and (!empty($array_islands))) {
    $is_archipel = 1;
    foreach($array_islands as $island_id) {
      $list_islands .= ", ".$island_id;
    }
  }
  
  $items_per_page = 50;
  $db_names = pim_fi_node2bd($node_type, TRUE);
  switch($node_type) {
    case 'bd_ni_faune_flore_marine_present':
    case 'bd_ni_faune_flore_marine_absent':
      $external_ref = TRUE;
      break;
    default:
      $external_ref = FALSE;
      break;
  }
  
  $head = array();
  if (isset($db_names['group'])) {
    $head[] = array('data' => t('Group'), 'field' => 'spgroup', 'sort' => 'asc');
  }
  $head[] = array('data' => t('Species'), 'field' => 'species', 'sort' => 'asc');
  $head[] = array('data' => t('Year'), 'field' => 'mydate');
  if (isset($db_names['classe_effectifs'])) {
    $head[] = array('data' => t('Size class'), 'field' => 'effectif');
  }
  $head[] = array('data' => t('Observers'), 'field' => 'observateurs');
  $head[] = array('data' => t('Source'), 'field' => 'type_source');
    //array('data' => t('Writer'), 'field' => 'redacteur'),
    //array('data' => t('Updated'), 'field' => 'myupdate', 'sort' => 'desc'),
  if ($is_archipel) {
    $head[] = array('data' => t('Island'), 'field' => 'ile');
  }
  
  if ($external_ref == FALSE) {
    $sql = "SELECT p.%s as spgroup, 
              COALESCE( CONCAT(t.name, ' ', p.%s),t.name) as species, t.tid as spid, 
              year(p.%s) as mydate,
              tile.name as ile,
              tsrc.name as type_source, tredac.name as redacteur,
              p.nid as nid, FROM_UNIXTIME(n.changed) as myupdate,
              teffectif.description as effectif,
              'titi' as observateurs
              FROM {%s} p
              inner join {term_data} t
                ON t.tid = p.%s
              inner join {term_data} tile
                ON tile.tid = p.%s
                AND tile.vid = 4
              inner join {node} n
                ON n.nid = p.nid
              left join {term_data} tsrc
                ON tsrc.tid = p.%s
                AND tsrc.vid in (42,43)
              left join {term_data} tredac
              ON tredac.tid = p.%s
              left join {term_data} teffectif
              ON teffectif.tid = p.%s
              Where p.%s in (%s)";
              
    $args = array();
    if (isset($db_names['group'])) {
      $args[] = $db_names['group'];
    } else {
      //dummy
      $args[] = $db_names['redacteur'];
    }
    $args[] = $db_names['taxon_prefix'];
    $args[] = $db_names['node_date'];
    $args[] = $db_names['node_table'];
    $args[] = $db_names['node_taxon'];
    $args[] = $db_names['ile_term_field'];
    $args[] = $db_names['type_source'];
    $args[] = $db_names['redacteur'];
    if (isset($db_names['classe_effectifs'])) {
      $args[] = $db_names['classe_effectifs'];
    } else {
      //dummy
      $args[] = $db_names['redacteur'];
    }
    $args[] = $db_names['ile_term_field'];
    $args[] = $list_islands;
    
  } else { 
    $sql = "SELECT p.%s as spgroup,
              COALESCE( CONCAT(p.%s, ' ', p.%s),p.%s) as species, p.%s as spid,
              year(p.%s) as mydate,
              tile.name as ile,
              tsrc.name as type_source, tredac.name as redacteur,
              p.nid as nid, FROM_UNIXTIME(n.changed) as myupdate,
              teffectif.description as effectif,
              'titi' as observateurs
            FROM {%s} p
            inner join {term_data} tile
                ON tile.tid = p.%s
                AND tile.vid = 4
            inner join {node} n
                ON n.nid = p.nid
            left join {term_data} tsrc
              ON tsrc.tid = p.%s
              AND tsrc.vid in (42,43)
            left join {term_data} tredac
              ON tredac.tid = p.%s
            left join {term_data} teffectif
              ON teffectif.tid = p.%s
            Where p.%s in (%s)";
    
    $args = array();
    if (isset($db_names['group'])) {
      $args[] = $db_names['group'];
    } else {
      //dummy
      $args[] = $db_names['redacteur'];
    }
    $args[] = $db_names['node_taxon_name'];
    $args[] = $db_names['taxon_prefix'];
    $args[] = $db_names['node_taxon_name'];
    $args[] = $db_names['node_taxon'];
    $args[] = $db_names['node_date'];
    $args[] = $db_names['node_table'];
    $args[] = $db_names['ile_term_field'];
    $args[] = $db_names['type_source'];
    $args[] = $db_names['redacteur'];
    
    if (isset($db_names['classe_effectifs'])) {
      $args[] = $db_names['classe_effectifs'];
    } else {
      //dummy
      $args[] = $db_names['redacteur'];
    }
    $args[] = $db_names['ile_term_field'];
    $args[] = $list_islands;
  }
  
  $query = sprintf($sql, $args[0],$args[1],$args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8],$args[9],$args[10],$args[11],$args[12]);

  $sql_count = "select count(*) from (".$sql.")T";  
  $sql .= tablesort_sql($head);

  $result = pager_query($sql,
                        $items_per_page, 0,
                        $sql_count,
                        $args);
  $total = db_result(db_query($sql_count, $args));
  if ($total > $items_per_page) $total .= " (".$items_per_page." ".t('per page').")";
  
  $sql2 = "select observateursName.name as observateur
            from {%s} MultiObservateursTable
            left join {term_data} observateursName
              ON observateursName.tid = MultiObservateursTable.%s
            Where MultiObservateursTable.nid = %d";
  
  while ($record = db_fetch_object($result)) {
  
    $observateursList = '';
    $args2 = array($db_names['observateurs_table'], $db_names['observateurs_field'], $record->nid);
    $observateursRes = db_query($sql2, $args2);
    while ($observateursRec = db_fetch_object($observateursRes)) {
      if (isset($observateursRec->observateur))
        $observateursList .=  $observateursRec->observateur .", ";
    }
    $row2add = array();
    if (isset($db_names['group'])) {
      $row2add[] = array('data' => $record->spgroup);
    }
    if ($external_ref == FALSE) {
	    $row2add[] = array('data' => "<a alt='".t('View Taxon')."' title='".t('View Taxon')."' href='".$base_url."/".$lang."fiche-taxon/".$record->spid."'>".$record->species."</a>");
	  }
	  else {
	  	$row2add[] = array('data' => "<a alt='".t('View Taxon')."' title='".t('View Taxon')."' href='".$base_url."/".$lang."fiche-worms/".$record->spid."'>".$record->species."</a>");
	  }
    $row2add[] = array('data' => $record->mydate);
    if (isset($db_names['classe_effectifs'])) {
      $row2add[] = array('data' => $record->effectif);
    }
    $row2add[] = array('data' => $observateursList);
    $row2add[] = array('data' => substr($record->type_source,0,6));
    //$row2add[] = array('data' => $record->redacteur);
    //$row2add[] = array('data' => substr($record->myupdate,0,10));
    if ($is_archipel) {
      $row2add[] = array('data' => substr($record->ile,5, 2));
    }
	$row2add[] = array('data' => "<a alt='".t('View Data')."' title='".t('View Data')."' href='".$path."/".$record->nid."/view'>".t("View")."</a>");
    
    $rows[] = $row2add;
  }
  
  $out = pim_fi_set_pageheader($tid);
  $out .= pim_fi_set_tableheader(t("Total: ").$total);
  $out .= "<div class='table-report'>";
  
  if ((!isset($rows)) or (empty($rows))) {
    $out .= pim_fi_set_emptycontent();
  } else {
    //$out .= drupal_get_form('fi_filter_form', $form);
    $out .= theme_table($head, $rows);
    $out .= theme('pager', NULL, $items_per_page, 0);
  }
  
  $out .= "</div>";
  $out .= pim_fi_set_pagefooter($tid);
  return $out;
  
}

/*--------------------------------------------------------
**  BDN Inventories Species List
**--------------------------------------------------------*/
function pim_fi_bdn_ispecies ($tid, $title, $array_node_type) {
  global $pim_fi_nodetype2url;
  global $base_url;
  
  if (i18n_get_lang() == "fr") {
	$lang = "";
  } else {
	$lang = i18n_get_lang()."/";
  }
  
  if (isset($_REQUEST['destination'])) {
    unset($_REQUEST['destination']);
  }
  if (empty($tid)) {
    drupal_set_message(t('No Island Selected'));
    return theme('status_messages', 'block');
  }
  if (! is_numeric($tid) ) {
    $array_tid = taxonomy_get_term_by_name($tid);
    $tid = $array_tid[0]->tid;
  }
  $list_islands = $tid;
  $array_islands = pim_fi_get_archipel_islands($tid);
  if (isset($array_islands) and (!empty($array_islands))) {
    foreach($array_islands as $island_id) {
      $list_islands .= ", ".$island_id;
    }
  }
  
  $items_per_page = 50;
  $db_names_ep = pim_fi_node2bd($array_node_type[0], TRUE);
  $db_names_ea = pim_fi_node2bd($array_node_type[1], TRUE);
  switch($array_node_type[0]) {
    case 'bd_ni_faune_flore_marine_present':
      $external_ref = TRUE;
      break;
    default:
      $external_ref = FALSE;
      break;
  }
  if (isset($db_names_ep['group'])) {
    $head = array(
        array('data' => t('Group'), 'field' => 'spgroup', 'sort' => 'asc'),
        array('data' => t('Species'), 'field' => 'species', 'sort' => 'asc'),
        array('data' => t('Protection'), 'field' => 'protection'),
        array('data' => t('Inventories'), 'field' => 'nb'),
    );
  } else {
    $head = array(
        array('data' => t('Species'), 'field' => 'species', 'sort' => 'asc'),
        array('data' => t('Protection'), 'field' => 'protection'),
        array('data' => t('Inventories'), 'field' => 'nb'),
    );
  }
  
  if ($external_ref == FALSE) {
    
    if (isset($db_names_ep['group'])) {
      $sql = "SELECT p.%s as spgroup, 
      					COALESCE( CONCAT(t.name, ' ', p.%s),t.name) as species, t.tid as spid, 
                count(p.nid) as nb, 'titi' as protection
                FROM {%s} p
                inner join {term_data} t
                ON t.tid = p.%s
                WHERE p.%s in (%s)
                GROUP by t.name, t.tid, p.%s, protection ";
      
      $args = array($db_names_ep['group'],
							      $db_names_ep['taxon_prefix'],
                    $db_names_ep['node_table'],
                    $db_names_ep['node_taxon'],
                    $db_names_ep['ile_term_field'], $list_islands,
                    $db_names_ep['group']);
    } else {
      $sql = "SELECT COALESCE( CONCAT(t.name, ' ', p.%s),t.name)  as species, t.tid as spid,
              count(p.nid) as nb, 'titi' as protection
              FROM {%s} p
              inner join {term_data} t
              ON t.tid = p.%s
              WHERE p.%s in (%s)
              GROUP by t.name, t.tid, protection ";
    
      $args = array($db_names_ep['taxon_prefix'],
							   $db_names_ep['node_table'],
                 $db_names_ep['node_taxon'],
                 $db_names_ep['ile_term_field'], $list_islands);
    
    }
  } else  {
    //External REF - pour l'instant, le group y est toujours       
    $sql = "SELECT p.%s as spgroup, COALESCE( CONCAT(p.%s, ' ', p.%s),p.%s) as species, p.%s as spid, 
            count(p.nid) as nb, 'titi' as protection
            FROM {%s} p
            WHERE p.%s in (%s)
            GROUP by p.%s, p.%s, p.%s, protection ";
                  
    $args = array($db_names_ep['group'],
                  $db_names_ep['node_taxon_name'],
                  $db_names_ep['taxon_prefix'],
                  $db_names_ep['node_taxon_name'],
                  $db_names_ep['node_taxon'],
                  $db_names_ep['node_table'],
                  $db_names_ep['ile_term_field'], $list_islands,
                  $db_names_ep['node_taxon_name'],
                  $db_names_ep['node_taxon'],
                  $db_names_ep['group']);
  }
  //$debug_query = sprintf($sql, $args[0],$args[1],$args[2],$args[3],$args[4]);
  
  $sql_count = "SELECT count(*) from (".$sql.")T";  
  $sql .= tablesort_sql($head);

  $result = pager_query($sql,
                        $items_per_page, 0,
                        $sql_count,
                        $args);
  $total = db_result(db_query($sql_count, $args));
  if ($total > $items_per_page) $total .= " (".$items_per_page." ".t('per page').")";
  
  $sql2 = "select tp.name as protection
           from {content_type_bd_t_fichetaxon} ft
           inner join {content_field_bd_t_protection} ftp
           on ft.nid = ftp.nid
           inner join {term_data} tp
           on tp.tid = ftp.field_bd_t_protection_value
           where ft.%s = %d
           Order by tp.name";
           
  while ($record = db_fetch_object($result)) {
    
    $protectionList = '';
    $protectionRes = db_query($sql2, $db_names_ep['fichetaxon_fieldtaxon'], $record->spid);
    while ($protectionRec = db_fetch_object($protectionRes)) {
      $protectionList .=  $protectionRec->protection .", ";
    }
    $row2add = array();
    if (isset($record->spgroup)) {
      $row2add[] = array('data' => $record->spgroup);
    }
		if ($external_ref == FALSE) {
	    $row2add[] = array('data' => "<a alt='".t('View Taxon')."' title='".t('View Taxon')."' href='".$base_url."/".$lang."fiche-taxon/".$record->spid."'>".$record->species."</a>");
	  }
	  else {
	  	$row2add[] = array('data' => "<a alt='".t('View Taxon')."' title='".t('View Taxon')."' href='".$base_url."/".$lang."fiche-worms/".$record->spid."'>".$record->species."</a>");
	  }
    $row2add[] = array('data' => $protectionList);
    $row2add[] = array('data' => $record->nb);
    $rows_ep[] = $row2add;
  }
  /*-------------------------*/
  /* Especes Absentes */
  if ($external_ref == FALSE) {
    if (isset($db_names_ea['group'])) {
      $args = array($db_names_ea['group'],
                  	$db_names_ea['taxon_prefix'],
                    $db_names_ea['node_table'],
                    $db_names_ea['node_taxon'],
                    $db_names_ea['ile_term_field'], $list_islands,
                    $db_names_ea['group']);
    } else {
      $args = array($db_names_ea['taxon_prefix'],
                  $db_names_ea['node_table'],
                   $db_names_ea['node_taxon'],
                   $db_names_ea['ile_term_field'], $list_islands);
    }
  } else {
    //External REF - pour l'instant, le groupe y est toujours
    $args = array($db_names_ea['group'],
                  $db_names_ea['node_taxon_name'],
                  $db_names_ea['taxon_prefix'],
                  $db_names_ea['node_taxon_name'],
                  $db_names_ea['node_taxon'],
                  $db_names_ea['node_table'],
                  $db_names_ea['ile_term_field'], $list_islands,
                  $db_names_ea['node_taxon_name'],
                  $db_names_ea['node_taxon'],
                  $db_names_ea['group']);
  }

  $result = db_query($sql, $args);
  $total_ea = db_result(db_query($sql_count, $args));
                       
  while ($record = db_fetch_object($result)) {
    
    $protectionList = '';
    $protectionRes = db_query($sql2, $db_names_ea['fichetaxon_fieldtaxon'], $record->spid);
    while ($protectionRec = db_fetch_object($protectionRes)) {
      $protectionList .=  $protectionRec->protection .", ";
    }
    $row2add = array();
    if (isset($record->spgroup)) {
      $row2add = array(array('data' => $record->spgroup));
    }

    if ($external_ref == FALSE) {
	    $row2add[] = array('data' => "<a alt='".t('View Taxon')."' title='".t('View Taxon')."' href='".$base_url."/".$lang."fiche-taxon/".$record->spid."'>".$record->species."</a>");
	  }
	  else {
	      $row2add[] = array('data' => "<a alt='".t('View Taxon')."' title='".t('View Taxon')."' href='".$base_url."/".$lang."fiche-worms/".$record->spid."'>".$record->species."</a>");
	  }
    $row2add[] = array('data' => $protectionList);
    $row2add[] = array('data' => $record->nb);
    $rows_ea[] = $row2add;
  }
  /*------------------------------------*/
  $out = pim_fi_set_pageheader($tid);
  
  $out .= pim_fi_set_tableheader($title." - ".t("Observed Species\t")."<br/>".t("Total: ").$total);
  $out .= "<div class='table-report'>";
  
  if ((!isset($rows_ep)) or (empty($rows_ep))) {
    $out .= pim_fi_set_emptycontent();
  } else {
    //$out .= drupal_get_form('fi_filter_form', $form);
    $out .= theme_table($head, $rows_ep);
    $out .= theme('pager', NULL, $items_per_page, 0);
  }
  $out .= "</div>";
  
  $out .= pim_fi_set_tableheader($title." - ".t("Unfound Species\t")."<br/>".t("Total: ").$total_ea);
  $out .= "<div class='table-report'>";
  
  if ((!isset($rows_ea)) or (empty($rows_ea))) {
    $out .= pim_fi_set_emptycontent();
  } else {
    //$out .= drupal_get_form('fi_filter_form', $form);
    $out .= theme_table($head, $rows_ea);
  }
  $out .= "</div>";
  
  if ((!empty($rows_ep)) or (!empty($rows_ea))) {
    $out .= pim_fi_get_legend_bdnGroup($array_node_type[0]);
  }
  $out .= pim_fi_set_pagefooter($tid);
  return $out;
}

function fi_filter_form() {

  $formname="fi_filter_form";
  $sortby_array = array (
    t('L.nid desc')  => t('newest'),
    t('L.city_name ')  => t('suburb'),
    t('L.price desc')  => t('price'),
  );
   $form['sortby'] = array(
        '#type' => 'textfield',
        'limit' => TRUE,
    'vid' => '29',
    'depth' => '10',
    'id' => 'term_node_tid_depth',
    'table' => 'node',
    'field' => 'term_node_tid_depth',
    'hierarchy' => 0,
        '#name' => $formname,
        '#id' => $formname,
        '#title' => '',
        '#default_value' => '',
        '#options' => $sortby_array,
        '#description' => '',
        '#multiple' => $multiple = FALSE,
        '#required' => $required = FALSE,
    // upon changing the dropdown box, reorder the SQL results with the new ORDER BY
    '#attributes' => array('onChange' => sort_results()),
      );

      return $form;
}

function sort_results(){

//set sort by variable as the value chosen in the dropdown box
$sortby = $form['sortby']['#value'];

  $output = "";
  $SQL = "SELECT L.nid
      FROM {rlisting_listing} L
      WHERE (L.building_type_id = 1 OR L.building_type_id = 3 OR L.building_type_id = 4)
          AND L.listing_type_id = 2
          AND (L.listing_status = ".AVAILABLE_LISTING." OR L.listing_status = 

".AVAILABLE_SOON.")
          ORDER BY $sortby
  ";
  $result = pager_query($SQL,40,0);
  if (db_num_rows($result) > 0){
    while ($record = db_fetch_object($result)){
      $nodes .= node_view(node_load($record->nid),true);
    };
  }else{
    $output  = "There were no results found";
  };
  $output = drupal_get_form('sortby_dropdown_form', $form);
  $output .= $nodes;
  $output .= theme('pager',NULL,40,0);

  return $output;
}


