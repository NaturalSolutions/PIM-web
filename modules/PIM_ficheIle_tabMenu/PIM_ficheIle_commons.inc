<?php

global $bdni_all_types; 

//$GLOBALS["bdni_all_types"]=$bdni_all_types;

function pim_fi_set_bdni_types() {
  global $bdni_all_types;
  
  $bdni_all_types = array (
  'Marine Species' => array (
      'extRef' => TRUE,
      'nodeTypes' => array (
        'bd_ni_faune_flore_marine_present',
        'bd_ni_faune_flore_marine_absent'),
  ),
  'Botany' => array (
      'extRef' => FALSE,
      'nodeTypes' => array (
        'bd_ni_botanique_present',
        'bd_ni_botanique_absent'),
  ),
  'Arthropoda' => array (
      'extRef' => FALSE,
      'nodeTypes' => array (
        'bd_ni_entomo_present',
        'bd_ni_entomo_absent'),
  ),
  'Herpetology' => array (
      'extRef' => FALSE,
      'nodeTypes' => array (
        'bd_ni_herpetologie_present',
        'bd_ni_herpetologie_absent'),
  ),
  'Ornithology' => array (
      'extRef' => FALSE,
      'nodeTypes' => array (
        'bd_ni_ornithologie_present',
        'bd_ni_ornithologie_absent'),
  ),
  'Terrestrial Mammals' => array (
      'extRef' => FALSE,
      'nodeTypes' => array (
        'bd_ni_mam_terrestres_present',
        'bd_ni_mam_terrestres_absent'),
  ),
  'Chiroptera' => array (
      'extRef' => FALSE,
      'nodeTypes' => array (
        'bd_ni_chiroptere_present',
        'bd_ni_chiroptere_absent'),
  ),
  
  /*
  'bd_ni_autre_terrestre_present',
  'bd_ni_autre_terrestre_absent',
  */
 );
}

