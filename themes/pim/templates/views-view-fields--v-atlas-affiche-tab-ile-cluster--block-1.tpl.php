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
/*                     AFFICHE DATA OF ILE && CLUSTER                      */
/*                                                                         */
/***************************************************************************/
/*********************************  ****************************************/
/*********************************  ****************************************/
  global $base_url;
?>

<?php foreach ($fields as $id => $field): ?>


<?php if ($id == 'title') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $title = $field->content; ?>
	<div class="leftZoneForCulster">
		<?php echo $title; ?>
	</div>
  <?php endif; ?>
<?php endif;?> 


<?php if ($id == 'field_cluster_have_ile_nid') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $have_ile = $field->content; ?>
	<div class="rightZoneForCulster">
	<?php echo $have_ile; ?>
	</div>
  <?php else: ?>
  	<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ø</div>
  <?php endif;?>
<?php endif;?>


<?php endforeach; ?>







