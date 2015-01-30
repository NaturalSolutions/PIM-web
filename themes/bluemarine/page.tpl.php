<?php
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language ?>" xml:lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">

<head>
  <?php print $head ?>
  <title><?php print $head_title ?></title>
  <?php print $styles ?>
  <?php print $scripts ?>
  <script type="text/javascript"><?php /* Needed to avoid Flash of Unstyle Content in IE */ ?> </script>
</head>


<?php 
global $base_url;
//get current url
function getUrl() {
  $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
  $url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
  $url .= $_SERVER["REQUEST_URI"];
  return $url;
}
$currentPage = explode('/', getUrl());
$currentPage = $currentPage[count($currentPage) - 1];
?>

<body 
<?php 
  if($currentPage != 'glossaire' && $currentPage != 'term' && $is_admin != TRUE) echo "class='not-admin menuAtlas pageMenu'"; 
  else if($currentPage == 'glossaire' || $currentPage == 'term' && $is_admin != TRUE) echo "class='not-admin menuAtlas pageMenu glossaire'"; ?> 
> <!-- Fermeture balise body -->


<?php if($is_admin != TRUE): ?>

  <script>jQuery( document ).ready(function() { isAdmin = false; });</script>
  
<?php else: ?>

  <script>jQuery( document ).ready(function() { isAdmin = true; });</script>  

<?php endif; ?>

<?php if($currentPage == 'glossaire' || $currentPage == 'term'): ?>

  <script>jQuery( document ).ready(function() { isGlossaire = true; });</script>
  
<?php else: ?>

  <script>jQuery( document ).ready(function() { isGlossaire = false; });</script>

<?php endif; ?>

<script>var base_url = '<?php echo $base_url; ?>';</script>

<table border="0" cellpadding="0" cellspacing="0" id="header">
  <tr>
    <td id="logo">
      <?php if ($logo) { ?><a href="<?php print $front_page ?>" title="<?php print t('Home') ?>"><img src="<?php print $logo ?>" alt="<?php print t('Home') ?>" /></a><?php } ?>
      <?php if ($site_name) { ?><h1 class='site-name'><a href="<?php print $front_page ?>" title="<?php print t('Home') ?>"><?php print $site_name ?></a></h1><?php } ?>
      <?php if ($site_slogan) { ?><div class='site-slogan'><?php print $site_slogan ?></div><?php } ?>
    </td>
    <td id="menu">
      <?php if (isset($secondary_links)) { ?><?php print theme('links', $secondary_links, array('class' => 'links', 'id' => 'subnavlist')) ?><?php } ?>
      <?php if (isset($primary_links)) { ?><?php print theme('links', $primary_links, array('class' => 'links', 'id' => 'navlist')) ?><?php } ?>
      <?php print $search_box ?>
    </td>
  </tr>
  <tr>
    <td colspan="2"><div><?php print $header ?></div></td>
  </tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" id="content">
  <tr>
    <?php if ($left && $is_admin == TRUE) { ?><td id="sidebar-left">
      <?php print $left ?>
    </td><?php } ?>
    <td valign="top">
      <?php if ($mission) { ?><div id="mission"><?php print $mission ?></div><?php } ?>
      <div id="main">
        <?php print $breadcrumb ?>
        <h1 class="title"><?php print $title ?></h1>
        <div class="tabs"><?php print $tabs ?></div>
        <?php if ($show_messages) { print $messages; } ?>
        <?php print $help ?>
        <?php print $content; ?>
        <?php print $feed_icons; ?>
      </div>
    </td>
    <?php if ($right) { ?><td id="sidebar-right">
      <?php print $right ?>
    </td><?php } ?>
  </tr>
</table>

<div id="footer">
  <?php print $footer_message ?>
  <?php print $footer ?>

<script>
  jQuery( document ).ready(function() {

    if(!isAdmin) $('fieldset.collapsed').removeClass('collapsed');
    
    if(!isAdmin && isGlossaire){

      $('.messages.status').html("Le nouveau terme '<em>isGlossaire</em>' a été créé. Cliquez <a href='"+base_url+"/projet-atlas/glossaire'>ici</a> pour revenir au glossaire");
    

      // var blocTermeLiee = $('#edit-relations-68-wrapper').html(); 
      // $('#edit-relations-68-wrapper').hide(); 

      // $('#edit-synonyms-wrapper').after('<div class="form-item" id="edit-relations-68-wrapper">'+blocTermeLiee+'</div>');

      $('div#edit-relations-68-wrapper label').text('Traduction :');   
      

    

    } 
    

  });
  
</script>


</div>
<?php print $closure ?>
</body>
</html>
