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
/*                        PAGE PROJET-ATLAS                                */
/*                                                                         */
/***************************************************************************/
/*********************************  ****************************************/
/*********************************  ****************************************/
  global $base_url, $language, $user;
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
          <div class="tabs"><?php if($current_url === 'edit' || $user->roles[11] == 'Mega Admin') print $tabs; ?></div>
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
        
        <!-- le contenu commence ici         -->
        <div id="content-area">

                    
          <div class='firstLineOFHpAtlas'>
          <?php if($language->language == 'fr') echo "<p>Atlas des PIM</p>"; else echo "<p>Atlas on western Mediterranean small islands</p>"; ?>
          </div> 
          <div class='secondLineOFHpAtlas'></div> 
            
            
            <?php print views_embed_view('v_atlas_presentation', 'block_1'); ?>
            <a id="btnImprim" href="<?php echo $base_url; ?>/book/export/html/56647"><?php if( $language->language == 'en') echo 'View all'; else echo 'Voir tout l\'atlas'; ?></a>
            


            <!-- Commentaires -->
            <?php if($language->language == 'fr'): ?>
              <h2 class='titleCommentaire'>Derniers commentaires</h2>
            <?php else: ?>
              <h2 class='titleCommentaire'>Latest comments</h2>
            <?php endif;  ?>
            <?php print views_embed_view('v_atlas_affiche_comment_in_hp', 'block_1'); ?>

            

            <!-- block mes publications -->
            <h2 id='labelMesPubi'>Mes publications</h2>
            <?php print views_embed_view('v_atlas_presentation', 'block_7', $user->uid); ?>
            <span class="btnSeeLess">Réduire</span>
          
      
                     
            <!-- Dashboard -->
            <div class="dashboard">
              
              <h2 class='dashboardLabel'><?php if( $language->language == 'fr') echo 'Tableau de bord'; else echo 'Dashboard'; ?></h2>
                <!-- affiche derniere publication -->
                <?php print views_embed_view('v_atlas_presentation', 'block_2'); ?>                
                <!-- affiche Compteur de brouillon -->
                <div id="absoluteContainer">
                  <?php $nbBrouillon = views_get_view_result('v_atlas_presentation', 'block_4'); ?>
                  <?php $nbAvalider = views_get_view_result('v_atlas_presentation', 'block_5'); ?>
                  <?php $nbTerminer = views_get_view_result('v_atlas_presentation', 'block_6'); ?>
                  <p><?php echo count($nbBrouillon); ?> publication(s) brouillons</p>                            
                  <p><?php echo count($nbAvalider); ?> publication(s) à valider</p>                            
                  <p><?php echo count($nbTerminer); ?> publication(s) terminée(s)</p>                                            
                </div>            
            
            </div>


            <!-- la carte des sous bassins en HP -->
            <div id='map_hp'>

              <!-- On récupere la liste des nid sous-bassin -->
              <?php $listeIDsousBassin = views_get_view_result('v_atlas_affiche_number_ile_clust', 'default'); ?>
              
              <?php             
              // pour chque nid sous bassin on recupere le nombre d ile / cluster
              foreach($listeIDsousBassin as $item): ?>
                
                <!-- On récuprer les cluster lier au sous bassin -->
                <?php $res = views_get_view_result('v_atlas_affiche_number_ile_clust', 'block_1', $item->nid); ?>
                <?php $resIle = views_get_view_result('v_atlas_affiche_number_ile_clust', 'block_2', $item->nid); ?>
                <?php 
                  //On va cherche le nom du sous bassin
                  $node = node_load($item->nid);
                  $name_lien_sous_bassin = l($node->title, 'node/'.$item->nid);
                  $name_lien_sous_bassin = explode('/', $name_lien_sous_bassin);
                  $name_lien_sous_bassin = explode('"', $name_lien_sous_bassin[count($name_lien_sous_bassin) - 2]);
                  $name_lien_sous_bassin = trim($name_lien_sous_bassin[count($name_lien_sous_bassin) - 2]);
                  $name_lien_sous_bassin = preg_replace('/\s+/', ' ', $name_lien_sous_bassin);

                  //Get statut of sous-bassin
                  if($node->avalider == 1) $statutOfSousBassin = 'avalider';
                  else if($node->brouillon == 1) $statutOfSousBassin = 'brouillon';
                  else if($node->termine == 1) $statutOfSousBassin = 'termine';
                  
                  //Le nombre de cluster lier au sous bassin envoyé
                  $nb_cluster = count($res);
                  $nb_ile = count($resIle);

                                    
                  //S'il existe des ils dans un sous bassin
                  $ctpIslandBrouillon=0;
                  $ctpIslandAvalider=0;
                  $ctpIslandTermine=0;
                  $ctpClusterBrouillon=0;
                  $ctpClusterAvalider=0;
                  $ctpClusterTermine=0;
                 

                  if($nb_ile > 0){


                    //Pour chaque ile
                    foreach ($resIle as $key => $island) {
                      
                      //Get nid of island                  
                      $nidOfIsland = $island->nid;

                      //load island node 
                      $nodeOfIsland  = node_load($nidOfIsland);

                      if($nodeOfIsland->brouillon == 1) $ctpIslandBrouillon++;
                      else if($nodeOfIsland->avalider == 1) $ctpIslandAvalider++;
                      else if($nodeOfIsland->termine == 1) $ctpIslandTermine++;

    
                    }
                    
                    $ctpIslandBrouillon = ($ctpIslandBrouillon / $nb_ile) * 100;
                    $ctpIslandAvalider = ($ctpIslandAvalider / $nb_ile) * 100;
                    $ctpIslandTermine = ($ctpIslandTermine / $nb_ile) * 100;                    

                  }

                  if($nb_cluster > 0){


                    //Pour chaque ile
                    foreach ($res as $key => $cluster) {
                      
                      //Get nid of cluster                  
                      $nidOfCluster = $cluster->nid;

                      //load cluster node 
                      $nodeOfcluster  = node_load($nidOfCluster);

                      if($nodeOfcluster->brouillon == 1) $ctpClusterBrouillon++;
                      else if($nodeOfcluster->avalider == 1) $ctpClusterAvalider++;
                      else if($nodeOfcluster->termine == 1) $ctpClusterTermine++;

    
                    }
                    
                    $ctpClusterBrouillon = ($ctpClusterBrouillon / $nb_cluster) * 100;
                    $ctpClusterAvalider = ($ctpClusterAvalider / $nb_cluster) * 100;
                    $ctpClusterTermine = ($ctpClusterTermine / $nb_cluster) * 100;                    

                  }
                                   
                                
                ?>
                  <!-- Pour chaque sous bassin :> Affichage de son bouton + son nombre de cluster liés -->
                  <a href="<?php echo $base_url; ?>/projet-atlas/<?php echo $name_lien_sous_bassin; ?>" id='<?php echo $name_lien_sous_bassin; ?>' alt='<?php echo $node->title; ?>' title='Voir la page du <?php echo $node->title; ?>'></a>

                  <div class='hidden infoOnHover <?php echo $name_lien_sous_bassin; ?>'>

                    
                    <div class='hidden statutOfSousBassin'><?php echo $statutOfSousBassin; ?></div>

                    <div class='hidden ctpIslandBrouillon'><?php echo $ctpIslandBrouillon; ?></div>
                    <div class='hidden ctpIslandAvalider'><?php echo $ctpIslandAvalider; ?></div>
                    <div class='hidden ctpIslandTermine'><?php echo $ctpIslandTermine; ?></div>

                    <div class='hidden ctpClusterBrouillon'><?php echo $ctpClusterBrouillon; ?></div>
                    <div class='hidden ctpClusterAvalider'><?php echo $ctpClusterAvalider; ?></div>
                    <div class='hidden ctpClusterTermine'><?php echo $ctpClusterTermine; ?></div>
                    
                  
                    <h4><?php echo $node->title; ?><span class='statutCodeColor'></span></h4>
                    
                    <div class='countCluster' alt='Nombre de cluster'>
                      <?php echo $nb_cluster; ?>
                      <label>cluster(s)</label>
                      <div class="progressbar">
                        <div class="statutB"></div>
                        <div class="statutA"></div>
                        <div class="statutT"></div>                        
                      </div>
                    </div>
                    
                    <div class='countIsland' alt='Nombre île'>
                      <?php echo $nb_ile; ?>
                      <label>île(s)</label>
                      <div class="progressbar">
                        <div class="statutB"></div>
                        <div class="statutA"></div>
                        <div class="statutT"></div>                        
                      </div>
                    </div>

                  </div>
                
                
              <?php endforeach; ?>
            
            <p class='legend'><span class='labelBrouillon'></span>&nbsp;Brouillon <span class='labelAvalider'></span>&nbsp;A valider <span class='labelTerminer'></span>&nbsp;Terminer</p>
            
            </div> <!-- fin map -->

            <div class='zoneInfoHover'></div>


            <!-- Block visibles par Admin PiM : Affichage d'informations sur l'activité des utilisateurs -->
            <?php $currentRoles = $user->roles; ?>            
            <?php foreach($currentRoles as $item): ?> 
                <?php if($item == 'Admin PIM'): ?>
                  <h2 class="labelAdminTabUser">Les utilisateurs</h2>
                  <?php print views_embed_view('v_affiche_user_infos_for_admin', 'default'); ?>
                  <h2 class="labelAdminTabPubli">Les publications</h2>
                  <?php print views_embed_view('v_atlas_presentation', 'block_8'); ?>
                <?php endif; ?>
            <?php endforeach; ?>
            

         </div><!-- fin content-area -->

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

    var lang = '<?php echo $language->language; ?>';

    var toggleMesPubliEnTrop = function(){
      

      //click sur voir+
      $('.btnSeeMore').click(function(){

        //cache le bouton Voir+
        $(this).hide();

        //On enleve la class qui cache pour tout montrer
        $('div.unePublication').removeClass('lineForHide');

        //On montre le bouton réduire
        $('.btnSeeLess').show();
      
      });

      //click sur réduire
      $('.btnSeeLess').click(function(){

        //cache le bouton Voir+
        $(this).hide();

        //On enleve la class qui cache pour tout montrer
        $('div.unePublication').each(function( index ) {  
        
          
          
          if(index > 2) {
            console.log(index);
            $(this).addClass('lineForHide');
          }

        });        

        //On ajoute le bouton réduire
        $('.btnSeeMore').show();
      
      });


    };

    var goPopup = function(){

      var first_visite = sessionStorage.getItem("first_visite");
      
      if(first_visite == 0 || first_visite == null) {
        
        //Afficher la popup
        var reponse = confirm('Veuillez prendre connaissance de la charte des contributeurs et des normes de rédaction.');
        if(reponse == true) sessionStorage.setItem("first_visite",1);

      }


    };

    var toggleComment = function(){

      $('div.view-v-atlas-affiche-comment-in-hp .seeMore').click(function(e) {
        //desactiver le lien
        e.preventDefault();

        //Si pas visible alors montre
        if( $(this).text() == 'Voir+' || $(this).text() == 'See more' ){

          if(lang == 'fr') $(this).text('Réduire');
          else $(this).text('Hide');
          
          $('div.containerOfOneComment').removeClass('commentHider');
          $('div.view-v-atlas-affiche-comment-in-hp div.views-row-3 div.containerOfOneComment').css('borderBottom','1px dashed #4779c0');
          $('div.view-v-atlas-affiche-comment-in-hp div.views-row-last').children().css('paddingBottom','50px');

        }else{
          
          $('div.view-v-atlas-affiche-comment-in-hp div.views-row').each(function( index ){
              if(index > 2) {

                $(this).children().addClass('commentHider');
                
              }
          });


          if(lang == 'fr') $(this).text('Voir+');
          else $(this).text('See more');


          $('div.view-v-atlas-affiche-comment-in-hp div.views-row-3 div.containerOfOneComment').css('borderBottom','none');
        
        }

        

      
      });

    }

    var hoverOnMap = function(){

      //when hover a sous-bassin on the map
      $('div#map_hp a').hover(function() {

          /*//get id block
          var idBlock = '.'+$(this).attr('id');*/

          //dispay info block
          var zoneInfoOfCurrentHover = $(this).next();
          zoneInfoOfCurrentHover.show();

          //Get info statut of sous-bassin
          statutOfSousBassin = zoneInfoOfCurrentHover.find('.statutOfSousBassin').text();
          titleOfBloc = zoneInfoOfCurrentHover.find('.statutCodeColor');
          if(statutOfSousBassin == 'brouillon') titleOfBloc.css('backgroundColor','rgba(255, 0, 0, 0.6)');
          if(statutOfSousBassin == 'avalider') titleOfBloc.css('backgroundColor','rgba(251, 114, 27, 0.68)');
          if(statutOfSousBassin == 'terminer') titleOfBloc.css('backgroundColor','rgba(71, 121, 192, 0.79)');
          

          //Get % info for islands
          var currrentPourcentOfIslandBrouillon = Math.round(zoneInfoOfCurrentHover.find('.ctpIslandBrouillon').html());
          var currrentPourcentOfIslandAvalider = Math.round(zoneInfoOfCurrentHover.find('.ctpIslandAvalider').html());
          var currrentPourcentOfIslandTerminer = Math.round(zoneInfoOfCurrentHover.find('.ctpIslandTermine').html());

          //Get % info for cluster
          var currrentPourcentOfClusterBrouillon = Math.round(zoneInfoOfCurrentHover.find('.ctpClusterBrouillon').html());
          var currrentPourcentOfClusterAvalider = Math.round(zoneInfoOfCurrentHover.find('.ctpClusterAvalider').html());
          var currrentPourcentOfClusterTerminer = Math.round(zoneInfoOfCurrentHover.find('.ctpClusterTermine').html());

          //display % info for islands
          if(currrentPourcentOfIslandBrouillon > 0 ){
            zoneInfoOfCurrentHover.find('.countIsland .statutB').animate({
              width: currrentPourcentOfIslandBrouillon+'%'            
              },
              1000, function() {
              /* stuff to do after animation is complete */
              if(currrentPourcentOfIslandBrouillon > 10) $(this).html(currrentPourcentOfIslandBrouillon+'%');              
            });
          } 
          if(currrentPourcentOfIslandAvalider > 0 ){
            zoneInfoOfCurrentHover.find('.countIsland .statutA').animate({
              width: currrentPourcentOfIslandAvalider+'%'            
              },
              1000, function() {
              /* stuff to do after animation is complete */
              if(currrentPourcentOfIslandAvalider > 10) $(this).html(currrentPourcentOfIslandAvalider+'%');
            });
          }
          if(currrentPourcentOfIslandTerminer > 0 ){
            zoneInfoOfCurrentHover.find('.countIsland .statutT').animate({
              width: currrentPourcentOfIslandTerminer+'%'            
              },
              1000, function() {
              /* stuff to do after animation is complete */
              if(currrentPourcentOfIslandTerminer > 10) $(this).html(currrentPourcentOfIslandTerminer+' %');
            });            
          }

          //display % info for cluster
          if(currrentPourcentOfClusterBrouillon > 0 ){
            zoneInfoOfCurrentHover.find('.countCluster .statutB').animate({
              width: currrentPourcentOfClusterBrouillon+'%'            
              },
              1000, function() {
              /* stuff to do after animation is complete */
              if(currrentPourcentOfClusterBrouillon > 10) $(this).html(currrentPourcentOfClusterBrouillon+'%');              
            });
          } 
          if(currrentPourcentOfClusterAvalider > 0 ){
            zoneInfoOfCurrentHover.find('.countCluster .statutA').animate({
              width: currrentPourcentOfClusterAvalider+'%'            
              },
              1000, function() {
              /* stuff to do after animation is complete */
              if(currrentPourcentOfClusterAvalider > 10) $(this).html(currrentPourcentOfClusterAvalider+'%');
            });
          }
          if(currrentPourcentOfClusterTerminer > 0 ){
            zoneInfoOfCurrentHover.find('.countCluster .statutT').animate({
              width: currrentPourcentOfClusterTerminer+'%'            
              },
              1000, function() {
              /* stuff to do after animation is complete */
              if(currrentPourcentOfClusterTerminer > 10) $(this).html(currrentPourcentOfClusterTerminer+' %');
            });            
          }


      }, function() {

        //Hide when leaving block
        var zoneInfoOfCurrentHover = $(this).next();
        zoneInfoOfCurrentHover.hide();
        zoneInfoOfCurrentHover.find('.statutB, .statutA, .statutT').css('width', 0);
        zoneInfoOfCurrentHover.find('.statutB, .statutA, .statutT').html('');
      
      
      });

    }
        

    window.init = function() {
      //show hide du bloc publication
      toggleMesPubliEnTrop();

      //show hide du bloc commentaire
      toggleComment();

      //PoPuP
      goPopup();

      //To Display data of sous-bassin when hover item on map
      hoverOnMap();

    }
    
    init(); // true 

  });
</script>
</html>
