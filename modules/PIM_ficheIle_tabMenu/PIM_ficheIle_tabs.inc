<?php
/*--------------------------------------------------------
**  Tabs Definition
**--------------------------------------------------------*/
function pim_fi_set_nodetype2url() {
	global $pim_fi_nodetype2url;
	if (!empty($pim_fi_nodetype2url)) {
		return;
	}

	$pim_fi_nodetype2url = array (
		/* BD ile */
		'bd_i_description_physique' => array (
			'base_url' => 'bdi',
			'url' => 'bdi',
			'title' => t('Geography'),
			'weight' => -35,
			'callback' => 'pim_fi_node_bd_i_callback',
			'page arguments' => array(1, 'view', 'bd_i_description_physique'),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdi_dp',
		),
		
		'bd_i_caracteristiques_environnem' => array (
			'base_url' => 'bdi',
			'url' => 'bdi_ce',
			'title' => t('Environment characteristics'),
			'weight' => -34,
			'callback' => 'pim_fi_node_bd_i_callback',
			'page arguments' => array(1, 'view', 'bd_i_caracteristiques_environnem'),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdi_ce',
		),
		
		'bd_i_occupation' => array (
			'base_url' => 'bdi',
			'url' => 'bdi_o',
			'title' => t('Occupation'),
			'weight' => -33,
			'callback' => 'pim_fi_node_bd_i_callback',
			'page arguments' => array(1, 'view', 'bd_i_occupation'),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdi_o',
		),
    
        'bd_i_multipop' => array (
            'base_url' => 'bdi',
            'url' => 'bdi_pop',
            'title' => t('Population'),
            'weight' => -32,
            'callback' => 'pim_fi_node_bd_i_multipop_callback',
            'page arguments' => array(1, 'list', 'bd_i_multipop'),
            'access arguments' => array('access content'),
            'bd_prefix' => 'bdi_pop',
        ),
		
		'bd_i_statut_de_propriete' => array (
			'base_url' => 'bdi',
			'url' => 'bdi_sp',
			'title' => t('Property status'),
			'weight' => -31,
			'callback' => 'pim_fi_node_bd_i_callback',
			'page arguments' => array(1, 'view', 'bd_i_statut_de_propriete'),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdi_sp',
		),
		
		'bd_i_statut_de_protection' => array (
			'base_url' => 'bdi',
			'url' => 'bdi_spt',
			'title' => t('Protection status'),
			'weight' => -30,
			'callback' => 'pim_fi_view_bd_i_protection_callback',
			'page arguments' => array(1, 'list', 'bd_i_problemes_et_menaces'),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdi_spt',
		),
		'bd_i_reglementation_activite' => array (
			'base_url' => 'bdi',
			'url' => 'bdi_ra',
			'title' => t('Activities regulation'),
			'weight' => -29,
			'callback' => 'pim_fi_node_bd_i_callback',
			'page arguments' => array(1, 'view', 'bd_i_reglementation_activite'),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdi_ra',
		),
		'bd_i_problemes_et_menaces' => array (
			'base_url' => 'bdi',
			'url' => 'bdi_pm',
			'title' => t('Problems and threats'),
			'weight' => -28,
			'callback' => 'pim_fi_node_bd_i_callback',
			'page arguments' => array(1, 'view', 'bd_i_problemes_et_menaces'),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdi_pm',
		),
		
		'bd_i_gestionnaire' => array (
			'base_url' => 'bdi',
			'url' => 'bdi_g',
			'title' => t('Management operations'),
			'weight' => -27,
			'callback' => 'pim_fi_node_bd_i_callback',
			'page arguments' => array(1, 'view', 'bd_i_gestionnaire'),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdi_g',
		),
		
		/* BDI custom Views */
		'Vue_Documents' => array (
			'base_url' => 'bdi',
			'url' => 'ile-docview',
			'title' => t('Bibliography'),
			'weight' => -9,
			'callback' => 'pim_fi_view_bd_i_documents_callback',
			'page arguments' => array(1),
			'access arguments' => array('access content'),
			'bd_prefix' => '',
		),
		'bd_i_photos_illustrations' => array (
			'base_url' => 'bdi',
			'url' => 'ile-photoview',
			'title' => t('Island Pictures'),
			'weight' => -8,
			'callback' => 'pim_fi_view_bd_i_photos_callback',
			'page arguments' => array(1, 'list', 'bd_i_photos_illustrations'),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bd_i_pi',
		),
		
		/* BDN high level custom views */
		'Vue_Inventaires' => array (
			'base_url' => 'bdn',
			'url' => 'bdn-inventoryview',
			'title' => t('Overview'),
			'weight' => -7,
			'callback' => 'pim_fi_charts_inventories_reports',
			'page arguments' => array(1),
			'access arguments' => array('access content'),
			'bd_prefix' => '',
		),
		/* 1 Faune Flore Marines */
		'faune_flore_marine_especes_report' => array (
			'base_url' => 'bdn_ffm_i',
			'url' => 'bdn_ffm_ispecies',
			'title' => t('Species list'),
			'title2' => t('Marine Species'),
			'weight' => -30,
			'callback' => 'pim_fi_bdn_ispecies',
			'page arguments' => array(1,t('Marine Species'), array('bd_ni_faune_flore_marine_present', 'bd_ni_faune_flore_marine_absent')),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_fm_p',
			
		),
    /*
		'faune_flore_marine_inventaires_report' => array (
			'base_url' => 'bdn_ffm_i',
			'url' => 'bdn_ffm_ireport',
			'title' => t('Reports'),
			'title2' => t('Marine Species'),
			'weight' => -25,
			'callback' => 'pim_fi_charts_bdn_ireports',
			'page arguments' => array(1,t('Marine Species'), array('bd_ni_faune_flore_marine_present', 'bd_ni_faune_flore_marine_absent')),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_fm_p',
			
		),
    */
		'bd_ni_faune_flore_marine_present' => array (
			'base_url' => 'bdn_ffm_i',
			'url' => 'bdn_ffm_ip',
			'title' => t('Observed Species'),
			'title2' => t('Marine Species'),
			'weight' => -20,
			'callback' => 'pim_fi_view_bd_n_callback',
			'page arguments' => array(1, 'view', 'bd_ni_faune_flore_marine_present'),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_fm_p',
			
		),
		'bd_ni_faune_flore_marine_absent' => array (
			'base_url' => 'bdn_ffm_i',
			'url' => 'bdn_ffm_ia',
			'title' => t('Unfound Species'),
			'title2' => t('Marine Species'),
			'weight' => -10,
			'callback' => 'pim_fi_view_bd_n_callback',
			'page arguments' => array(1, 'view', 'bd_ni_faune_flore_marine_absent'),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_fm_a',
		),
    
		/* 2 Bota */
		'botanique_especes_report' => array (
			'base_url' => 'bdn_b_i',
			'url' => 'bdn_b_ispecies',
			'title' => t('Species list'),
			'title2' => t('Botany'),
			'weight' => -30,
			'callback' => 'pim_fi_bdn_ispecies',
			'page arguments' => array(1,t('Botany'), array('bd_ni_botanique_present', 'bd_ni_botanique_absent')),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_b_p',
		),
    /*
		'botanique_inventaires_report' => array (
			'base_url' => 'bdn_b_i',
			'url' => 'bdn_b_ireport',
			'title' => t('Reports'),
			'title2' => t('Botany'),
			'weight' => -25,
			'callback' => 'pim_fi_charts_bdn_ireports',
			'page arguments' => array(1,t('Botany'), array('bd_ni_botanique_present', 'bd_ni_botanique_absent')),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_b_p',
		),
    */
		'bd_ni_botanique_present' => array (
			'base_url' => 'bdn_b_i',
			'url' => 'bdn_b_ip',
			'title' => t('Observed Species'),
			'title2' => t('Botany'),
			'weight' => -20,
			'callback' => 'pim_fi_view_bd_n_callback',
			'page arguments' => array(1, 'view', 'bd_ni_botanique_present'),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_b_p',
		),
		'bd_ni_botanique_absent' => array (
			'base_url' => 'bdn_b_i',
			'url' => 'bdn_b_ia',
			'title' => t('Unfound Species'),
			'title2' => t('Botany'),
			'weight' => -10,
			'callback' => 'pim_fi_view_bd_n_callback',
			'page arguments' => array(1, 'view', 'bd_ni_botanique_absent'),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_b_a',
		),
		
    /* 3 Arthropodes */
		'entomo_especes_report' => array (
			'base_url' => 'bdn_e_i',
			'url' => 'bdn_e_ispecies',
			'title' => t('Species list'),
			'title2' => t('Arthropoda'),
			'weight' => -30,
			'callback' => 'pim_fi_bdn_ispecies',
			'page arguments' => array(1,t('Arthropoda'), array('bd_ni_entomo_present', 'bd_ni_entomo_absent')),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_e_p',
			
		),
    /*
		'entomo_inventaires_report' => array (
			'base_url' => 'bdn_e_i',
			'url' => 'bdn_e_ireport',
			'title' => t('Reports'),
			'title2' => t('Arthropoda'),
			'weight' => -25,
			'callback' => 'pim_fi_charts_bdn_ireports',
			'page arguments' => array(1,t('Arthropoda'), array('bd_ni_entomo_present', 'bd_ni_entomo_absent')),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_e_p',
			
		),
    */
		'bd_ni_entomo_present' => array (
			'base_url' => 'bdn_e_i',
			'url' => 'bdn_e_ip',
			'title' => t('Observed Species'),
			'title2' => t('Arthropoda'),
			'weight' => -20,
			'callback' => 'pim_fi_view_bd_n_callback',
			'page arguments' => array(1, 'view', 'bd_ni_entomo_present'),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_e_p',
			
		),
		'bd_ni_entomo_absent' => array (
			'base_url' => 'bdn_e_i',
			'url' => 'bdn_e_ia',
			'title' => t('Unfound Species'),
			'title2' => t('Arthropoda'),
			'weight' => -10,
			'callback' => 'pim_fi_view_bd_n_callback',
			'page arguments' => array(1, 'view', 'bd_ni_entomo_absent'),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_e_a',
		),
    
    /* 4 Herpeto */
		'herpetologie_especes_report' => array (
			'base_url' => 'bdn_h_i',
			'url' => 'bdn_h_ispecies',
			'title' => t('Species list'),
			'title2' => t('Herpetology'),
			'weight' => -30,
			'callback' => 'pim_fi_bdn_ispecies',
			'page arguments' => array(1,t('Herpetology'), array('bd_ni_herpetologie_present', 'bd_ni_herpetologie_absent')),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_h_p',
			
		),
    /*
		'herpetologie_inventaires_report' => array (
			'base_url' => 'bdn_h_i',
			'url' => 'bdn_h_ireport',
			'title' => t('Reports'),
			'title2' => t('Herpetology'),
			'weight' => -25,
			'callback' => 'pim_fi_charts_bdn_ireports',
			'page arguments' => array(1, t('Herpetology'), array('bd_ni_herpetologie_present', 'bd_ni_herpetologie_absent')),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_h_p',
			
		),
    */
		'bd_ni_herpetologie_present' => array (
			'base_url' => 'bdn_h_i',
			'url' => 'bdn_h_ip',
			'title' => t('Observed Species'),
			'title2' => t('Herpetology'),
			'weight' => -20,
			'callback' => 'pim_fi_view_bd_n_callback',
			'page arguments' => array(1, 'view', 'bd_ni_herpetologie_present'),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_h_p',
		),
		'bd_ni_herpetologie_absent' => array (
			'base_url' => 'bdn_h_i',
			'url' => 'bdn_h_ia',
			'title' => t('Unfound Species'),
			'title2' => t('Herpetology'),
			'weight' => -10,
			'callback' => 'pim_fi_view_bd_n_callback',
			'page arguments' => array(1, 'view', 'bd_ni_herpetologie_absent'),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_h_a',
		),
    
    /* 5 Ornithologie */
		'ornithologie_especes_report' => array (
			'base_url' => 'bdn_o_i',
			'url' => 'bdn_o_ispecies',
			'title' => t('Species list'),
			'title2' => t('Ornithology'),
			'weight' => -30,
			'callback' => 'pim_fi_bdn_ispecies',
			'page arguments' => array(1,t('Ornithology'), array('bd_ni_ornithologie_present', 'bd_ni_ornithologie_absent')),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_o_p',
			
		),
    /*
		'ornithologie_inventaires_report' => array (
			'base_url' => 'bdn_o_i',
			'url' => 'bdn_o_ireport',
			'title' => t('Reports'),
			'title2' => t('Ornithology'),
			'weight' => -25,
			'callback' => 'pim_fi_charts_bdn_ireports',
			'page arguments' => array(1, t('Ornithology'), array('bd_ni_ornithologie_present', 'bd_ni_ornithologie_absent')),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_o_p',
			
		),
    */
		'bd_ni_ornithologie_present' => array (
			'base_url' => 'bdn_o_i',
			'url' => 'bdn_o_ip',
			'title' => t('Observed Species'),
			'title2' => t('Ornithology'),
			'weight' => -20,
			'callback' => 'pim_fi_view_bd_n_callback',
			'page arguments' => array(1, 'view', 'bd_ni_ornithologie_present'),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_o_p',
		),
		'bd_ni_ornithologie_absent' => array (
			'base_url' => 'bdn_o_i',
			'url' => 'bdn_o_ia',
			'title' => t('Unfound Species'),
			'title2' => t('Ornithology'),
			'weight' => -10,
			'callback' => 'pim_fi_view_bd_n_callback',
			'page arguments' => array(1, 'view', 'bd_ni_ornithologie_absent'),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_o_a',
		),
    
    /* 6 Mammifères terrestres non volants */
		'mam_terrestres_especes_report' => array (
			'base_url' => 'bdn_mt_i',
			'url' => 'bdn_mt_ispecies',
			'title' => t('Species list'),
			'title2' => t('Terrestrial mammals'),
			'weight' => -30,
			'callback' => 'pim_fi_bdn_ispecies',
			'page arguments' => array(1,t('Terrestrial Mammals'), array('bd_ni_mam_terrestres_present', 'bd_ni_mam_terrestres_absent')),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_mt_p',
			
		),
    /*
		'mam_terrestres_inventaires_report' => array (
			'base_url' => 'bdn_mt_i',
			'url' => 'bdn_mt_ireport',
			'title' => t('Reports'),
			'title2' => t('Terrestrial mammals'),
			'weight' => -25,
			'callback' => 'pim_fi_charts_bdn_ireports',
			'page arguments' => array(1, t('Terrestrial Mammals'), array('bd_ni_mam_terrestres_present', 'bd_ni_mam_terrestres_absent')),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_mt_p',
			
		),
    */
		'bd_ni_mam_terrestres_present' => array (
			'base_url' => 'bdn_mt_i',
			'url' => 'bdn_mt_ip',
			'title' => t('Observed Species'),
			'title2' => t('Terrestrial mammals'),
			'weight' => -20,
			'callback' => 'pim_fi_view_bd_n_callback',
			'page arguments' => array(1, 'view', 'bd_ni_mam_terrestres_present'),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_mt_p',
		),
		'bd_ni_mam_terrestres_absent' => array (
			'base_url' => 'bdn_mt_i',
			'url' => 'bdn_mt_ia',
			'title' => t('Unfound Species'),
			'title2' => t('Terrestrial mammals'),
			'weight' => -10,
			'callback' => 'pim_fi_view_bd_n_callback',
			'page arguments' => array(1, 'view', 'bd_ni_mam_terrestres_absent'),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_mt_a',
		),
    
		/* 7 Chiro */
		'chiroptere_especes_report' => array (
			'base_url' => 'bdn_c_i',
			'url' => 'bdn_c_ispecies',
			'title' => t('Species list'),
			'title2' => t('Chiroptera'),
			'weight' => -30,
			'callback' => 'pim_fi_bdn_ispecies',
			'page arguments' => array(1,t('Chiroptera'), array('bd_ni_chiroptere_present', 'bd_ni_chiroptere_absent')),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_c_p',
			
		),
    /*
		'chiroptere_inventaires_report' => array (
			'base_url' => 'bdn_c_i',
			'url' => 'bdn_c_ireport',
			'title' => t('Reports'),
			'title2' => t('Chiroptera'),
			'weight' => -25,
			'callback' => 'pim_fi_charts_bdn_ireports',
			'page arguments' => array(1,t('Chiroptera'), array('bd_ni_chiroptere_present', 'bd_ni_chiroptere_absent')),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_c_p',
			
		),
    */
		'bd_ni_chiroptere_present' => array (
			'base_url' => 'bdn_c_i',
			'url' => 'bdn_c_ip',
			'title' => t('Observed Species'),
			'title2' => t('Chiroptera'),
			'weight' => -20,
			'callback' => 'pim_fi_view_bd_n_callback',
			'page arguments' => array(1, 'view', 'bd_ni_chiroptere_present'),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_c_p',
			
		),
		'bd_ni_chiroptere_absent' => array (
			'base_url' => 'bdn_c_i',
			'url' => 'bdn_c_ia',
			'title' => t('Unfound Species'),
			'title2' => t('Chiroptera'),
			'weight' => -10,
			'callback' => 'pim_fi_view_bd_n_callback',
			'page arguments' => array(1, 'view', 'bd_ni_chiroptere_absent'),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_c_a',
		),
    
		/* Autres sp terrestres */
    /*
		'bd_ni_autre_terrestre_present' => array (
			'base_url' => 'bdn_at_i',
			'url' => 'bdn_at_ip',
			'title' => t('Observed Species'),
			'title2' => t('Other sp.'),
			'weight' => -20,
			'callback' => 'pim_fi_view_bd_n_callback',
			'page arguments' => array(1, 'view', 'bd_ni_autre_terrestre_present'),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_at_p',
		),
		'bd_ni_autre_terrestre_absent' => array (
			'base_url' => 'bdn_at_i',
			'url' => 'bdn_at_ia',
			'title' => t('Unfound Species'),
			'title2' => t('Other sp.'),
			'weight' => -10,
			'callback' => 'pim_fi_view_bd_n_callback',
			'page arguments' => array(1, 'view', 'bd_ni_autre_terrestre_absent'),
			'access arguments' => array('access content'),
			'bd_prefix' => 'bdni_at_a',
		),
    */
	);
}
/*--------------------------------------------------------
**	Tab Theme
**--------------------------------------------------------*/
function pim_fi_tab_fieldset_theme($title, $menu_group, $collapsed) {
	/* fieldsets: **Attention** pas d'espace entre </legend> et la première <div> = $wrapperstart */
	/* evite l'apparition de scroll bar */
	$wrapperstart = '<div class="fieldset-wrapper" style="display: block; overflow: hidden;">';
	$wrapperend = '</div>';
	 
	$tab = pim_fi_menu_primary_local_tasks(0, NULL, $menu_group);
	 
	$out = '<fieldset class="'. $collapsed .' fi_bdn_tabs">';
	$out .= '<legend>'.$title.'</legend>'.$wrapperstart;
	$out .= '<div class="tabs-bdn-subtitle2">'.t("Inventories").'</div>';
	$out .= '<div class="tabs"><ul class="tabs primary clearfix">';
	$out .= $tab;
	$out .= '</ul></div>';
	$out .= $wrapperend;
	$out .= '</fieldset>';
	
	return $out;
}
function pim_fi_tab_theme($title, $menu_group) {
	
	/* evite l'apparition de scroll bar */
	$wrapperstart = '<div class="fieldset-wrapper" style="display: block; overflow: hidden;">';
	$wrapperend = '</div>';

	$tab = pim_fi_menu_primary_local_tasks(0, NULL, $menu_group);
	
	$out .= '<div class="tabs-bdn-subtitle1">'.$title.'</div>';
	//$out .= '<div class="tabs-bdn-subtitle2">'.t("Inventories").'</div>';
	$out .= '<div class="tabs"><ul class="tabs primary clearfix">';
	$out .= $tab;
	$out .= '</ul></div>';
	//$out .= $wrapperend;
	
	
	return $out;
}
/*--------------------------------------------------------
**	Tab Local Tasks
**--------------------------------------------------------*/
/* hacked from CTools */
function pim_fi_menu_primary_local_tasks($level = 0, $node_type = NULL, 
																				 $menu_group = NULL, $return_root = FALSE) {
	static $tabs;
	static $root_path;

	/*@Modif*/
	if (!isset($tabs)) {
		$tabs = array();
	}
	if ((!empty($menu_group)) or (empty($tabs))) {
	/*@endModif*/
		
		$router_item = menu_get_item();
		if (!$router_item || !$router_item['access']) {
			return '';
		}
		
		/*@Modif*/
		If (!empty($menu_group)) {
			/* Permet d'afficher tous les onglets fiche-Ile sur les url de type fiche-Ile/%/bdn_.../%/view */ 
			$router_item['path'] = preg_replace('/(fiche-Ile\/%\/bdn_.*)\/%.*/', '$1', $router_item['path']);
			$router_item['tab_parent'] = preg_replace('/(fiche-Ile\/%)\/bdn_.*\/%/', '$1', $router_item['tab_parent']);
			
			if ($menu_group == 'bdi') {
				$sql = "SELECT * FROM {menu_router} ".
							 "WHERE tab_root = '%s' ".
							 "and (path = 'fiche-Ile/%%' ".
							 "	or path like 'fiche-Ile/\%%/ile-%%view' ".
							 "	or path like 'fiche-Ile/\%%/bdi%%') ".
							 "ORDER BY weight, title";
			} else if ($menu_group == 'bdn') {
				//dd("bdn menu");
				$sql = "SELECT * FROM {menu_router} ".
							 "WHERE tab_root = '%s' ".
							 "and path like 'fiche-Ile/\%%/bdn-%%view' ".
							 "ORDER BY weight, title";
			} else {
				
				$sql = "SELECT * FROM {menu_router} ".
							 "WHERE tab_root = '%s' ".
							 "and path like 'fiche-Ile/\%%/".pim_fi_get_baseurl($menu_group)."%%' ".
							 "ORDER BY weight, title";
			}
		} 
		/*@endModif*/
		else {
			$sql = "SELECT * FROM {menu_router} WHERE tab_root = '%s' ORDER BY weight, title";
		}
		$query = sprintf($sql, $router_item['tab_root']);
		//dd($query);
		
		// Get all tabs and the root page.
		$result = db_query($sql, $router_item['tab_root']);
		
		$map = arg();
		$children = array();
		$tasks = array();
		$root_path = $router_item['path'];
		
		while ($item = db_fetch_array($result)) {
			_menu_translate($item, $map, TRUE);
			if ($item['tab_parent']) {
				// All tabs, but not the root page.
				$children[$item['tab_parent']][$item['path']] = $item;
			}
			// Store the translated item for later use.
			$tasks[$item['path']] = $item;
		}
		
		/*canceled @Modif: useless since View tab is a default menu
		 * href is taken from parent path
		$children["node/%"]["node/%/view"]["href"] = 'fiche-Ile/847';
		$tasks["node/%/view"]["href"] = 'fiche-Ile/847';
		*/
		
		// Find all tabs below the current path.
		$path = $router_item['path'];

		/*@Modif: useless call*/
		//_ctools_menu_add_dynamic_items($children[$path]);
		/*@endModif*/

		// Tab parenting may skip levels, so the number of parts in the path may not
		// equal the depth. Thus we use the $depth counter (offset by 1000 for ksort).
		$depth = 1001;
		while (isset($children[$path])) {
			$tabs_current = '';
			$next_path = '';
			$count = 0;
			foreach ($children[$path] as $item) {
				if ($item['access']) {
					$count++;
					// The default task is always active.
					if ($item['type'] == MENU_DEFAULT_LOCAL_TASK) {
						// Find the first parent which is not a default local task.
						if (isset($item['tab_parent'])) {
							for ($p = $item['tab_parent']; $tasks[$p]['type'] == MENU_DEFAULT_LOCAL_TASK; $p = $tasks[$p]['tab_parent']);
							$href = $tasks[$p]['href'];
							$next_path = $item['path'];
						}
						else {
							$href = $item['href'];
						}
						$link = theme('menu_item_link', array('href' => $href) + $item);
						$tabs_current .= theme('menu_local_task', $link, TRUE);
					}
					else {
						$link = theme('menu_item_link', $item);
						$tabs_current .= theme('menu_local_task', $link);
					}
				}
			}
			$path = $next_path;
			$mytabs[$depth]['count'] = $count;
			$mytabs[$depth]['output'] = $tabs_current;
			$depth++;
		}
		
		// Find all tabs at the same level or above the current one.
		$parent = $router_item['tab_parent'];
		$path = $router_item['path'];
		$current = $router_item;
		$depth = 1000;
		while (isset($children[$parent])) {
			$tabs_current = '';
			$next_path = '';
			$next_parent = '';
			$count = 0;
			foreach ($children[$parent] as $item) {
				if ($item['access']) {
					$count++;
					if ($item['type'] == MENU_DEFAULT_LOCAL_TASK) {
						// Find the first parent which is not a default local task.
						for ($p = $item['tab_parent']; $tasks[$p]['type'] == MENU_DEFAULT_LOCAL_TASK; $p = $tasks[$p]['tab_parent']);
						
						/*@Modif*/
						If (!empty($node_type)) {
							$parts = explode('/', $tasks[$p]['href']);
							$nid = $parts[1];
							$pim_url = pim_fi_hack_nodeview_url($nid, $node_type);
							if (isset($pim_url)) {
								$tasks[$p]['href'] = $pim_url;
							}
						}
						/*@endModif*/
						$link = theme('menu_item_link', array('href' => $tasks[$p]['href']) + $item);
						
						if ($item['path'] == $router_item['path']) {
							$root_path = $tasks[$p]['path'];
						}
					}
					else {
						$link = theme('menu_item_link', $item);
					}
					// We check for the active tab.
					if ($item['path'] == $path) {
						$tabs_current .= theme('menu_local_task', $link, TRUE);
						$next_path = $item['tab_parent'];
						if (isset($tasks[$next_path])) {
							$next_parent = $tasks[$next_path]['tab_parent'];
						}
					}
					else {
						$tabs_current .= theme('menu_local_task', $link);
					}
				}
			}
			$path = $next_path;
			$parent = $next_parent;
			$mytabs[$depth]['count'] = $count;
			$mytabs[$depth]['output'] = $tabs_current;
			$depth--;
		}
		
		if (isset($mytabs)) {
			// Sort by depth.
			ksort($mytabs);
			// Remove the depth, we are interested only in their relative placement.
			$mytabs = array_values($mytabs);
		}
	}
	
	if ($return_root) {
		return $root_path;
	}
	else {
		// We do not display single tabs.
		if (empty($tabs)) $tabs = $mytabs;
		return (isset($mytabs[$level]) && $mytabs[$level]['count'] > 0) ? $mytabs[$level]['output'] : '';
	}
}

