
<?php 
/***************************************************************************/
/***************************************************************************/
/*                        PAGE EDITION SOUS BASSINS                        */
/*                                                                         */
/***************************************************************************/
/*********************************  ****************************************/
/*********************************  ****************************************/

global $base_url, $language, $user;
?>

<!-- recuperation de ladresse courante pr tester si on est en mode edition / visu -->
<?php $current_url = request_uri(); ?>
<?php $current_url = explode('/', $current_url ); ?>
<?php $current_url = $current_url[ count($current_url) - 1]; ?>

<!-- mettre id ici -->
<?php $nid = request_uri(); ?>
<?php $nid = explode('/', $nid ); ?>
<?php $nid = $nid[ count($nid) - 2]; ?>

<!-- Tableau explicatifs d'introduction -->
<table class='infoSousBassin'>
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

<a class='addButton' title='Ajouter une ile' href="<?php echo $base_url; if($language->language == 'en') echo '/en'; ?>/node/add/book-ile?id=<?php echo $nid; ?>" target='_blank'><?php if($language->language == 'fr') echo "Une ile"; else echo "An island"; ?></a>
<a class='addButton' title='Ajouter un cluster' href="<?php echo $base_url; if($language->language == 'en') echo '/en'; ?>/node/add/book-cluster?id=<?php echo $nid; ?>" target='_blank'><?php if($language->language == 'fr') echo "Un cluster"; else echo "A cluster"; ?></a>

<br/>
<br/>
<!-- on alterer qq variables -->
<?php $form['options']['#collapsed'] = 0; ?>

<?php if($language->language == 'fr'): ?>
	<?php $form['author']['name']['#description'] = 'Ajoutez votre nom séparé par une virgule'; ?>
<?php else: ?>
	<?php $form['author']['name']['#description'] = 'Add your name here, please use comma separator for multiple authors'; ?>
<?php endif; ?>	


<?php print drupal_render($form['title']); ?>
<?php print drupal_render($form['author']); ?>
<?php print drupal_render($form['field_ss_bassin_author']); ?>
<?php print drupal_render($form['field_ss_bassin_responsable']); ?>

<?php print drupal_render($form['field_ss_bassin_pic_of_map']); ?>

<h4>1 - <?php if($language->language == 'fr') echo "Présentation et caractéristiques générales"; else echo "Presentation of the sub-basin and general characteristics"; ?></h4>
<div class='indentRight1'>
	<div class='contenerRelatif'><span class='addLegend' title='<?php if($language->language == 'fr') echo 'Ajouter une légende'; else echo 'Add a legend'; ?>'>L</span><span class='addEncadre' title='<?php if($language->language == 'fr') echo 'Ajouter un encadré'; else echo 'Add a block'; ?>'><?php if($language->language == 'fr') echo 'E'; else echo 'B'; ?></span><span class='addSection' title='<?php if($language->language == 'fr') echo 'Ajouter un chapitre'; else echo 'Add a chapter'; ?>'>C</span><?php print drupal_render($form['field_ss_bassin_caract_env']); ?></div>
	<div class='contenerRelatif'><span class='addLegend' title='<?php if($language->language == 'fr') echo 'Ajouter une légende'; else echo 'Add a legend'; ?>'>L</span><span class='addEncadre' title='<?php if($language->language == 'fr') echo 'Ajouter un encadré'; else echo 'Add a block'; ?>'><?php if($language->language == 'fr') echo 'E'; else echo 'B'; ?></span><span class='addSection' title='<?php if($language->language == 'fr') echo 'Ajouter un chapitre'; else echo 'Add a chapter'; ?>'>C</span><?php print drupal_render($form['field_ss_bassin_context_eco']); ?></div>
	<div class='contenerRelatif'><span class='addLegend' title='<?php if($language->language == 'fr') echo 'Ajouter une légende'; else echo 'Add a legend'; ?>'>L</span><span class='addEncadre' title='<?php if($language->language == 'fr') echo 'Ajouter un encadré'; else echo 'Add a block'; ?>'><?php if($language->language == 'fr') echo 'E'; else echo 'B'; ?></span><span class='addSection' title='<?php if($language->language == 'fr') echo 'Ajouter un chapitre'; else echo 'Add a chapter'; ?>'>C</span><?php print drupal_render($form['field_ss_bassin_occupation_hum']); ?></div>
</div>

