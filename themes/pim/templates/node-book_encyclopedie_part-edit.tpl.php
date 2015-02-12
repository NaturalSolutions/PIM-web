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

<!-- Tableau explicatifs d'introduction -->
<table class='infoEncyclop'>
  <tr>
    <th>Textes des sous-sections (1.1 ; 1.2 …)</th>
    <td>18 000 caractères maximum (espaces compris, sans la bibliographie),= 4 pages A4 format paysage</td>
  </tr>
  <tr>
    <th>Références bibliographiques du texte</th>
    <td>25 références bibliographiques maximum</td>
  </tr>
  <tr>
    <th>Encadrés</th>
    <td>Encadrés moyens ou longs, 3 encadrés maximum par fiche.</td>
  </tr>
</table>


<?php print drupal_render($form['title']); ?>
<?php print drupal_render($form['field_encylop_author']); ?>


<div class='contenerRelatif'>
	<span class='addLegend' title='<?php if($language->language == 'fr') echo 'Ajouter une légende'; else echo 'Add a legend'; ?>'>L</span>
	<span class='addEncadre' title='<?php if($language->language == 'fr') echo 'Ajouter un encadré'; else echo 'Add a block'; ?>'><?php if($language->language == 'fr') echo 'E'; else echo 'B'; ?></span>
	<span class='addSection' title='<?php if($language->language == 'fr') echo 'Ajouter un chapitre'; else echo 'Add a chapter'; ?>'>C</span>
	<?php print drupal_render($form['field_encylop_body']); ?>
</div>

<div class='contenerRelatif'><span class='btnShowDocs' title='Add a document'>B</span><?php print drupal_render($form['field_encyclop_biblio']); ?></div>



<div id='dialog2' title="Documents liés à l'Atlas" class='contenerRelatif'>
	<a href='<?php echo $base_url; ?>/Bibliotheque' target='_blank'><?php if($language->language == 'fr') echo 'Voir tous les documents'; else echo 'See all documents'; ?></a>
	<?php print views_embed_view('v_atlas_display_docs', 'block_1'); ?>
</div>


<?php print drupal_render($form['options']); ?>
<?php print drupal_render($form); ?>
<?php print drupal_render($form['buttons']); ?>


<span class="tooltip"><?php if($language->language == fr) echo 'Veuillez noter les modifictions effectuées'; else echo 'Please note modifictions made'; ?></span>
<p><span class='redStar'>*</span><?php if($language->language == fr) echo 'Champ obligatoire'; else echo 'Required field'; ?></p>
<div id='overlayButton'></div>

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
		$('#edit-log-wrapper label').html('Changes made<span>*</span>:');
	}else{

		$('#edit-log-wrapper label').html('Modifications effectuées<span>*</span>:');
	}

	//Deplacer le bouton enregistrer
	var saveButton = $('#edit-submit');
	var deleteButton = $('#edit-delete');

	saveButton.insertBefore('#node-form > div > fieldset:last');
	deleteButton.insertBefore('#node-form > div > fieldset:last');

	//Pour afficher un message sur la souris
	var displayMessageOnCursor = function(){

		//Active le texte sur le cursor
		var tooltip = $('.tooltip');
		tooltip.show();
		window.onmousemove = function (e) {
		    var x = e.clientX,
		        y = e.clientY;
		    tooltip.css('top', (y + 10) + 'px');
		    tooltip.css('left', (x + 10) + 'px');
		};
	}

	
	//Comportement lors survol du bouton ENREGISTRER 
	var button = $('#edit-submit');
	var overlayOnButton = $('#overlayButton');
	var combined = button.add(overlayOnButton);

	combined.mouseenter(function(){

		console.log($('#edit-log').val());
		//Si pas de message de log
		if($('#edit-log').val() == '') {

			overlayOnButton.show();
			overlayOnButton.css('cursor','not-allowed');		
			displayMessageOnCursor();
			logIsWrite = false;
			
		}
		else{
			overlayOnButton.hide();
			$('.tooltip').css('display','none');
			overlayOnButton.css('cursor','auto');
			logIsWrite = true;			

		} 
	});

	//Comportement lors qu'on quitte le focus sur le bouton ENREGISTRER 
	overlayOnButton.mouseleave(function(){
		$('.tooltip').css('display','none');			
	});


	//Rendre obligatoire le message de révision
	$('#node-form').submit(function(){
				
		if($('#edit-log').val() == '') {
			var textLogRevision = prompt("Message de log : ", "Nouvelle révision");
			$('#edit-log').val(textLogRevision); 
			return false;
		}
		else return true;		
	});

	//Lors de clics sur ajout references biblio
	$('.btnShowDocs').click(function(){
		$("#dialog2").dialog();
	 	$('#dialog2').show();
	 	
	 	$('.ui-dialog-titlebar-close').addClass('closeDialog2');
		$('div.views-field-field-document-titre-value a').each(function(){
			$( this ).attr('target','_blank');
		});
		$('.ui-dialog-titlebar-close').click(function(){

			$("#dialog2").dialog("destroy");
			
		});
	});

	//Compteur de mots
	function wordCount( val ){
	    return {
	        charactersNoSpaces : val.replace(/\s+/g, '').length,
	        characters         : val.length,
	        words              : val.match(/\S+/g).length,
	        lines              : val.split(/\r*\n/).length
	    }
	}
	
	//Compteur de mots
 	setTimeout(function(){

		$('.form-item').each(function(){

			var formItem = $(this);

			formItem.append("<p class='wordCpt'></p>");
				
			$(this).find('iframe').contents().find("body").bind( "click", function() {	

				var c = wordCount( $(this).text() );
				var cpt = "Words: "+ c.words;
				
				$(formItem).find('p.wordCpt').text(cpt);
			
			});
				
		});

	},4000);

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
				var auteur = prompt("Auteur : ", "Prénom NOM (Organisme)");
			}else{
				var titre = prompt("Title : ", "Your title here");
				var texte = prompt("Text : ", "Your text here");
				var auteur = prompt("Author : ", "Firstname Lastname (Group)");
			}

			
			var encadre = "<p class='encadreStyle'><strong>"+titre+"</strong><br/>"+texte+"<br/><em>"+auteur+"</em></p><p>&nbsp;</p><p>&nbsp;</p>";   		
			
			if(texte || titre) $( this ).nextAll('.form-item').find('iframe').contents().find( ".cke_show_borders" ).append(encadre);
	    	if(texte || titre) $( this ).nextAll('.form-item').find('iframe').contents().find( ".encadreStyle" ).css('backgroundColor','orange').css('padding','6px').css('border','1px solid black');
     	
     	}
	});


}); 
</script>