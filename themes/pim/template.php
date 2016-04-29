<?php
/**
 * @file
 * Contains theme override functions and preprocess functions for the theme.
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. You can add new regions for block content, modify
 *   or override Drupal's theme functions, intercept or make additional
 *   variables available to your theme, and create custom PHP logic. For more
 *   information, please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/theme-guide
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   The Drupal theme system uses special theme functions to generate HTML
 *   output automatically. Often we wish to customize this HTML output. To do
 *   this, we have to override the theme function. You have to first find the
 *   theme function that generates the output, and then "catch" it and modify it
 *   here. The easiest way to do it is to copy the original function in its
 *   entirety and paste it here, changing the prefix from theme_ to STARTERKIT_.
 *   For example:
 *
 *     original: theme_breadcrumb()
 *     theme override: STARTERKIT_breadcrumb()
 *
 *   where STARTERKIT is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_breadcrumb() function.
 *
 *   If you would like to override any of the theme functions used in Zen core,
 *   you should first look at how Zen core implements those functions:
 *     theme_breadcrumbs()      in zen/template.php
 *     theme_menu_item_link()   in zen/template.php
 *     theme_menu_local_tasks() in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called template suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node-forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and template suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440
 *   and http://drupal.org/node/190815#template-suggestions
 */


/**
 * Implementation of HOOK_theme().
 */
function pim_theme(&$existing, $type, $theme, $path) {

  //Pour l'ajout du templage custom : node_type_form dans /zen/zen-internals/template.theme-registry.inc

  $hooks = zen_theme($existing, $type, $theme, $path);
  // Add your theme hooks like this:
  /*
  $hooks['hook_name_here'] = array( // Details go here );
  */
  // @TODO: Needs detailed comments. Patches welcome!
  return $hooks;
}

/**
 * Override or insert variables into all templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered (name of the .tpl.php file.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_page(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');

  // To remove a class from $classes_array, use array_diff().
  //$vars['classes_array'] = array_diff($vars['classes_array'], array('class-to-remove'));
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_node(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // STARTERKIT_preprocess_node_page() or STARTERKIT_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $vars['node']->type;
  if (function_exists($function)) {
    $function($vars, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_comment(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_block(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */


//Fonction utilisée afin d'associer un template à une vue de façon programmatique
// Intéret : éviter la mutiliplication de template identique
// Remarque : A Adapter en fonction des besoins voir http://drupalcontrib.org/api/drupal/contributions--views--theme--theme.inc/6 pour les fonctions
// Remarque :  pour fonctionner il faut absolument qu'une template s'appliquant à l'élément soit déjà défini. (Par défaut : views-view-fields.tpl.php)
function pim_preprocess_views_view_fields($vars) {
  if (($vars['view']->name == "Partenaires_Bailleurs")){
    if (preg_match("/^attachment_([3|4])$/i",$vars['view']->current_display )) {
      $vars['template_files'][] = 'views-view-fields--Partenaire-Bailleur--attachment-Text';
    }
    elseif (preg_match("/^attachment_([2|5])$/i",$vars['view']->current_display )) {
      $vars['template_files'][] = 'views-view-fields--Partenaire-Bailleur--Logos';
    }
   }
  elseif (($vars['view']->name == "ArchivesNews") || ($vars['view']->name == "TopNews")){
        
    if (preg_match("/^attachment_(\d+)$/i",$vars['view']->current_display )) {
            $vars['template_files'][] = 'views-view-fields--News--attachment';
    }
  }
  elseif (($vars['view']->name == "Equipe")){
    if (preg_match("/^attachment_([1|3])$/i",$vars['view']->current_display )) {
            $vars['template_files'][] = 'views-view-fields--Partenaire-Bailleur--attachment-Text';
    }
    elseif (preg_match("/^attachment_([2|4])$/i",$vars['view']->current_display )) {
            $vars['template_files'][] = 'views-view-fields--Equipe--Corege';
    }
  }
  elseif (($vars['view']->name == "Corege")){
    if (preg_match("/^attachment_([1])$/i",$vars['view']->current_display )) {
      $vars['template_files'][] = 'views-view-fields--Equipe--Corege';
    }
  }
  elseif (($vars['view']->name == "DocPIM") ){
    if (preg_match("/^attachment_([1])$/i",$vars['view']->current_display )) {
            $vars['template_files'][] = 'views-view-fields--Docs--attachment';
    }
  }
  elseif ($vars['view']->name == "Bibliotheque"){
    if (preg_match("/^page_([2])$/i",$vars['view']->current_display )) {
       $vars['template_files'][] = 'views-view-fields--Docs--attachment';
    }
  }
  
  elseif (($vars['view']->name == "phototheque")){
    if (preg_match("/^attachment_([1|3])$/i",$vars['view']->current_display )) {
            $vars['template_files'][] = 'views-view-fields--Partenaire-Bailleur--attachment-Text';
    }
    elseif (preg_match("/^attachment_([2|4])$/i",$vars['view']->current_display )) {
            $vars['template_files'][] = 'views-view-fields--phototheque--slideshow';
    }
  }
  /*
  elseif (($vars['view']->name == "Annuaire")){
    if (preg_match("/^page_([1])$/i",$vars['view']->current_display )) {
            $vars['template_files'][] = 'views-view-fields--Equipe--Corege';
    }
  }
  */
}