<h4>2 - <?php if($language->language == 'fr') echo "Usages contemporains et pressions"; else echo "Contemporary human activities and pressures existing on the sub-basin"; ?></h4>
<div class='indentRight1'>
	<div class='contenerRelatif'><span class='addLegend' title='<?php if($language->language == 'fr') echo 'Ajouter une légende'; else echo 'Add a legend'; ?>'>L</span><span class='addEncadre' title='<?php if($language->language == 'fr') echo 'Ajouter un encadré'; else echo 'Add a block'; ?>'><?php if($language->language == 'fr') echo 'E'; else echo 'B'; ?></span><span class='addSection' title='<?php if($language->language == 'fr') echo 'Ajouter un chapitre'; else echo 'Add a chapter'; ?>'>C</span><?php print drupal_render($form['field_ss_bassin_dom_terrestre']); ?></div>
	<div class='contenerRelatif'><span class='addLegend' title='<?php if($language->language == 'fr') echo 'Ajouter une légende'; else echo 'Add a legend'; ?>'>L</span><span class='addEncadre' title='<?php if($language->language == 'fr') echo 'Ajouter un encadré'; else echo 'Add a block'; ?>'><?php if($language->language == 'fr') echo 'E'; else echo 'B'; ?></span><span class='addSection' title='<?php if($language->language == 'fr') echo 'Ajouter un chapitre'; else echo 'Add a chapter'; ?>'>C</span><?php print drupal_render($form['field_ss_bassin_dom_marrin']); ?></div>
</div>

<h4>3 - <?php if($language->language == 'fr') echo "Etat des connaissances sur la biodiversité et enjeux de conservation"; else echo "State of knowledge concerning biodiversity and its conservation stakes"; ?></h4>
<div class='indentRight1'>
	<div class='contenerRelatif'><span class='addLegend' title='<?php if($language->language == 'fr') echo 'Ajouter une légende'; else echo 'Add a legend'; ?>'>L</span><span class='addEncadre' title='<?php if($language->language == 'fr') echo 'Ajouter un encadré'; else echo 'Add a block'; ?>'><?php if($language->language == 'fr') echo 'E'; else echo 'B'; ?></span><span class='addSection' title='<?php if($language->language == 'fr') echo 'Ajouter un chapitre'; else echo 'Add a chapter'; ?>'>C</span><?php print drupal_render($form['field_ss_bassin_dom_terrestre_e']); ?></div>
	<div class='contenerRelatif'><span class='addLegend' title='<?php if($language->language == 'fr') echo 'Ajouter une légende'; else echo 'Add a legend'; ?>'>L</span><span class='addEncadre' title='<?php if($language->language == 'fr') echo 'Ajouter un encadré'; else echo 'Add a block'; ?>'><?php if($language->language == 'fr') echo 'E'; else echo 'B'; ?></span><span class='addSection' title='<?php if($language->language == 'fr') echo 'Ajouter un chapitre'; else echo 'Add a chapter'; ?>'>C</span><?php print drupal_render($form['field_ss_bassin_dom_marin_e']); ?></div>
</div>

<h4>4 - <?php if($language->language == 'fr') echo "Status de conservation et gestion"; else echo "Protection statuses and management issues"; ?></h4>
<div class='indentRight1'>
	<div class='contenerRelatif'><span class='addLegend' title='<?php if($language->language == 'fr') echo 'Ajouter une légende'; else echo 'Add a legend'; ?>'>L</span><span class='addEncadre' title='<?php if($language->language == 'fr') echo 'Ajouter un encadré'; else echo 'Add a block'; ?>'><?php if($language->language == 'fr') echo 'E'; else echo 'B'; ?></span><span class='addSection' title='<?php if($language->language == 'fr') echo 'Ajouter un chapitre'; else echo 'Add a chapter'; ?>'>C</span><?php print drupal_render($form['field_ss_bassin_status_conserv']); ?></div>
</div>

<h4>5 - <?php if($language->language == 'fr') echo "Stratégie de conservation"; else echo "Preservation strategy"; ?></h4>
<div class='indentRight1'>
	<div class='contenerRelatif'><span class='addLegend' title='<?php if($language->language == 'fr') echo 'Ajouter une légende'; else echo 'Add a legend'; ?>'>L</span><span class='addEncadre' title='<?php if($language->language == 'fr') echo 'Ajouter un encadré'; else echo 'Add a block'; ?>'><?php if($language->language == 'fr') echo 'E'; else echo 'B'; ?></span><span class='addSection' title='<?php if($language->language == 'fr') echo 'Ajouter un chapitre'; else echo 'Add a chapter'; ?>'>C</span><?php print drupal_render($form['field_ss_bassin_strat_conserv']); ?></div>
</div>


<div class='indentRight1'>
	<div class='contenerRelatif'><span class='btnShowDocs' title='Add a document'>B</span><?php print drupal_render($form['field_ss_bassin_biblio']); ?></div>
