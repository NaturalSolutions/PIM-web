
<?php 
/***************************************************************************/
/***************************************************************************/
/*                        PAGE EDITION SOUS BASSINS                        */
/*                                                                         */
/***************************************************************************/
/*********************************  ****************************************/
/*********************************  ****************************************/

global $base_url, $language;
?>

<!-- recuperation de ladresse courante pr tester si on est en mode edition / visu -->
<?php $current_url = request_uri(); ?>
<?php $current_url = explode('/', $current_url ); ?>
<?php $current_url = $current_url[ count($current_url) - 1]; ?>

<!-- mettre id ici -->
<?php $nid = request_uri(); ?>
<?php $nid = explode('/', $nid ); ?>
<?php $nid = $nid[ count($nid) - 2]; ?>

<a class='addButton' title='Ajouter une ile' href="<?php echo $base_url; ?>/node/add/book-ile?id=<?php echo $nid; ?>" target='_blank'><?php if($language->language == 'fr') echo "Une ile"; else echo "A island"; ?></a>
<a class='addButton' title='Ajouter un cluster' href="<?php echo $base_url; ?>/node/add/book-cluster?id=<?php echo $nid; ?>" target='_blank'><?php if($language->language == 'fr') echo "Un cluster"; else echo "A cluster"; ?></a>

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
<?php print drupal_render($form['field_ss_bassin_pic_of_map']); ?>

<h4>1 - <?php if($language->language == 'fr') echo "Présentation et caractéristiques générales"; else echo "Presentation of the sub-basin and general characteristics"; ?></h4>
<div class='indentRight1'>
	<div class='contenerRelatif'><span class='addLegend' title='Add a legend'>L</span><span class='addEncadre' title='Add a block'>E</span><span class='addSection' title='Ajouter une section'>S</span><?php print drupal_render($form['field_ss_bassin_caract_env']); ?></div>
	<div class='contenerRelatif'><span class='addLegend' title='Add a legend'>L</span><span class='addEncadre' title='Add a block'>E</span><span class='addSection' title='Ajouter une section'>S</span><?php print drupal_render($form['field_ss_bassin_context_eco']); ?></div>
	<div class='contenerRelatif'><span class='addLegend' title='Add a legend'>L</span><span class='addEncadre' title='Add a block'>E</span><span class='addSection' title='Ajouter une section'>S</span><?php print drupal_render($form['field_ss_bassin_occupation_hum']); ?></div>
</div>

<h4>2 - <?php if($language->language == 'fr') echo "Usages contemporains et pressions"; else echo "Contemporary human activities and pressures existing on the sub-basin"; ?></h4>
<div class='indentRight1'>
	<div class='contenerRelatif'><span class='addLegend' title='Add a legend'>L</span><span class='addEncadre' title='Add a block'>E</span><span class='addSection' title='Ajouter une section'>S</span><?php print drupal_render($form['field_ss_bassin_dom_terrestre']); ?></div>
	<div class='contenerRelatif'><span class='addLegend' title='Add a legend'>L</span><span class='addEncadre' title='Add a block'>E</span><span class='addSection' title='Ajouter une section'>S</span><?php print drupal_render($form['field_ss_bassin_dom_marrin']); ?></div>
</div>

<h4>3 - <?php if($language->language == 'fr') echo "Etat des connaissances sur la biodiversité et enjeux de conservation"; else echo "State of knowledge concerning biodiversity and its conservation stakes"; ?></h4>
<div class='indentRight1'>
	<div class='contenerRelatif'><span class='addLegend' title='Add a legend'>L</span><span class='addEncadre' title='Add a block'>E</span><span class='addSection' title='Ajouter une section'>S</span><?php print drupal_render($form['field_ss_bassin_dom_terrestre_e']); ?></div>
	<div class='contenerRelatif'><span class='addLegend' title='Add a legend'>L</span><span class='addEncadre' title='Add a block'>E</span><span class='addSection' title='Ajouter une section'>S</span><?php print drupal_render($form['field_ss_bassin_dom_marin_e']); ?></div>
</div>

<h4>4 - <?php if($language->language == 'fr') echo "Status de conservation et gestion"; else echo "Protection statuses and management issues"; ?></h4>
<div class='indentRight1'>
	<div class='contenerRelatif'><span class='addLegend' title='Add a legend'>L</span><span class='addEncadre' title='Add a block'>E</span><span class='addSection' title='Ajouter une section'>S</span><?php print drupal_render($form['field_ss_bassin_status_conserv']); ?></div>
