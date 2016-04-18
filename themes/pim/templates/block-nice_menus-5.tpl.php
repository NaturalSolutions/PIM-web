<?php
/**
 * @file
 * Theme implementation to display a block.
 *
 * Available variables:
 * - $title: Block title.
 * - $content: Block content.
 * - $block->module: Module that generated the block.
 * - $block->delta: An ID for the block, unique within each module.
 * - $block->region: The block region embedding the current block.
 * - $edit_links: A list of contextual links for the block. It can be
 *   manipulated through the variable $edit_links_array from preprocess
 *   functions.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - block: The current template type, i.e., "theming hook".
 *   - block-[module]: The module generating the block. For example, the user
 *     module is responsible for handling the default user navigation block. In
 *     that case the class would be "block-user".
 *   - first: The first block in the region.
 *   - last: The last block in the region.
 *   - region-count-[x]: The position of the block in the list of blocks in the
 *     current region.
 *   - region-odd: An odd-numbered block of the list of blocks in the current
 *     region.
 *   - region-even: An even-numbered block of the list of blocks in the current
 *     region.
 *   - count-[x]: The position of the block in the list of blocks on the current
 *     page.
 *   - odd: An odd-numbered block of the list of blocks on the current page.
 *   - even: An even-numbered block of the list of blocks on the current page.
 *
 * Helper variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $edit_links_array: An array of contextual links for the block.
 * - $block_zebra: Outputs 'odd' and 'even' dependent on each block region.
 * - $zebra: Same output as $block_zebra but independent of any block region.
 * - $block_id: Counter dependent on each block region.
 * - $id: Same output as $block_id but independent of any block region.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 * - $block_html_id: A valid HTML ID and guaranteed unique.
 *
 * @see template_preprocess()
 * @see zen_preprocess()
 * @see template_preprocess_block()
 * @see zen_preprocess_block()
 * @see zen_process()
 */
?>
<!-- Template for block Menu Atlas HP -->
<?php global $base_url, $user; ?>