</div>

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


	//language, traduction
	var lang = '<?php echo $language->language; ?>';
	var logIsWrite = false;
	if(lang == 'en'){
		
		$('table#field_ss_bassin_pic_of_map_values > thead > tr > th').text('Map:');
		$('div#edit-title-wrapper label').html('Title: <span class="form-required" title="This field is requier.">*</span>');
		$('div#edit-field-ss-bassin-author-0-value-wrapper label').text('Author(s):');
		$('div#edit-field-ss-bassin-author-0-value-wrapper .description').text('Add your name with a coma separator');
		$('div#edit-field-ss-bassin-caract-env-0-value-wrapper label').text('1.1 Environment characteristics:');
		$('div#edit-field-ss-bassin-context-eco-0-value-wrapper label').text('1.2 Ecological context  et natural heritage:');
		$('div#edit-field-ss-bassin-occupation-hum-0-value-wrapper label').text('1.3 Ancient human activities and environment history:');
		$('div#edit-field-ss-bassin-dom-terrestre-0-value-wrapper label').text('2.1 Terrestrial environment:');
		$('div#edit-field-ss-bassin-dom-marrin-0-value-wrapper label').text('2.2 Marine environment:');
		$('div#edit-field-ss-bassin-dom-terrestre-e-0-value-wrapper label').text('3.1 Terrestrial environment:');
		$('div#edit-field-ss-bassin-dom-marin-e-0-value-wrapper label').text('3.2 Marine environment:');
		$('div#edit-field-ss-bassin-biblio-0-value-wrapper label').text('Main bibliographic references:');
		$('div#edit-field-ss-bassin-biblio-0-value-wrapper .description').html("Please follow these examples:<br><p><b>Books</b>: Médail F., 2008. Plantes du littoral. In : Cruon R. (ed.). <i>Le Var et sa flore, plantes rares ou protégées. </i>Naturalia Publications, Turriers : pp. 477-488. Revue : Cheylan G., 1984. Les mammifères des îles de Provence et de Méditerranée occidentale : un exemple de peuplement insulaire non équilibré ? <i>Revue d' Ecologie (Terre et Vie), </i>39 : 37-54.<br><b>Proceedings</b>: Collectif (Pasqualini M., Arnaud P. et Varaldo C., dirs.), 2003.<i> Des îles côte à côte. Histoire du peuplement des îles de l’Antiquité au Moyen Âge (Provence, Alpes-Maritimes, Ligurie, Toscane). In : </i>Actes de la table ronde de Bordighera, 12-13 décembre 1997. In : Actes de la table ronde de Bordighera, 12-13 décembre 1997. <i>Bulletin archéologique de Provence, </i>supplément 1 : 250 p.<br><b>Scientific reports</b>: Pasqualini M., 2013. Les îles d’Hyères et les îles du littoral provençal. Recherches sur leur peuplement de la Protohistoire au Moyen Âge. <i>Scientific Reports of the Port-Cros national Park,</i> 27 : 53-65.<br><b>Training period reports</b>: Fouchard M., 2013. <i>La biodiversité des petites îles de Provence-Côte d’Azur : éléments de synthèse en vue d'une stratégie régionale de conservation.</i> Rapport de stage, Master 2 Sciences de la biodiversité et écologie, Parcours professionnel Expertise écologique et gestion de la biodiversité (EEGB). Aix-Marseille Université, Aix-en-Provence, 35 p. + 1 vol. d'annexes : 22 p. + 1 CD-Rom.</p>");

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

	
	//Pour faire correspondre l'etat "Promu en page d'accueil" avec "A valider" et l'état "Epinglé en haut des listes" avec "Terminé"
	$('#edit-avalider-wrapper input').change(function(){	
		if($(this).attr('checked') == true) $('#edit-promote-wrapper input').attr('checked',true);
		else $('#edit-promote-wrapper input').attr('checked',false);
	});
	$('#edit-termine-wrapper input').change(function(){
		if($(this).attr('checked') == true) $('#edit-sticky-wrapper input').attr('checked',true);
		else $('#edit-sticky-wrapper input').attr('checked',false);
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

	// Pour remplir le champ titre	
	// $('#edit-submit').click(function(){
	// 	var titre = $('#edit-title').val();
	// 	$('#wysiwyg-toggle-edit-body').trigger('click');
	// 	$('#edit-body').val(titre);
	// 	//Maj automatique du titre pour l'affichage du menu
	// 	$('#edit-menu-link-title').val(titre);
	// });

	//Pour forcer la selection de format d'entre sur PiM Atlas
	setTimeout(function(){
	$('.wysiwyg.wysiwyg-format-6').each(function(){
		$(this).change();
		$('.addEncadre, .addSection, .addLegend').fadeIn();
	});
	},3000);	

	//Renseigne automatiqument le titre dans le champ titre de l'url pour menu
	$('#edit-submit').click(function(){

		var titre = $('#edit-title').val();
		$('#edit-menu-link-title').val(titre);

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


	//Ajout label image carte
	$('table#field_ss_bassin_pic_of_map_values thead tr th').html(' Image carte : <i>(les photos téléchargée doivent être libres de droit. Elles doivent être versée en haute définition)</i>');	
	

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
			}else{
				var titre = prompt("Title : ", "Your title here");
				var texte = prompt("Text : ", "Your text here");
			}
			
			var section = "<p><strong>"+titre+"</strong></p><p>"+texte+"</p>";   					    	
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
//End of .ready() called.

/*

//$("#dialog").dialog();
//$("#dialog").show();



Recharger iframe :
-----------------
document.getElementById(FrameID).contentDocument.location.reload(true);
ou 
$('#frameId').attr('src', function () { return $(this).contents().get(0).location.href });
*/

</script>