</div>

<h4>5 - <?php if($language->language == 'fr') echo "Stratégie de conservation"; else echo "Preservation strategy"; ?></h4>
<div class='indentRight1'>
	<div class='contenerRelatif'><span class='addLegend' title='Add a legend'>L</span><span class='addEncadre' title='Add a block'>E</span><span class='addSection' title='Ajouter une section'>S</span><?php print drupal_render($form['field_ss_bassin_strat_conserv']); ?></div>
</div>


<div class='indentRight1'>
	<div class='contenerRelatif'><span class='addLegend' title='Add a legend'>L</span><span class='addEncadre' title='Add a block'>E</span><span class='addSection' title='Ajouter une section'>S</span><?php print drupal_render($form['field_ss_bassin_biblio']); ?></div>
</div>


<?php print drupal_render($form['options']); ?>
<?php print drupal_render($form['buttons']); ?>



<!-- <div id="dialog">
  <label for='input1'>Titre :</label><input type="text" id="input1" value='Votre titre ici'/><br/>
  <label for='input2' id='label4TextAera'>texte :</label><TEXTAREA type="text" id="input2" value='Votre texte ici'></TEXTAREA><br/>
  <label for='input3'>Autheur :</label><input type="text" id="input3" value='Votre nom ici'/>
</div> -->

<?php print drupal_render($form); ?>

<script>



$( document ).ready(function() {
// Handler for .ready() called.


	//language, traduction
	var lang = '<?php echo $language->language; ?>';
	if(lang == 'en'){
		
		$('table#field_ss_bassin_pic_of_map_values > thead > tr > th').text('Map:');
		$('div#edit-title-wrapper label').html('Title: <span class="form-required" title="This field is requier.">*</span>');
		$('div#edit-field-ss-bassin-author-0-value-wrapper label').text('Auhtor(s):');
		$('div#edit-field-ss-bassin-author-0-value-wrapper .description').text('[Add your name with a coma separator]');
		$('div#edit-field-ss-bassin-caract-env-0-value-wrapper label').text('1.1 Environment characteristics ');
		$('div#edit-field-ss-bassin-context-eco-0-value-wrapper label').text('1.2 Ecological context  et natural heritage');
		$('div#edit-field-ss-bassin-occupation-hum-0-value-wrapper label').text('1.3 Ancient human activities and environment history');
		$('div#edit-field-ss-bassin-dom-terrestre-0-value-wrapper label').text('2.1 Terrestrial environment');
		$('div#edit-field-ss-bassin-dom-marrin-0-value-wrapper label').text('2.2 Marine environment');
		$('div#edit-field-ss-bassin-dom-terrestre-e-0-value-wrapper label').text('3.1 Terrestrial environment');
		$('div#edit-field-ss-bassin-dom-marin-e-0-value-wrapper label').text('3.2 Marine environment');

		var inputBrouillon = $('#edit-brouillon-wrapper input');
		var inputAvalider = $('#edit-avalider-wrapper input');
		var inputTerminer = $('#edit-termine-wrapper input');
		$('#edit-brouillon-wrapper label').empty().append(inputBrouillon).append('<span> Draft</span>');
		$('#edit-avalider-wrapper label').empty().append(inputAvalider).append('<span> To be validated</span>');
		$('#edit-termine-wrapper label').empty().append(inputTerminer).append('<span> Complete</span>');
	}

	// Pour remplir le champ titre	
	$('#edit-submit').click(function(){
		var titre = $('#edit-title').val();
		$('#wysiwyg-toggle-edit-body').trigger('click');
		$('#edit-body').val(titre);
		//Maj automatique du titre pour l'affichage du menu
		$('#edit-menu-link-title').val(titre);
	});

	//Pour forcer la selection de format d'entre sur PiM Atlas
	//setTimeout(function(){
	$('.wysiwyg.wysiwyg-format-6').each(function(){
		$(this).change();
		$('.addEncadre, .addSection, .addLegend').fadeIn();
	});
	//},3000);	


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
			
			var section = "<p><strong>"+titre+"</strong></p><p>"+texte+"</p>";   					    	
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

			
			var encadre = "<p class='encadreStyle'><strong>"+titre+"</strong><br/>"+texte+"<br/><em>"+auteur+"</em></p><p>&nbsp;</p><p>&nbsp;</p>";   		
			
			if(texte || titre) $( this ).nextAll('.form-item').find('iframe').contents().find( "p:last" ).append(encadre);
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