/*--------------------------------------------------------
**  Basic helpers
**--------------------------------------------------------*/
function pim_fi_node2bd($node_type, $return_bdfields = FALSE) {
  global $pim_fi_nodetype2url;
  pim_fi_set_nodetype2url();
  
  if (empty($node_type)) {
    return NULL;
  }
  $bd_prefix = $pim_fi_nodetype2url[$node_type]['bd_prefix'];
  if (empty($bd_prefix)) {
    return NULL;
  }
  $result = array();
  
  /*
   * ATTENTION : le code appelant est susceptible de trier le tableau avec 
   * ksort() en utilisant le champs "order". Par conséquent, si deux champs ont la 
   * même valeur de "order", seul le dernier est conservé.
   * Note GB 03/12/2014
   */

  /* Common fields */
  $result['node_table'] = array('field'=> 'content_type_' . $node_type, 'storage'=>'');
  
  $result['ile_term_field'] = array('field'=>"field_" . $bd_prefix . "_code_ile_ilot", 'storage'=>'value', 'display'=>'view', 'order'=>6);
  if ($node_type == 'bd_i_description_physique') {
    $result['ile_term_field'] = array('field'=>"field_" . $bd_prefix . "_nom_ile_code_ile", 'storage'=>'value', 'display'=>'view', 'order'=>6);
  }
  
  $result['referentiel'] = array('field'=>"field_" .$bd_prefix."_referentiel", 'storage'=>'value', 'display'=>'view', 'order'=>2);
  $result['node_taxon'] = array('field'=>"field_" .$bd_prefix."_taxon", 'storage'=>'value', 'display'=>'view', 'order'=>1);
  $result['taxon_initial_name'] = array('field'=>"field_" .$bd_prefix."_taxon_initialnam", 'storage'=>'value', 'display'=>'view', 'order'=>5);
  
  $result['node_date'] = array('field'=>"field_" .$bd_prefix."_date", 'storage'=>'value', 'display'=>'view', 'order'=>8);
  $result['type_source'] = array('field'=>"field_" .$bd_prefix."_type_de_source", 'storage'=>'value', 'display'=>'view', 'order'=>75);
  $result['source_nid'] = array('field'=>"field_" .$bd_prefix."_source", 'storage'=>'nid', 'display'=>'view', 'order'=>80);
  $result['redacteur'] = array('field'=>"field_" .$bd_prefix."_redacteur", 'storage'=>'value', 'display'=>'view', 'order'=>70);
  $result['protocole'] = array('field'=>"field_" .$bd_prefix."_protocole", 'storage'=>'value', 'display'=>'view', 'order'=>50);
  $result['introduit'] = array('field'=>"field_" .$bd_prefix."_introduit", 'storage'=>'value', 'display'=>'view', 'order'=>40);
  $result['introduit2'] = array('field'=>"field_" .$bd_prefix."_introduit2", 'storage'=>'value', 'display'=>'view', 'order'=>41);
  $result['fiable'] = array('field'=>"field_" .$bd_prefix."_fiable", 'storage'=>'value', 'display'=>'view', 'order'=>35);
  $result['taxon_prefix'] = array('field'=>"field_" .$bd_prefix."_taxon_prefix", 'storage'=>'value', 'display'=>'view', 'order'=>100);
  
  $result['remarque'] = array('field'=>"field_" .$bd_prefix."_remarque", 'storage'=>'value', 'display'=>'view', 'order'=>115);
  $result['public_data'] = array('field'=>"field_" .$bd_prefix."_donnees_publique", 'storage'=>'value', 'display'=>'view', 'order'=>135);
  
  $result['observateurs_table'] = array('field'=>"content_field_" .$bd_prefix."_observateurs", 'storage'=>'', 'display'=>'view', 'order'=>65);;
  $result['observateurs_field'] = array('field'=>"field_" .$bd_prefix."_observateurs", 'storage'=>'value', 'display'=>'view', 'order'=>65);
  
  /* communs Present / communs Absent */
  switch($node_type) {
    case 'bd_ni_botanique_present':
    case 'bd_ni_chiroptere_present':
    case 'bd_ni_entomo_present':
    case 'bd_ni_herpetologie_present':
    case 'bd_ni_mam_terrestres_present':
    case 'bd_ni_faune_flore_marine_present':
    case 'bd_ni_ornithologie_present':
    case 'bd_ni_autre_terrestre_present':
      $result['latlon'] = array('field'=>"field_" .$bd_prefix."_lat_lon", 'storage'=>'geo', 'display'=>'view', 'order'=>60);
      $result['classe_effectifs'] = array('field'=>"field_" .$bd_prefix."_classe_effectifs", 'storage'=>'value', 'display'=>'view', 'order'=>10);
      $result['localisation'] = array('field'=>"field_" .$bd_prefix."_localisation", 'storage'=>'value', 'display'=>'view', 'order'=>55);
      $result['observation'] = array('field'=>"field_" .$bd_prefix."_observation", 'storage'=>'value', 'display'=>'view', 'order'=>30);
      $result['indice'] = array('field'=>"field_" .$bd_prefix."_indice", 'storage'=>'value', 'display'=>'view', 'order'=>31); 
      $result['nb_indiv'] = array('field'=>'field_' . $bd_prefix . '_nb_individus', 'storage'=>'value', 'display'=>'view', 'order'=>11);
      if ($node_type == 'bd_ni_ornithologie_present') {
        $result['nb_indiv_min'] = array('field'=>'field_' . $bd_prefix . '_nb_individus_min', 'storage'=>'value', 'display'=>'view', 'order'=>12);
        $result['nb_indiv_max'] = array('field'=>'field_' . $bd_prefix . '_nb_individus_max', 'storage'=>'value', 'display'=>'view', 'order'=>13);
      }
    break;
    
    case 'bd_ni_botanique_absent':
    case 'bd_ni_chiroptere_absent':
    case 'bd_ni_entomo_absent':
    case 'bd_ni_herpetologie_absent':
    case 'bd_ni_mam_terrestres_absent':
    case 'bd_ni_faune_flore_marine_absent':
    case 'bd_ni_ornithologie_absent':
    case 'bd_ni_autre_terrestre_absent':
      $result['expert'] = array('field'=>"field_" .$bd_prefix."_expert", 'storage'=>'value', 'display'=>'view', 'order'=>81);
      $result['potentiel'] = array('field'=>"field_" .$bd_prefix."_potentiel", 'storage'=>'value', 'display'=>'view', 'order'=>10);
      $result['potentiel2'] = array('field'=>"field_" .$bd_prefix."_potentiel_2", 'storage'=>'value', 'display'=>'view', 'order'=>11);
    break;
  }
  /* Taxon */
  switch($node_type) {
    case 'bd_ni_chiroptere_present':
    case 'bd_ni_chiroptere_absent':
      $result['fichetaxon_fieldtaxon'] = array('field'=>"field_bd_t_taxon_chiroptere", 'storage'=>'value', 'display'=>'view');
    break;
    case 'bd_ni_herpetologie_present':
    case 'bd_ni_herpetologie_absent':
      $result['fichetaxon_fieldtaxon'] = array('field'=>"field_bd_t_taxon_herpeto", 'storage'=>'value', 'display'=>'view');
    break;
    case 'bd_ni_botanique_absent':
    case 'bd_ni_botanique_present':
      $result['fichetaxon_fieldtaxon'] = array('field'=>"field_bd_t_taxon_bota", 'storage'=>'value', 'display'=>'view');
    break;
    case 'bd_ni_entomo_absent':
    case 'bd_ni_entomo_present':
      $result['fichetaxon_fieldtaxon'] = array('field'=>"field_bd_t_taxon_entomo", 'storage'=>'value', 'display'=>'view');
    break;
    
    case 'bd_ni_faune_flore_marine_present':
    case 'bd_ni_faune_flore_marine_absent':
      $result['fichetaxon_fieldtaxon'] = array('field'=>"field_bd_t_taxon_worms_worms_lsid", 'storage'=>'', 'func'=>'worms', 'display'=>'view');
      $result['node_taxon_name'] = array('field'=>"field_" .$bd_prefix."_taxon_worms_name", 'storage'=>'', 'func'=>'worms', 'display'=>'view');
      $result['node_taxon'] = array('field'=>"field_" .$bd_prefix."_taxon_worms_lsid", 'storage'=>'', 'func'=>'worms', 'display'=>'view');
      $result['node_taxon_field'] = array('field'=>"field_" .$bd_prefix."_taxon", 'storage'=>'worms', 'func'=>'worms', 'display'=>'view', 'order'=>1);
    break;
    
    case 'bd_ni_mam_terrestres_absent':
    case 'bd_ni_mam_terrestres_present':
      $result['fichetaxon_fieldtaxon'] = array('field'=>"field_bd_t_taxon_mam_terrestre", 'storage'=>'value', 'display'=>'view');
    break;
    case 'bd_ni_ornithologie_absent':
    case 'bd_ni_ornithologie_present':
      $result['fichetaxon_fieldtaxon'] = array('field'=>"field_bd_t_taxon_ornitho", 'storage'=>'value', 'display'=>'view');
    break;
    
    case 'bd_ni_autre_terrestre_absent':
    case 'bd_ni_autre_terrestre_present':
      $result['fichetaxon_fieldtaxon'] = array('field'=>"field_bd_t_taxon_autre_terrestre", 'storage'=>'value', 'display'=>'view');
    break;
  }
  
  /* Specific fields */
  switch($node_type) {
    case 'bd_ni_botanique_present':
      $result['group'] = array('field'=>'field_' . $bd_prefix . '_group', 'storage'=>'value', 'display'=>'view', 'order'=>0);
      $result['b_p_distribution'] = array('field'=>'field_' . $bd_prefix . '_distribution', 'storage'=>'value', 'display'=>'view', 'order'=>12);
      $result['b_p_stade'] = array('field'=>'field_' . $bd_prefix . '_stade', 'storage'=>'value', 'display'=>'view', 'order'=>13);
      //$result['b_p_envahissante'] = array('field'=>'field_' . $bd_prefix . '_envahissante', 'storage'=>'value', 'display'=>'view', 'order'=>14);
      $result['b_p_remarque'] = array('field'=>'field_' . $bd_prefix . '_remarque', 'storage'=>'value', 'display'=>'view', 'order'=>15);
    break;
    case 'bd_ni_chiroptere_present':
      $result['c_p_indice_activite'] = array('field'=>'field_' . $bd_prefix . '_indice_activite', 'storage'=>'value', 'display'=>'view', 'order'=>12);
      $result['c_p_presence'] = array('field'=>'field_' . $bd_prefix . '_presence', 'storage'=>'value', 'display'=>'view', 'order'=>13);
      $result['c_p_reproducteur'] = array('field'=>'field_' . $bd_prefix . '_reproducteur', 'storage'=>'value', 'display'=>'view', 'order'=>14);
    break;
    case 'bd_ni_entomo_present':
      $result['group'] = array('field'=>'field_' . $bd_prefix . '_group', 'storage'=>'value', 'display'=>'view', 'order'=>0);
      $result['e_p_stade'] = array('field'=>'field_' . $bd_prefix . '_stade', 'storage'=>'value', 'display'=>'view', 'order'=>14);
    break;
    case 'bd_ni_herpetologie_present':
      $result['h_p_stade'] = array('field'=>'field_' . $bd_prefix . '_stade', 'storage'=>'value', 'display'=>'view', 'order'=>12);
    break;
    case 'bd_ni_mam_terrestres_present':
      $result['mt_p_type_de_piege'] = array('field'=>'field_' . $bd_prefix . '_type_de_piege', 'storage'=>'value', 'display'=>'view', 'order'=>12);
    break;
    case 'bd_ni_faune_flore_marine_present':
      $result['group'] = array('field'=>'field_' . $bd_prefix . '_group', 'storage'=>'value', 'display'=>'view', 'order'=>-10);
      $result['ffm_p_distribution'] = array('field'=>'field_' . $bd_prefix . '_distribution', 'storage'=>'value', 'display'=>'view', 'order'=>12);
      $result['ffm_p_famille'] = array('field'=>"field_" .$bd_prefix."_famille", 'storage'=>'value','display'=>'view', 'order'=>-5);
    break;
    case 'bd_ni_ornithologie_present':
      $result['o_p_couple_min'] = array('field'=>'field_' . $bd_prefix . '_nb_couples_min', 'storage'=>'value', 'display'=>'view', 'order'=>13);
      $result['o_p_couple_max'] = array('field'=>'field_' . $bd_prefix . '_nb_couples_max', 'storage'=>'value', 'display'=>'view', 'order'=>14);
      $result['o_p_presence'] = array('field'=>'field_' . $bd_prefix . '_presence', 'storage'=>'value', 'display'=>'view', 'order'=>17);
      $result['o_p_reproducteur'] = array('field'=>'field_' . $bd_prefix . '_reproducteur', 'storage'=>'value', 'display'=>'view', 'order'=>18);
    break;
    case 'bd_ni_autre_terrestre_present':
      $result['at_p_stade'] = array('field'=>'field_' . $bd_prefix . '_stade', 'storage'=>'value', 'display'=>'view', 'order'=>13);
    break;
    
    case 'bd_ni_botanique_absent':
      $result['group'] = array('field'=>'field_' . $bd_prefix . '_group', 'storage'=>'value', 'display'=>'view', 'order'=>0);
      $result['b_a_remarque'] = array('field'=>'field_' . $bd_prefix . '_remarque', 'storage'=>'value', 'display'=>'view', 'order'=>12);
    break;
    case 'bd_ni_chiroptere_absent':
    break;
    case 'bd_ni_entomo_absent':
      $result['group'] = array('field'=>'field_' . $bd_prefix . '_group', 'storage'=>'value', 'display'=>'view', 'order'=>0);
    break;
    case 'bd_ni_herpetologie_absent':
    case 'bd_ni_mam_terrestres_absent':
    break;
    case 'bd_ni_faune_flore_marine_absent':
      $result['group'] = array('field'=>'field_' . $bd_prefix . '_group', 'storage'=>'value', 'display'=>'view', 'order'=>-10);
      $result['ffm_a_famille'] = array('field'=>"field_" .$bd_prefix."_famille", 'storage'=>'value','display'=>'view', 'order'=>-5);
    break;
    case 'bd_ni_ornithologie_absent':
    break;
  }
  if ($return_bdfields == TRUE) {
    array_walk($result, 'pim_fi_make_bd_field');
  }
  return $result;
}

