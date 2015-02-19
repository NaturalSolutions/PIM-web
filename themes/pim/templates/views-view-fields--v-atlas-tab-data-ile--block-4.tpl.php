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
/*                 VUE AFFICHE LE STATUS DE GESTION                        */
/*                 D'UNE ILE DANS LE TABLEAU RECAP                         */
/*                                                                         */
/***************************************************************************/
/*********************************  ****************************************/
/*********************************  ****************************************/
  global $base_url, $language;
?>

<?php foreach ($fields as $id => $field): ?>


<?php if ($id == 'field_bdi_g_nom_gestionnaire_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_bdi_g_nom_gestionnaire_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_bdi_g_annee_debut_gestion_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_bdi_g_annee_debut_gestion_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_bdi_g_type_accordg_precis_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_bdi_g_type_accordg_precis_value = $field->content; ?>
  <?php endif; ?>
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
  
  <TR>
  
  <?php if($counter == '1'): ?><th ROWSPAN=<?php echo $countNbTotalItem;?>>Gestionnaires</th><?php endif; ?>

  <td><?php echo $field_bdi_g_type_accordg_precis_value; ?></td>
  <td><?php if($field_bdi_g_annee_debut_gestion_value == '<span class="date-display-single">1666</span>') echo "NC"; else echo $field_bdi_g_annee_debut_gestion_value; ?></td>
    <td><?php echo $field_bdi_g_nom_gestionnaire_value; ?></td>

  
  </TR>








