<?php 
/***************************************************************************/
/***************************************************************************/
/*                        PAGE EDITION NORMES                              */
/*                                                                         */
/***************************************************************************/
/*********************************  ****************************************/
/*********************************  ****************************************/
global $base_url, $language, $node;
?>




<?php print drupal_render($form); ?>
<?php print drupal_render($form['options']); ?>
<?php print drupal_render($form['buttons']); ?>

<script>
$( document ).ready(function() {
// Handler for .ready() called.

	//Pour forcer la selection de format d'entre sur PiM Atlas
	setTimeout(function(){
	$('.wysiwyg.wysiwyg-format-6').each(function(){
		$(this).change();
		//$('.addEncadre, .addSection, .addLegend').fadeIn();
	});
	},1000);


}); 
</script>