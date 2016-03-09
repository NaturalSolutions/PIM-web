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
          <h1>Pictogrammes par sous-bassins</h1>
          <?php 
         
          //Get param in url for pager
          if(isset($_GET["pager"])) $pager = $_GET["pager"];
          else $pager = 0; 

          //Select all island of PIM BDD
          $sql = "SELECT p.field_bdi_dp_code_ile_value, 
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
                              replace(c.name,'Algérie','Algeria'),      
                            'Tunisie-Nord','Tunisie-Nord'),
                                          'Tunisie-Est','Eastern Tunisia'),
                                      'Sicile','Sicily'),
                                  'Sardaigne','Sardinia'),
                              'Malte','Malta'),
                          'Italie - Sud','Italy Tyrrhenian'),
                'Espagne-Sud et Est','Eastern Spain'),
                  'Corse','Corsica'),
            'Adriatique Ouest','Italy Tyrrhenian'),
          'Baléares','Balearic Islands') nameSousBassin
          FROM drp_content_type_bd_i_description_physique p
          LEFT JOIN drp_term_data c
          ON c.tid = p.field_bdi_dp_zone_geographique_value
          WHERE p.field_bdi_dp_ispim_island_value = 'Oui' 
          OR p.field_bdi_dp_ispim_island_value IS NULL
          ORDER BY nameSousBassin ASC LIMIT 10 OFFSET ".$pager."0;";           

          $result = db_query($sql);    
          $cpt = 0;                  
          //Display
          if (!$result) die('Invalid query: ' . mysql_error());
          else while (  $row  =  db_fetch_array($result) ) {
            
            //Si le nom du sous bassin est different de l'ancien on l'affiche
            if($row['nameSousBassin'] != $tabOfNameSousBassin[$cpt -1]) echo "<h2>".$row['nameSousBassin']."</h2>";
            
            //Stock ancien nom du sous bassin pour comparaison
            $tabOfNameSousBassin[$cpt] = $row['nameSousBassin'];
            //Increment compteur
            $cpt++;

            //Get termName
            $termName = $row['field_bdi_dp_code_ile_value'];     
            $myTerm = taxonomy_get_term_by_name($termName);
            $myTid = $myTerm[0]->tid;
            $allSyno = taxonomy_get_synonyms($myTid);
            $firstSyno = $allSyno[0];

            //Affichage island
            echo "<p><a target='_blank' class='titleIsland' href='$base_url/fiche-Ile/$termName'>".$firstSyno."</a></p>";            

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
                      <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$termName"; ?>'>Donnée dans la base</a>
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
            <?php  
            
          }
          
          //Get pager
          $sql = "SELECT p.field_bdi_dp_code_ile_value, c.name          
          FROM drp_content_type_bd_i_description_physique p
          LEFT JOIN drp_term_data c
          ON c.tid = p.field_bdi_dp_zone_geographique_value
          WHERE p.field_bdi_dp_ispim_island_value = 'Oui' 
          OR p.field_bdi_dp_ispim_island_value IS NULL;";     
          $result = db_query($sql);          
          echo "Nombre d'îles : ".$result->num_rows."<br/>";

          //Display pager
          echo "<div class='pager'>";
          for($i=1;$i<($result->num_rows / 10);$i++){
            if($pager == $i) echo "<a href='pictos-par-sous-bassin?pager=$i' class='itemPager active'>$i</a>";
            else echo "<a href='pictos-par-sous-bassin?pager=$i' class='itemPager'>$i</a>";
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



      /*jQuery('.onePicto.expert.connaissance.fauneM #edit-title-wrapper input').val("picto surcharge sur: "+term);
      jQuery('.onePicto.expert.connaissance.floreM #edit-title-1-wrapper input').val("picto surcharge sur: "+term);
      jQuery('.onePicto.expert.connaissance.grotte #edit-title-2-wrapper input').val("picto surcharge sur: "+term);
      jQuery('.onePicto.expert.interet.botanique #edit-title-3-wrapper input').val("picto surcharge sur: "+term);
      jQuery('.onePicto.expert.interet.ornithologie #edit-title-4-wrapper input').val("picto surcharge sur: "+term);
      jQuery('.onePicto.expert.interet.herpetologie #edit-title-5-wrapper input').val("picto surcharge sur: "+term);
      jQuery('.onePicto.expert.interet.mamifere #edit-title-6-wrapper input').val("picto surcharge sur: "+term);
      jQuery('.onePicto.expert.interet.chiroptere #edit-title-7-wrapper input').val("picto surcharge sur: "+term);
      jQuery('.onePicto.expert.interet.invert #edit-title-8-wrapper input').val("picto surcharge sur: "+term);
      jQuery('.onePicto.expert.interet.fauneM #edit-title-9-wrapper input').val("picto surcharge sur: "+term);
      jQuery('.onePicto.expert.interet.floreM #edit-title-10-wrapper input').val("picto surcharge sur: "+term);
      jQuery('.onePicto.expert.interet.grotte #edit-title-11-wrapper input').val("picto surcharge sur: "+term);
      jQuery('.onePicto.expert.interet.paysT #edit-title-12-wrapper input').val("picto surcharge sur: "+term);
      jQuery('.onePicto.expert.interet.paysM #edit-title-13-wrapper input').val("picto surcharge sur: "+term);
      jQuery('.onePicto.expert.interet.bati #edit-title-14-wrapper input').val("picto surcharge sur: "+term);*/
      
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
      

      jQuery('div.lesPicto div.onePicto').click(function(event) {
      /* Stuff to do when the mouse enters the element */
      var thePictoClique = jQuery(this);
      var popup = thePictoClique.find('div.popup');
      var editBtn = popup.find('a.editPicto');
      var visuBtn = popup.find('a.visuPicto');
      var visuZone = popup.find('.visu');
      var editZone = popup.find('.edit');
      var term = thePictoClique.parent('.lesPicto').attr('data-term');
      
      //Print term in fields      
      //jQuery('.onePicto.expert input:first-of-type').not('.form-submit').val("picto surcharge sur: "+term);
      
      //Changer destination      
      if(thePictoClique.hasClass('expert')){ // Si form edit

        var action = popup.find('form#node-form').attr('action');
        var currentUrl = window.location.pathname.split('/');


        //gestion redirect after submit form edit surcharge       
        if(action.split('?destination').length == 1){

          currentUrl = currentUrl[currentUrl.length - 1];          
          action = action+'?destination=projet-atlas/'+currentUrl;
          popup.find('form#node-form').attr('action', action);
          
        }

      }
        


      //Print genre et type in popup
      popup.find('.form-item').each(function(index, el) {    
        if(index == 0)  jQuery(this).find('input').val("picto surcharge sur: "+term);
        if(index == 17) jQuery(this).find('input').val(thePictoClique.attr('class').split(' ')[2]);
        if(index == 18) jQuery(this).find('input').val(thePictoClique.attr('class').split(' ')[3]);
      });      

      //To toogle show hide popup
      jQuery('.popup.active').hide();
      popup.addClass('active');

      //Toggle show / hide the popup
     /* thePictoClique.parent('.lesPicto').find('.onePicto').each(function(index, el) {      
        
        var currentPopup = jQuery(this).find('.popup');
        //Cacher l'ancienne popup lors du hover
        if( currentPopup.length > 0 ) currentPopup.hide();        
        
      });   */   
      
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
    

    /*var current_url = "<?php echo $current_url; ?>";    
    //Si on est pas en mode edition alors execute script gestion popup
    if(current_url != 'edit')*/ gestionPopup();    


  });

</script>
</html>
