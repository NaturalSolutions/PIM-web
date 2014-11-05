<!--le corps-->
<div class="views-view--Partenaire-Bailleur--attachment-logos-content">
	
	<?php 
	if($fields['field_partenaire_photo_fid']): 
	?>
	
		<div class="views-view--Partenaire-Bailleur--attachment-logos-content-image">
				<<?php print $fields['field_partenaire_photo_fid']->inline_html;?> class="views-field-<?php print $fields['field_partenaire_photo_fid']->class; ?>">
				
							<?php
							// $field->element_type is either SPAN or DIV depending upon whether or not
							// the field is a 'block' element type or 'inline' element type.
							?>
						<<?php print $fields['field_partenaire_photo_fid']->element_type; ?> class="field-content">
								    <?php print $fields['field_partenaire_photo_fid']->content; ?>
						</<?php print $fields['field_partenaire_photo_fid']->element_type; ?>>
				</<?php print $fields['field_partenaire_photo_fid']->inline_html;?>>
		</div>
		
		
	<?php endif; ?>

	<?php if( $fields['field_partenaire_organisation_value']->content): ?>
		<span class="texte-gris">
			<?php print $fields['field_partenaire_organisation_value']->content; ?>
		</span>
	<?php endif; ?>


</div>