function pim_fi_make_bd_field(&$item, $key) {
  if (isset($item['storage']) and ! (empty($item['storage']))) {
    $item = $item['field']."_".$item['storage'];
  } else {
    $item = $item['field'];
  }
}



function pim_fi_get_tid($nid, $node_type) {
  $db_names = pim_fi_node2bd($node_type, TRUE);
  if (empty($db_names) || empty($nid)) {
    return NULL;
  }
  $result = db_query("select %s from {%s} where nid = %d",
                     $db_names['ile_term_field'],
                     $db_names['node_table'], 
                     $nid);
    while ($tid = db_fetch_array($result)) {
      /* il n'y a qu'un seul resultat */
      $array_tid[] = $tid[$db_names['ile_term_field']];
      break;
  }
  if (empty($array_tid[0])) {
    return NULL;
  }
  return $array_tid[0];
}

function pim_fi_get_single_nid($tid, $node_type) {

  $db_names = pim_fi_node2bd($node_type, TRUE);
  if (empty($db_names) or empty($tid)) {
    return NULL;
  }
  if (! is_numeric($tid) ) {
    $array_tid = taxonomy_get_term_by_name($tid);
    $tid = $array_tid[0]->tid;
    //print "<pre>"; print "new tid: "; print $tid; var_dump($array_tid); print "</pre>";
  }
  
  $result = db_query("select nid from {%s} where %s = %d",
                     $db_names['node_table'], 
                     $db_names['ile_term_field'],
                     $tid);
  
  while ($nid = db_fetch_array($result)) {
      /* Pour BD_I types, il n'y a qu'un seul resultat */
      $array_nid[] = $nid['nid'];
      $break;
  }
  if (empty($array_nid[0])) {
    return NULL;
  }
  return $array_nid[0];
}

