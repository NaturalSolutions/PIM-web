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
/*                      VUE AFFICHE LORS AUCUN STATUT                      */
/*                     D'UNE ILE DANS LE TABLEAU RECAP                     */
/*                                                                         */
/***************************************************************************/
/*********************************  ****************************************/
/*********************************  ****************************************/
  global $base_url, $language;
?>

<?php foreach ($fields as $id => $field): ?>


<?php if ($id == 'field_bdi_spt_statut_protection_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_bdi_spt_statut_protection_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_bdi_spt_annee_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_bdi_spt_annee_value = $field->content; ?>
  <?php else: ?>
  <?php $field_bdi_spt_annee_value = '<center>-</center>'; ?>
<?php endif;?>
<?php endif;?>

<?php if ($id == 'field_bdi_spt_aire_concernee_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_bdi_spt_aire_concernee_value = $field->content; ?>
  <?php else: ?>
  <?php $field_bdi_spt_aire_concernee_value = '<center>-</center>'?>
<?php endif;?>
<?php endif;?>


<?php if ($id == 'name') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $name = $field->content; ?>
  <?php else: ?>
  <?php $name = ''; ?>
  <?php endif;?>
<?php endif;?>

<?php if ($id == 'counter') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $counter = $field->content; ?>
  <?php endif; ?>
<?php endif;?>


<?php endforeach; ?>



<?php  

  $view = views_get_current_view();
  $countNbTotalItem = $view->total_rows;

?>



<!-- On récupere le status et on test si c'est un statut National ou internationnal -->
  
 
  <TR>
  
  <?php if($counter == '1'): ?><td ROWSPAN=<?php echo $countNbTotalItem;?>>Pas de statut de protection</td><?php endif; ?>
  
  <td><?php echo $field_bdi_spt_statut_protection_value; ?></td>
  <td><?php echo $field_bdi_spt_annee_value; ?></td>
  <td><?php echo $field_bdi_spt_aire_concernee_value; ?></td>
    
  </TR>