<?php 
$access = false;
foreach ($user->roles as $key => $value) {    
  //Limit access to the page
  if($value == 'Admin PIM') $access = true;    
}  
if($access) $link = "<a class='linkForEditMenuAtlas' href='$base_url/admin/build/menu-customize/menu-menu-atlas-hp' alt='Modifier le menu' title='Modifier le menu' target='_blank'></a>";  
?>

  
<div id="<?php print $block_html_id; ?>" class="<?php print $classes; ?>">
  <?php if ($title): ?>
    <h2 class="title"><?php print $title; ?><?php if(!empty($link)) echo $link; ?></h2>
  <?php endif; ?>

  <div class="content">
    <?php print $content; ?>
    <li class="tousLesSousBassins menu-path-projet-atlas-pictos-par-sous-bassin">
      <!-- <a href="<?php //echo $base_url.'/cache/projet-atlas/tous-les-pictos-par-sous-bassin_ssbassin=Gibraltar&pager=0.html'; ?>">Tous les pictogrammes</a>       -->
    </li>
  </div>

  <?php print $edit_links; ?>



  <!-- Partie visible en mode visualisation, la liste des users avec leurs choix de couleur -->
  <?php $res = views_get_view_result('v_atlas_affiche_allcolor_user', 'block_1'); ?>
  <h2 class="title">Contributeurs Atlas</h2>
  <i class='labelSelectColor'>Couleur de rédaction</i>
  <?php 
  for($i=0;$i<count($res);$i++){
    
    if( $res[$i]->profile_values_profile_couleur_contrib_value  == 'Violet') $color = '#660099';
    elseif( $res[$i]->profile_values_profile_couleur_contrib_value  == 'Rouge') $color = '#FF0000';
    elseif( $res[$i]->profile_values_profile_couleur_contrib_value  == 'Rouge bordeaux') $color = '#6D071A';
    elseif( $res[$i]->profile_values_profile_couleur_contrib_value  == 'Bleu') $color = '#0000FF';
    elseif( $res[$i]->profile_values_profile_couleur_contrib_value  == 'Bleu ciel') $color = '#77B5FE';
    elseif( $res[$i]->profile_values_profile_couleur_contrib_value  == 'Bleu saphir') $color = '#0131B4';
    elseif( $res[$i]->profile_values_profile_couleur_contrib_value  == 'Vert') $color = '#00FF00';
    elseif( $res[$i]->profile_values_profile_couleur_contrib_value  == 'Vert kaki') $color = '#798933';
    elseif( $res[$i]->profile_values_profile_couleur_contrib_value  == 'Vert émeraude') $color = '#01D758';
    elseif( $res[$i]->profile_values_profile_couleur_contrib_value  == 'Orange') $color = '#ED7F10';
    elseif( $res[$i]->profile_values_profile_couleur_contrib_value  == 'Violet') $color = '#660099';
    elseif( $res[$i]->profile_values_profile_couleur_contrib_value  == 'Rose') $color = '#FD6C9E';
    elseif( $res[$i]->profile_values_profile_couleur_contrib_value  == 'Gris') $color = '#606060';
    elseif( $res[$i]->profile_values_profile_couleur_contrib_value  == 'Noir') $color = '#000000';
    else $color = '';
     
    echo "<span style='color:".$color."' class='list-item-contrib'>".$res[$i]->users_name."</span><br/>";
  } 
  ?>

  <!-- Partie visible en mode EDITION. Permet de voir son choix de couleur -->
  <?php $res = views_get_view_result('v_atlas_affiche_allcolor_user', 'default', $user->uid); ?>
  <!-- On récupere la couleur d'un utilisateur spécifique et on affiche  -->
  <?php //$favoriteColor = $res[0]->profile_values_profile_couleur_contrib_value; ?>  
  <?php
  if( $res[0]->profile_values_profile_couleur_contrib_value  == 'Violet') $color = '#660099';
  elseif( $res[0]->profile_values_profile_couleur_contrib_value  == 'Rouge') $color = '#FF0000';
  elseif( $res[0]->profile_values_profile_couleur_contrib_value  == 'Rouge bordeaux') $color = '#6D071A';
  elseif( $res[0]->profile_values_profile_couleur_contrib_value  == 'Bleu') $color = '#0000FF';
  elseif( $res[0]->profile_values_profile_couleur_contrib_value  == 'Bleu ciel') $color = '#77B5FE';
  elseif( $res[0]->profile_values_profile_couleur_contrib_value  == 'Bleu saphir') $color = '#0131B4';
  elseif( $res[0]->profile_values_profile_couleur_contrib_value  == 'Vert') $color = '#00FF00';
  elseif( $res[0]->profile_values_profile_couleur_contrib_value  == 'Vert kaki') $color = '#798933';
  elseif( $res[0]->profile_values_profile_couleur_contrib_value  == 'Vert émeraude') $color = '#01D758';
  elseif( $res[0]->profile_values_profile_couleur_contrib_value  == 'Orange') $color = '#ED7F10';
  elseif( $res[0]->profile_values_profile_couleur_contrib_value  == 'Violet') $color = '#660099';
  elseif( $res[0]->profile_values_profile_couleur_contrib_value  == 'Rose') $color = '#FD6C9E';
  elseif( $res[0]->profile_values_profile_couleur_contrib_value  == 'Gris') $color = '#606060';
  elseif( $res[0]->profile_values_profile_couleur_contrib_value  == 'Noir') $color = '#000000';
  else $color = '';
  ?>
  <p style="border-color:<?php echo $color; ?>;" id='label4selectColor'>Voici votre <span class='colorChoice' style="color:<?php echo $color; ?>;">couleur</span> de rédaction, cliquer <a href="<?php echo $base_url; ?>/user/<?php echo $user->uid; ?>/edit/Atlas" target='_blank' alt='Edition du profil' title='Edition du profil'>ici</a> pour la changer</p>
  


</div><!-- /.block -->

<script> // penser a regarder si possibilité de modifier la valeur du manu a la volé, dans la variable $form
$( document ).ready(function() {

	//Pointe vers nomres de redaction fr,en
	$('li.menu-13570.menu-path-node-57241 > a').attr('target','_blank');
	$('li.menu-13574.menu-path-node-57241 > a').attr('target','_blank');

	//Pointe vers charte de contribution fr,en
  $('li.menu-13569.menu-path-node-57239 > a').attr('target','_blank');
  $('li.menu-13573.menu-path-node-57239 > a').attr('target','_blank');

  //Pointe vers glossaire fr,en
	$('li.menu-13568.menu-path-node-57240 > a').attr('target','_blank');
	$('li.menu-13572.menu-path-node-57240 > a').attr('target','_blank');
  
  var access = "<?php echo $access; ?>";
  
  if(!access){
    //desable link to les pictogrammes
    $('ul#nice-menu-5 li').each(function(index, el) {
      
      if($(this).find('a').text() == 'Pictogrammes') $(this).remove();
    
    });
  }

  
  
});
</script>


