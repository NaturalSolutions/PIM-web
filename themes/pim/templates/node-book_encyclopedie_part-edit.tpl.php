<?php 
/***************************************************************************/
/***************************************************************************/
/*                 PAGE EDITION ENCYCLOPEDIE PART                          */
/*                                                                         */
/***************************************************************************/
/*********************************  ****************************************/
/*********************************  ****************************************/
global $base_url, $language, $node;
?>

<!-- on alterer qq variables -->
<?php $form['options']['#collapsed'] = 0; ?>

<?php if($language->language == 'fr'): ?>
	<?php $form['author']['name']['#description'] = 'Ajoutez votre nom séparé par une virgule'; ?>
<?php else: ?>
	<?php $form['author']['name']['#description'] = 'Add your name here, please use comma separator for multiple authors'; ?>
<?php endif; ?>	


<?php print drupal_render($form['title']); ?>
<?php print drupal_render($form['field_encylop_author']); ?>


<div class='contenerRelatif'>
	<span class='addLegend' title='<?php if($language->language == 'fr') echo 'Ajouter une légende'; else echo 'Add a legend'; ?>'>L</span>
	<span class='addEncadre' title='<?php if($language->language == 'fr') echo 'Ajouter un encadré'; else echo 'Add a block'; ?>'><?php if($language->language == 'fr') echo 'E'; else echo 'B'; ?></span>
	<span class='addSection' title='<?php if($language->language == 'fr') echo 'Ajouter un chapitre'; else echo 'Add a chapter'; ?>'>C</span>
	<?php print drupal_render($form['field_encylop_body']); ?>
</div>



<?php print drupal_render($form['options']); ?>
<?php print drupal_render($form['buttons']); ?>
<?php print drupal_render($form); ?>

<script>
$( document ).ready(function() {
// Handler for .ready() called.

	//Pour faire correspondre l'etat "Promu en page d'accueil" avec "A valider" et l'état "Epinglé en haut des listes" avec "Terminé"
	$('#edit-avalider-wrapper input').change(function(){	
		if($(this).attr('checked') == true) $('#edit-promote-wrapper input').attr('checked',true);
		else $('#edit-promote-wrapper input').attr('checked',false);
	});
	$('#edit-termine-wrapper input').change(function(){
		if($(this).attr('checked') == true) $('#edit-sticky-wrapper input').attr('checked',true);
		else $('#edit-sticky-wrapper input').attr('checked',false);
	});

	//Pour forcer la selection de format d'entre sur PiM Atlas
	setTimeout(function(){
	$('.wysiwyg.wysiwyg-format-6').each(function(){
		$(this).change();
		$('.addEncadre, .addSection, .addLegend').fadeIn();
	});
	},1000);

	//language, traduction
	var lang = '<?php echo $language->language; ?>';
	if(lang == 'en'){

		$('div#edit-field-encylop-author-0-value-wrapper label').text('Author(s):');

		var inputBrouillon = $('#edit-brouillon-wrapper input');
		var inputAvalider = $('#edit-avalider-wrapper input');
		var inputTerminer = $('#edit-termine-wrapper input');
		$('#edit-brouillon-wrapper label').empty().append(inputBrouillon).append('<span> Draft</span>');
		$('#edit-avalider-wrapper label').empty().append(inputAvalider).append('<span> To be validated</span>');
		$('#edit-termine-wrapper label').empty().append(inputTerminer).append('<span> Complete</span>');

	}

	// si on click sur ajouter un encadre ou une section ou legend
	$('.addEncadre, .addSection, .addLegend').click(function(){ 	


		if( $(this).hasClass( "addLegend" ) ){ 

			if(lang == 'fr') {
				var textLegend = prompt("Légende : ", "Votre légende ici");
			}else{
				var textLegend = prompt("Legend : ", "Your legend here");
			}
			
			var legend = "<p style='padding-left: 30px;' data-mce-style='padding-left: 30px;'><span style='font-size: small;'><em>"+textLegend+"</em></span></p>";
			if(textLegend) $( this ).nextAll('.form-item').find('iframe').contents().find( ".cke_show_borders" ).append(legend);

		}else if($(this).hasClass( "addSection" )) {

			if(lang == 'fr'){
				var titre = prompt("Titre : ", "Votre titre ici");
				var texte = prompt("Texte : ", "Votre texte ici");
				var auteur = prompt("Auteur : ", "Nom de l'auteur");
			}else{
				var titre = prompt("Title : ", "Your title here");
				var texte = prompt("Text : ", "Your text here");
				var auteur = prompt("Author : ", "Name of the author");
			}
			
			var section = "<p><strong>"+titre+"</strong></p><p>"+texte+"<br/><em style='color:#4779C0;'>"+auteur+"</em></p>";   					    	
	  	    if(texte || titre) $( this ).nextAll('.form-item').find('iframe').contents().find( ".cke_show_borders" ).append(section);	    	
     	
     	}
     	else if($(this).hasClass( "addEncadre" )) {

			if(lang == 'fr'){
				var titre = prompt("Titre : ", "Votre titre ici");
				var texte = prompt("Texte : ", "Votre texte ici");
				var auteur = prompt("Auteur : ", "Nom de l'auteur");
			}else{
				var titre = prompt("Title : ", "Your title here");
				var texte = prompt("Text : ", "Your text here");
				var auteur = prompt("Author : ", "Name of the author");
			}

			
			var encadre = "<p class='encadreStyle'><strong>"+titre+"</strong><br/>"+texte+"<br/><em>"+auteur+"</em></p><p>&nbsp;</p><p>&nbsp;</p>";   		
			
			if(texte || titre) $( this ).nextAll('.form-item').find('iframe').contents().find( ".cke_show_borders" ).append(encadre);
	    	if(texte || titre) $( this ).nextAll('.form-item').find('iframe').contents().find( ".encadreStyle" ).css('backgroundColor','orange').css('padding','6px').css('border','1px solid black');
     	
     	}
	});


}); 
</script>