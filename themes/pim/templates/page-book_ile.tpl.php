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
/***************************************************************************/
/***************************************************************************/
/*                            PAGE TYPE ILE                                */
/*                                                                         */
/***************************************************************************/
/*********************************  ****************************************/
/*********************************  ****************************************/

global $user, $base_url, $language;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">

<head>
  <title><?php print $head_title; ?></title>
  
  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $scripts; ?>

 
</head>


<!-- recuperation de ladresse courante pr tester si on est en mode edition / visu -->
<?php $current_url = request_uri(); ?>
<?php $current_url = explode('/', $current_url ); ?>
<?php $current_url = $current_url[ count($current_url) - 1]; ?>


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
          <div class="tabs">
            <?php 
            /*if($current_url === 'edit' || $user->roles[11] == 'Mega Admin')*/ 
            print $tabs;
            if ( $user->uid ): ?>
            
              <!-- Pour ajouter le bouton commenter -->
              <script> 
              
              var nodeID = "<?php echo $node->nid; ?>";
              var base_url = "<?php echo $base_url; ?>";
              var lang = "<?php echo $language->language; ?>";
              if(lang == 'fr'){
                $('ul.tabs.primary.clearfix').append("<li><a href='"+base_url+"/comment/reply/"+nodeID+"#comment-form'><span class='tab'>Commenter</span></a></li>");
              }else{
                $('ul.tabs.primary.clearfix').append("<li><a href='"+base_url+"/comment/reply/"+nodeID+"#comment-form'><span class='tab'>Comment</span></a></li>");
              }
              </script>
                       
          <?php endif; ?>
          </div>
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
        
        
        <div id="content-area" class='containerOfMyIsland'>
          
    
          <!-- si on edit alors affiche content  -->
          <?php if($current_url === 'edit' || $user->roles[11] == 'Mega Admin' || $current_url === 'revisions' || $current_url === 'view' || $current_url === 'revert' || $current_url === 'delete'): ?>

            <!-- Dans le cas ou on est dans la page qui demande confirmation pour revenir ancienne verion de révision -->
            <?php if($current_url === 'revert') echo "<p>Êtes vous certain de vouloir renevir à cette version ?</p>"; ?>
            <!-- Ajout d un titre dans la page vu des anciennes versions -->
            <?php if($current_url === 'view') echo '<a href="revert" title="Revenir à cette version" class="LikeAtitle">'.$title.'</a>'; ?>  

            <!-- On affiche tout le contenu -->
            <?php  print $content; ?>
                          
          <!-- sinon affiche vue -->
          <?php else: ?>
                           
            <!-- Recuperation du l'iD de la node courante -->
            <?php $nid = $node->nid; ?>
            <!-- Envoie de l'ID dans la vue templaté -->
            <?php print views_embed_view('v_atlas_book_ile', 'block_1', $nid); ?>
            
            <?php if($language->language == 'fr'): ?>
              <h2 class='titleCommentaire'>Commentaires</h2>
            <?php else: ?>
              <h2 class='titleCommentaire'>Comments</h2>
            <?php endif;  ?>
            <?php print views_embed_view('v_atlas_affiche_comment', 'block_1', $nid); ?>
            
            <br/>
           

            <?php //echo $content; ?>

          <?php endif; ?>          



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

    //Pour cacher le tableau recap du status de protection nationnal si aucunes valeurs
    if(jQuery('table.tableRecapIleN tbody tr').length > 1) jQuery('table.tableRecapIleN').show();
    if(jQuery('table.tableRecapIleA tbody tr').length > 1) jQuery('table.tableRecapIleA').show();

  });
</script>
</html>
