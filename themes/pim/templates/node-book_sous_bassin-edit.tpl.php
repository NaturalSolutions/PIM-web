
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

<h4>1 - <?php if($language->language == 'fr') echo "Présentation et caractéristiques générales"; else echo "Presentation and general properties"; ?></h4>
<div class='indentRight1'>
	<div class='contenerRelatif'><span class='addLegend' title='Add a legend'>L</span><span class='addEncadre' title='Add a block'>E</span><span class='addSection' title='Ajouter une section'>S</span><?php print drupal_render($form['field_ss_bassin_caract_env']); ?></div>
	<div class='contenerRelatif'><span class='addLegend' title='Add a legend'>L</span><span class='addEncadre' title='Add a block'>E</span><span class='addSection' title='Ajouter une section'>S</span><?php print drupal_render($form['field_ss_bassin_context_eco']); ?></div>
	<div class='contenerRelatif'><span class='addLegend' title='Add a legend'>L</span><span class='addEncadre' title='Add a block'>E</span><span class='addSection' title='Ajouter une section'>S</span><?php print drupal_render($form['field_ss_bassin_occupation_hum']); ?></div>
</div>

<h4>2 - <?php if($language->language == 'fr') echo "Usages contemporains et pressions"; else echo "Habilities and preasure"; ?></h4>
<div class='indentRight1'>
	<div class='contenerRelatif'><span class='addLegend' title='Add a legend'>L</span><span class='addEncadre' title='Add a block'>E</span><span class='addSection' title='Ajouter une section'>S</span><?php print drupal_render($form['field_ss_bassin_dom_terrestre']); ?></div>
	<div class='contenerRelatif'><span class='addLegend' title='Add a legend'>L</span><span class='addEncadre' title='Add a block'>E</span><span class='addSection' title='Ajouter une section'>S</span><?php print drupal_render($form['field_ss_bassin_dom_marrin']); ?></div>
</div>

<h4>3 - <?php if($language->language == 'fr') echo "Etat des connaissances sur la biodiversité et enjeux de conservation"; else echo "State of data on biodiversity"; ?></h4>
<div class='indentRight1'>
	<div class='contenerRelatif'><span class='addLegend' title='Add a legend'>L</span><span class='addEncadre' title='Add a block'>E</span><span class='addSection' title='Ajouter une section'>S</span><?php print drupal_render($form['field_ss_bassin_dom_terrestre_e']); ?></div>
	<div class='contenerRelatif'><span class='addLegend' title='Add a legend'>L</span><span class='addEncadre' title='Add a block'>E</span><span class='addSection' title='Ajouter une section'>S</span><?php print drupal_render($form['field_ss_bassin_dom_marin_e']); ?></div>
</div>

<h4>4 - <?php if($language->language == 'fr') echo "Status de conservation et gestion"; else echo "State of conservation and management"; ?></h4>
<div class='indentRight1'>
	<div class='contenerRelatif'><span class='addLegend' title='Add a legend'>L</span><span class='addEncadre' title='Add a block'>E</span><span class='addSection' title='Ajouter une section'>S</span><?php print drupal_render($form['field_ss_bassin_status_conserv']); ?></div>
</div>

<h4>5 - <?php if($language->language == 'fr') echo "Stratégie de conservation"; else echo "Strategy of conservation"; ?></h4>
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


	//language
	var lang = '<?php echo $language->language; ?>';
	if(lang == 'en'){
		$('div#edit-field-ss-bassin-caract-env-0-value-wrapper label').text('1.1 General properties');
		$('div#edit-field-ss-bassin-context-eco-0-value-wrapper label').text('1.2 Ecology context');
		$('div#edit-field-ss-bassin-occupation-hum-0-value-wrapper label').text('1.3 Human occupation and history of environement');
		$('div#edit-field-ss-bassin-dom-terrestre-0-value-wrapper label').text('2.1 Terrestre domain');
		$('div#edit-field-ss-bassin-dom-marrin-0-value-wrapper label').text('2.2 Marine domain');
		$('div#edit-field-ss-bassin-dom-terrestre-e-0-value-wrapper label').text('3.1 Terrestre domain');
		$('div#edit-field-ss-bassin-dom-marin-e-0-value-wrapper label').text('3.2 Marine domain');
		$('table#field_ss_bassin_pic_of_map_values th').text('Image of map');
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
	setTimeout(function(){
		$('.wysiwyg.wysiwyg-format-6').each(function(){
			$(this).change();
			$('.addEncadre, .addSection, .addLegend').fadeIn();
		});
	},3000);	

	// parcour des iframe et ajout de la propriete scroll et ajout style si encadre
	setTimeout(function(){

		$('iframe').each(function(){
			
			$( this ).contents().find( "body" ).css('overflowY','scroll');
 			$( this ).contents().find( ".encadreStyle" ).css('backgroundColor','orange').css('padding','6px').css('border','1px solid black');
     			
		});

	},3000);
	

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