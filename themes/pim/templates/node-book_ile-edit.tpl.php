<?php 
/***************************************************************************/
/***************************************************************************/
/*                        PAGE EDITION ILE                                 */
/*                                                                         */
/***************************************************************************/
/*********************************  ****************************************/
/*********************************  ****************************************/

global $base_url, $language, $node;
?>
<!-- recuperation de ladresse courante pr tester si on est en mode edition / visu -->
<?php $current_url = request_uri(); ?>
<?php $current_url = explode('/', $current_url ); ?>
<?php $current_url[ count($current_url) - 2]; ?>

<?php if($current_url[ count($current_url) - 2] == 'add'): ?>

	<h1 class='titleIle'><?php if($language->language == 'fr') echo "Création d'une fiche île"; else echo "[New island's factsheets ]";?></h1>

<?php elseif($current_url[ count($current_url) - 1] == 'edit'): ?>

	<h1 class='titleIle'><?php if($language->language == 'fr') echo "Édition d'une fiche île"; else echo "[Edition of island's factsheets ]";?></h1>

<?php endif; ?>

<!-- on alterer qq variables -->
<?php $form['options']['#collapsed'] = 0; ?>
<?php $form['menu']['#collapsed'] = 0; ?>

<?php if($language->language == 'fr'): ?>
	<?php $form['author']['name']['#description'] = 'Ajoutez votre nom séparé par une virgule'; ?>
<?php else: ?>
	<?php $form['author']['name']['#description'] = 'Add your name here, please use comma separator for multiple authors'; ?>
<?php endif; ?>	

<?php print drupal_render($form['field_ile_code']); ?>
<?php print drupal_render($form['title']); ?>
<?php print drupal_render($form['author']); ?>
<?php print drupal_render($form['field_ile_autor']); ?>


<?php print drupal_render($form['field_ile_image']); ?>

<?php print drupal_render($form['field_ile_id_ss_bassin']); ?>

<?php print drupal_render($form['field_ile_id_cluster']); ?>

<div class='contenerRelatif'><span class='addLegend' title='Add a legend'>L</span><span class='addEncadre' title='Add a block'>E</span><span class='addSection' title='Ajouter une section'>S</span><?php print drupal_render($form['field_ile_tab']); ?></div>

<div class='contenerRelatif'><span class='addLegend' title='Add a legend'>L</span><span class='addEncadre' title='Add a block'>E</span><span class='addSection' title='Ajouter une section'>S</span><?php print drupal_render($form['field_ile_desc_gen']); ?></div>

<div class='contenerRelatif'><span class='addLegend' title='Add a legend'>L</span><span class='addEncadre' title='Add a block'>E</span><span class='addSection' title='Ajouter une section'>S</span><?php print drupal_render($form['field_ile_connaiss']); ?></div>

<div class='contenerRelatif'><span class='addLegend' title='Add a legend'>L</span><span class='addEncadre' title='Add a block'>E</span><span class='addSection' title='Ajouter une section'>S</span><?php print drupal_render($form['field_ile_interet']); ?></div>

<div class='contenerRelatif'><span class='addLegend' title='Add a legend'>L</span><span class='addEncadre' title='Add a block'>E</span><span class='addSection' title='Ajouter une section'>S</span><?php print drupal_render($form['field_ile_pression']); ?></div>

<div class='contenerRelatif'><span class='addLegend' title='Add a legend'>L</span><span class='addEncadre' title='Add a block'>E</span><span class='addSection' title='Ajouter une section'>S</span><?php print drupal_render($form['field_ile_gest_conserv']); ?></div>

<div class='contenerRelatif'><span class='btnShowDocs' title='Add a document'>B</span><?php print drupal_render($form['field_ile_biblio']); ?></div>




<div id='dialog2' title="Documents liés à l'Atlas" class='contenerRelatif'>
	<a href='<?php echo $base_url; ?>/Bibliotheque' target='_blank'><?php if($language->language == 'fr') echo 'Voir tous les documents'; else echo 'See all documents'; ?></a>
	<?php print views_embed_view('v_atlas_display_docs', 'block_1'); ?>
