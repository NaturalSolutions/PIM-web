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
$principe_gestion_tid = $_GET['field_bdi_g_principe_gestion_value'];
$principe_gestion = taxonomy_get_term($principe_gestion_tid);
?>


		<?php if (($principe_gestion_tid == 'All') || ($principe_gestion_tid == '')): ?>
			<tr>
			<td class="ficheile-label" style='width: 10%;'><div class="texte-gris"><?php print $fields['field_bdi_g_code_ile_ilot_value']->content; ?></div></td>
			<td class="ficheile-value"><div class="texte-gris">
			<?php print $fields['field_bdi_g_principe_gestion_value']->content; ?>
			</div></td>
		</tr>
		<?php else: ?>
			<?php print $fields['field_bdi_g_code_ile_ilot_value']->content.' ,'; ?>
		<?php endif; ?>	


