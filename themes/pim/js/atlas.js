$( document ).ready(function() {
	
		//Pour cacher le bouton vers l'atlas
		$('body.not-logged-in li.menu-13519.menu-path-node-56082 ').hide();


		
		//On va chercher le nidID dans l'url
		var pathname = window.location.pathname;
		var href = window.location.href;

	  	pathBase = href.split('/');
		
		// Script pour ajouter le menu dans la page des commentaires   ->>>>>  MARCHE EN PROD
	  	pathBase = pathBase[0] +'//'+ pathBase[1] +'/'+ pathBase[2]; 
	  	
		href = href.split('/');
		href = href[href.length - 4];

		pathname = pathname.split('/');
	  	pathname = pathname[pathname.length -1];

		var nodeID = pathname;
		var lang = $('html').attr('lang');

		var allClassBody = $('body').attr('class');
		allClassBody = allClassBody.split(' ');
		console.log(allClassBody[3]);
		console.log(allClassBody[4]);
		
        
        if(lang == 'fr') var bar = "<div class='tabs'><ul class='tabs primary clearfix'><li><a href='"+pathBase+"/node/"+nodeID+"'><span class='tab'>Voir</span></a></li><li><a href='"+pathBase+"/node/"+nodeID+"/edit'><span class='tab'>Modifier</span></a></li><li class='tab'><a href='"+pathBase+"/node/"+nodeID+"/revisions' class='tab'><span class='tab'>Révisions</span></a></li><li class='active'><a href='"+pathBase+"/comment/reply/"+nodeID+"#comment-form' class='active'><span class='tab'>Commenter</span></a></li></div>";
		else var bar = "<div class='tabs'><ul class='tabs primary clearfix'><li><a href='"+pathBase+"/en/node/"+nodeID+"'><span class='tab'>View</span></a></li><li><a href='"+pathBase+"/en/node/"+nodeID+"/edit'><span class='tab'>Edit</span></a></li><li class='tab'><a href='"+pathBase+"/en/node/"+nodeID+"/revisions' class='tab'><span class='tab'>Revisions</span></a></li><li class='active'><a href='"+pathBase+"/en/comment/reply/"+nodeID+"#comment-form' class='active'><span class='tab'>Comment</span></a></li></div>";

		$('body.section-comment #content .section').before(bar);

		
		if(nodeID == 'book-les-pictos-interet' || nodeID == 'book-les-pictos-connaissances' || nodeID == 'book-les-pictos-pression' || nodeID == 'book-les-pictos-gestions') {
			
			var action = $('form').attr('action');	        	      	      
		    //To redirect after add node picto
		    action = action+'?destination=projet-atlas/tous-les-pictogrammes';
		    $('form').attr('action', action);			

		}

		//Show hide correct field
		var changeThingsForPictoPression = function(val){
			/* Act on the event */
			//On va cherher le texte des options du select	
			var optionSelectedTexte = $('#edit-field-book-type-picto-pression-value').find("option[value='"+val+"']").text();					
			if(optionSelectedTexte == 'Impact des usages / terre' || optionSelectedTexte == 'Impact des usages / mer' || optionSelectedTexte == 'Espèces envahissantes / terrestres' || optionSelectedTexte == 'Espèces envahissantes / marines' ){
				$('#edit-field-book-value-picto-pression1-value-wrapper').show();
				$('#edit-field-book-value-picto-pression-value-wrapper').hide();
			}else{
				$('#edit-field-book-value-picto-pression-value-wrapper').show();
				$('#edit-field-book-value-picto-pression1-value-wrapper').hide();
			}

		}
		var changeThingsForPictoGestions = function(val){
			/* Act on the event */
			//On va cherher le texte des options du select	
			var optionSelectedTexte = $('#edit-field-book-type-picto-gestions-value').find("option[value='"+val+"']").text();
			
			if(optionSelectedTexte == 'Statut de protection terrestre' || optionSelectedTexte == 'Statut de protection marin' || optionSelectedTexte == "Existence d'un gestionnaire" || optionSelectedTexte == 'Comité de gestion' || optionSelectedTexte == 'Accès autorisé sur le site' || optionSelectedTexte == 'Pêche autorisée sur le site'){

				$('#edit-field-book-value-picto-gestions-value-wrapper').show();
				$('#edit-field-book-value-picto-gestions1-value-wrapper').hide();
				$('#edit-field-book-value-picto-gestions2-value-wrapper').hide();
				$('#edit-field-book-value-picto-gestions3-value-wrapper').hide();
			
			}else if(optionSelectedTexte == 'Présence du gestionnaire sur le site'){

				$('#edit-field-book-value-picto-gestions-value-wrapper').hide();
				$('#edit-field-book-value-picto-gestions1-value-wrapper').show();
				$('#edit-field-book-value-picto-gestions2-value-wrapper').hide();
				$('#edit-field-book-value-picto-gestions3-value-wrapper').hide();

			}else if(optionSelectedTexte == 'Moyens disponibles'){

				$('#edit-field-book-value-picto-gestions-value-wrapper').hide();
				$('#edit-field-book-value-picto-gestions1-value-wrapper').hide();
				$('#edit-field-book-value-picto-gestions2-value-wrapper').show();
				$('#edit-field-book-value-picto-gestions3-value-wrapper').hide();

			}else if(optionSelectedTexte == 'Plan de gestion'){

				$('#edit-field-book-value-picto-gestions-value-wrapper').hide();
				$('#edit-field-book-value-picto-gestions1-value-wrapper').hide();
				$('#edit-field-book-value-picto-gestions2-value-wrapper').hide();
				$('#edit-field-book-value-picto-gestions3-value-wrapper').show();

			}
		}

		if(allClassBody[4] == 'page-node-add-book-les-pictos-pression' || allClassBody[3] == 'node-type-book-les-pictos-pression') {
			
			changeThingsForPictoPression($('select#edit-field-book-type-picto-pression-value').val());

			$('select#edit-field-book-type-picto-pression-value').change(function(event) {
				changeThingsForPictoPression($(this).val());
			});
						
		}
		else if(allClassBody[4] == 'page-node-add-book-les-pictos-gestions' || allClassBody[3] == 'node-type-book-les-pictos-gestions') {
			
			changeThingsForPictoGestions($('select#edit-field-book-type-picto-gestions-value').val());

			$('select#edit-field-book-type-picto-gestions-value').change(function(event) {				
				changeThingsForPictoGestions($(this).val());
			});
						
		}


});