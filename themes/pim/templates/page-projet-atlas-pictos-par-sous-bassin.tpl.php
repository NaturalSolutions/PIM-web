<?php
/**
 * @file
 * Theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $css: An array of CSS files for the current page.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/garland.
 * - $is_front: TRUE if the current page is the front page. Used to toggle the mission statement.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Page metadata:
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $head_title: A modified version of the page title, for use in the TITLE tag.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It should be placed within the <body> tag. When selecting through CSS
 *   it's recommended that you use the body tag, e.g., "body.front". It can be
 *   manipulated through the variable $classes_array from preprocess functions.
 *   The default values can be one or more of the following:
 *   - front: Page is the home page.
 *   - not-front: Page is not the home page.
 *   - logged-in: The current viewer is logged in.
 *   - not-logged-in: The current viewer is not logged in.
 *   - node-type-[node type]: When viewing a single node, the type of that node.
 *     For example, if the node is a "Blog entry" it would result in "node-type-blog".
 *     Note that the machine name will often be in a short form of the human readable label.
 *   - page-views: Page content is generated from Views. Note: a Views block
 *     will not cause this class to appear.
 *   - page-panels: Page content is generated from Panels. Note: a Panels block
 *     will not cause this class to appear.
 *   The following only apply with the default 'sidebar_first' and 'sidebar_second' block regions:
 *     - two-sidebars: When both sidebars have content.
 *     - no-sidebars: When no sidebar content exists.
 *     - one-sidebar and sidebar-first or sidebar-second: A combination of the
 *       two classes when only one of the two sidebars have content.
 * - $node: Full node object. Contains data that may not be safe. This is only
 *   available if the current page is on the node's primary url.
 * - $menu_item: (array) A page's menu item. This is only available if the
 *   current page is in the menu.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $mission: The text of the site mission, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $search_box: HTML to display the search box, empty if search has been disabled.
 * - $primary_links (array): An array containing the Primary menu links for the
 *   site, if they have been configured.
 * - $secondary_links (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title: The page title, for use in the actual HTML content.
 * - $messages: HTML for status and error messages. Should be displayed prominently.
 * - $tabs: Tabs linking to any sub-pages beneath the current page (e.g., the
 *   view and edit tabs when displaying a node).
 * - $help: Dynamic help text, mostly for admin pages.
 * - $content: The main content of the current page.
 * - $feed_icons: A string of all feed icons for the current page.
 *
 * Footer/closing data:
 * - $footer_message: The footer message as defined in the admin settings.
 * - $closure: Final closing markup from any modules that have altered the page.
 *   This variable should always be output last, after all other dynamic content.
 *
 * Helper variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * Regions:
 * - $content_top: Items to appear above the main content of the current page.
 * - $content_bottom: Items to appear below the main content of the current page.
 * - $navigation: Items for the navigation bar.
 * - $sidebar_first: Items for the first sidebar.
 * - $sidebar_second: Items for the second sidebar.
 * - $header: Items for the header region.
 * - $footer: Items for the footer region.
 * - $page_closure: Items to appear below the footer.
 *
 * The following variables are deprecated and will be removed in Drupal 7:
 * - $body_classes: This variable has been renamed $classes in Drupal 7.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see zen_preprocess()
 * @see zen_process()
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">

<head>
  <title><?php print $head_title; ?></title>
  
  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $scripts; ?>

 
</head>

<?php 
module_load_include('inc', 'node', 'node.pages');    
$node_type = 'book_les_pictos_surcharge';
$form_id = $node_type . '_node_form';
global $user, $base_url;  
?>
<body class="<?php print $classes; ?>">

  <?php if ($primary_links): ?>
    <div id="skip-link"><a href="#main-menu"><?php print t('Jump to Navigation'); ?></a></div>
  <?php endif; ?>

  <div id="page-wrapper"><div id="page">

    <div id="header"><div class="section clearfix">

    <div id="header-top">
      <?php if ($site_name || $site_slogan): ?>
      <div id="name-and-slogan">
        <?php if ($site_name): ?>
        <?php if ($title): ?>
          <div id="site-name"><strong>
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
          </strong></div>
        <?php else: /* Use h1 when the content title is empty */ ?>
          <h1 id="site-name">
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
          </h1>
        <?php endif; ?>
        <?php endif; ?>

        <?php if ($site_slogan): ?>
        <div id="site-slogan"><?php print $site_slogan; ?></div>
        <?php endif; ?>
      </div><!-- /#name-and-slogan -->
      <?php endif; ?>

      <?php if ($search_box): ?>
      <div id="search-box"><?php print $search_box; ?></div>
      <?php endif; ?>

      <?php print $header; ?>
      
    </div>
    
    <div class="mr-propre"></div>
    
    <div id="header-bottom">
      <div id="header-left">
        <?php if ($logo): ?>
        <div id="logo-container">
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></a>
        </div>
        <?php endif; ?>
        <div class="mr-propre"></div>
        <?php if($header_left): ?>
        <?php print $header_left; ?>
        <?php endif; ?>
      </div>
      <?php if($header_right): ?>
        <div id="header-right"><?php print $header_right; ?></div>
      <?php endif; ?>
    </div>

    </div></div><!-- /.section, /#header -->
  
  <div class="mr-propre"></div>

    <div id="main-wrapper" class="clearfix">
		<!--<div id="main" class="clearfix">-->
		<div id="main" class="clearfix<?php if ($primary_links || $navigation) { print ' with-navigation'; } ?>">
		
    <?php if($content_intro): ?>
      <div id="content-intro" class="column"><div class="section">
      <?php print $content_intro; ?>
      </div></div> <!-- /.section /#content_intro -->
    <?php endif; ?>
    
      <div id="content" class="column"><div class="section">

        <?php if ($mission): ?>
          <div id="mission"><?php print $mission; ?></div>
        <?php endif; ?>

        <?php print $highlight; ?>

        <?php print $breadcrumb; ?>
        <?php print $messages; ?>
        <?php if ($tabs): ?>
          <div class="tabs"><?php print $tabs; ?></div>
        <?php endif; ?>
        <?php print $help; ?>
        
        <?php if ($fi_breadcrumb): ?>
          <div id="fi_breadcrumb">
            <span class="texte-orange">
          <?php print $fi_breadcrumb; ?>
            </span>
          </div>
        <?php endif; ?>

        <?php if ($content_top): ?>
          <?php print $content_top; ?>
        <?php endif; ?>
        

        <div id="content-area">
          <h1>Annuaire des îles</h1>
          <h2 class='bigTitleSousBassin'>SOUS-BASSIN MÉDITERRANÉEN</h2>
          <p class='help'>Séléctionnez un sous bassin</p>
          <?php 
         
          //Get param in url for pager
          if(isset($_GET["pager"])) $pager = $_GET["pager"];
          else $pager = 0; 
          $offset = ($pager*3);          

          if(isset($_GET["ssbassin"])) $ssbassin = urldecode($_GET["ssbassin"]);
          else $ssbassin = "Gibraltar";

          //Selection des iles de la bdd dans certaine région (remplacé) qui sont précisé PIM ou non-renseigné
          $sql = "SELECT distinct c.name, 
            replace(        
              replace(      
                replace(              
                  replace(              
                    replace(              
                      replace(              
                        replace(                            
                          replace(            
                            replace(            
                              replace(            
                                replace(              
                                  replace(              
                                    replace(              
                                      replace(c.name,'Gibraltar','Alboran'),       
                                    'Algérie','Algeria'),
                                  'Sardaigne','Sardinia'),
                                'Sicile','Sicily'),
                              'Tunisie-Est','Eastern Tunisia'),                            
                            'Tunisie-Nord','Northern Tunisia'),                            
                                          'Maroc Atlantique','Atlantic Morocco'),                            
                                      'Corse','Corsica'),
                      'France-Sud','Southern France'),
                              'Baléares','Balearic Islands'),
                  'Malte','Malta'),
                      'Italie-Mar Ligure','Italy Ligurian'),
              'Italie-Mar Tirreno','Italy Tyrrhenian'),
            'Espagne-Sud et Est','Eastern Spain') nameSousBassin
          FROM drp_content_type_bd_i_description_physique p
          JOIN drp_term_data c
          ON c.tid = p.field_bdi_dp_zone_geographique_value
          WHERE COALESCE(p.field_bdi_dp_ispim_island_value,'Oui') = 'Oui' 
          AND p.field_bdi_dp_code_ile_value is not null
          AND c.name NOT LIKE 'Adriatique Ouest'
          AND c.name NOT LIKE 'Chypre'
          AND c.name NOT LIKE 'Crète'
          AND c.name NOT LIKE 'Egypte-Nord' 
          AND c.name NOT LIKE 'Est-Méditerranée'
          AND c.name NOT LIKE 'Illyrie'
          AND c.name NOT LIKE 'Italie - Sud'
          AND c.name NOT LIKE 'Libye'          
          ORDER BY nameSousBassin ASC;";

          $result = db_query($sql);    

          //Display
          $cpt=0;
          if (!$result) die('Invalid query1: ' . mysql_error());
          else while (  $row  =  db_fetch_array($result) ) {
            if($ssbassin == $row['name']) $active = 'active';
            else $active = 'notactive';             
            echo "<a class='linkSSbassin ".$active."' title='Afficher les pictogrammes pour ce sous bassin' href='$base_url/projet-atlas/pictos-par-sous-bassin?ssbassin=".urlencode($row['name'])."&pager=0'>".$row['nameSousBassin']."</a>";
          }
          
          //Selection des iles de la bdd dans certaine région (remplacé) qui sont précisé PIM ou non-renseigné         
          $sql = "SELECT distinct p.field_bdi_dp_code_ile_value, 
                replace(        
                  replace(      
                  replace(              
                    replace(              
                    replace(              
                      replace(              
                      replace(                            
                        replace(            
                        replace(            
                          replace(            
                          replace(              
                            replace(              
                            replace(              
                              replace(c.name,'Gibraltar','Alboran'),       
                            'Algérie','Algeria'),
                            'Sardaigne','Sardinia'),
                          'Sicile','Sicily'),
                          'Tunisie-Est','Eastern Tunisia'),                            
                        'Tunisie-Nord','Northern Tunisia'),                            
                                'Maroc Atlantique','Atlantic Morocco'),                            
                              'Corse','Corsica'),
                      'France-Sud','Southern France'),
                          'Baléares','Balearic Islands'),
                    'Malte','Malta'),
                      'Italie-Mar Ligure','Italy Ligurian'),
                  'Italie-Mar Tirreno','Italy Tyrrhenian'),
                'Espagne-Sud et Est','Eastern Spain') nameSousBassin , s.name , s.tid
                FROM drp_content_type_bd_i_description_physique p 
                JOIN drp_term_data c
                ON c.tid = p.field_bdi_dp_zone_geographique_value
                LEFT JOIN ( 
                select tid,min(tsid) tsid
                  from drp_term_synonym 
                  where name not like ''
                  group by tid
                  order by tid
                ) Sy 
                ON Sy.tid = p.field_bdi_dp_nom_ile_code_ile_value 
                LEFT JOIN  drp_term_synonym s ON s.tid = Sy.tid and s.tsid = Sy.tsid
                WHERE COALESCE(p.field_bdi_dp_ispim_island_value,'Oui') = 'Oui' 
                AND p.field_bdi_dp_code_ile_value is not null
                AND c.name NOT LIKE 'Adriatique Ouest'
                AND c.name NOT LIKE 'Chypre'
                AND c.name NOT LIKE 'Crète'
                AND c.name NOT LIKE 'Egypte-Nord' 
                AND c.name NOT LIKE 'Est-Méditerranée'
                AND c.name NOT LIKE 'Illyrie'
                AND c.name NOT LIKE 'Italie - Sud'
                AND c.name NOT LIKE 'Libye'
                AND p.field_bdi_dp_code_ile_value not LIKE '%0'
                AND c.name LIKE '".$ssbassin."'
                ORDER BY nameSousBassin ASC
                , s.name ASC 
          LIMIT 3 OFFSET ".$offset.";";


          $result = db_query($sql);    
          $cpt = 0;                  
          //Display
          if (!$result) die('Invalid query:0 ' . mysql_error());
          else while (  $row  =  db_fetch_array($result) ) {
            
            //Si le nom du sous bassin est different de l'ancien on l'affiche
            if($row['nameSousBassin'] != $tabOfNameSousBassin[$cpt -1]) {              
              echo "<h3 class='titleSousBassin'>".$row['nameSousBassin']."</h3>";
            }
            
            //Stock ancien nom du sous bassin pour comparaison
            $tabOfNameSousBassin[$cpt] = $row['nameSousBassin'];
            //Increment compteur
            $cpt++;

            //Get termName            
            $termName = $row['field_bdi_dp_code_ile_value'];
            $firstSyno = $row['name'];
            $myTid = $row['tid'];

            if($firstSyno == '') $firstSyno = 'Lien';
            
            //Get info sur proprietephysique de l'ile
            $resPhysique = views_get_view_result($name = 'v_atlas_tab_data_ile', $display_id = 'block_1', $myTid);
            //Get info sur propriete fonciere de l'ile
            $resFonciere = views_get_view_result('v_atlas_tab_data_ile', 'block_2', $myTid); 

            //Parcour des info fonciere
            foreach ($resFonciere as $key => $value) {
              //Get
              $pourcentPublic = $value->node_data_field_bdi_sp_code_ile_ilot_field_bdi_sp_p_terre_pourcent_value;
              $pourcentPrivee = $value->node_data_field_bdi_sp_code_ile_ilot_field_bdi_sp_priv_terre_pourcent_value;
            }

            //Parcour des info physique
            foreach ($resPhysique as $key => $value) {
              //Get
              $surface =  $value->node_data_field_bdi_dp_nom_ile_code_ile_field_bdi_dp_sup_terrestre_ha_value;
              $distance = $value->node_data_field_bdi_dp_nom_ile_code_ile_field_bdi_dp_dist_cote_cont_value;
              $altitude = $value->node_data_field_bdi_dp_nom_ile_code_ile_field_bdi_dp_altitude_metre_value;            
              $lineaire = $value->node_data_field_bdi_dp_nom_ile_code_ile_field_bdi_dp_lineaire_cote_metre_value;            
            
            }
            
            $valuePropriete = '';
            if($pourcentPublic == '100') $valuePropriete = 'publique';
            else if($pourcentPrivee == '100') $valuePropriete = 'privée';
            else if($pourcentPublic == '' && $pourcentPrivee == '') $valuePropriete = 'N/A';
            else $valuePropriete = 'publique/privée';


            //drupal_set_message( "<pre>" . print_r($resFonciere, TRUE) . "</pre>" ); 

            //Affichage island avec ses infos physique et foncière
            echo "
            <div class='lineHeader'>
            
              <a target='_blank' class='titleIsland' href='$base_url/fiche-Ile/$termName'>".$firstSyno."</a>
              
              <div class='col col1'>
                <span class='item surface'>Surface (ha) : $surface</span>
                <span class='item altitude'>Altitude (m) : $altitude</span>
              </div>
              
              <div class='col col2'>
                <span class='item distance'>Distance au continent (M) : $distance</span>
                <span class='item lineaire'>Linéaire côtier (m) : $lineaire</span>
              </div>

              <div class='col col3'>
                <span class='item propriete'>Propriété : $valuePropriete</span>
              </div>

            </div>
            ";        


            /*-- ----------------------------------------------------------------------------
            -- État des connaissances
            -- ----------------------------------------------------------------------------*/
            
            //Bota
            $sql1 = "select b.niveau from picto_etaco_bota b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatBota = $result1['niveau'] - 1;   

            //Ornithologie
            $sql1 = "select b.niveau from picto_etaco_ornitho b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1);             
            $etatOrni = $result1['niveau'] - 1;
            
            //Herpétologie
            $sql1 = "select b.niveau from picto_etaco_herpeto b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1);
            $etatHerpe = $result1['niveau'] - 1;
            
            //Mammifères
            $sql1 = "select b.niveau from picto_etaco_mamm b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1);             
            $etatMami = $result1['niveau'] - 1;
            
            //Chiroptères
            $sql1 = "select b.niveau from picto_etaco_chiro b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1);             
            $etatChiro = $result1['niveau'] - 1;
                          
            //Invertébrés
            $sql1 = "select b.niveau from picto_etaco_invert b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1);             
            $etatInvert = $result1['niveau'] - 1;  
            
            //Caractéristique environnentales
            $sql1 = "select b.niveau from picto_etaco_carenv b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1);             
            $etatEnviro = $result1['niveau'] - 1;
            
            //Socie économie
            $sql1 = "select b.niveau from picto_etaco_soceco b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1);             
            $etatEco = $result1['niveau'] - 1;         
            
            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Botanique et connaissance
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_connaiss_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND t.name = 'Botanique' ORDER BY c.field_book_value_picto_connaiss_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsBota[$row['field_book_value_picto_connaiss_value']] = $row['filepath'];
              $rowsLabelBota [$row['field_book_value_picto_connaiss_value']] = $row['field_book_value_picto_connaiss_value'];
              $rowsTitleBota[$row['field_book_value_picto_connaiss_value']] = $row['title'];    
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Ornithologie et connaissance
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_connaiss_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND t.name = 'Ornithologie' ORDER BY c.field_book_value_picto_connaiss_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsOrni[$row['field_book_value_picto_connaiss_value']] = $row['filepath'];   
              $rowsLabelOrni [$row['field_book_value_picto_connaiss_value']] = $row['field_book_value_picto_connaiss_value'];
              $rowsTitleOrni[$row['field_book_value_picto_connaiss_value']] = $row['title'];    
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Herpétologie et connaissance
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_connaiss_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND t.name = 'Herpétologie' ORDER BY c.field_book_value_picto_connaiss_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsHerpeto[$row['field_book_value_picto_connaiss_value']] = $row['filepath'];
              $rowsLabelHerpeto [$row['field_book_value_picto_connaiss_value']] = $row['field_book_value_picto_connaiss_value'];
              $rowsTitleHerpeto[$row['field_book_value_picto_connaiss_value']] = $row['title'];    
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Mammifères et connaissance
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_connaiss_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND t.name = 'Mammifères' ORDER BY c.field_book_value_picto_connaiss_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsMami[$row['field_book_value_picto_connaiss_value']] = $row['filepath']; 
              $rowsLabelMami [$row['field_book_value_picto_connaiss_value']] = $row['field_book_value_picto_connaiss_value'];
              $rowsTitleMami[$row['field_book_value_picto_connaiss_value']] = $row['title'];    
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Chiroptères et connaissance
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_connaiss_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND t.name = 'Chiroptères' ORDER BY c.field_book_value_picto_connaiss_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsChiro[$row['field_book_value_picto_connaiss_value']] = $row['filepath']; 
              $rowsLabelChiro [$row['field_book_value_picto_connaiss_value']] = $row['field_book_value_picto_connaiss_value'];
              $rowsTitleChiro[$row['field_book_value_picto_connaiss_value']] = $row['title'];    
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Invertébrés et connaissance
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_connaiss_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND t.name = 'Invertébrés' ORDER BY c.field_book_value_picto_connaiss_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsInvert[$row['field_book_value_picto_connaiss_value']] = $row['filepath']; 
              $rowsLabelInvert [$row['field_book_value_picto_connaiss_value']] = $row['field_book_value_picto_connaiss_value'];
              $rowsTitleInvert[$row['field_book_value_picto_connaiss_value']] = $row['title'];    
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici caractéristique environnentales
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_connaiss_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND t.name = 'Caractéristique environnementales' ORDER BY c.field_book_value_picto_connaiss_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsCaraEnviro[$row['field_book_value_picto_connaiss_value']] = $row['filepath'];
              $rowsLabelCaraEnviro [$row['field_book_value_picto_connaiss_value']] = $row['field_book_value_picto_connaiss_value'];
              $rowsTitleCaraEnviro[$row['field_book_value_picto_connaiss_value']] = $row['title'];    
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Socie économie
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_connaiss_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND t.name = 'Socio economie' ORDER BY c.field_book_value_picto_connaiss_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsEco[$row['field_book_value_picto_connaiss_value']] = $row['filepath'];
              $rowsLabelEco [$row['field_book_value_picto_connaiss_value']] = $row['field_book_value_picto_connaiss_value'];
              $rowsTitleEco[$row['field_book_value_picto_connaiss_value']] = $row['title'];    
            }

            //On stock le bon picto en fonction de la valeur
            $urlOfPictoBotaToDisplay = $rowsBota[$etatBota];
            $urlOfPictoOrniToDisplay = $rowsOrni[$etatOrni];
            $urlOfPictoHerpeToDisplay = $rowsHerpeto[$etatHerpe];
            $urlOfPictoMamiToDisplay = $rowsMami[$etatMami];
            $urlOfPictoChiroToDisplay = $rowsChiro[$etatChiro];
            $urlOfPictoInvertToDisplay = $rowsInvert[$etatInvert];
            $urlOfPictoEnviroToDisplay = $rowsCaraEnviro[$etatEnviro];
            $urlOfPictoEcoToDisplay = $rowsEco[$etatEco];

            //On stock le bon label en fonction de la valeur
            $labelBota = $rowsLabelBota[$etatBota];
            $labelOrni = $rowsLabelOrni[$etatOrni];
            $labelHerpe = $rowsLabelHerpeto[$etatHerpe];
            $labelMami = $rowsLabelMami[$etatMami];
            $labelChiro = $rowsLabelChiro[$etatChiro];
            $labelInvert = $rowsLabelInvert[$etatInvert];
            $labelCaractEnv = $rowsLabelCaraEnviro[$etatEnviro];
            $labelSocioEco = $rowsLabelEco[$etatEco];

            //On stock le bon titre en fonction de la valeur
            $titleBota = $rowsTitleBota[$etatBota];
            $titleOrni = $rowsTitleOrni[$etatOrni];
            $titleHerpe = $rowsTitleHerpeto[$etatHerpe];
            $titleMami = $rowsTitleMami[$etatMami];
            $titleChiro = $rowsTitleChiro[$etatChiro];
            $titleInvert = $rowsTitleInvert[$etatInvert];
            $titleCaractEnv = $rowsTitleCaraEnviro[$etatEnviro];
            $titleSocioEco = $rowsTitleEco[$etatEco];

            /*
            * FAUNE MARINE
            */
            //Get nid of picto_surcharge to load the correct node edit form -> FauneM
            $idPictoMSurcharge = ''; $comValueFauneM = ''; $isRemarquableFauneM = ''; $valueOfPictoSurchargeFauneM = ''; $urlPictoSurchargeFauneM = '';
            $sql1 = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur: ".$termName."' AND s.field_book_type_picto_surcharge_value = 'fauneM' AND s.field_book_genre_picto_surcharge_value = 'connaissance';";
            $result1 = db_query($sql1);  
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $idPictoMSurcharge = $row['nid'];  
              $comValueFauneM = $row['field_book_star_com_picto_value'];  
              $isRemarquableFauneM = $row['field_book_star_on_picto_value'];
              $valueOfPictoSurchargeFauneM = $row['field_book_value_picto_surcharge_value'];

              //Si on a une valeur surchargé alors on va chercher le pictogrammes correspondant
              if($valueOfPictoSurchargeFauneM != ''){
                //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici FauneM et connaissance
                $sql2 = "SELECT d.filepath, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND c.field_book_value_picto_connaiss_value = ".$valueOfPictoSurchargeFauneM." AND t.name = 'Faune marine';";  
                $result2 = db_query($sql2);
                if (!$result2) die('Invalid query: ' . mysql_error());
                else while (  $row  =  db_fetch_array($result2) ) $urlPictoSurchargeFauneM = $row['filepath'];      
              }

            }
            if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
            //else create a blank node    
            else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
            $outputFauneM = drupal_get_form($form_id, $node);

            /*
            * FLORE MARINE
            */
            //Get nid of picto_surcharge to load the correct node edit form -> FloreM
            $idPictoMSurcharge = ''; $comValueFloreM = ''; $isRemarquableFloreM = ''; $valuePictoSurchargeFloreM = ''; $urlPictoSurchargeFloreM = '';
            $sql1 = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur: ".$termName."' AND s.field_book_type_picto_surcharge_value = 'floreM' AND s.field_book_genre_picto_surcharge_value = 'connaissance';";  
            $result1 = db_query($sql1);              
            $result1 = db_fetch_array($result1);                         
            $idPictoMSurcharge = $result1['nid'];  
            $comValueFloreM = $result1['field_book_star_com_picto_value'];       
            $isRemarquableFloreM = $result1['field_book_star_on_picto_value'];        
            $valuePictoSurchargeFloreM = $result1['field_book_value_picto_surcharge_value'];             

            //Si on a une valeur surchargé alors on va chercher le pictogrammes correspondant
            if($valuePictoSurchargeFloreM != ''){
              //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici FauneM et connaissance
              $sql2 = "SELECT d.filepath, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND c.field_book_value_picto_connaiss_value = ".$valuePictoSurchargeFloreM." AND t.name = 'Flore marine';";  
              $result2 = db_query($sql2);
              if (!$result2) die('Invalid query0: ' . mysql_error());
              else while (  $row  =  db_fetch_array($result2) ) $urlPictoSurchargeFloreM = $row['filepath'];              
            }              
            
            if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
            //else create a blank node    
            else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
            $outputFloreM = drupal_get_form($form_id, $node);


            /*
            * GROTTE
            */
            //Get nid of picto_surcharge to load the correct node edit form -> FloreM
            $idPictoMSurcharge = ''; $comValueGrotte = ''; $isRemarquableGrotte = ''; $valuePictoSurchargeGrotte = ''; $urlPictoSurchargeGrotte = '';
            $sql1 = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur: ".$termName."' AND s.field_book_type_picto_surcharge_value = 'grotte' AND s.field_book_genre_picto_surcharge_value = 'connaissance';";  
            $result1 = db_query($sql1);  
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $idPictoMSurcharge = $row['nid'];  
              $comValueGrotte = $row['field_book_star_com_picto_value'];       
              $isRemarquableGrotte = $row['field_book_star_on_picto_value'];        
              $valuePictoSurchargeGrotte = $row['field_book_value_picto_surcharge_value'];        
              
              //Si on a une valeur surchargé alors on va chercher le pictogrammes correspondant
              if($valuePictoSurchargeGrotte != ''){
                //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici FauneM et connaissance
                $sql2 = "SELECT d.filepath, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND c.field_book_value_picto_connaiss_value = ".$valuePictoSurchargeGrotte." AND t.name = 'Grotte / fonds rocheux-sableux';";  
                $result2 = db_query($sql2);
                if (!$result2) die('Invalid query: ' . mysql_error());
                else while (  $row  =  db_fetch_array($result2) ) $urlPictoSurchargeGrotte = $row['filepath'];              
              }

            }
            if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
            //else create a blank node    
            else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
            $outputGrotte = drupal_get_form($form_id, $node);

            //Transforme value of picto to label
            switch ($labelBota) {
              case 0: $labelBota = 'Pas de données'; break;
              case 1: $labelBota = 'Données anciennes'; break;
              case 2: $labelBota = 'Données récentes'; break;
              case 3: $labelBota = 'Bonne connaissance'; break;    
            } // fin switch  
            switch ($labelOrni) {
              case 0: $labelOrni = 'Pas de données'; break;
              case 1: $labelOrni = 'Données anciennes'; break;
              case 2: $labelOrni = 'Données récentes'; break;
              case 3: $labelOrni = 'Bonne connaissance'; break;    
            } // fin switch  
            switch ($labelHerpe) {
              case 0: $labelHerpe = 'Pas de données'; break;
              case 1: $labelHerpe = 'Données anciennes'; break;
              case 2: $labelHerpe = 'Données récentes'; break;
              case 3: $labelHerpe = 'Bonne connaissance'; break;    
            } // fin switch 
            switch ($labelMami) {
              case 0: $labelMami = 'Pas de données'; break;
              case 1: $labelMami = 'Données anciennes'; break;
              case 2: $labelMami = 'Données récentes'; break;
              case 3: $labelMami = 'Bonne connaissance'; break;    
            } // fin switch
            switch ($labelChiro) {
              case 0: $labelChiro = 'Pas de données'; break;
              case 1: $labelChiro = 'Données anciennes'; break;
              case 2: $labelChiro = 'Données récentes'; break;
              case 3: $labelChiro = 'Bonne connaissance'; break;    
            } // fin switch 
            switch ($labelInvert) {
              case 0: $labelInvert = 'Pas de données'; break;
              case 1: $labelInvert = 'Données anciennes'; break;
              case 2: $labelInvert = 'Données récentes'; break;
              case 3: $labelInvert = 'Bonne connaissance'; break;    
            } // fin switch
            switch ($labelCaractEnv) {
              case 0: $labelCaractEnv = 'Pas de données'; break;
              case 1: $labelCaractEnv = 'Données anciennes'; break;
              case 2: $labelCaractEnv = 'Données récentes'; break;
              case 3: $labelCaractEnv = 'Bonne connaissance'; break;    
            } // fin switch 
            switch ($labelSocioEco) {
              case 0: $labelSocioEco = 'Pas de données'; break;
              case 1: $labelSocioEco = 'Données anciennes'; break;
              case 2: $labelSocioEco = 'Données récentes'; break;
              case 3: $labelSocioEco = 'Bonne connaissance'; break;    
            } // fin switch  
            switch ($valueOfPictoSurchargeFauneM) {
              case 0: $labelEtatSurchargeFauneM = 'Pas de données'; break;
              case 1: $labelEtatSurchargeFauneM = 'Données anciennes'; break;
              case 2: $labelEtatSurchargeFauneM = 'Données récentes'; break;
              case 3: $labelEtatSurchargeFauneM = 'Bonne connaissance'; break;    
            } // fin switch  
            switch ($valuePictoSurchargeFloreM) {
              case 0: $labelEtatSurchargeFloreM = 'Pas de données'; break;
              case 1: $labelEtatSurchargeFloreM = 'Données anciennes'; break;
              case 2: $labelEtatSurchargeFloreM = 'Données récentes'; break;
              case 3: $labelEtatSurchargeFloreM = 'Bonne connaissance'; break;    
            } // fin switch  
            switch ($valuePictoSurchargeGrotte) {
              case 0: $valuePictoSurchargeGrotte = 'Pas de connaissance'; break;
              case 1: $valuePictoSurchargeGrotte = 'Fond sableux'; break;
              case 2: $valuePictoSurchargeGrotte = 'Fond rocheux'; break;
              case 3: $valuePictoSurchargeGrotte = 'Grottes'; break;    
            } // fin switch


            ?>

            <div class="linePictos">              
              <div class="labelLesPictos connaissance">
                  <p>CONNAISSANCE</p>                
              </div>            
              <div class="lesPicto book_les_pictos_connaissances" data-term="<?php echo $termName; ?>">
                
                <!-- Botanique -->
                <?php if($urlOfPictoBotaToDisplay != ''): ?>
                  <div class="onePicto Botanique"><?php echo "<img src='$base_url/$urlOfPictoBotaToDisplay' alt='$titleBota' title='$titleBota' />"; ?>
                    <div class="popup"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                        <p class="titleGenrePicto">Etat des connaissances</p>
                        <p class="titleTypePicto">Botanique</p>
                        <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoBotaToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelBota; ?></p></div>            
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$linkToBase"; ?>'>Donnée dans la base</a>
                      </div>          
                    </div>
                  </div>
                <?php endif; ?>
                <!-- Ornithologie -->
                <?php if($urlOfPictoOrniToDisplay != ''): ?>
                  <div class="onePicto orni"><?php echo "<img src='$base_url/$urlOfPictoOrniToDisplay' alt='$titleOrnito' title='$titleOrnito' />"; ?>
                    <div class="popup"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                        <p class="titleGenrePicto">Etat des connaissances</p>
                        <p class="titleTypePicto">Ornithologie</p>
                        <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoOrniToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelOrni; ?></p></div>            
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>          
                    </div>
                  </div>
                <?php endif; ?>
                <!-- Herpétologie -->
                <?php if($urlOfPictoHerpeToDisplay != ''): ?>
                  <div class="onePicto herpe <?php echo $etatHerpe; ?>"><?php echo "<img src='$base_url/$urlOfPictoHerpeToDisplay' alt='$titleHerpe' title='$titleHerpe' />"; ?>
                    <div class="popup"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                        <p class="titleGenrePicto">Etat des connaissances</p>
                        <p class="titleTypePicto">Herpétologie</p>
                        <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoHerpeToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelHerpe; ?></p></div>            
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>          
                    </div>
                  </div>
                <?php endif; ?>
                <!-- Mammifères -->
                <?php if($urlOfPictoMamiToDisplay != ''): ?>
                  <div class="onePicto mammi <?php echo $etatMami; ?>"><?php echo "<img src='$base_url/$urlOfPictoMamiToDisplay' alt='$titleMami' title='$titleMami' />"; ?>
                    <div class="popup"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                        <p class="titleGenrePicto">Etat des connaissances</p>
                        <p class="titleTypePicto">Mammifères</p>
                        <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoMamiToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelMami; ?></p></div>            
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>          
                    </div>
                  </div>
                <?php endif; ?>
                <!-- Chiroptères -->
                <?php if($urlOfPictoChiroToDisplay != ''): ?>
                  <div class="onePicto chirop <?php echo $etatChiro; ?>"><?php echo "<img src='$base_url/$urlOfPictoChiroToDisplay' alt='$titleChiro' title='$titleChiro' />"; ?>
                    <div class="popup"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                        <p class="titleGenrePicto">Etat des connaissances</p>
                        <p class="titleTypePicto">Chiroptères</p>
                        <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoChiroToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelChiro; ?></p></div>            
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>          
                    </div>
                  </div>
                <?php endif; ?>
                <!-- Invertébrés -->
                <?php if($urlOfPictoInvertToDisplay != ''): ?>
                  <div class="onePicto invert <?php echo $etatInvert; ?>"><?php echo "<img src='$base_url/$urlOfPictoInvertToDisplay' alt='$titleInvert' title='$titleInvert' />"; ?>
                    <div class="popup"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                        <p class="titleGenrePicto">Etat des connaissances</p>
                        <p class="titleTypePicto">Invertébrés</p>
                        <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoInvertToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelInvert; ?></p></div>            
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>          
                    </div>
                  </div>
                <?php endif; ?>
                <!-- Faune Marine -->
                <div class="onePicto expert connaissance fauneM" title='Faune Marine'>
                  <?php 
                    if($urlPictoSurchargeFauneM) echo "<img class='surcharge' src='$base_url/$urlPictoSurchargeFauneM' alt='$titleFauneM' title='$titleFauneM' />"; 
                    else echo "<i>Expert</i>";        
                    if($isRemarquableFauneM == '1') echo "<i class='star'>*</i>";
                  ?>      
                  <div class="popup"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
                        <p class="titleGenrePicto">Etat des connaissances</p>
                        <p class="titleTypePicto">Faune Marine</p>
                        <div class="linePicto">
                          <?php 
                          if($urlPictoSurchargeFauneM != '') echo "<img src='$base_url/$urlPictoSurchargeFauneM'/>"; 
                          else echo '<p class="noPicto">Pas de pictogramme</p>';               
                          if($urlPictoSurchargeFauneM != '') echo "<p class='labelEtat'>".$labelEtatSurchargeFauneM."</p>";              
                          ?>
                        </div>
                        <div class="remarquable"><?php if($isRemarquableFauneM == '1') echo "* Présence d'une espèce remarquable"; ?></div>
                        <div class="commentaire"><?php if($comValueFauneM != '') echo '<label>Commentaire : </label>'.$comValueFauneM; ?></div>
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>
                      <div class='edit'>
                        <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
                        <p class="titleGenrePicto">Etat des connaissances</p>
                        <p class="titleTypePicto">Faune Marine</p>            
                        <div class="linePicto">
                          <?php if($urlPictoSurchargeFauneM != '') echo "<img src='$base_url/$urlPictoSurchargeFauneM'/>"; else echo '<p class="desc">Choisir une valeur pour afficher un pictogramme</p>'; ?>              
                          <?php echo '<div class="myFormOnVisu">'.$outputFauneM.'</div>'; ?>              
                        </div>
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>         
                      </div>
                    </div>
                </div>
                <!-- Flore Marine -->
                <div class="onePicto expert connaissance floreM" title='Flore Marine'>
                   <?php 
                    if($urlPictoSurchargeFloreM) echo "<img class='surcharge' src='$base_url/$urlPictoSurchargeFloreM' alt='$titleFloreM' title='$titleFloreM' />"; 
                    else echo "<i>Expert</i>";        
                    if($isRemarquableFloreM == '1') echo "<i class='star'>*</i>";
                  ?>       
                  <div class="popup"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
                        <p class="titleGenrePicto">Etat des connaissances</p>
                        <p class="titleTypePicto">Flore Marine</p>
                        <div class="linePicto">
                          <?php 
                          if($urlPictoSurchargeFloreM != '') echo "<img src='$base_url/$urlPictoSurchargeFloreM'/>"; 
                          else echo '<p class="noPicto">Pas de pictogramme</p>';               
                          if($urlPictoSurchargeFloreM != '') echo "<p class='labelEtat'>".$labelEtatSurchargeFloreM."</p>"; 
                          ?>
                        </div>
                        <div class="remarquable"><?php if($isRemarquableFloreM == '1') echo "* Présence d'une espèce remarquable"; ?></div>
                        <div class="commentaire"><?php if($comValueFloreM != '') echo '<label>Commentaire : </label>'.$comValueFloreM; ?></div>
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>
                      <div class='edit'>
                        <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
                        <p class="titleGenrePicto">Etat des connaissances</p>
                        <p class="titleTypePicto">Flore Marine</p>            
                        <div class="linePicto">
                          <?php if($urlPictoSurchargeFloreM != '') echo "<img src='$base_url/$urlPictoSurchargeFloreM'/>"; else echo '<p class="desc">Choisir une valeur pour afficher un pictogramme</p>'; ?>              
                          <?php echo '<div class="myFormOnVisu">'.$outputFloreM.'</div>'; ?>              
                        </div>
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>         
                      </div>
                    </div>
                </div>
                <!-- Grotte / Fond rocheux -->
                <div class="onePicto expert connaissance grotte" title='Grotte / Fond rocheux'>
                  <?php 
                    if($urlPictoSurchargeGrotte) echo "<img class='surcharge' src='$base_url/$urlPictoSurchargeGrotte' alt='$titleGrotte' title='$titleGrotte' />"; 
                    else echo "<i>Expert</i>";        
                    if($isRemarquableGrotte == '1') echo "<i class='star'>*</i>";
                  ?>      
                  <div class="popup"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
                        <p class="titleGenrePicto">Etat des connaissances</p>
                        <p class="titleTypePicto">Grotte / Fond rocheux</p>
                        <div class="linePicto">
                          <?php 
                          if($urlPictoSurchargeGrotte != '') echo "<img src='$base_url/$urlPictoSurchargeGrotte'/>"; 
                          else echo '<p class="noPicto">Pas de pictogramme</p>';               
                          if($urlPictoSurchargeGrotte != '') echo "<p class='labelEtat'>".$valuePictoSurchargeGrotte."</p>"; 
                          ?>
                        </div>
                        <div class="remarquable"><?php if($isRemarquableGrotte == '1') echo "* Présence d'une espèce remarquable"; ?></div>
                        <div class="commentaire"><?php if($comValueGrotte != '') echo '<label>Commentaire : </label>'.$comValueGrotte; ?></div>
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>
                      <div class='edit'>
                        <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
                        <p class="titleGenrePicto">Etat des connaissances</p>
                        <p class="titleTypePicto">Grotte / Fond rocheux</p>            
                        <div class="linePicto">
                          <?php if($urlPictoSurchargeGrotte != '') echo "<img src='$base_url/$urlPictoSurchargeGrotte'/>"; else echo '<p class="desc">Choisir une valeur pour afficher un pictogramme</p>'; ?>              
                          <?php echo '<div class="myFormOnVisu">'.$outputGrotte.'</div>'; ?>              
                        </div>
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>         
                      </div>
                    </div>
                </div>
                <!-- caractéristique environnentales -->
                <?php if($urlOfPictoEnviroToDisplay != ''): ?>
                  <div class="onePicto inviro <?php echo $etatEnviro; ?>"><?php echo "<img src='$base_url/$urlOfPictoEnviroToDisplay' alt='$titleCaractEnv' title='$titleCaractEnv' />"; ?>
                    <div class="popup"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                        <p class="titleGenrePicto">Etat des connaissances</p>
                        <p class="titleTypePicto">Caractéristique environnentales</p>
                        <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoEnviroToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelCaractEnv; ?></p></div>            
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>          
                    </div>
                  </div>
                <?php endif; ?>
                <!-- Socio économie -->
                <?php if($urlOfPictoEcoToDisplay != ''): ?>
                  <div class="onePicto invert <?php echo $etatEco; ?>"><?php echo "<img src='$base_url/$urlOfPictoEcoToDisplay' alt='$titleSocioEco' title='$titleSocioEco' />"; ?>
                    <div class="popup"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                        <p class="titleGenrePicto">Etat des connaissances</p>
                        <p class="titleTypePicto">Socio économie</p>
                        <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoEcoToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelSocioEco; ?></p></div>            
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>          
                    </div>
                  </div>
                <?php endif; ?>


              </div>
            </div>
            <?php  

            /*-- ----------------------------------------------------------------------------
            -- Intérêts des patrimoines
            -- ----------------------------------------------------------------------------*/

            //Botanique
            $sql1 = "select b.niveau from picto_intepa_bota b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatBota = $result1['niveau'] - 1;
            
            //Ornithologie
            $sql1 = "select b.niveau from picto_intepa_ornitho b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatOrni = $result1['niveau'] - 1;  
            
            //Herpétologie
            $sql1 = "select b.niveau from picto_intepa_herpeto b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatHerpe = $result1['niveau'] - 1;
            
            //Mammifères
            $sql1 = "select b.niveau from picto_intepa_mamm b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatMami = $result1['niveau'] - 1;
            
            //Chiroptères
            $sql1 = "select b.niveau from picto_intepa_chiro b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatChiro = $result1['niveau'] - 1;
            
            //Invertébré
            //Valeur rentré par l'expert

            //Faune marine
            $sql1 = "select b.niveau from picto_intepa_faunem b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatFauneM = $result1['niveau'] - 1;
            
            //Flore marine
            $sql1 = "select b.niveau from picto_intepa_florem b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatFloreM = $result1['niveau'] - 1;
            
            //Grotte et fond rocheux -> Valeur rentré par l'expert

            //Paysage (Terre)
            $sql1 = "select b.niveau from picto_intepa_paysat b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatPaysT = $result1['niveau'] - 1;

            //Paysage (Mer) -> Valeur rentré par l'expert
            
            //Patrimoine bâti -> Valeur rentré par l'expert
              
            //Création de richesse économique (Mer)
            $sql1 = "select b.niveau from picto_intepa_crem b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatEcoMer = $result1['niveau'] - 1;
              
            //Création de richesse économique (Terre)
            $sql1 = "select b.niveau from picto_intepa_cret b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatEcoTerre = $result1['niveau'] - 1;

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Botanique et Interêt des patrimoines                
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_interet_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND t.name = 'Botanique' ORDER BY c.field_book_value_picto_interet_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsBota[$row['field_book_value_picto_interet_value']] = $row['filepath']; 
              $rowsLabelBota [$row['field_book_value_picto_interet_value']] = $row['field_book_value_picto_interet_value'];
              $rowsTitleBota[$row['field_book_value_picto_interet_value']] = $row['title'];    
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Ornithologie et Interêt des patrimoines
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_interet_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND t.name = 'Ornithologie' ORDER BY c.field_book_value_picto_interet_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsOrni[$row['field_book_value_picto_interet_value']] = $row['filepath']; 
              $rowsLabelOrni [$row['field_book_value_picto_interet_value']] = $row['field_book_value_picto_interet_value'];
              $rowsTitleOrni[$row['field_book_value_picto_interet_value']] = $row['title'];    
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Herpétologie et Interêt des patrimoines
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_interet_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND t.name = 'Herpétologie' ORDER BY c.field_book_value_picto_interet_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsHerpeto[$row['field_book_value_picto_interet_value']] = $row['filepath']; 
              $rowsLabelHerpeto [$row['field_book_value_picto_interet_value']] = $row['field_book_value_picto_interet_value'];
              $rowsTitleHerpeto[$row['field_book_value_picto_interet_value']] = $row['title'];    
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Mammifères et Interêt des patrimoines
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_interet_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND t.name = 'Mammifères' ORDER BY c.field_book_value_picto_interet_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsMami[$row['field_book_value_picto_interet_value']] = $row['filepath']; 
              $rowsLabelMami [$row['field_book_value_picto_interet_value']] = $row['field_book_value_picto_interet_value'];
              $rowsTitleMami[$row['field_book_value_picto_interet_value']] = $row['title'];    
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Chiroptere et Interêt des patrimoines
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_interet_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND t.name = 'Chiroptères' ORDER BY c.field_book_value_picto_interet_value ASC;";
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsChiro[$row['field_book_value_picto_interet_value']] = $row['filepath']; 
              $rowsLabelChiro [$row['field_book_value_picto_interet_value']] = $row['field_book_value_picto_interet_value'];
              $rowsTitleChiro[$row['field_book_value_picto_interet_value']] = $row['title'];    
            }

            /*intervention manuel de l'expert pour invertébré*/

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Faune marine et Interêt des patrimoines
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_interet_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND t.name = 'Faune marine' ORDER BY c.field_book_value_picto_interet_value ASC;";
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsFauneM[$row['field_book_value_picto_interet_value']] = $row['filepath']; 
              $rowsLabelFauneM [$row['field_book_value_picto_interet_value']] = $row['field_book_value_picto_interet_value'];
              $rowsTitleFauneM[$row['field_book_value_picto_interet_value']] = $row['title'];    
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Flore marine et Interêt des patrimoines
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_interet_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND t.name = 'Flore marine' ORDER BY c.field_book_value_picto_interet_value ASC;";
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsFloreM[$row['field_book_value_picto_interet_value']] = $row['filepath']; 
              $rowsLabelFloreM [$row['field_book_value_picto_interet_value']] = $row['field_book_value_picto_interet_value'];
              $rowsTitleFloreM[$row['field_book_value_picto_interet_value']] = $row['title'];    
            }

            /*intervention manuel de l'expert pour Grotte et fond rocheux*/

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Paysage / Terre et Interêt des patrimoines
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_interet_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND t.name = 'Paysager / Terre' ORDER BY c.field_book_value_picto_interet_value ASC;";
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsPaysT[$row['field_book_value_picto_interet_value']] = $row['filepath']; 
              $rowsLabelPaysT [$row['field_book_value_picto_interet_value']] = $row['field_book_value_picto_interet_value'];
              $rowsTitlePaysT[$row['field_book_value_picto_interet_value']] = $row['title'];    
            }

            /*intervention manuel de l'expert pour Paysage / Mer */
            /*intervention manuel de l'expert pour Patrimoine bâti */

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Création de richesse économique (Mer) et Interêt des patrimoines
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_interet_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND t.name = 'Création de richesse économique (Mer)' ORDER BY c.field_book_value_picto_interet_value ASC;";
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsEcoMer[$row['field_book_value_picto_interet_value']] = $row['filepath']; 
              $rowsLabelEcoMer [$row['field_book_value_picto_interet_value']] = $row['field_book_value_picto_interet_value'];
              $rowsTitleEcoMer[$row['field_book_value_picto_interet_value']] = $row['title'];    
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Création de richesse économique (Terre) et Interêt des patrimoines
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_interet_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND t.name = 'Création de richesse économique (Terre)' ORDER BY c.field_book_value_picto_interet_value ASC;";
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsEcoTerre[$row['field_book_value_picto_interet_value']] = $row['filepath']; 
              $rowsLabelEcoTerre [$row['field_book_value_picto_interet_value']] = $row['field_book_value_picto_interet_value'];
              $rowsTitleEcoTerre[$row['field_book_value_picto_interet_value']] = $row['title'];    
            }

            //On stock le bon picto en fonction de la valeur
            $urlOfPictoBotaToDisplay = $rowsBota[$etatBota];
            $urlOfPictoOrniToDisplay = $rowsOrni[$etatOrni];
            $urlOfPictoHerpetoToDisplay = $rowsHerpeto[$etatHerpe];
            $urlOfPictoMamitoToDisplay = $rowsMami[$etatMami];
            $urlOfPictoChiroToDisplay = $rowsChiro[$etatChiro];
            $urlOfPictoFauneMToDisplay = $rowsFauneM[$etatFauneM];
            $urlOfPictoFloreMToDisplay = $rowsFloreM[$etatFloreM];
            $urlOfPictoPaysTToDisplay = $rowsPaysT[$etatPaysT];
            $urlOfPictoEcoMerToDisplay = $rowsEcoMer[$etatEcoMer];
            $urlOfPictoEcoTerreToDisplay = $rowsEcoTerre[$etatEcoTerre];

            //On stock le bon label en fonction de la valeur
            $labelBota = $rowsLabelBota[$etatBota];
            $labelOrni = $rowsLabelOrni[$etatOrni];
            $labelHerpe = $rowsLabelHerpeto[$etatHerpe];
            $labelMami = $rowsLabelMami[$etatMami];
            $labelChiro = $rowsLabelChiro[$etatChiro];
            $labelFauneM = $rowsLabelFauneM[$etatFauneM];
            $labelFloreM = $rowsLabelFloreM[$etatFloreM];
            $labelPaysT = $rowsLabelPaysT[$etatPaysT];
            $labelCreaRichessEcoMer = $rowsLabelEcoMer[$etatEcoMer];
            $labelCreaRichessEcoTerre = $rowsLabelEcoTerre[$etatEcoTerre];

            //On stock le bon titre en fonction de la valeur
            $titleBota = $rowsTitleBota[$etatBota];
            $titleOrni = $rowsTitleOrni[$etatOrni];
            $titleHerpe = $rowsTitleHerpeto[$etatHerpe];
            $titleMami = $rowsTitleMami[$etatMami];
            $titleChiro = $rowsTitleChiro[$etatChiro];
            $titleFauneM = $rowsTitleFauneM[$etatFauneM];
            $titleFloreM = $rowsTitleFloreM[$etatFloreM];
            $titlePaysT = $rowsTitlePaysT[$etatPaysT];
            $titleCreaRichessEcoMer = $rowsTitleEcoMer[$etatEcoMer];
            $titleCreaRichessEcoTerre = $rowsTitleEcoTerre[$etatEcoTerre];

            /*
            * BOTANIQUE
            */
            //Get nid of picto_surcharge to load the correct node edit form -> bota            
            $idPictoMSurcharge = ''; $comValueBota = ''; $isRemarquableBota = ''; 
            $sql1 = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur: ".$termName."' AND s.field_book_type_picto_surcharge_value = 'botanique' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
            $result1 = db_query($sql1);  
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $idPictoMSurcharge = $row['nid'];  
              $comValueBota = $row['field_book_star_com_picto_value'];       
              $isRemarquableBota = $row['field_book_star_on_picto_value'];
            }
            if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
            //else create a blank node    
            else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
            $outputBota = drupal_get_form($form_id, $node);

            /*
            * ORNITHOLOGIE
            */
            //Get nid of picto_surcharge to load the correct node edit form -> orni
            $idPictoMSurcharge = ''; $comValueOrni = ''; $isRemarquableOrni = ''; 
            $sql1 = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur: ".$termName."' AND s.field_book_type_picto_surcharge_value = 'ornithologie' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
            $result1 = db_query($sql1);  
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $idPictoMSurcharge = $row['nid'];  
              $comValueOrni = $row['field_book_star_com_picto_value'];       
              $isRemarquableOrni = $row['field_book_star_on_picto_value'];        
            }
            if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
            //else create a blank node    
            else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
            $outputOrni = drupal_get_form($form_id, $node);

            /*
            * HERPETOLOGIE
            */
            //Get nid of picto_surcharge to load the correct node edit form -> orni
            $idPictoMSurcharge = ''; $comValueHerpe = ''; $isRemarquableHerpe = '';
            $sql1 = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur: ".$termName."' AND s.field_book_type_picto_surcharge_value = 'herpetologie' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
            $result1 = db_query($sql1);  
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $idPictoMSurcharge = $row['nid'];  
              $comValueHerpe = $row['field_book_star_com_picto_value'];       
              $isRemarquableHerpe = $row['field_book_star_on_picto_value'];        
            }
            if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
            //else create a blank node    
            else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
            $outputHerpe = drupal_get_form($form_id, $node);

            /*
            * MAMIFERE
            */
            //Get nid of picto_surcharge to load the correct node edit form -> orni
            $idPictoMSurcharge = ''; $comValueMami = ''; $isRemarquableMami = '';
            $sql1 = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur: ".$termName."' AND s.field_book_type_picto_surcharge_value = 'mamifere' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
            $result1 = db_query($sql1);  
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $idPictoMSurcharge = $row['nid'];  
              $comValueMami = $row['field_book_star_com_picto_value'];       
              $isRemarquableMami = $row['field_book_star_on_picto_value'];        
            }
            if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
            //else create a blank node    
            else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
            $outputMami = drupal_get_form($form_id, $node);

            /*
            * CHIROPTERE
            */
            //Get nid of picto_surcharge to load the correct node edit form -> orni
            $idPictoMSurcharge = ''; $comValueChiro = ''; $isRemarquableChiro = '';
            $sql1 = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur: ".$termName."' AND s.field_book_type_picto_surcharge_value = 'chiroptere' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
            $result1 = db_query($sql1);  
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $idPictoMSurcharge = $row['nid'];  
              $comValueChiro = $row['field_book_star_com_picto_value'];       
              $isRemarquableChiro = $row['field_book_star_on_picto_value'];        
            }
            if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
            //else create a blank node    
            else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
            $outputChiro = drupal_get_form($form_id, $node);

            /*
            * INVERTEBRE
            */
            //Get nid of picto_surcharge to load the correct node edit form -> orni
            $idPictoMSurcharge = ''; $comValueInvert = ''; $isRemarquableInvert = ''; $valueOfPictoSurchargeInvert = ''; $urlPictoSurchargeInvert = '';
            $sql1 = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur: ".$termName."' AND s.field_book_type_picto_surcharge_value = 'invert' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
            $result1 = db_query($sql1);  
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $idPictoMSurcharge = $row['nid'];  
              $comValueInvert = $row['field_book_star_com_picto_value'];       
              $isRemarquableInvert = $row['field_book_star_on_picto_value'];
              $valueOfPictoSurchargeInvert = $row['field_book_value_picto_surcharge_value'];        
              
              //Si on a une valeur surchargé alors on va chercher le pictogrammes correspondant
              if($valueOfPictoSurchargeInvert != ''){
                //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici bota et interet
                $sql1 = "SELECT d.filepath, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND c.field_book_value_picto_interet_value = ".$valueOfPictoSurchargeInvert." AND t.name = 'Invertébrés';";  
                $result1 = db_query($sql1);
                if (!$result1) die('Invalid query: ' . mysql_error());
                else while (  $row  =  db_fetch_array($result1) ) $urlPictoSurchargeInvert = $row['filepath'];
              }        
            }
            if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
            //else create a blank node    
            else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
            $outputInvert = drupal_get_form($form_id, $node);

            /*
            * FAUNE MARINE
            */
            //Get nid of picto_surcharge to load the correct node edit form -> orni
            $idPictoMSurcharge = ''; $comValueFauneM_i = ''; $isRemarquableFauneM_i = '';
            $sql1 = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur: ".$termName."' AND s.field_book_type_picto_surcharge_value = 'fauneM' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
            $result1 = db_query($sql1);  
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $idPictoMSurcharge = $row['nid'];  
              $comValueFauneM_i = $row['field_book_star_com_picto_value'];       
              $isRemarquableFauneM_i = $row['field_book_star_on_picto_value'];        
            }
            if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
            //else create a blank node    
            else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
            $outputFauneM = drupal_get_form($form_id, $node);

            /*
            * FLORE MARINE
            */
            //Get nid of picto_surcharge to load the correct node edit form -> orni
            $idPictoMSurcharge = ''; $comValueFloreM_i = ''; $isRemarquableFloreM_i = '';
            $sql1 = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur: ".$termName."' AND s.field_book_type_picto_surcharge_value = 'floreM' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
            $result1 = db_query($sql1);  
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $idPictoMSurcharge = $row['nid'];  
              $comValueFloreM_i = $row['field_book_star_com_picto_value'];       
              $isRemarquableFloreM_i = $row['field_book_star_on_picto_value'];        
            }
            if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
            //else create a blank node    
            else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
            $outputFloreM = drupal_get_form($form_id, $node);

            /*
            * GROTTE
            */
            //Get nid of picto_surcharge to load the correct node edit form -> orni
            $idPictoMSurcharge = ''; $comValueGrotteI = ''; $isRemarquableGrotteI = ''; $valueOfPictoSurchargeGrotteI = ''; $urlPictoSurchargeGrotteI = '';
            $sql1 = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur: ".$termName."' AND s.field_book_type_picto_surcharge_value = 'grotte' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
            $result1 = db_query($sql1);  
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $idPictoMSurcharge = $row['nid'];  
              $comValueGrotteI = $row['field_book_star_com_picto_value'];       
              $isRemarquableGrotteI = $row['field_book_star_on_picto_value'];        
              $valueOfPictoSurchargeGrotteI = $row['field_book_value_picto_surcharge_value'];        
              
              //Si on a une valeur surchargé alors on va chercher le pictogrammes correspondant
              if($valueOfPictoSurchargeGrotteI != ''){
                //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici bota et interet
                $sql2 = "SELECT d.filepath, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND c.field_book_value_picto_interet_value = ".$valueOfPictoSurchargeGrotteI." AND t.name = 'Grotte / fonds rocheux-sableux';";  
                $result2 = db_query($sql2);
                if (!$result2) die('Invalid query: ' . mysql_error());
                else while (  $row  =  db_fetch_array($result2) ) $urlPictoSurchargeGrotteI = $row['filepath'];
              }

            }
            if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
            //else create a blank node    
            else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
            $outputGrotte = drupal_get_form($form_id, $node);
            

            /*
            * PAYSAGE / TERRE
            */
            //Get nid of picto_surcharge to load the correct node edit form -> orni
            $idPictoMSurcharge = ''; $comValuePaysT = ''; $isRemarquablePaysT = ''; $valueOfPictoSurchargePaysT = ''; $urlPictoSurchargePaysT = '';
            $sql1 = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur: ".$termName."' AND s.field_book_type_picto_surcharge_value = 'paysT' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
            $result1 = db_query($sql1);  
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $idPictoMSurcharge = $row['nid'];  
              $comValuePaysT = $row['field_book_star_com_picto_value'];       
              $isRemarquablePaysT = $row['field_book_star_on_picto_value'];
              $valueOfPictoSurchargePaysT = $row['field_book_value_picto_surcharge_value'];        
              
              //Si on a une valeur surchargé alors on va chercher le pictogrammes correspondant
              if($valueOfPictoSurchargePaysT != ''){
                //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici bota et interet
                $sql2 = "SELECT d.filepath, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND c.field_book_value_picto_interet_value = ".$valueOfPictoSurchargePaysT." AND t.name = 'Paysager / Terre';";  
                $result2 = db_query($sql2);
                if (!$result2) die('Invalid query: ' . mysql_error());
                else while (  $row  =  db_fetch_array($result2) ) $urlPictoSurchargePaysT = $row['filepath'];
              }        
            }
            if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
            //else create a blank node    
            else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
            $outputPaysT = drupal_get_form($form_id, $node);

            /*
            * PAYSAGE / MER
            */
            //Get nid of picto_surcharge to load the correct node edit form -> orni
            $idPictoMSurcharge = ''; $comValuePaysM = ''; $isRemarquablePaysM = ''; $valueOfPictoSurchargePaysM = ''; $urlPictoSurchargePaysM = '';
            $sql1 = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur: ".$termName."' AND s.field_book_type_picto_surcharge_value = 'paysM' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
            $result1 = db_query($sql1);  
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $idPictoMSurcharge = $row['nid'];  
              $comValuePaysM = $row['field_book_star_com_picto_value'];       
              $isRemarquablePaysM = $row['field_book_star_on_picto_value'];
              $valueOfPictoSurchargePaysM = $row['field_book_value_picto_surcharge_value'];        
              
              //Si on a une valeur surchargé alors on va chercher le pictogrammes correspondant
              if($valueOfPictoSurchargePaysM != ''){
                //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici bota et interet
                $sql2 = "SELECT d.filepath, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND c.field_book_value_picto_interet_value = ".$valueOfPictoSurchargePaysM." AND t.name = 'Paysager / Mer';";  
                $result2 = db_query($sql2);
                if (!$result2) die('Invalid query: ' . mysql_error());
                else while (  $row  =  db_fetch_array($result2) ) $urlPictoSurchargePaysM = $row['filepath'];
              }        
            }
            if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
            //else create a blank node    
            else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
            $outputPaysM = drupal_get_form($form_id, $node);

            /*
            * PATRIMOINE BATI
            */
            //Get nid of picto_surcharge to load the correct node edit form -> bati
            $idPictoMSurcharge = ''; $comValueBati = ''; $isRemarquableBati = ''; $valueOfPictoSurchargeBati = ''; $urlPictoSurchargeBati = '';
            $sql1 = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur: ".$termName."' AND s.field_book_type_picto_surcharge_value = 'bati' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
            $result1 = db_query($sql1);  
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $idPictoMSurcharge = $row['nid'];  
              $comValueBati = $row['field_book_star_com_picto_value'];       
              $isRemarquableBati = $row['field_book_star_on_picto_value'];
              $valueOfPictoSurchargeBati = $row['field_book_value_picto_surcharge_value'];        
              
              //Si on a une valeur surchargé alors on va chercher le pictogrammes correspondant
              if($valueOfPictoSurchargeBati != ''){
                //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici bota et interet
                $sql2 = "SELECT d.filepath, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND c.field_book_value_picto_interet_value = ".$valueOfPictoSurchargeBati." AND t.name = 'Patrimoine bâti';";  
                $result2 = db_query($sql2);
                if (!$result2) die('Invalid query: ' . mysql_error());
                else while (  $row  =  db_fetch_array($result2) ) $urlPictoSurchargeBati = $row['filepath'];
              }        
            }
            if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
            //else create a blank node    
            else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
            $outputBati = drupal_get_form($form_id, $node);

            /*
            * CREATION DE RICHESSE ECONOMIQUE - MER
            
            //Get nid of picto_surcharge to load the correct node edit form -> orni
            $idPictoMSurcharge = '';
            $sql = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur:".$nid."' AND s.field_book_type_picto_surcharge_value = 'ecoM' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
            $result = db_query($sql);  
            if (!$result) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result) ) {
              $idPictoMSurcharge = $row['nid'];  
              $comValueEcoM = $row['field_book_star_com_picto_value'];       
              $isRemarquableEcoM = $row['field_book_star_on_picto_value'];        
            }
            if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
            //else create a blank node    
            else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
            $outputEcoM = drupal_get_form($form_id, $node);

            /*
            * CREATION DE RICHESSE ECONOMIQUE - TERRE
            
            //Get nid of picto_surcharge to load the correct node edit form -> orni
            $idPictoMSurcharge = '';
            $sql = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur:".$nid."' AND s.field_book_type_picto_surcharge_value = 'ecoT' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
            $result = db_query($sql);  
            if (!$result) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result) ) {
              $idPictoMSurcharge = $row['nid'];  
              $comValueEcoT = $row['field_book_star_com_picto_value'];       
              $isRemarquableEcoT = $row['field_book_star_on_picto_value'];        
            }
            if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
            //else create a blank node    
            else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
            $outputEcoT = drupal_get_form($form_id, $node);*/

            //Transforme value of picto to label
            switch ($labelBota) {
              case 0: $labelBota = 'Pas de données'; break;
              case 1: $labelBota = 'Faible'; break;
              case 2: $labelBota = 'Moyen'; break;
              case 3: $labelBota = 'Fort'; break;    
            } // fin switch  
            switch ($labelOrni) {
              case 0: $labelOrni = 'Pas de données'; break;
              case 1: $labelOrni = 'Faible'; break;
              case 2: $labelOrni = 'Moyen'; break;
              case 3: $labelOrni = 'Fort'; break;    
            } // fin switch  
            switch ($labelHerpe) {
              case 0: $labelHerpe = 'Pas de données'; break;
              case 1: $labelHerpe = 'Faible'; break;
              case 2: $labelHerpe = 'Moyen'; break;
              case 3: $labelHerpe = 'Fort'; break;    
            } // fin switch 
            switch ($labelMami) {
              case 0: $labelMami = 'Pas de données'; break;
              case 1: $labelMami = 'Faible'; break;
              case 2: $labelMami = 'Moyen'; break;
              case 3: $labelMami = 'Fort'; break;    
            } // fin switch
            switch ($labelChiro) {
              case 0: $labelChiro = 'Pas de données'; break;
              case 1: $labelChiro = 'Faible'; break;
              case 2: $labelChiro = 'Moyen'; break;
              case 3: $labelChiro = 'Fort'; break;    
            } // fin switch   
            switch ($valueOfPictoSurchargeInvert) {
              case 0: $valueOfPictoSurchargeInvert = 'Pas de données'; break;
              case 1: $valueOfPictoSurchargeInvert = 'Faible'; break;
              case 2: $valueOfPictoSurchargeInvert = 'Moyen'; break;
              case 3: $valueOfPictoSurchargeInvert = 'Fort'; break;    
            } // fin switch   
            switch ($labelFauneM) {
              case 0: $labelFauneM = 'Pas de données'; break;
              case 1: $labelFauneM = 'Faible'; break;
              case 2: $labelFauneM = 'Moyen'; break;
              case 3: $labelFauneM = 'Fort'; break;    
            } // fin switch 
            switch ($labelFloreM) {
              case 0: $labelFloreM = 'Pas de données'; break;
              case 1: $labelFloreM = 'Faible'; break;
              case 2: $labelFloreM = 'Moyen'; break;
              case 3: $labelFloreM = 'Fort'; break;    
            } // fin switch  
            switch ($labelPaysT) {
              case 0: $labelPaysT = 'Pas de données'; break;
              case 1: $labelPaysT = 'Faible'; break;
              case 2: $labelPaysT = 'Moyen'; break;
              case 3: $labelPaysT = 'Fort'; break;    
            } // fin switch 
            switch ($valueOfPictoSurchargePaysT) {
              case 0: $valueOfPictoSurchargePaysT = 'Pas de données'; break;
              case 1: $valueOfPictoSurchargePaysT = 'Faible'; break;
              case 2: $valueOfPictoSurchargePaysT = 'Moyen'; break;
              case 3: $valueOfPictoSurchargePaysT = 'Fort'; break;    
            } // fin switch  
            switch ($valueOfPictoSurchargePaysM) {
              case 0: $valueOfPictoSurchargePaysM = 'Pas de données'; break;
              case 1: $valueOfPictoSurchargePaysM = 'Faible'; break;
              case 2: $valueOfPictoSurchargePaysM = 'Moyen'; break;
              case 3: $valueOfPictoSurchargePaysM = 'Fort'; break;    
            } // fin switch  
            switch ($labelCreaRichessEcoMer) {
              case 0: $labelCreaRichessEcoMer = 'Pas de données'; break;
              case 1: $labelCreaRichessEcoMer = 'Faible'; break;
              case 2: $labelCreaRichessEcoMer = 'Moyen'; break;
              case 3: $labelCreaRichessEcoMer = 'Fort'; break;    
            } // fin switch
            switch ($labelCreaRichessEcoTerre) {
              case 0: $labelCreaRichessEcoTerre = 'Pas de données'; break;
              case 1: $labelCreaRichessEcoTerre = 'Faible'; break;
              case 2: $labelCreaRichessEcoTerre = 'Moyen'; break;
              case 3: $labelCreaRichessEcoTerre = 'Fort'; break;    
            } // fin switch  
            switch ($valueOfPictoSurchargeGrotteI) {
              case 0: $valueOfPictoSurchargeGrotteI = 'Pas de connaissance'; break;
              case 1: $valueOfPictoSurchargeGrotteI = 'Faible'; break;
              case 2: $valueOfPictoSurchargeGrotteI = 'Moyen'; break;
              case 3: $valueOfPictoSurchargeGrotteI = 'Fort'; break;    
            } // fin switch
            switch ($valueOfPictoSurchargeBati) {
              case 0: $valueOfPictoSurchargeBati = 'Pas de connaissance'; break;
              case 1: $valueOfPictoSurchargeBati = 'Faible'; break;
              case 2: $valueOfPictoSurchargeBati = 'Moyen'; break;
              case 3: $valueOfPictoSurchargeBati = 'Fort'; break;    
            } // fin switch


            ?>
  
            <!-- Botanique -->
            <div class="linePictos">              
              <div class="labelLesPictos interet">
                  <p>INTÉRÊT</p>                
              </div>
              <div class="lesPicto book_les_pictos_interets" data-term="<?php echo $termName; ?>">
                <?php if($urlOfPictoBotaToDisplay != ''): ?>
                  <div class="onePicto expert interet botanique"><?php echo "<img src='$base_url/$urlOfPictoBotaToDisplay' alt='$titleBota' title='$titleBota' />"; ?>
                    <?php         
                    if($isRemarquableBota == '1') echo "<i class='star'>*</i>";
                    ?> 
                    <div class="popup green"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
                        <p class="titleGenrePicto">Interêt des patrimoines</p>
                        <p class="titleTypePicto">Botanique</p>
                        <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoBotaToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelBota; ?></p></div>            
                        <div class="remarquable"><?php if($isRemarquableBota == '1') echo "* Présence d'une espèce remarquable"; ?></div>
                        <div class="commentaire"><?php if($comValueBota != '') echo '<label>Commentaire : </label>'.$comValueBota; ?></div>
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>
                      <div class='edit'>
                        <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
                        <p class="titleGenrePicto">Interêt des patrimoines</p>
                        <p class="titleTypePicto">Botanique</p>            
                        <div class="linePicto">              
                          <?php echo '<div class="myFormOnVisu">'.$outputBota.'</div>'; ?>
                        </div>
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>         
                      </div>
                    </div>
                  </div>
                <?php endif; ?>  
                <!-- Ornithologie -->  
                <?php if($urlOfPictoOrniToDisplay != ''): ?>
                  <div class="onePicto expert interet ornithologie"><?php echo "<img src='$base_url/$urlOfPictoOrniToDisplay' alt='$titleOrni' title='$titleOrni' />"; ?>        
                    <?php         
                    if($isRemarquableOrni == '1') echo "<i class='star'>*</i>";
                    ?>
                    <div class="popup green"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
                        <p class="titleGenrePicto">Interêt des patrimoines</p>
                        <p class="titleTypePicto">Ornithologie</p>
                        <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoOrniToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelOrni; ?></p></div>
                        <div class="remarquable"><?php if($isRemarquableOrni == '1') echo "* Présence d'une espèce remarquable"; ?></div>
                        <div class="commentaire"><?php if($comValueOrni != '') echo '<label>Commentaire : </label>'.$comValueOrni; ?></div>
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>
                      <div class='edit'>
                        <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
                        <p class="titleGenrePicto">Interêt des patrimoines</p>
                        <p class="titleTypePicto">Ornithologie</p>            
                        <div class="linePicto">              
                          <?php echo '<div class="myFormOnVisu">'.$outputOrni.'</div>'; ?>
                        </div>
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>         
                      </div>          
                    </div>
                  </div>
                <?php endif; ?>    
                <!-- Herpétologie --> 
                <?php if($urlOfPictoHerpetoToDisplay != ''): ?>
                  <div class="onePicto expert interet herpetologie"><?php echo "<img src='$base_url/$urlOfPictoHerpetoToDisplay' alt='$titleHerpeto' title='$titleHerpeto' />"; ?>      
                    <?php         
                    if($isRemarquableHerpe == '1') echo "<i class='star'>*</i>";
                    ?>
                    <div class="popup green"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
                        <p class="titleGenrePicto">Interêt des patrimoines</p>
                        <p class="titleTypePicto">Herpétologie</p>
                        <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoHerpetoToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelHerpe; ?></p></div>            
                        <div class="remarquable"><?php if($isRemarquableHerpe == '1') echo "* Présence d'une espèce remarquable"; ?></div>
                        <div class="commentaire"><?php if($comValueHerpe != '') echo '<label>Commentaire : </label>'.$comValueHerpe; ?></div>
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>  
                      <div class='edit'>
                        <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
                        <p class="titleGenrePicto">Interêt des patrimoines</p>
                        <p class="titleTypePicto">Herpétologie</p>            
                        <div class="linePicto">              
                          <?php echo '<div class="myFormOnVisu">'.$outputHerpe.'</div>'; ?>
                        </div>
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>         
                      </div>        
                    </div>
                  </div>
                <?php endif; ?>    
                <!-- Mammifères -->
                <?php if($urlOfPictoMamitoToDisplay != ''): ?>
                  <div class="onePicto expert interet mamifere"><?php echo "<img src='$base_url/$urlOfPictoMamitoToDisplay' alt='$titleMami' title='$titleMami' />"; ?>        
                    <?php         
                    if($isRemarquableMami == '1') echo "<i class='star'>*</i>";
                    ?>
                    <div class="popup green"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
                        <p class="titleGenrePicto">Interêt des patrimoines</p>
                        <p class="titleTypePicto">Mammifères</p>
                        <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoMamitoToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelMami; ?></p></div>            
                        <div class="remarquable"><?php if($isRemarquableMami == '1') echo "* Présence d'une espèce remarquable"; ?></div>
                        <div class="commentaire"><?php if($comValueMami != '') echo '<label>Commentaire : </label>'.$comValueMami; ?></div>
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>
                      <div class='edit'>
                        <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
                        <p class="titleGenrePicto">Interêt des patrimoines</p>
                        <p class="titleTypePicto">Mammifères</p>            
                        <div class="linePicto">              
                          <?php echo '<div class="myFormOnVisu">'.$outputMami.'</div>'; ?>
                        </div>
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>         
                      </div>          
                    </div>
                  </div>
                <?php endif; ?>    
                <!-- Chiroptere -->
                <?php if($urlOfPictoChiroToDisplay != ''): ?>
                  <div class="onePicto expert interet chiroptere"><?php echo "<img src='$base_url/$urlOfPictoChiroToDisplay' alt='$titleChiro' title='$titleChiro' />"; ?>        
                    <?php         
                    if($isRemarquableChiro == '1') echo "<i class='star'>*</i>";
                    ?>
                    <div class="popup green"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
                        <p class="titleGenrePicto">Interêt des patrimoines</p>
                        <p class="titleTypePicto">Chiroptere</p>
                        <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoChiroToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelChiro; ?></p></div>
                        <div class="remarquable"><?php if($isRemarquableChiro == '1') echo "* Présence d'une espèce remarquable"; ?></div>
                        <div class="commentaire"><?php if($comValueChiro != '') echo '<label>Commentaire : </label>'.$comValueChiro; ?></div>
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>
                      <div class='edit'>
                        <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
                        <p class="titleGenrePicto">Interêt des patrimoines</p>
                        <p class="titleTypePicto">Chiroptere</p>            
                        <div class="linePicto">              
                          <?php echo '<div class="myFormOnVisu">'.$outputChiro.'</div>'; ?>
                        </div>
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>         
                      </div>           
                    </div>
                  </div>
                <?php endif; ?>    
                <!-- Invertebré -->
                <div class="onePicto expert interet invert" title='Invertébré'>
                  <?php 
                    if($urlPictoSurchargeInvert) echo "<img class='surcharge' src='$base_url/$urlPictoSurchargeInvert' alt='' title='' />"; 
                    else echo "<i>Expert</i>";        
                    if($isRemarquableInvert == '1') echo "<i class='star'>*</i>";
                  ?>      
                  <div class="popup green"><div class="croix">X</div>
                    <div class='visu'>
                      <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
                      <p class="titleGenrePicto">Interêt des patrimoines</p>
                      <p class="titleTypePicto">Invertebré</p>
                      <div class="linePicto">
                        <?php 
                        if($urlPictoSurchargeInvert != '') echo "<img src='$base_url/$urlPictoSurchargeInvert'/>"; 
                        else echo '<p class="noPicto">Pas de pictogramme</p>';               
                        if($urlPictoSurchargeInvert != '') echo "<p class='labelEtat'>".$valueOfPictoSurchargeInvert."</p>"; 
                        ?>
                      </div>
                      <div class="remarquable"><?php if($isRemarquableInvert == '1') echo "* Présence d'un lieu remarquable"; ?></div>
                      <div class="commentaire"><?php if($comValueInvert != '') echo '<label>Commentaire : </label>'.$comValueInvert; ?></div>
                      <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                    </div>
                    <div class='edit'>
                      <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
                      <p class="titleGenrePicto">Interêt des patrimoines</p>
                      <p class="titleTypePicto">Invertebré</p>            
                      <div class="linePicto">
                        <?php if($urlPictoSurchargeInvert != '') echo "<img src='$base_url/$urlPictoSurchargeInvert'/>"; else echo '<p class="desc">Choisir une valeur pour afficher un pictogramme</p>'; ?>              
                        <?php echo '<div class="myFormOnVisu">'.$outputInvert.'</div>'; ?>              
                      </div>
                      <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>         
                    </div>
                  </div>
                </div>
                <!-- Faune marine -->
                <?php if($urlOfPictoFauneMToDisplay != ''): ?>
                  <div class="onePicto expert interet fauneM"><?php echo "<img src='$base_url/$urlOfPictoFauneMToDisplay' alt='$titleFauneM' title='$titleFauneM' />"; ?>        
                    <?php         
                    if($isRemarquableFauneM_i == '1') echo "<i class='star'>*</i>";
                    ?>
                    <div class="popup green"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
                        <p class="titleGenrePicto">Interêt des patrimoines</p>
                        <p class="titleTypePicto">Faune marine</p>
                        <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoFauneMToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelFauneM; ?></p></div>            
                        <div class="remarquable"><?php if($isRemarquableFauneM_i == '1') echo "* Présence d'une espèce remarquable"; ?></div>
                        <div class="commentaire"><?php if($comValueFauneM_i != '') echo '<label>Commentaire : </label>'.$comValueFauneM_i; ?></div>
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>
                      <div class='edit'>
                        <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
                        <p class="titleGenrePicto">Interêt des patrimoines</p>
                        <p class="titleTypePicto">Faune marine</p>            
                        <div class="linePicto">              
                          <?php echo '<div class="myFormOnVisu">'.$outputFauneM.'</div>'; ?>
                        </div>
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>         
                      </div>          
                    </div>
                  </div>
                <?php endif; ?>    
                <!-- Flore marine -->
                <?php if($urlOfPictoFloreMToDisplay != ''): ?>
                  <div class="onePicto expert interet floreM"><?php echo "<img src='$base_url/$urlOfPictoFloreMToDisplay' alt='$titleFloreM' title='$titleFloreM' />"; ?>      
                    <?php         
                    if($isRemarquableFloreM_i == '1') echo "<i class='star'>*</i>";
                    ?>
                    <div class="popup green"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
                        <p class="titleGenrePicto">Interêt des patrimoines</p>
                        <p class="titleTypePicto">Flore marine</p>
                        <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoFloreMToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelFloreM; ?></p></div>            
                        <div class="remarquable"><?php if($isRemarquableFloreM_i == '1') echo "* Présence d'une espèce remarquable"; ?></div>
                        <div class="commentaire"><?php if($comValueFloreM_i != '') echo '<label>Commentaire : </label>'.$comValueFloreM_i; ?></div>
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>
                      <div class='edit'>
                        <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
                        <p class="titleGenrePicto">Interêt des patrimoines</p>
                        <p class="titleTypePicto">Flore marine</p>            
                        <div class="linePicto">              
                          <?php echo '<div class="myFormOnVisu">'.$outputFloreM.'</div>'; ?>
                        </div>
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>         
                      </div>      
                    </div>
                  </div>
                <?php endif; ?>    
                <!-- Grotte / fond rocheux -->
                <div class="onePicto expert interet grotte" title='Grotte et fond rocheux'>
                  <?php 
                    if($urlPictoSurchargeGrotteI) echo "<img class='surcharge' src='$base_url/$urlPictoSurchargeGrotteI' alt='' title='' />"; 
                    else echo "<i>Expert</i>";        
                    if($isRemarquableGrotteI == '1') echo "<i class='star'>*</i>";
                  ?>      
                  <div class="popup green"><div class="croix">X</div>
                    <div class='visu'>
                      <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
                      <p class="titleGenrePicto">Interêt des patrimoines</p>
                      <p class="titleTypePicto">Grotte / Fond rocheux</p>
                      <div class="linePicto">
                        <?php 
                        if($urlPictoSurchargeGrotteI != '') echo "<img src='$base_url/$urlPictoSurchargeGrotteI'/>"; 
                        else echo '<p class="noPicto">Pas de pictogramme</p>';               
                        if($urlPictoSurchargeGrotteI != '') echo "<p class='labelEtat'>".$valueOfPictoSurchargeGrotteI."</p>"; 
                        ?>
                      </div>
                      <div class="remarquable"><?php if($isRemarquableGrotteI == '1') echo "* Présence d'un lieu remarquable"; ?></div>
                      <div class="commentaire"><?php if($comValueGrotteI != '') echo '<label>Commentaire : </label>'.$comValueGrotteI; ?></div>
                      <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                    </div>
                    <div class='edit'>
                      <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
                      <p class="titleGenrePicto">Interêt des patrimoines</p>
                      <p class="titleTypePicto">Grotte / Fond rocheux</p>            
                      <div class="linePicto">
                        <?php if($urlPictoSurchargeGrotteI != '') echo "<img src='$base_url/$urlPictoSurchargeGrotteI'/>"; else echo '<p class="desc">Choisir une valeur pour afficher un pictogramme</p>'; ?>              
                        <?php echo '<div class="myFormOnVisu">'.$outputGrotte.'</div>'; ?>              
                      </div>
                      <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>         
                    </div>
                  </div>
                </div>
                <!-- Paysage / Terre ici (valeur + surcharge)-->
                <?php if($urlOfPictoPaysTToDisplay != '' || $urlPictoSurchargePaysT != ''): ?>
                <div class="onePicto expert interet paysT">
                    <?php 
                    if($urlPictoSurchargePaysT != '') echo "<img class='surcharge' src='$base_url/$urlPictoSurchargePaysT' alt='' title='' />"; 
                    else echo "<img src='$base_url/$urlOfPictoPaysTToDisplay' alt='' title='' />";      
                    if($isRemarquablePaysT == '1') echo "<i class='star'>*</i>";
                  ?>      
                  <div class="popup green"><div class="croix">X</div>
                    <div class='visu'>
                      <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
                      <p class="titleGenrePicto">Interêt des patrimoines</p>
                      <p class="titleTypePicto">Paysage / Terre</p>
                      <div class="linePicto">
                        <?php 
                        if($urlPictoSurchargePaysT != '') echo "<img src='$base_url/$urlPictoSurchargePaysT'/>"; 
                        else echo "<img src='$base_url/$urlOfPictoPaysTToDisplay'/>"; 
                        if($urlPictoSurchargePaysT != '') echo "<p class='labelEtat'>".$valueOfPictoSurchargePaysT."</p>"; 
                        else echo "<p class='labelEtat'>".$labelPaysT."</p>"; 
                        ?>
                      </div>
                      <div class="remarquable"><?php if($isRemarquablePaysT == '1') echo "* Présence d'un lieu remarquable"; ?></div>
                      <div class="commentaire"><?php if($comValuePaysT != '') echo '<label>Commentaire : </label>'.$comValuePaysT; ?></div>
                      <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                    </div>
                    <div class='edit'>
                      <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
                      <p class="titleGenrePicto">Interêt des patrimoines</p>
                      <p class="titleTypePicto">Paysage / Terre</p>            
                      <div class="linePicto">
                        <?php 
                        if($urlPictoSurchargePaysT != '') echo "<img src='$base_url/$urlPictoSurchargePaysT'/> <p class='desc'>Choisir une valeur pour surcharger le pictogramme</p>";
                        else echo "<img src='$base_url/$urlOfPictoPaysTToDisplay'/>";            
                        echo '<div class="myFormOnVisu">'.$outputPaysT.'</div>'; 
                        ?>              
                      </div>
                      <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>         
                    </div>
                  </div>
                </div>
                <?php endif; ?>
                <!-- Paysage / Mer -->
                <div class="onePicto expert interet paysM" title='Paysage / Mer'>
                  <?php 
                    if($urlPictoSurchargePaysM) echo "<img class='surcharge' src='$base_url/$urlPictoSurchargePaysM' alt='' title='' />"; 
                    else echo "<i>Expert</i>";        
                    if($isRemarquablePaysM == '1') echo "<i class='star'>*</i>";
                  ?>      
                  <div class="popup green"><div class="croix">X</div>
                    <div class='visu'>
                      <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
                      <p class="titleGenrePicto">Interêt des patrimoines</p>
                      <p class="titleTypePicto">Paysage / Mer</p>
                      <div class="linePicto">
                        <?php 
                        if($urlPictoSurchargePaysM != '') echo "<img src='$base_url/$urlPictoSurchargePaysM'/>"; 
                        else echo '<p class="noPicto">Pas de pictogramme</p>';               
                        if($urlPictoSurchargePaysM != '') echo "<p class='labelEtat'>".$valueOfPictoSurchargePaysM."</p>"; 
                        ?>
                      </div>
                      <div class="remarquable"><?php if($isRemarquablePaysM == '1') echo "* Présence d'un lieu remarquable"; ?></div>
                      <div class="commentaire"><?php if($comValuePaysM != '') echo '<label>Commentaire : </label>'.$comValuePaysM; ?></div>
                      <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                    </div>
                    <div class='edit'>
                      <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
                      <p class="titleGenrePicto">Interêt des patrimoines</p>
                      <p class="titleTypePicto">Paysage / Mer</p>            
                      <div class="linePicto">
                        <?php if($urlPictoSurchargePaysM != '') echo "<img src='$base_url/$urlPictoSurchargePaysM'/>"; else echo '<p class="desc">Choisir une valeur pour afficher un pictogramme</p>'; ?>              
                        <?php echo '<div class="myFormOnVisu">'.$outputPaysM.'</div>'; ?>              
                      </div>
                      <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>         
                    </div>
                  </div>
                </div>
                <!-- Patrimoine bâti -->
                <div class="onePicto expert interet bati" title='Patrimoine bâti'>
                  <?php 
                    if($urlPictoSurchargeBati) echo "<img class='surcharge' src='$base_url/$urlPictoSurchargeBati' alt='' title='' />"; 
                    else echo "<i>Expert</i>";        
                    if($isRemarquableBati == '1') echo "<i class='star'>*</i>";
                  ?>      
                  <div class="popup green"><div class="croix">X</div>
                    <div class='visu'>
                      <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
                      <p class="titleGenrePicto">Interêt des patrimoines</p>
                      <p class="titleTypePicto">Patrimoine bâti</p>
                      <div class="linePicto">
                        <?php 
                        if($urlPictoSurchargeBati != '') echo "<img src='$base_url/$urlPictoSurchargeBati'/>"; 
                        else echo '<p class="noPicto">Pas de pictogramme</p>';               
                        if($urlPictoSurchargeBati != '') echo "<p class='labelEtat'>".$valueOfPictoSurchargeBati."</p>"; 
                        ?>
                      </div>
                      <div class="remarquable"><?php if($isRemarquableBati == '1') echo "* Présence d'un lieu remarquable"; ?></div>
                      <div class="commentaire"><?php if($comValueBati != '') echo '<label>Commentaire : </label>'.$comValueBati; ?></div>
                      <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                    </div>
                    <div class='edit'>
                      <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
                      <p class="titleGenrePicto">Interêt des patrimoines</p>
                      <p class="titleTypePicto">Patrimoine bâti</p>            
                      <div class="linePicto">
                        <?php if($urlPictoSurchargeBati != '') echo "<img src='$base_url/$urlPictoSurchargeBati'/>"; else echo '<p class="desc">Choisir une valeur pour afficher un pictogramme</p>'; ?>              
                        <?php echo '<div class="myFormOnVisu">'.$outputBati.'</div>'; ?>              
                      </div>
                      <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>         
                    </div>
                  </div>
                </div>
                <!-- Création de richesse économique (Mer) -->
                <?php if($urlOfPictoEcoMerToDisplay != ''): ?>
                  <div class="onePicto noexpert interet ecoM"><?php echo "<img src='$base_url/$urlOfPictoEcoMerToDisplay' alt='$titleCreaRichessEcoMer' title='$titleCreaRichessEcoMer' />"; ?>                
                    <div class="popup green"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                        <p class="titleGenrePicto">Interêt des patrimoines</p>
                        <p class="titleTypePicto">Création de richesse économique (Mer)</p>
                        <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoEcoMerToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelCreaRichessEcoMer; ?></p></div>                        
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>          
                    </div>
                  </div>
                <?php endif; ?>    
                <!-- Création de richesse économique (Terre) -->
                <?php if($urlOfPictoEcoTerreToDisplay != ''): ?>
                  <div class="onePicto noexpert interet ecoT"><?php echo "<img src='$base_url/$urlOfPictoEcoTerreToDisplay' alt='$titleCreaRichessEcoTerre' title='$titleCreaRichessEcoTerre' />"; ?>                
                    <div class="popup green"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                        <p class="titleGenrePicto">Interêt des patrimoines</p>
                        <p class="titleTypePicto">Création de richesse économique (Terre)</p>
                        <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoEcoTerreToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelCreaRichessEcoTerre; ?></p></div>                        
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>                  
                    </div>
                  </div>
                <?php endif; ?>    
              </div>
            </div>
            <?php  

            /*-- ----------------------------------------------------------------------------
            -- Pressions
            -- ----------------------------------------------------------------------------*/

            //Desserte par navette  
            $sql1 = "select b.niveau from picto_press_denav b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatNavette = $result1['niveau'];
            
            //Présence de bâti
            $sql1 = "select b.niveau from picto_press_preba b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatBati = $result1['niveau'];
              
            //Activités touristisques
            $sql1 = "select b.niveau from picto_press_actou b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatTouriste = $result1['niveau'];
              
            //Présence d'habitants à l'année
            $sql1 = "select b.niveau from picto_press_haban b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatHabitant = $result1['niveau'];  
              
            //Impacts des usages (Terre)
            $sql1 = "select b.niveau from picto_press_imusat b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatUsageTerre = $result1['niveau'];
              
            //Impacts des usages (Mer)
            $sql1 = "select b.niveau from picto_press_imusam b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatUsageMer = $result1['niveau'];
              
            //Espèces envahissantes terrestres
            $sql1 = "select b.niveau from picto_press_eet b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatEspTerre = $result1['niveau'];
              
            //Espèces envahissantes marines
            $sql1 = "select b.niveau from picto_press_eem b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatEspMer = $result1['niveau'];
              
            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Desserte par navette  et Pressions
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_pression_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_pression c ON c.field_book_picto_pression_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_pression_value WHERE n.type = 'book_les_pictos_pression' AND t.name = 'Desserte par navette' ORDER BY c.field_book_value_picto_pression_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsNavette[$row['field_book_value_picto_pression_value']] = $row['filepath']; 
              $rowsLabelNavette [$row['field_book_value_picto_pression_value']] = $row['field_book_value_picto_pression_value'];
              $rowsTitleNavette[$row['field_book_value_picto_pression_value']] = $row['title'];    
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Présence de bâti  et Pressions
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_pression_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_pression c ON c.field_book_picto_pression_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_pression_value WHERE n.type = 'book_les_pictos_pression' AND t.name = 'Présence de bâti' ORDER BY c.field_book_value_picto_pression_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsBati[$row['field_book_value_picto_pression_value']] = $row['filepath']; 
              $rowsLabelBati [$row['field_book_value_picto_pression_value']] = $row['field_book_value_picto_pression_value'];
              $rowsTitleBati[$row['field_book_value_picto_pression_value']] = $row['title'];    
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Activités touristisques et Pressions
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_pression_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_pression c ON c.field_book_picto_pression_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_pression_value WHERE n.type = 'book_les_pictos_pression' AND t.name = 'Activités touristiques' ORDER BY c.field_book_value_picto_pression_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsTouriste[$row['field_book_value_picto_pression_value']] = $row['filepath']; 
              $rowsLabelTouriste [$row['field_book_value_picto_pression_value']] = $row['field_book_value_picto_pression_value'];
              $rowsTitleTouriste[$row['field_book_value_picto_pression_value']] = $row['title'];    
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Présence d'habitants à l'année et Pressions
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_pression_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_pression c ON c.field_book_picto_pression_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_pression_value WHERE n.type = 'book_les_pictos_pression' AND t.name = \"Présence d'habitants à l'année\" ORDER BY c.field_book_value_picto_pression_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsHab[$row['field_book_value_picto_pression_value']] = $row['filepath']; 
              $rowsLabelHab [$row['field_book_value_picto_pression_value']] = $row['field_book_value_picto_pression_value'];
              $rowsTitleHab[$row['field_book_value_picto_pression_value']] = $row['title'];
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Impacts des usages (Terre) et Pressions
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_pression1_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_pression c ON c.field_book_picto_pression_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_pression_value WHERE n.type = 'book_les_pictos_pression' AND t.name = 'Impact des usages / terre' ORDER BY c.field_book_value_picto_pression1_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsUsageT[$row['field_book_value_picto_pression1_value']] = $row['filepath']; 
              $rowsLabelImpactUsageT [$row['field_book_value_picto_pression1_value']] = $row['field_book_value_picto_pression1_value'];
              $rowsTitleImpactUsageT[$row['field_book_value_picto_pression1_value']] = $row['title'];    
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Impacts des usages (Mer) et Pressions
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_pression1_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_pression c ON c.field_book_picto_pression_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_pression_value WHERE n.type = 'book_les_pictos_pression' AND t.name = 'Impact des usages / mer' ORDER BY c.field_book_value_picto_pression1_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsUsageM[$row['field_book_value_picto_pression1_value']] = $row['filepath']; 
              $rowsLabelImpactUsageM [$row['field_book_value_picto_pression1_value']] = $row['field_book_value_picto_pression1_value'];
              $rowsTitleImpactUsageM[$row['field_book_value_picto_pression1_value']] = $row['title'];    
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Espèces envahissantes terrestres et Pressions
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_pression1_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_pression c ON c.field_book_picto_pression_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_pression_value WHERE n.type = 'book_les_pictos_pression' AND t.name = 'Espèces envahissantes / terrestres' ORDER BY c.field_book_value_picto_pression1_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsEspEnvahT[$row['field_book_value_picto_pression1_value']] = $row['filepath']; 
              $rowsLabelEspEnvahT [$row['field_book_value_picto_pression1_value']] = $row['field_book_value_picto_pression1_value'];
              $rowsTitleEspEnvahT[$row['field_book_value_picto_pression1_value']] = $row['title'];    
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Espèces envahissantes marines et Pressions
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_pression1_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_pression c ON c.field_book_picto_pression_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_pression_value WHERE n.type = 'book_les_pictos_pression' AND t.name = 'Espèces envahissantes / marines' ORDER BY c.field_book_value_picto_pression1_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsEspEnvahM[$row['field_book_value_picto_pression1_value']] = $row['filepath']; 
              $rowsLabelEspEnvahM [$row['field_book_value_picto_pression1_value']] = $row['field_book_value_picto_pression1_value'];
              $rowsTitleEspEnvahM[$row['field_book_value_picto_pression1_value']] = $row['title'];    
            }

            //On stock le bon picto en fonction de la valeur
            $urlOfPictoNavetteToDisplay = $rowsNavette[$etatNavette];
            $urlOfPictoEtatBatiToDisplay = $rowsBati[$etatBati];
            $urlOfPictoTouristeToDisplay = $rowsTouriste[$etatTouriste];
            $urlOfPictoHabToDisplay = $rowsHab[$etatHabitant];
            $urlOfPictoUsageTerreToDisplay = $rowsUsageT[$etatUsageTerre];
            $urlOfPictoUsageMerToDisplay = $rowsUsageM[$etatUsageMer];
            $urlOfPictoEspEnvahTerreToDisplay = $rowsEspEnvahT[$etatEspTerre];
            $urlOfPictoEspEnvahMerToDisplay = $rowsEspEnvahM[$etatEspMer];
            
            //On stock le bon label en fonction de la valeur
            $labelNavette = $rowsLabelNavette[$etatNavette];
            $labelBati = $rowsLabelBati[$etatBati];
            $labelTouriste = $rowsLabelTouriste[$etatTouriste];
            $labelHab = $rowsLabelHab[$etatHabitant];
            $labelImpactUsageT = $rowsLabelImpactUsageT[$etatUsageTerre];
            $labelImpactUsageM = $rowsLabelImpactUsageM[$etatUsageMer];
            $labelEspEnvahT = $rowsLabelEspEnvahT[$etatEspTerre];
            $labelEspEnvahM = $rowsLabelEspEnvahM[$etatEspMer];

            //On stock le bon titre en fonction de la valeur
            $titleNavette = $rowsTitleNavette[$etatNavette];
            $titleBati = $rowsTitleBati[$etatBati];
            $titleTouriste = $rowsTitleTouriste[$etatTouriste];
            $titleHab = $rowsTitleHab[$etatHabitant];
            $titleImpactUsageT = $rowsTitleImpactUsageT[$etatUsageTerre];
            $titleImpactUsageM = $rowsTitleImpactUsageM[$etatUsageMer];
            $titleEspEnvahT = $rowsTitleEspEnvahT[$etatEspTerre];
            $titleEspEnvahM = $rowsTitleEspEnvahM[$etatEspMer];


            //Converion du label numérique en string
            switch ($labelNavette) {
              case 0: $labelNavette = '?'; break;
              case 1: $labelNavette = 'Non'; break;
              case 2: $labelNavette = 'Oui'; break;
              case 3: $labelNavette = '---'; break;    
            } // fin switch
            switch ($labelBati) {
              case 0: $labelBati = '?'; break;
              case 1: $labelBati = 'Non'; break;
              case 2: $labelBati = 'Oui'; break;
              case 3: $labelBati = '---'; break;    
            } // fin switch
            switch ($labelTouriste) {
              case 0: $labelTouriste = '?'; break;
              case 1: $labelTouriste = 'Non'; break;
              case 2: $labelTouriste = 'Oui'; break;
              case 3: $labelTouriste = '---'; break;    
            } 
            switch ($labelHab) {
              case 0: $labelHab = '?'; break;
              case 1: $labelHab = 'Non'; break;
              case 2: $labelHab = 'Oui'; break;
              case 3: $labelHab = '---'; break;    
            } 
            switch ($labelImpactUsageT) {
              case 0: $labelImpactUsageT = '?'; break;
              case 1: $labelImpactUsageT = 'Nul'; break;
              case 2: $labelImpactUsageT = 'Faible'; break;
              case 3: $labelImpactUsageT = 'Moyen'; break;    
              case 4: $labelImpactUsageT = 'Fort'; break;    
            } // fin switch
            switch ($labelImpactUsageM) {
              case 0: $labelImpactUsageM = '?'; break;
              case 1: $labelImpactUsageM = 'Nul'; break;
              case 2: $labelImpactUsageM = 'Faible'; break;
              case 3: $labelImpactUsageM = 'Moyen'; break;    
              case 4: $labelImpactUsageM = 'Fort'; break;    
            } // fin switch
            switch ($labelEspEnvahT) {
              case 0: $labelEspEnvahT = '?'; break;
              case 1: $labelEspEnvahT = 'Nul'; break;
              case 2: $labelEspEnvahT = 'Faible'; break;
              case 3: $labelEspEnvahT = 'Moyen'; break;    
              case 4: $labelEspEnvahT = 'Fort'; break;    
            } // fin switch
            switch ($labelEspEnvahM) {
              case 0: $labelEspEnvahM = '?'; break;
              case 1: $labelEspEnvahM = 'Nul'; break;
              case 2: $labelEspEnvahM = 'Faible'; break;
              case 3: $labelEspEnvahM = 'Moyen'; break;    
              case 4: $labelEspEnvahM = 'Fort'; break;    
            } // fin switch

            
            ?>

            <div class="linePictos">              
              <div class="labelLesPictos pression">
                  <p>PRESSIONS</p>                
              </div>
              <div class="lesPicto book_les_pictos_pressions" data-term="<?php echo $termName; ?>">
                <!-- Desserte par navette -->
                <?php if($urlOfPictoNavetteToDisplay != ''): ?>
                  <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoNavetteToDisplay' alt='$titleNavette' title='$titleNavette' />"; ?>
                    <div class="popup red"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                        <p class="titleGenrePicto">Pressions</p>
                        <p class="titleTypePicto">Desserte par navette</p>
                        <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoNavetteToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelNavette; ?></p></div>                        
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>          
                    </div>
                  </div>
                <?php endif; ?>        
                <!-- Présence de bâti -->
                <?php if($urlOfPictoEtatBatiToDisplay != ''): ?>
                  <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoEtatBatiToDisplay' alt='$titleBati' title='$titleBati' />"; ?>
                    <div class="popup red"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                        <p class="titleGenrePicto">Pressions</p>
                        <p class="titleTypePicto">Présence de bâti</p>
                        <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoEtatBatiToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelBati; ?></p></div>                        
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>          
                    </div>
                  </div>
                <?php endif; ?>        
                <!-- Activités touristiques -->
                <?php if($urlOfPictoTouristeToDisplay != ''): ?>
                  <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoTouristeToDisplay' alt='$titleTouriste' title='$titleTouriste' />"; ?>
                    <div class="popup red"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                        <p class="titleGenrePicto">Pressions</p>
                        <p class="titleTypePicto">Activités touristiques</p>
                        <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoTouristeToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelTouriste; ?></p></div>                        
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>          
                    </div>
                  </div>
                <?php endif; ?>        
                <!-- Présence d'habitants à l'année -->
                <?php if($urlOfPictoHabToDisplay != ''): ?>
                  <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoHabToDisplay' alt='$titleHab' title='$titleHab' />"; ?>
                    <div class="popup red"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                        <p class="titleGenrePicto">Pressions</p>
                        <p class="titleTypePicto">Présence d'habitants à l'année</p>
                        <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoHabToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelHab; ?></p></div>                        
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>          
                    </div>
                  </div>
                <?php endif; ?>   
                <!-- Impacts des usages / Terre -->     
                <?php if($urlOfPictoUsageTerreToDisplay != ''): ?>
                  <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoUsageTerreToDisplay' alt='$titleImpactUsageT' title='$titleImpactUsageT' />"; ?>
                    <div class="popup red"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                        <p class="titleGenrePicto">Pressions</p>
                        <p class="titleTypePicto">Impacts des usages / Terre</p>
                        <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoUsageTerreToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelImpactUsageT; ?></p></div>                        
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>          
                    </div>
                  </div>
                <?php endif; ?>        
                <!-- Impacts des usages / Mer -->     
                <?php if($urlOfPictoUsageMerToDisplay != ''): ?>
                  <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoUsageMerToDisplay' alt='$titleImpactUsageM' title='$titleImpactUsageM' />"; ?>
                    <div class="popup red"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                        <p class="titleGenrePicto">Pressions</p>
                        <p class="titleTypePicto">Impacts des usages / Mer</p>
                        <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoUsageMerToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelImpactUsageM; ?></p></div>                        
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>          
                    </div>
                  </div>
                <?php endif; ?>        
                <!-- Espèces envahissantes / Terrestres -->
                <?php if($urlOfPictoEspEnvahTerreToDisplay != ''): ?>
                  <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoEspEnvahTerreToDisplay' alt='$titleEspEnvahT' title='$titleEspEnvahT' />"; ?>
                    <div class="popup red"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                        <p class="titleGenrePicto">Pressions</p>
                        <p class="titleTypePicto">Espèces envahissantes / Terrestres</p>
                        <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoEspEnvahTerreToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelEspEnvahT; ?></p></div>                        
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>          
                    </div>
                  </div>
                <?php endif; ?>        
                <!-- Espèces envahissantes / Marines -->
                <?php if($urlOfPictoEspEnvahMerToDisplay != ''): ?>
                  <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoEspEnvahMerToDisplay' alt='$titleEspEnvahM' title='$titleEspEnvahM' />"; ?>
                    <div class="popup red"><div class="croix">X</div>
                      <div class='visu'>
                        <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                        <p class="titleGenrePicto">Pressions</p>
                        <p class="titleTypePicto">Espèces envahissantes / Marines</p>
                        <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoEspEnvahMerToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelEspEnvahM; ?></p></div>                        
                        <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                      </div>          
                    </div>    
                  </div>
                <?php endif; ?>        
              </div>
            </div>


            <?php


            /*-- ----------------------------------------------------------------------------
            -- Gestion / Conservation
            -- ----------------------------------------------------------------------------*/

            //Statut de protection terrestre
            $sql1 = "select b.niveau from picto_gecon_spt b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatProtectionT = $result1['niveau'];
            
            //Statut de protection marin
            $sql1 = "select b.niveau from picto_gecon_spm b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatProtectionM = $result1['niveau'];
            
            //Existence d'un gestionnaire
            $sql1 = "select b.niveau from picto_press_pregest b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatGestion = $result1['niveau'];
            
            //Existence d'un gestionnaire sur le site
            $sql1 = "select b.niveau from picto_press_exgest b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatGestionSite = $result1['niveau'];
            
            //Comité de gestion
            $sql1 = "select b.niveau from picto_press_cogest b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatComiteGestion = $result1['niveau'];
            
            //Moyens disponibles
            $sql1 = "select b.niveau from picto_press_moydi b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatMoyenDispo = $result1['niveau'];
            
            //Plan de gestion
            $sql1 = "select b.niveau from picto_press_plagest b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatPlanGestion = $result1['niveau'];
            
            //Accès autorisé sur le site
            $sql1 = "select b.niveau from picto_press_accaut b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatAccesAutoSite = $result1['niveau'];
            
            //Pêche autorisée sur le site
            $sql1 = "select b.niveau from picto_press_pecaut b where code_ile = '".$termName."'";           
            $result1 = db_query($sql1);
            $result1 = db_fetch_array($result1); 
            $etatPecheAutoSite = $result1['niveau'];
            
            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Statut de protection terrestre et Gestion / Conservation
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_gestions_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = 'Statut de protection terrestre' ORDER BY c.field_book_value_picto_gestions_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsProtecT[$row['field_book_value_picto_gestions_value']] = $row['filepath']; 
              $rowsLabelProtectT [$row['field_book_value_picto_gestions_value']] = $row['field_book_value_picto_gestions_value'];
              $rowsTitleProtectT[$row['field_book_value_picto_gestions_value']] = $row['title'];    
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Statut de protection marin et Gestion / Conservation
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_gestions_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = 'Statut de protection marin' ORDER BY c.field_book_value_picto_gestions_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsProtecM[$row['field_book_value_picto_gestions_value']] = $row['filepath']; 
              $rowsLabelProtectM [$row['field_book_value_picto_gestions_value']] = $row['field_book_value_picto_gestions_value'];
              $rowsTitleProtectM[$row['field_book_value_picto_gestions_value']] = $row['title'];
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Existence d'un gestionnaire et Gestion / Conservation
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_gestions_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = \"Existence d'un gestionnaire\" ORDER BY c.field_book_value_picto_gestions_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsExistGestion[$row['field_book_value_picto_gestions_value']] = $row['filepath']; 
              $rowsLabelExistGestion [$row['field_book_value_picto_gestions_value']] = $row['field_book_value_picto_gestions_value'];
              $rowsTitleExistGestion[$row['field_book_value_picto_gestions_value']] = $row['title'];
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici "Existence d'un gestionnaire sur le site" et Gestion / Conservation
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_gestions1_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = 'Présence du gestionnaire sur le site' ORDER BY c.field_book_value_picto_gestions1_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsExistGestionSite[$row['field_book_value_picto_gestions1_value']] = $row['filepath']; 
              $rowsLabelExistGestionSite [$row['field_book_value_picto_gestions1_value']] = $row['field_book_value_picto_gestions1_value'];
              $rowsTitleExistGestionSite[$row['field_book_value_picto_gestions1_value']] = $row['title'];
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici "Comité de gestion" et Gestion / Conservation
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_gestions_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = 'Comité de gestion' ORDER BY c.field_book_value_picto_gestions_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsComiteGestion[$row['field_book_value_picto_gestions_value']] = $row['filepath']; 
              $rowsLabelComiteGestion [$row['field_book_value_picto_gestions_value']] = $row['field_book_value_picto_gestions_value'];
              $rowsTitleComiteGestion[$row['field_book_value_picto_gestions_value']] = $row['title'];
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici "Moyens disponibles" et Gestion / Conservation
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_gestions2_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = 'Moyens disponibles' ORDER BY c.field_book_value_picto_gestions2_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsMoyensDispo[$row['field_book_value_picto_gestions2_value']] = $row['filepath']; 
              $rowsLabelMoyensDispo [$row['field_book_value_picto_gestions2_value']] = $row['field_book_value_picto_gestions2_value'];
              $rowsTitleMoyensDispo[$row['field_book_value_picto_gestions2_value']] = $row['title'];
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici "Plan de gestion" et Gestion / Conservation
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_gestions3_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = 'Plan de gestion' ORDER BY c.field_book_value_picto_gestions3_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsPlanGestion[$row['field_book_value_picto_gestions3_value']] = $row['filepath']; 
              $rowsLabelPlanGestion [$row['field_book_value_picto_gestions3_value']] = $row['field_book_value_picto_gestions3_value'];
              $rowsTitlePlanGestion[$row['field_book_value_picto_gestions3_value']] = $row['title'];
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici "Accès autorisé sur le site" et Gestion / Conservation
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_gestions_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = 'Accès autorisé sur le site' ORDER BY c.field_book_value_picto_gestions_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsAcces[$row['field_book_value_picto_gestions_value']] = $row['filepath']; 
              $rowsLabelAcces [$row['field_book_value_picto_gestions_value']] = $row['field_book_value_picto_gestions_value'];
              $rowsTitleAcces[$row['field_book_value_picto_gestions_value']] = $row['title'];
            }

            //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici "Pêche autorisée sur le site" et Gestion / Conservation
            $sql1 = "SELECT d.filepath, c.field_book_value_picto_gestions_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = 'Pêche autorisée sur le site' ORDER BY c.field_book_value_picto_gestions_value ASC;";  
            $result1 = db_query($sql1);
            if (!$result1) die('Invalid query: ' . mysql_error());
            else while (  $row  =  db_fetch_array($result1) ) {
              $rowsPeche[$row['field_book_value_picto_gestions_value']] = $row['filepath']; 
              $rowsLabelPeche [$row['field_book_value_picto_gestions_value']] = $row['field_book_value_picto_gestions_value'];
              $rowsTitlePeche[$row['field_book_value_picto_gestions_value']] = $row['title'];
            }

            //On stock le bon picto en fonction de la valeur
            $urlOfPictoProtecTerreToDisplay = $rowsProtecT[$etatProtectionT];
            $urlOfPictoProtecMerToDisplay = $rowsProtecM[$etatProtectionM];
            $urlOfPictoExisteGestionToDisplay = $rowsExistGestion[$etatGestion];
            $urlOfPictoExisteGestionSiteToDisplay = $rowsExistGestionSite[$etatGestionSite];
            $urlOfPictoEtatComiteGestionToDisplay = $rowsComiteGestion[$etatComiteGestion];
            $urlOfPictoMoyensDispoToDisplay = $rowsMoyensDispo[$etatMoyenDispo];
            $urlOfPictoPlanGestionToDisplay = $rowsPlanGestion[$etatPlanGestion];
            $urlOfPictoAccesToDisplay = $rowsAcces[$etatAccesAutoSite];
            $urlOfPictoPecheToDisplay = $rowsPeche[$etatPecheAutoSite];

            //On stock le bon label en fonction de la valeur
            $labelStatutProtecT = $rowsLabelProtectT[$etatProtectionT];
            $labelStatutProtecM = $rowsLabelProtectM[$etatProtectionM];
            $labelGestion = $rowsLabelExistGestion[$etatGestion];
            $labelGestionSite = $rowsLabelExistGestionSite[$etatGestionSite];
            $labelComiteGestion = $rowsLabelComiteGestion[$etatComiteGestion];
            $labelMoyensDispo = $rowsLabelMoyensDispo[$etatMoyenDispo];
            $labelPlanGestion = $rowsLabelPlanGestion[$etatPlanGestion];
            $labelAccesAutoSite = $rowsLabelAcces[$etatAccesAutoSite];
            $labelPecheAuto = $rowsLabelPeche[$etatPecheAutoSite];

            //On stock le bon titre en fonction de la valeur
            $titleStatutProtecT = $rowsTitleProtecT[$etatProtectionT];
            $titleStatutProtecM = $rowsTitleProtecM[$etatProtectionM];
            $titleGestion = $rowsTitleExistGestion[$etatGestion];
            $titleGestionSite = $rowsTitleExistGestionSite[$etatGestionSite];
            $titleComiteGestion = $rowsTitleComiteGestion[$etatComiteGestion];
            $titleMoyensDispo = $rowsTitleMoyensDispo[$etatMoyenDispo];
            $titlePlanGestion = $rowsTitlePlanGestion[$etatPlanGestion];
            $titleAccesAutoSite = $rowsTitleAcces[$etatAccesAutoSite];
            $titlePecheAuto = $rowsTitlePeche[$etatPecheAutoSite];

            //Transforme value of picto to label
            switch ($labelStatutProtecT) {
              case 0: $labelStatutProtecT = '?'; break;
              case 1: $labelStatutProtecT = 'Non'; break;
              case 2: $labelStatutProtecT = 'Oui'; break;
              case 3: $labelStatutProtecT = '---'; break;    
            } // fin switch
            //Transforme value of picto to label
            switch ($labelStatutProtecM) {
              case 0: $labelStatutProtecM = '?'; break;
              case 1: $labelStatutProtecM = 'Non'; break;
              case 2: $labelStatutProtecM = 'Oui'; break;
              case 3: $labelStatutProtecM = '---'; break;    
            } // fin switch
          //Transforme value of picto to label
            switch ($labelGestion) {
              case 0: $labelGestion = '?'; break;
              case 1: $labelGestion = 'Non'; break;
              case 2: $labelGestion = 'Oui'; break;
              case 3: $labelGestion = '---'; break;    
            } // fin switch
            switch ($labelGestionSite) {
              case 0: $labelGestionSite = '?'; break;
              case 1: $labelGestionSite = 'Nul'; break;
              case 2: $labelGestionSite = 'Temporaire'; break;
              case 3: $labelGestionSite = 'Permanente'; break;    
            } // fin switch
            switch ($labelComiteGestion) {
              case 0: $labelComiteGestion = '?'; break;
              case 1: $labelComiteGestion = 'Non'; break;
              case 2: $labelComiteGestion = 'Oui'; break;
              case 3: $labelComiteGestion = '---'; break;    
            } // fin switch
            switch ($labelMoyensDispo) {
              case 0: $labelMoyensDispo = '?'; break;
              case 1: $labelMoyensDispo = 'Nuls'; break;
              case 2: $labelMoyensDispo = 'Corrects'; break;
              case 3: $labelMoyensDispo = 'Importants'; break;    
            } // fin switch
            switch ($labelPlanGestion) {
              case 0: $labelPlanGestion = '?'; break;
              case 1: $labelPlanGestion = 'Non'; break;
              case 2: $labelPlanGestion = 'En projet'; break;
              case 3: $labelPlanGestion = 'Oui'; break;    
            } // fin switch
            switch ($labelAccesAutoSite) {
              case 0: $labelAccesAutoSite = '?'; break;
              case 1: $labelAccesAutoSite = 'Non'; break;    
              case 2: $labelAccesAutoSite = 'Oui'; break;    
              case 3: $labelAccesAutoSite = '---'; break;    
            } // fin switch
            switch ($labelPecheAuto) {
              case 0: $labelPecheAuto = '?'; break;
              case 1: $labelPecheAuto = 'Non'; break;    
              case 2: $labelPecheAuto = 'Oui'; break;    
              case 3: $labelPecheAuto = '---'; break;    
            } // fin switch


            ?>

            <div class="linePictos">
              
              <div class="labelLesPictos gestion">
                  <p>GESTION <br/> CONSERVATION</p>                
              </div>
              <div class="lesPicto book_les_pictos_gestions" data-term="<?php echo $termName; ?>">
              <!-- Statut de protection terrestre -->
              <?php if($urlOfPictoProtecTerreToDisplay != ''): ?>
                <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoProtecTerreToDisplay' alt='$titleStatutProtecT' title='$titleStatutProtecT' />"; ?>
                  <div class="popup marron"><div class="croix">X</div>
                    <div class='visu'>
                      <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                      <p class="titleGenrePicto">Gestion / Conservation</p>
                      <p class="titleTypePicto">Statut de protection terrestre</p>
                      <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoProtecTerreToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelStatutProtecT; ?></p></div>                        
                      <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                    </div>          
                  </div>
                </div>
              <?php endif; ?>  
              <!-- Statut de protection marin -->          
              <?php if($urlOfPictoProtecMerToDisplay != ''): ?>
                <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoProtecMerToDisplay' alt='$titleStatutProtecM' title='$titleStatutProtecM' />"; ?>
                  <div class="popup marron"><div class="croix">X</div>
                    <div class='visu'>
                      <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                      <p class="titleGenrePicto">Gestion / Conservation</p>
                      <p class="titleTypePicto">Statut de protection marin</p>
                      <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoProtecMerToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelStatutProtecM; ?></p></div>                        
                      <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                    </div>          
                  </div>
                </div>
              <?php endif; ?>  
              <!-- Existence d'un gestionaire -->          
              <?php if($urlOfPictoExisteGestionToDisplay != ''): ?>
                <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoExisteGestionToDisplay' alt='$titleGestion' title='$titleGestion' />"; ?>
                  <div class="popup marron"><div class="croix">X</div>
                    <div class='visu'>
                      <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                      <p class="titleGenrePicto">Gestion / Conservation</p>
                      <p class="titleTypePicto">Existence d'un gestionaire</p>
                      <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoExisteGestionToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelGestion; ?></p></div>                        
                      <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                    </div>          
                  </div>
                </div>
              <?php endif; ?>            
              <!-- Existence d'un gestionaire sur le site -->          
              <?php if($urlOfPictoExisteGestionSiteToDisplay != ''): ?>
                <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoExisteGestionSiteToDisplay' alt='$titleGestionSite' title='$titleGestionSite' />"; ?>
                  <div class="popup marron"><div class="croix">X</div>
                    <div class='visu'>
                      <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                      <p class="titleGenrePicto">Gestion / Conservation</p>
                      <p class="titleTypePicto">Existence d'un gestionaire sur le site</p>
                      <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoExisteGestionSiteToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelGestionSite; ?></p></div>                        
                      <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                    </div>          
                  </div>
                </div>
              <?php endif; ?>  
              <!-- Comité de gestion -->          
              <?php if($urlOfPictoEtatComiteGestionToDisplay != ''): ?>
                <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoEtatComiteGestionToDisplay' alt='$titleComiteGestion' title='$titleComiteGestion' />"; ?>
                  <div class="popup marron"><div class="croix">X</div>
                    <div class='visu'>
                      <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                      <p class="titleGenrePicto">Gestion / Conservation</p>
                      <p class="titleTypePicto">Comité de gestion</p>
                      <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoEtatComiteGestionToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelComiteGestion; ?></p></div>                        
                      <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                    </div>          
                  </div>
                </div>
              <?php endif; ?>            
              <!-- Moyens Disponibles -->
              <?php if($urlOfPictoMoyensDispoToDisplay != ''): ?>
                <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoMoyensDispoToDisplay' alt='$titleMoyensDispo' title='$titleMoyensDispo' />"; ?>
                  <div class="popup marron"><div class="croix">X</div>
                    <div class='visu'>
                      <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                      <p class="titleGenrePicto">Gestion / Conservation</p>
                      <p class="titleTypePicto">Comité de gestion</p>
                      <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoMoyensDispoToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelMoyensDispo; ?></p></div>                        
                      <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                    </div>          
                  </div>
                </div>
              <?php endif; ?>            
              <!-- Plan de gestion -->
              <?php if($urlOfPictoPlanGestionToDisplay != ''): ?>
                <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoPlanGestionToDisplay' alt='$titlePlanGestion' title='$titlePlanGestion' />"; ?>
                  <div class="popup marron"><div class="croix">X</div>
                    <div class='visu'>
                      <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                      <p class="titleGenrePicto">Gestion / Conservation</p>
                      <p class="titleTypePicto">Plan de gestion</p>
                      <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoPlanGestionToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelPlanGestion; ?></p></div>                        
                      <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                    </div>          
                  </div>
                </div>
              <?php endif; ?>        
              <!-- Accès autorisé sur le site -->    
              <?php if($urlOfPictoAccesToDisplay != ''): ?>
                <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoAccesToDisplay' alt='$titleAccesAutoSite' title='$titleAccesAutoSite' />"; ?>
                  <div class="popup marron"><div class="croix">X</div>
                    <div class='visu'>
                      <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                      <p class="titleGenrePicto">Gestion / Conservation</p>
                      <p class="titleTypePicto">Accès autorisé sur le site</p>
                      <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoAccesToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelAccesAutoSite; ?></p></div>                        
                      <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                    </div>          
                  </div>
                </div>
              <?php endif; ?>
              <!-- Pêche autorisé sur le site -->            
              <?php if($urlOfPictoPecheToDisplay != ''): ?>
                <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoPecheToDisplay' alt='$titlePecheAuto' title='$titlePecheAuto' />"; ?>
                  <div class="popup marron"><div class="croix">X</div>
                    <div class='visu'>
                      <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
                      <p class="titleGenrePicto">Gestion / Conservation</p>
                      <p class="titleTypePicto">Pêche autorisé sur le site</p>
                      <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoPecheToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelPecheAuto; ?></p></div>                        
                      <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
                    </div>          
                  </div>
                </div>
              <?php endif; ?>            
            </div>
          </div>
            
          <?php  
            
          }//Fin while query all bdd island
        
          
          //Get pager
          $sql = "SELECT count( c.name ) nb_island                 
          FROM drp_content_type_bd_i_description_physique p
          JOIN drp_term_data c
          ON c.tid = p.field_bdi_dp_zone_geographique_value  
          LEFT JOIN ( 
              select tid,min(tsid) tsid
              from drp_term_synonym 
              where name not like ''
              group by tid
              order by tid
            ) Sy 
          ON Sy.tid = p.field_bdi_dp_nom_ile_code_ile_value 
          LEFT JOIN  drp_term_synonym s ON s.tid = Sy.tid and s.tsid = Sy.tsid        
          WHERE COALESCE(p.field_bdi_dp_ispim_island_value,'Oui') = 'Oui' 
          AND p.field_bdi_dp_code_ile_value is not null
          AND c.name NOT LIKE 'Adriatique Ouest'
          AND c.name NOT LIKE 'Chypre'
          AND c.name NOT LIKE 'Crète'
          AND c.name NOT LIKE 'Egypte-Nord' 
          AND c.name NOT LIKE 'Est-Méditerranée'
          AND c.name NOT LIKE 'Illyrie'
          AND c.name NOT LIKE 'Italie - Sud'
          AND c.name NOT LIKE 'Libye'
          AND p.field_bdi_dp_code_ile_value not LIKE '%0'
          AND c.name LIKE '".$ssbassin."';";

          $result = db_query($sql);    
          $result = db_fetch_array($result);   

          echo "<br/><p class='nbIsland'>Nombre d'îles dans ce sous-bassin: ".$result['nb_island']."</p>";

          //Display pager
          echo "<div class='pager'>";
          for($i=0;$i<($result['nb_island'] / 3);$i++){
            if($pager == $i) echo "<a href='pictos-par-sous-bassin?ssbassin=$ssbassin&pager=$i' class='itemPager active'>$i</a>";
            else echo "<a href='pictos-par-sous-bassin?ssbassin=$ssbassin&pager=$i' class='itemPager'>$i</a>";
          }
          echo "</div>";


          ?>
        </div>

        <?php print $content_bottom; ?>

        <?php if ($feed_icons): ?>
          <div class="feed-icons"><?php print $feed_icons; ?></div>
        <?php endif; ?>

      </div></div><!-- /.section, /#content -->

      <?php print $sidebar_first; ?>

      <?php print $sidebar_second; ?>
    
     <div class="mr-propre"></div>

    </div>
		</div><!-- /#main, /#main-wrapper -->
  
  <div class="mr-propre"></div>


  </div></div><!-- /#page, /#page-wrapper -->
  
  <!-- photo ile -->
