
<div class="accueil-blockblanc">

		
	<div class="accueil-block-data-image">
		<<?php print $fields['field_chapeau_image_fid']->inline_html;?> class="views-field-<?php print $fields['field_chapeau_image_fid']->class; ?>">
				
		<?php
		// $field->element_type is either SPAN or DIV depending upon whether or not
		// the field is a 'block' element type or 'inline' element type.
		?>
            <<?php print $fields['field_chapeau_image_fid']->element_type; ?> class="field-content">
                <?php print $fields['field_chapeau_image_fid']->content; ?>
            </<?php print $fields['field_chapeau_image_fid']->element_type; ?>>
		</<?php print $fields['field_chapeau_image_fid']->inline_html;?>>
	</div>
    
    <?php 
        $block = module_invoke('nice_menus', 'block', 'view', '15');
		$block['content'] = preg_replace('/<li class=.*nsExport.*<\/a><\/li>/', "", $block['content']);
        print $block['content'];
    ?>
	

</div>