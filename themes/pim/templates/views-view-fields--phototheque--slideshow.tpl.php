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
        <?php print $fields['edit_node']->content; print " ";  ?>
        <?php print $fields['delete_node']->content; ?>
    </span>
</div>

<div class="mr-propre"></div>

<?php endif; ?>

<div id="content-fields-sildeshow">

<?php if($fields['field_photos_image_fid']): ?>
<?php 
	$title = $fields['title']->content; 
	if($fields['field_photos_date_value']){
		$date =  date("d/m/Y", strtotime($fields['field_photos_date_value']->raw));
		$title .= " -- ".$date;
	}
	if($fields['field_photos_auteur_value']) {
		$title .= " -- ". $fields['field_photos_auteur_value']->content;
	}
	$title = htmlspecialchars($title);
?>
						 
	<div class="content-fields-slideshow-image">
			<<?php print $fields['field_photos_image_fid']->inline_html;?> class="views-field-<?php print $fields['field_photos_image_fid']->class; ?>">
					<<?php print $fields['field_photos_image_fid']->element_type; ?> class="field-content">
						<a href="<?php print $fields['field_photos_image_fid_1']->content; ?>" rel="lightshow[<?php print $fields['field_photos_portfolio_value']->content; ?>]" 
						 title="<?php print $title; ?>">
							<?php print $fields['field_photos_image_fid']->content; ?>
						</a>
					</<?php print $fields['field_photos_image_fid']->element_type; ?>>
			</<?php print $fields['field_photos_image_fid']->inline_html;?>>
	</div>
<?php endif; ?>
<div class="content-fields-slideshow-text">
	<!-- Titre -->
	<?php if($fields['title']): ?>
		<<?php print $fields['title']->element_type; ?> class="field-content texte-gris-grossi-gras">
            <?php print $fields['title']->content; ?>
        </<?php print $fields['title']->element_type; ?>>
	<?php endif; ?>
	
	<!-- Description -->
	<?php if($fields['field_photos_description_value']): ?>
		<<?php print $fields['field_photos_description_value']->element_type; ?> class="field-content texte-gris">
            <?php print $fields['field_photos_description_value']->content; ?>
        </<?php print $fields['field_photos_description_value']->element_type; ?>>
	<?php endif; ?>
	
	<!--Métadonnées-->
	<?php if(($fields['field_photos_description_value']) || ($fields['field_photos_auteur_value'])): ?>
		<div class="content-fields-slideshow-text-meta">
		<!-- Date -->
		<?php if($fields['field_photos_date_value']): ?>
			<<?php print $fields['field_photos_date_value']->element_type; ?> class="field-content texte-gris">
                <?php print $fields['field_photos_date_value']->content; ?>
            </<?php print $fields['field_photos_date_value']->element_type; ?>>
		<?php endif; ?>

		<!-- Auteur -->
		<?php if($fields['field_photos_auteur_value']): ?>
			<<?php print $fields['field_photos_auteur_value']->element_type; ?> class="field-content texte-gris-grossi-gras">
                <?php print $fields['field_photos_auteur_value']->content; ?>
            </<?php print $fields['field_photos_auteur_value']->element_type; ?>>
		<?php endif; ?>
		</div>
	<?php endif; ?>
</div>

</div>
	
	

