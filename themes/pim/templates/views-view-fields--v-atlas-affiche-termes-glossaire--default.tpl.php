<?php
// $Id$
/**
 * @file views-view-fields.tpl.php
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->separator: an optional separator that may appear before a field.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
/***************************************************************************/
/***************************************************************************/
/*                     v_atlas_affiche_termes_glossaire                    */
/*                                                                         */
/***************************************************************************/
/*********************************  ****************************************/
/*********************************  ****************************************/
  global $base_url, $language;
?>

<?php foreach ($fields as $id => $field): ?>


<?php if ($id == 'name') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $name = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'description') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $description = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'tid') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $tid = $field->content; ?>
  <?php endif; ?>
<?php endif;?>


<?php endforeach; ?>


<?php $tabOfSynonymes = taxonomy_get_synonyms($tid); ?>
<?php $currentTerme = taxonomy_get_term($tid); ?>
<?php $currentRelatedTerme = taxonomy_get_related($tid, $key = 'tid'); ?>
<?php $languageOFCurrentTerme = $currentTerme->language; ?>

<?php if($language->language == $languageOFCurrentTerme ): ?>


<div class='oneTerme'> 
  
  <p class="labelTerme">
    <?php 
    if(!empty($languageOFCurrentTerme)) echo "<span class='$languageOFCurrentTerme'></span>";
    echo $name; 
    ?>
    <small> <?php 
      if(!empty($tabOfSynonymes)){
  
        echo '( ';
        for($i=0;$i<count($tabOfSynonymes);$i++){

          echo $tabOfSynonymes[$i];
          if($i < count($tabOfSynonymes) -1 ) echo ', ';

        }
        echo ' )';

     }
    ?> 
    </small>
  </p>
  <p class="descroTerme">
    <?php echo $description; ?>
  </p>

  <div class='btnVoir'><?php if($language->language == 'fr') echo 'Voir +'; else echo 'See more'; ?></div>


    
  <?php 
  if(!empty($currentRelatedTerme)){
    
    echo '<div class="blockOfRelatedTerme">';
    if($language->language == 'fr') echo '<label>Traduction :</label><br/>'; else echo '<label>Translation:</label><br/>';
    
    $i = 1;
    foreach ($currentRelatedTerme as $key => $value) {
      
      

      if($value->tid2 == $tid) $tidOFRelatedTerme = $value->tid1;     
      else $tidOFRelatedTerme = $value->tid2;

      $currentRelatedTerme = taxonomy_get_term($tidOFRelatedTerme); 
      $languageOFcurrentRelatedTerme = $currentRelatedTerme->language;
      
      
      echo "<a title='Voir le terme' class='$languageOFcurrentRelatedTerme relatedTerme' target='_blank' href='$base_url/admin/content/taxonomy/edit/term/$tidOFRelatedTerme?destination=projet-atlas/glossaire'>$value->name</a><br/>";
      $i++;
    
    }
  echo '</div>';
  } 
  ?>

  <br/>
  <a href="<?php echo $base_url; ?>/admin/content/taxonomy/edit/term/<?php echo $tid; ?>?destination=projet-atlas/glossaire"><i><?php if($language->language == 'fr') echo 'Modifier'; else echo 'Edit'; ?></i></a>
  
</div>


<?php endif; ?>