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
/*               VUE AFFICHE LA DESCRIPTION PHYSIQUE                       */
/*                D'UNE ILE DANS LE TABLEAU RECAP                          */
/*                                                                         */
/***************************************************************************/
/*********************************  ****************************************/
/*********************************  ****************************************/
  global $base_url, $language;
?>

<?php foreach ($fields as $id => $field): ?>


<?php if ($id == 'field_bdi_dp_topo_communes_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_bdi_dp_topo_communes_value = $field->content; ?>
  <?php else: ?>
  <?php $field_bdi_dp_topo_communes_value = '<center>-</center>'; ?>
<?php endif;?>
<?php endif;?>

<?php if ($id == 'field_bdi_dp_sup_terrestre_ha_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_bdi_dp_sup_terrestre_ha_value = $field->content; ?>
  <?php else: ?>
  <?php $field_bdi_dp_sup_terrestre_ha_value = '<center>-</center>'; ?>
<?php endif;?>
<?php endif;?>

<?php if ($id == 'field_bdi_dp_lineaire_cote_metre_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_bdi_dp_lineaire_cote_metre_value = $field->content; ?>
  <?php else: ?>
  <?php $field_bdi_dp_lineaire_cote_metre_value = '<center>-</center>'; ?>
<?php endif;?>
<?php endif;?>

<?php if ($id == 'field_bdi_dp_dist_cote_cont_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_bdi_dp_dist_cote_cont_value = $field->content; ?>
  <?php else: ?>
  <?php $field_bdi_dp_dist_cote_cont_value = '<center>-</center>'; ?>
<?php endif;?>
<?php endif;?>

<?php if ($id == 'field_bdi_dp_altitude_metre_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_bdi_dp_altitude_metre_value = $field->content; ?>
  <?php else: ?>
  <?php $field_bdi_dp_altitude_metre_value = '<center>-</center>'; ?>
<?php endif;?>
<?php endif;?>

<?php if ($id == 'field_bdi_dp_archipel_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_bdi_dp_archipel_value = $field->content; ?>
  <?php else: ?>
  <?php $field_bdi_dp_archipel_value = '<center>-</center>'; ?>
<?php endif;?>
<?php endif;?>


<?php endforeach; ?>


<table class='tableRecapIle'>
  
  <tr>
    <th>Commune</th>
    <td><center><?php echo $field_bdi_dp_topo_communes_value; ?></center></td>
  </tr>

  <tr>
    <th>Archipel</th>
    <td><center><?php echo $field_bdi_dp_archipel_value; ?></center></td>
  </tr>

  <tr>
    <th>Surface (ha)</th>
    <td><center><?php echo $field_bdi_dp_sup_terrestre_ha_value; ?></center></td>
  </tr>

  <tr>
    <th>Linéaire côté (m)</th>
    <td><center><?php echo $field_bdi_dp_lineaire_cote_metre_value; ?></center></td>
  </tr>

  <tr>
    <th>Distance à la côte (M)</th>
    <td><center><?php echo $field_bdi_dp_dist_cote_cont_value; ?></center></td>
  </tr>
  
  <tr>
    <th>Altitude max (m)</th>
    <td><center><?php echo $field_bdi_dp_altitude_metre_value; ?></center></td>
  </tr>

</table> 

