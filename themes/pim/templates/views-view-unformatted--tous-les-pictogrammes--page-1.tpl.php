<?php
// $Id$
/**
 * @file views-view-unformatted.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>

<?php global $language, $base_url; ?>

<h1>Les pictogrammes</h1>
<h2>Connaissance</h2>
<?php $currentRoles = $user->roles; ?>            
<?php foreach($currentRoles as $item): ?> 
  <?php if($item == 'Admin PIM'): ?>
      <a class='addPicto' href='<?php echo $base_url; ?>/node/add/book-les-pictos-connaissances' title='Ajouter un picto'></a>
  <?php endif; ?>
<?php endforeach; ?>
<?php print views_embed_view('tous_les_pictogrammes', 'block_1'); ?> 


<h2>Intérêts</h2>
<?php $currentRoles = $user->roles; ?>            
<?php foreach($currentRoles as $item): ?> 
  <?php if($item == 'Admin PIM'): ?>
      <a class='addPicto' href='<?php echo $base_url; ?>/node/add/book-les-pictos-interet' title='Ajouter un picto'></a>
  <?php endif; ?>
<?php endforeach; ?>
<?php print views_embed_view('tous_les_pictogrammes', 'block_2'); ?> 


<h2>Pressions</h2>
<?php $currentRoles = $user->roles; ?>            
<?php foreach($currentRoles as $item): ?> 
  <?php if($item == 'Admin PIM'): ?>
      <a class='addPicto' href='<?php echo $base_url; ?>/node/add/book-les-pictos-pression' title='Ajouter un picto'></a>
  <?php endif; ?>
<?php endforeach; ?>
<?php print views_embed_view('tous_les_pictogrammes', 'block_3'); ?> 

<h2>Gestions</h2>
<?php $currentRoles = $user->roles; ?>            
<?php foreach($currentRoles as $item): ?> 
  <?php if($item == 'Admin PIM'): ?>
      <a class='addPicto' href='<?php echo $base_url; ?>/node/add/book-les-pictos-gestions' title='Ajouter un picto'></a>
  <?php endif; ?>
<?php endforeach; ?>
<?php print views_embed_view('tous_les_pictogrammes', 'block_4'); ?> 
