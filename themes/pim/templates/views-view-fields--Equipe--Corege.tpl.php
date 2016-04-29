<?php
// $Id: views-view-fields.tpl.php,v 1.6 2008/09/24 22:48:21 merlinofchaos Exp $
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
    <span class="admin-links">
        <?php print $fields['view_node']->content; print " "; ?>
        <?php print $fields['edit_node']->content; ?>
    </span>
</div>

<div class="mr-propre"></div>

<?php endif; ?>

<!--le corps-->
<div class="views-view--equipe-attachment-2-content">
	
	<?php 
	if($fields['field_membre_photo_fid']): 
	?>
	
		<div class="views-view--Equipe-attachment-2-content-image">
				<<?php print $fields['field_membre_photo_fid']->inline_html;?> class="views-field-<?php print $fields['field_membre_photo_fid']->class; ?>">
				
							<?php
							// $field->element_type is either SPAN or DIV depending upon whether or not
							// the field is a 'block' element type or 'inline' element type.
							?>
						<<?php print $fields['field_membre_photo_fid']->element_type; ?> class="field-content">
								    <?php print $fields['field_membre_photo_fid']->content; ?>
						</<?php print $fields['field_membre_photo_fid']->element_type; ?>>
				</<?php print $fields['field_membre_photo_fid']->inline_html;?>>
		</div>
		
		
	<?php endif; ?>

    <div class="texte-gris-grossi-gras">
        <h2><?php if( $fields['field_membres_prenom_value']->content): ?>
			<?php print $fields['field_membres_prenom_value']->content; ?>
        <?php endif; ?>

		<?php print $fields['field_membres_nom_value']->content; ?>
		</h2>
    </div>

    <div class="texte-gris">
        <?php if( $fields['field_membre_fonction_value']->content): ?>
			<?php print $fields['field_membre_fonction_value']->content; ?><br /> 
        <?php endif; ?>
		
		 <?php if( $fields['field_membre_structure_value']->content): ?>
			<?php print $fields['field_membre_structure_value']->content; ?><br />
        <?php endif; ?>

		<?php if ( $fields['field_membre_speciality_value']->content or $fields['field_membre_autres_specialites_value']->content): ?>
				<em><?php print t('Specialities')." : "; ?></em>
			<ul class="pim-specialite">
			<?php if( $fields['field_membre_speciality_value']->content): ?>
				<li>
				<?php print $fields['field_membre_speciality_value']->content; ?>
				</li>
			<?php endif; ?>
			<?php if( $fields['field_membre_autres_specialites_value']->content): ?>
				<li>
				<?php print $fields['field_membre_autres_specialites_value']->content; ?>
				</li>
			<?php endif; ?>
			</ul>
		<?php endif; ?>
		
		
		<?php if( $fields['field_membre_email_value']->content): ?>
			<em><?php print t('Email')." : "; ?></em>
			<?php print $fields['field_membre_email_value']->content; ?><br />
        <?php endif; ?>
		
		<?php if( $fields['field_membre_telephone_value']->content): ?>
			<em><?php print t('Tel')." : "; ?></em>
			<?php print $fields['field_membre_telephone_value']->content; ?>
        <?php endif; ?>
    </div>
	
</div>