function pim_preprocess_views_view(&$vars) {
  //print $vars['view']->name;
   switch ($vars['view']->name) {
      case "v_search_manager":
      case "v_search_protection":
      case "v_search_islands_archipelagos":
      case "v_search_inventory":
      case "v_search_inventory_anon":
         if ( ! preg_match("/^block/i",$vars['view']->current_display )) {
             if (empty($vars['view']->exposed_input)) {
              $vars['rows'] = array();
            }
         }
      break;

      case "Annuaire":
         if (empty($vars['view']->exposed_input)) {
            $vars['rows'] = array();
            unset($vars['pager']);
         }
      break;
  }
}
function pim_preprocess_page(&$vars) {
  global $fi_breadcrumb;

  if (!empty($fi_breadcrumb)) {
    $vars['fi_breadcrumb'] = $fi_breadcrumb;
  }
  
  if (arg(0) == 'taxonomy') {
    drupal_goto("fiche-taxon/pim/".arg(2));
  }

  /*Pier*/
  // Add per content type pages
  if ($vars['node']->type != "") {
    $vars['template_files'][] = "page-" . $vars['node']->type;
  }

}

function pim_preprocess_node(&$vars) {
  if (isset ($vars['node']) && preg_match('/^bd_ni_[\S\s]*_(present|absent)$/',$vars['node']->type )) {
    $vars['template_files'] = array();
    $vars['template_files'][] = 'node-bd_ni_all-table';
  }
  
  if (arg(0) == 'taxonomy') {
    //print "taxonomy ";
    //print_r($vars);
    /*$suggestions1 = array(
      'node-taxonomy'
    );
    $suggestions2 = array(
      'node-'.$vars['type'].'-taxonomy'
    );
    $vars['template_files'] = array_merge($vars['template_files'], $suggestions1, $suggestions2);*/
  }
}

/**
 * Override zen_menu_local_tasks.
 *
 * 1) Disable "View Edit Devel" Tabs on specific Pages (Pages are normally editable)
 * 2) Case of Edit Page for Node of type "bd_xxx"
 *     => Hack 'View' tab to link to fiche-Ile Page 
 */

function pim_menu_local_tasks($level = 0, $return_root = FALSE) {
  global $fi_breadcrumb;

  $output = '';
    
  $path =  $_GET['q'];
  
  //get only meaningfull part of url (site's base_url independant)
  $alias = drupal_get_path_alias($path);
  $alias_parts = explode('?', $alias);
  
  if ((strpos($alias_parts[0], "login") !== false) or
        (strpos($alias_parts[0], "accueil") !== false))
  {
    return $output;
  }
  
  $alias_parts = explode('/', $alias);
  $hack_ctools_menu = FALSE;
  /* 1) Case of node ADD of type "bd_xxx" (sauf fiche taxon)
   *   => Si le tid de l'ile est specifie en arg 3, Display custom breadcrumb
   * 2) Case of node EDIT of type "bd_xxx" (sauf fiche taxon)
   * => Hack 'View' tab to link to fiche-Ile Page 
   * => Display custom breadcrumb
   * FORM redirections are done in ficheIle module form_alter
   */
  
  if (strcasecmp($alias_parts[0],"node") == 0) {
    
    // 1) Case of node ADD 
    if (strcasecmp($alias_parts[1],"add") == 0) {
      //pas de code ile - pas de breadcrumb
      if (isset($alias_parts[3])) {
        $alias_parts[3] = explode('?', $alias_parts[3]);
        $tid = $alias_parts[3][0];
        //check quand meme le type de noeud
        $node_type = str_replace("-","_",$alias_parts[2]);
        if ((strpos($node_type, 'bd_') !== FALSE) && (strpos($node_type, 'bd_t') == FALSE)) {
          $fi_breadcrumb = PIM_ficheIle_tabMenu_set_breadcrumb($nid=NULL, $node_type, $tid);
        }
      }
    }
    
    // 2) Case of node EDIT 
    else if (isset($alias_parts[2]) && ((strcasecmp($alias_parts[2],'edit') == 0))) {
      $node = node_load($alias_parts[1], $revision=NULL, $reset=TRUE);

      if ((strpos($node->type, 'bd_') !== FALSE) && (strpos($node->type, 'bd_t') == FALSE)) {
        $hack_ctools_menu = TRUE;
        $primary = PIM_ficheIle_tabMenu_menu_primary_local_tasks(0, $node->type);
        $fi_breadcrumb = PIM_ficheIle_tabMenu_set_breadcrumb($alias_parts[1], $node->type);
      }
    }  
  }
  
  
  
  /* In most cases, use Ctools menu 
   * (CTools requires a different set of local task functions.)
   */
  if ($hack_ctools_menu == FALSE) {
    if (module_exists('ctools')) {
      //case insensitive comparison
      if (strcasecmp($alias_parts[0],'fiche-Ile') == 0) {
        
        /*BD Ile menu: done in PIM_ficheIle_tabMenu_preprocess_page */
        return $output;
        
      } else {
          $primary = ctools_menu_primary_local_tasks();
          $secondary = ctools_menu_secondary_local_tasks();
      }
    }
    else {
      $primary = menu_primary_local_tasks();
      $secondary = menu_secondary_local_tasks();
    }
  }
  
  if ($primary) {
    $output .= '<ul class="tabs primary clearfix">' . $primary . '</ul>';
  }
  if ($secondary) {
    $output .= '<ul class="tabs secondary clearfix">' . $secondary . '</ul>';
  }

  return $output;
}