function pim_fi_hack_nodeview_url($nid, $node_type, $tid=NULL) {
  global $pim_fi_nodetype2url;
  pim_fi_set_nodetype2url();
  
  if ((!isset($node_type)) or (empty($node_type))) {
    return NULL;
  }
  $url = $pim_fi_nodetype2url[$node_type]['url'];
  if (!isset($url)) return NULL;
  
  if ((!isset($tid)) and isset($nid)) {
    $tid = pim_fi_get_tid($nid, $node_type);
  }
  if (!isset($tid)) return NULL;
  if ((strpos($node_type, 'bd_i') !== FALSE) and (strpos($node_type, 'bd_i') == 0)) {
    $url = 'fiche-Ile/' . $tid . '/' . $url;
  } else if ((strpos($node_type, 'bd_ni') !== FALSE) and (strpos($node_type, 'bd_ni') == 0)) {
    //$url = 'fiche-Ile/' . $tid . '/' . $url . '/' . $nid . '/view';
    $url = 'fiche-Ile/' . $tid . '/' . $url ;
  }
  return $url;
}


function pim_fi_get_baseurl($menu_group) {
  global $pim_fi_nodetype2url;
  pim_fi_set_nodetype2url();
  
  /* r\E9cup\E8re un des node_types correspondand au menu group */
  switch($menu_group) {
    case 'bdi':
      $node_type = 'bd_i_description_physique';
      break;
    case 'bdn':
      $node_type = NULL;
      break;
    case 'bota_i':
      $node_type = 'bd_ni_botanique_present';
      break;
    case 'chiro_i':
      $node_type = 'bd_ni_chiroptere_present';
      break;
    case 'entomo_i':
      $node_type = 'bd_ni_entomo_present';
      break;
    case 'marineff_i':
      $node_type = 'bd_ni_faune_flore_marine_present';
      break;
    case 'herpeto_i':
      $node_type = 'bd_ni_herpetologie_present';
      break;
    case 'mamt_i':
      $node_type = 'bd_ni_mam_terrestres_present';
      break;
    case 'ornitho_i':
      $node_type = 'bd_ni_ornithologie_present';
      break;
    
  }
  return $pim_fi_nodetype2url[$node_type]['base_url'];
}