<div id="ile-background">
    
    
  <!-- footer -->
  <?php if ($footer || $footer_message || $secondary_links): ?>
      <div id="footer">
        <div class="section">

        <?php print theme(array('links__system_secondary_menu', 'links'), $secondary_links,
          array(
            'id' => 'secondary-menu',
            'class' => 'links clearfix',
          ),
          array(
            'text' => t('Secondary menu'),
            'level' => 'h2',
            'class' => 'element-invisible',
          ));
        ?>

        <?php if ($footer_message): ?>
          <div id="footer-message"><?php print $footer_message; ?></div>
        <?php endif; ?>

        <?php print $footer; ?>

        </div>
      </div><!-- /.section, /#footer -->
    <?php endif; ?>
    <!-- end footer -->
    
</div>
<!-- end photo ile -->

  <div class="mr-propre"></div>
  <?php print $page_closure; ?>

  <?php print $closure; ?>

</body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-28879746-1', 'initiative-pim.org');
  ga('send', 'pageview');

  jQuery( document ).ready(function() {

    // Tout ce qu'il se passe autour des pictogrammes et clic dessus avec l'ouverture de la popup
    var gestionPopup = function(){


      //Event de fermeture de la popup
      jQuery('.croix').click(function(event) {
        /* Act on the event */        
        thePopup = jQuery(this).parent();
         thePopup.hide();        
      });
      
      
      //Alter label select value
      jQuery('.onePicto.expert.connaissance.grotte #edit-field-book-value-picto-surcharge-value-2 option').each(function(index, el) {        
        var myOption = jQuery(this);
        if(index == 0) myOption.text('--'); else if(index == 1) myOption.text('Pas de connaissance'); else if(index == 2) myOption.text('Fond sableux'); else if(index == 3) myOption.text('Fond rocheux'); else if(index == 4) myOption.text('Grottes');
      });     

      //Alter label on interet select
      jQuery('.onePicto.expert.interet').each(function(posPicto, el) {

        var onePicto = jQuery(this);

        onePicto.find('.popup .edit .myFormOnVisu .standard > .form-item').each(function(posFormItem, elem) {
          
          var myItem = jQuery(this);

          if(posFormItem == 3) myItem.find('select option').each(function(index, el) {

            myOption = jQuery(this);
  
            if(index == 0) myOption.text('--');
            else if(index == 1) myOption.text('Pas de connaissance'); 
            else if(index == 2) myOption.text('Faible'); 
            else if(index == 3) myOption.text('Moyen'); 
            else if(index == 4) myOption.text('Fort');
            
          });

        });

      });

      
      var base_url = "<?php Print($base_url); ?>";
      

      jQuery('div.lesPicto div.onePicto').click(function(event) {
      /* Stuff to do when the mouse enters the element */
      var thePictoClique = jQuery(this);
      var popup = thePictoClique.find('div.popup');
      var editBtn = popup.find('a.editPicto');
      var visuBtn = popup.find('a.visuPicto');
      var visuZone = popup.find('.visu');
      var editZone = popup.find('.edit');
      var term = thePictoClique.parent('.lesPicto').attr('data-term');
            
                    
      //Print genre et type in popup
      popup.find('.form-item').each(function(index, el) {    
        if(index == 0)  jQuery(this).find('input').val("picto surcharge sur: "+term);
        if(index == 17) jQuery(this).find('input').val(thePictoClique.attr('class').split(' ')[2]);
        if(index == 18) jQuery(this).find('input').val(thePictoClique.attr('class').split(' ')[3]);
      });      

      //To toogle show hide popup
      jQuery('.popup.active').hide();
      popup.addClass('active');

      
      //On clikc Edit button in the popup
      editBtn.click(function(event) {        
        //disable link <a>
        event.preventDefault();        
        //toggle blocks
        editBtn.addClass('select');
        visuBtn.removeClass('select');
        visuZone.hide();
        editZone.show();        

      });

      visuBtn.click(function(event) {        
        //disable link <a>
        event.preventDefault();
        //toggle blocks
        visuBtn.addClass('select');
        editBtn.removeClass('select');
        visuZone.show();
        editZone.hide();

      });

      //Show Popup
      if(event.target.className != 'croix') {
        popup.show();
        popup.addClass('active');
      }



      });// fin click
  
    } //fin gestionPopup
    
    gestionPopup();    

  });

</script>
</html>
