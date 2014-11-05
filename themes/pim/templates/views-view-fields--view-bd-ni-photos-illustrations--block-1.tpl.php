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
?>

<?php
global $user;
if ((in_array("Admin PIM", $user->roles)) or (in_array("Mega Admin", $user->roles))): ?>
<div class="bloc-admin-extras">
    <span>
        <?php print $fields['edit_node']->content; print " "; ?>
        <?php print $fields['delete_node']->content; ?>
    </span>
</div>

<div class="mr-propre"></div>

<?php endif; ?>

 <<?php print $fields['field_bd_i_pi_image_fid']->inline_html;?> class="views-field-<?php print $fields['field_bd_i_pi_image_fid']->class; ?>">
    <?php if ($fields['field_bd_i_pi_image_fid']->label): ?>
      <label class="views-label-<?php print $fields['field_bd_i_pi_image_fid']->class; ?>">
        <?php print $field->label; ?>:
      </label>
    <?php endif; ?>
      <?php
      // $field->element_type is either SPAN or DIV depending upon whether or not
      // the field is a 'block' element type or 'inline' element type.
      ?>
      <<?php print $fields['field_bd_i_pi_image_fid']->element_type; ?> class="field-content"><?php print $fields['field_bd_i_pi_image_fid']->content; ?></<?php print $fields['field_bd_i_pi_image_fid']->element_type; ?>>
  </<?php print $fields['field_bd_i_pi_image_fid']->inline_html;?>>
	<b><?php print $fields['title']->content; ?></b>