/*--------------------------------------------------------
**  Archipel
**--------------------------------------------------------*/
function pim_fi_get_archipel_islands($tid) {
  if (! is_numeric($tid) ) {
    $array_tid = taxonomy_get_term_by_name($tid);
    $tid = $array_tid[0]->tid;
  }
  $is_archipel = 0;
  $synonyms = taxonomy_get_synonyms($tid);
  $ilecode = taxonomy_get_term($tid);
  
  $result = db_query("SELECT is_archipel FROM {term_fields_term} WHERE tid =%d",
                     $tid);
  while ($archipel = db_fetch_array($result)) {
      /* il n'y a qu'un seul resultat */
    $array_archipel[] = $archipel['is_archipel'];
    break;
  }
  $is_archipel = $array_archipel[0];
  if (empty($is_archipel)) {
    $is_archipel = (strpos($ilecode->name, '000') == strlen($ilecode->name) - 3) ? 1 : 0;
  }
  if (!($is_archipel)) { return null; }
  
  
  $result = db_query("select field_bdi_dp_nom_ile_code_ile_value " .
                     "from {content_type_bd_i_description_physique} " .
                     "where field_bdi_dp_archipel_value like '%%%s%%' " .
                     "and field_bdi_dp_nom_ile_code_ile_value <> %d",
                     $synonyms[0],
                     $tid);
  while ($island = db_fetch_array($result)) {
    $array_islands_id[] = $island['field_bdi_dp_nom_ile_code_ile_value'];
  }
  if (empty($array_islands_id)) {
    $archipel_strcode = substr($ilecode->name, 0, 4);
    $result = db_query("select tid from {term_data} " .
                       "where vid = 4 and name like '%s%%' " .
                       "and tid <> %d",
                       $archipel_strcode, $tid);
    while ($island = db_fetch_array($result)) {
      $array_islands_id[] = $island['tid'];
    }
  }
  return $array_islands_id;
}
/*--------------------------------------------------------
**  Ile photo
**--------------------------------------------------------*/
function pim_fi_get_picture($tid, $lightbox=FALSE, $returnDefault=TRUE) {
  global $base_url;
  
  $image_html = '';
  if (! is_numeric($tid) ) {
    $array_tid = taxonomy_get_term_by_name($tid);
    $tid = $array_tid[0]->tid;
  }
  $sql = "Select f.filepath as path, f.filename as filename 
          FROM {content_type_bd_i_description_physique} 
          INNER JOIN drp_files f 
          ON field_bdi_dp_photo_fid = f.fid
          where field_bdi_dp_nom_ile_code_ile_value = %d";
  $result = db_query($sql, $tid);
  $record = db_fetch_array($result);
  
  if (!isset($record) or (empty($record))) {
    if ($returnDefault == FALSE) return $image_html;
    $imageorigpath = NULL;
    $imagecachepath = $base_url."/"."sites/default/files/ficheIle/PIM_gris_172x76.png";
    $alt = t("Default")." ".t("Picture");
    $title = t("Default")." ".t("Picture");
    $image_html = "<img src='".$imagecachepath."' alt='".$alt."' title='".$title."' class='fiche_img'>";
    return $image_html;
  }
  
  //image is set
  $alt = t("Island")." ".t("Picture");
  $title = t("Island")." ".t("Picture");
  $attributes = array(
      'class' => 'fiche_img',
      'rel' => 'lightbox',
  );

  // generate the image hml
  $image_html = theme('imagecache', 'ficheile_image_172x76', $record['path'], $alt, $title, $attributes);
  $imageorigpath = $base_url."/".$record['path'];
  
  if ($lightbox == FALSE)
    return $image_html;
  
  
  if ($image_html) {         
    // define lightbox link
    $image_link = l(
      $image_html,
      $imageorigpath,
      array(
        'html' => true,
        'attributes' => array(
          'rel' => 'lightbox',
        )
      )
    );
  }
  
  return $image_link;
}
/*--------------------------------------------------------
**  Pages header footer empty content
**--------------------------------------------------------*/