/*--------------------------------------------------------
**	Tab access callback
**--------------------------------------------------------*/
/* hacked from node module */

function pim_fi_node_access($op, $tid, $node_type) {
	global $user;
	global $pim_fi_nodetype2url;
	pim_fi_set_nodetype2url();
	
	$account = $user;
	
	if (user_access('administer nodes', $account)) {
		return TRUE;
	}

	if (!user_access('access content', $account)) {
		return FALSE;
	}
	//@modif
	//'create' shortcut
	if ($op == 'create') {
		return user_access('create '. $node_type .' content', $account);
	}
	//'edit any' shortcut
	if (($op == 'update') && (user_access('edit any '. $node_type .' content', $account))) {
		return TRUE;
	}
	
	//Operation == 'edit own' from here
	if (strncasecmp($node_type, 'bd_i', strlen('bd_i')) == 0) {
		$nid = pim_fi_get_single_nid($tid, $node_type);
	} else {
		$nid = $tid;
	}
	//@end modif
	
	$node = node_load($nid, NULL, NULL);
	if (empty($node)) {
		return FALSE;
	}

    if ($op == 'view' && substr($node_type, 0, 5) === 'bd_ni') {
        $bd_prefix = $pim_fi_nodetype2url[$node_type]['bd_prefix'];
        $fname = 'field_'.$bd_prefix.'_donnees_publique';
        $field = $node->$fname;
        if ($account->uid === 0 && $field[0]['value'] === 'Donnée privée') {
            return FALSE;
        }
        return TRUE;
    }

	//@modif 
	//new shortcut: should be enough and quicker 
	// than complete drupal code with grant handling
	return ((user_access('edit own '. $node_type .' content', $account) &&
					($account->uid == $node->uid)));
	//@end modif
	
	//@TODO: rest of code is useless 
	//kept until Validation completed
	
	// Convert the node to an object if necessary:
	if ($op != 'create') {
		$node = (object)$node;
	}

	// Can't use node_invoke(), because the access hook takes the $op parameter
	// before the $node parameter.
	$module = node_get_types('module', $node);
	if ($module == 'node') {
		$module = 'node_content'; // Avoid function name collisions.
	}
	$access = module_invoke($module, 'access', $op, $node, $account);
	if (!is_null($access)) {
		return $access;
	}

	// If the module did not override the access rights, use those set in the
	// node_access table.
	if ($op != 'create' && $node->nid && $node->status) {
		$grants = array();
		foreach (node_access_grants($op, $account) as $realm => $gids) {
			foreach ($gids as $gid) {
				$grants[] = "(gid = $gid AND realm = '$realm')";
			}
		}

		$grants_sql = '';
		if (count($grants)) {
			$grants_sql = 'AND ('. implode(' OR ', $grants) .')';
		}

		$sql = "SELECT 1 FROM {node_access} WHERE (nid = 0 OR nid = %d) $grants_sql AND grant_$op >= 1";
		$result = db_query_range($sql, $node->nid, 0, 1);
		return (bool) db_result($result);
	}

	// Let authors view their own nodes.
	if ($op == 'view' && $account->uid == $node->uid && $account->uid != 0) {
		return TRUE;
	}

	return FALSE;
}


















