<?php 
/***************************************************************************/
/***************************************************************************/
/*                        PAGE EDITION PRESENTATION                        */
/*                                                                         */
/***************************************************************************/
/*********************************  ****************************************/
/*********************************  ****************************************/
global $base_url, $language, $node;
?>


<h1><?php if($language->language == 'fr') echo 'Édition du texte d\'introduction'; else echo 'Edition of the introduction text'; ?></h1>


<?php print drupal_render($form); ?>

<?php print drupal_render($form['options']); ?>
<?php print drupal_render($form['buttons']); ?>

<?php if($language->language == 'fr'): ?>
	<input type="submit" name="op" id="edit-submit" value="Enregistrer" class="form-submit custom">
<?php else: ?>
	<input type="submit" name="op" id="edit-submit" value="Save" class="form-submit custom">
<?php endif; ?>

<script>
jQuery( document ).ready(function() {

	var mafonction = function(){
		
		var lang = '<?php echo $language->language; ?>';


		if(lang == 'fr') {
		
			jQuery('#edit-field-title-fr-0-value-wrapper').show();
			jQuery('#edit-field-body-fr-0-value-wrapper').show();
			jQuery('.tabs.primary.clearfix > li > a').attr('href','/projet-atlas');

		}
		else {

			jQuery('#edit-field-title-en-0-value-wrapper').show();
			jQuery('#edit-field-body-en-0-value-wrapper').show();
			jQuery('.tabs.primary.clearfix > li > a').attr('href','/en/projet-atlas');		
			
		}
		
		


	};

	window.init = function() {
		mafonction();
	}
	
	init(); // true	
});

</script>