function pim_fi_set_pageheader($tid, $withHeader=TRUE) {
  global $user;
  global $base_url;
  
  if ($withHeader) $htmlout = ' <div id="ficheile">'; //attention \E0 fermer avec pim_fi_set_pagefooter
  $htmlout .= '<div class="ficheile-titre"><span class="texte-orange">';
        
  $synonyms = taxonomy_get_synonyms($tid);
  $ilecode = taxonomy_get_term($tid);
  if ((in_array("Admin PIM", $user->roles)) or 
      (in_array("Mega Admin", $user->roles))) {
      
      $htmlout .= '<a href="'.$base_url.'/admin/content/taxonomy_manager/voc/4/'.$tid.'">';
      $htmlout .= $synonyms[0].' - '.$ilecode->name;
      $htmlout .= '</a>';
  } 
  else {
    $htmlout .= $synonyms[0];
  }
  
  $htmlout .= '</span></div>';
  return $htmlout;
}

function pim_fi_set_pagefooter($tid) {
  $htmlout = '</div>';
  return $htmlout;
}

function pim_fi_set_tableheader($title) {
  return "<div class='table-titre'>".$title."</div>";
}

//@TODO use css for styles
function pim_fi_set_emptycontent() {
  $htmlout = "<div style='padding-top: 20px; padding-left: 26px;'>". t('No data for this island') ."</div>";
  return $htmlout;
}