</div>


<?php print drupal_render($form['field_ile_have_ss_bassin']); ?>
<?php print drupal_render($form['field_ile_have_cluster']); ?>

<?php print drupal_render($form); ?>
<?php print drupal_render($form['options']); ?>
<?php print drupal_render($form['buttons']); ?>


<script> // penser a regarder si possibilité de modifier la valeur du manu a la volé, dans la variable $form
$( document ).ready(function() {
// Handler for .ready() called.
	var lang = '<?php echo $language->language; ?>';
	var nid = document.URL;
	nid = nid.split('/');


	if(lang == 'en'){
		$('#edit-field-ile-code-value-wrapper label').text('Archipelago/Island/islet name or code:');
		$('table#field_ile_image_values > thead > tr > th').text('Map:');
		$('div#edit-field-ile-autor-0-value-wrapper label').text('Auhtor(s):');
		$('div#edit-field-ile-autor-0-value-wrapper .description').text('[Add your name with a coma separator]');
		$('div#edit-title-wrapper label').html('Title: <span class="form-required" title="This field is requier.">*</span>');
		$('div#edit-field-ile-tab-0-value-wrapper label').text('[Tab]:');
		$('div#edit-field-ile-desc-gen-0-value-wrapper label').text('General description:');
		$('div#edit-field-ile-connaiss-0-value-wrapper label').text('State of knowledge:');
		$('div#edit-field-ile-interet-0-value-wrapper label').text('Interest:');
		$('div#edit-field-ile-pression-0-value-wrapper label').text('Pressure and threats:');
		$('div#edit-field-ile-gest-conserv-0-value-wrapper label').text('Managment / Conservation:');
		$('div#edit-field-ile-biblio-0-value-wrapper label').text('Main bibliographic references:');

		var inputBrouillon = $('#edit-brouillon-wrapper input');
		var inputAvalider = $('#edit-avalider-wrapper input');
		var inputTerminer = $('#edit-termine-wrapper input');
		$('#edit-brouillon-wrapper label').empty().append(inputBrouillon).append('<span> Draft</span>');
		$('#edit-avalider-wrapper label').empty().append(inputAvalider).append('<span> To be validated</span>');
		$('#edit-termine-wrapper label').empty().append(inputTerminer).append('<span> Complete</span>');
	}
		

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

	

	//label sur champs image
	if(lang == 'fr') $('div#field-ile-image-items').before('<p class="labelFieldImages">Une carte, une photo générale et une photo aérienne</p>');
	else $('div#field-ile-image-items').before('<p class="labelFieldImages">[A map or a picture]</p>');

	//Lors de l'ajout d'une ile : add/
	if( nid[ nid.length - 1] != 'edit' ){

		nid = document.URL;
		nid = nid.split('id=');
		nid = nid[ nid.length - 1];

		//Renseigne automatiquement le champ ID_ss_bassin
		$('#edit-field-ile-id-ss-bassin-0-value').val(nid);

		//Renseigne automatiquement le champ ss_bassin
		$('select#edit-field-ile-have-ss-bassin-nid-nid').val(nid);
		
		//Renseigne automatiquement le champ url
		$('#edit-path').val('ile-atlas/'+nid+'R'+Math.floor((Math.random() * 1000) + 1));

		// Renseigner le titre avec une valeur par défaut
		$('#edit-title').val('Île :')

		//Gestion automatique du menu
		$('select#edit-menu-parent-hierarchical-select-selects-0').val('menu-menu-atlas-hp:0');
		
		
		//Pour revenir en haut de l'ecran après le .change sur le select
		$( "select#edit-menu-parent-hierarchical-select-selects-0 option[value='menu-menu-atlas-hp:0" ).change(function() {
			
			setTimeout(function(){	
				
				$('select#edit-menu-parent-hierarchical-select-selects-1').val('menu-menu-atlas-hp:13558'); 
				$("select#edit-menu-parent-hierarchical-select-selects-1 option[value='menu-menu-atlas-hp:13558']").trigger("change");
				setTimeout(function(){	$( document ).scrollTop( 0 ); },2000);
			},3000);
			
		});
		
		//Change effect pour forcer l'exection d'un bout de js qui génère les selects
		$("select#edit-menu-parent-hierarchical-select-selects-0 option[value='menu-menu-atlas-hp:0']").trigger("change");
		
	}

	//Pour forcer la selection de format d'entre sur PiM Atlas
	$('.wysiwyg.wysiwyg-format-6').each(function(){
		$(this).change();
		$('.addEncadre, .addSection, .addLegend').fadeIn();
		 
	});
	
	//Renseigne automatiqument le titre dans le champ titre de l'url pour menu
	$('#edit-submit').click(function(){

		var titre = $('#edit-title').val();
		$('#edit-menu-link-title').val(titre);

	});

	//Alteration du titre - Menu section
	if(lang == 'fr') jQuery('div.hierarchical-select-wrapper-wrapper label').text("Ajoutez votre page au Menu de l'atlas");
	else jQuery('div.hierarchical-select-wrapper-wrapper label').text("Add your page item in the Atlas menu");

	jQuery('legend.collapse-processed a').each(function(){
		if($(this).text() == 'Paramètres du menu') $(this).text('Emplacement de votre page dans le menu');
		if($(this).text() == 'Menu settings') $(this).text('Position of your page item in the menu');
	});



	/* Comment récupérer la bonne valeur du select généré ? pour automatiser encoer plus le menu */
	$('#edit-menu-weight-wrapper label').text('Position');
	if(lang == 'fr') $('#edit-menu-weight-wrapper .description').text('Dans le menu, les éléments à la position la plus élevé seront positionnés vers le bas. A l\'inverse les éléments aux positions faibles seront positionnés plus haut (Facultatif).');
	else $('#edit-menu-weight-wrapper .description').text('[In the menu items to the highest position will be positioned down. Conversely elements will be positioned at low positions above ( Optional) .]');


	// si on click sur ajouter un encadre ou une section ou legend
	$('.addEncadre, .addSection, .addLegend').click(function(){ 	


		if( $(this).hasClass( "addLegend" ) ){ 

			if(lang == 'fr') {
				var textLegend = prompt("Légende : ", "Votre légende ici");
			}else{
				var textLegend = prompt("Legend : ", "Your legend here");
			}
			
			var legend = "<p style='padding-left: 30px;' data-mce-style='padding-left: 30px;'><span style='font-size: small;'><em>"+textLegend+"</em></span></p>";
			if(textLegend) $( this ).nextAll('.form-item').find('iframe').contents().find( "p:last" ).append(legend);

		}else if($(this).hasClass( "addSection" )) {

			if(lang == 'fr'){
				var titre = prompt("Titre : ", "Votre titre ici");
				var texte = prompt("Texte : ", "Votre texte ici");
			}else{
				var titre = prompt("Title : ", "Your title here");
				var texte = prompt("Text : ", "Your text here");
			}
			
			var section = "<p style='background-color: #e1e1e1;padding: 15px;'><strong>"+titre+"</strong><br/>"+texte+"</p><p>&nbsp;</p><p>&nbsp;</p>";   					    	
	  	    if(texte || titre) $( this ).nextAll('.form-item').find('iframe').contents().find( "p:last" ).append(section);	    	
     	
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

			var encadre = "<p class='encadreStyle'> <strong>"+titre+"</strong> <br/>"+texte+"<br/> <em>"+auteur+"</em> </p><p>&nbsp;</p><p>&nbsp;</p>";   		
						    	
	  	    if(texte || titre) $( this ).nextAll('.form-item').find('iframe').contents().find( "p:last" ).append(encadre);
	    	if(texte || titre) $( this ).nextAll('.form-item').find('iframe').contents().find( ".encadreStyle" ).css('backgroundColor','orange').css('padding','6px').css('border','1px solid black');
     	
     	}
	});


}); 



</script>