function pim_fi_set_empty_bdi_nodelevel($node_type) {
  $htmlout = '';
  if (user_access('create '. $node_type .' content', $account)) {
    $htmlout = "<div style='padding-left: 26px;'>"."<br/>".t("Click on 'Modify' to add content.")."</div>";
  }
  return $htmlout;
}

function pim_fi_set_empty_bdi_listlevel($node_type) {
  $htmlout = '';
  return $htmlout;
}

/*--------------------------------------------------------
**  Pages Legends
**--------------------------------------------------------*/
function pim_fi_get_legend_bdnGroup($group) {

  $htmlout = "<div class='ficheile-legend'>";
  switch($group) {
    case 'bd_ni_faune_flore_marine_present':
    case 'bd_ni_faune_flore_marine_absent':
      $htmlout .= t('Groups :')."<br/>";
      $htmlout .= "ALG	= ".t('Algaea')."<br/>";
      $htmlout .= "ANN	= ".t('Annelids')."<br/>";
      $htmlout .= "ASC	= ".t('Ascidians')."<br/>";
      $htmlout .= "BRY	= ".t('Bryozoans')."<br/>";
      $htmlout .= "CNI	= ".t('Cnidarians')."<br/>";
      $htmlout .= "CRU	= ".t('Crustacea')."<br/>";
      $htmlout .= "CTE	= ".t('Ctenophora')."<br/>";
      $htmlout .= "ECH	= ".t('Echinoderms')."<br/>";
      $htmlout .= "MAM	= ".t('Mammals')."<br/>";
      $htmlout .= "MOL	= ".t('Molluscs')."<br/>";
      $htmlout .= "PAQ	= ".t('Aquatic plants')."<br/>";
      $htmlout .= "PLA	= ".t('Platyhelminthes')."<br/>";
      $htmlout .= "POI	= ".t('Fishs')."<br/>";
      $htmlout .= "POR	= ".t('Porifera')."<br/>";
      $htmlout .= "REP	= ".t('Reptiles')."<br/>";
      $htmlout .= "AUT	= ".t('Others')."<br/>";
    break;
    
    case 'bd_ni_entomo_present':
    case 'bd_ni_entomo_absent':
      $htmlout .= t('Groups :')."<br/>";
      $htmlout .= "ORT = ".t('Orthoptera')."<br/>";
      $htmlout .= "RHO = ".t('Rhopalocera')."<br/>";
      $htmlout .= "ODO = ".t('Odonata')."<br/>";
      $htmlout .= "COL = ".t('Coleoptera')."<br/>";
      $htmlout .= "AUT = ".t('Other')."<br/>";
    break;
    case 'bd_ni_botanique_present':
    case 'bd_ni_botanique_absent':
      $htmlout .= t('Groups :')."<br/>";
      $htmlout .= "ANG	= ".t('Angiospermae')."<br/>";
      $htmlout .= "BRY	= ".t('Bryophytes')."<br/>";
      $htmlout .= "FUN	= ".t('Fungi (except lichens)')."<br/>";
      $htmlout .= "GYM	= ".t('Gymnospermae')."<br/>";
      $htmlout .= "LIC	= ".t('Lichens')."<br/>";
      $htmlout .= "PTE	= ".t('Pteridophytes')."<br/>";
    break;
  }
  $htmlout .= "</div>";
  return $htmlout;
}




